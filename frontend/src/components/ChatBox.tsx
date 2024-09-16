import React, { useState, useEffect } from 'react';

interface ChatBoxProps {
    friendId: number;
    friendName: string;
}

const ChatBox: React.FC<ChatBoxProps> = ({ friendId, friendName }) => {
    const [messages, setMessages] = useState<string[]>([]);
    const [inputMessage, setInputMessage] = useState('');
    let ws: WebSocket;

    useEffect(() => {
        // Conecte ao servidor WebSocket com a identificação do amigo selecionado
        ws = new WebSocket(`ws://localhost:8080/chat/${friendId}`);

        ws.onmessage = (event) => { 
            setMessages((prev) => [...prev, event.data]);
        };

        return () => {
            ws.close();
        };
    }, [friendId]);

    const sendMessage = () => {
        if (inputMessage.trim() !== '') {
            ws.send(inputMessage);
            setInputMessage('');
        }
    };

    return (
        <div style={{ width: '70%', padding: '10px' }}>
            <h2>Chat com {friendName}</h2>
            <div style={{ height: '300px', overflowY: 'scroll', border: '1px solid #ccc', padding: '10px' }}>
                {messages.map((msg, index) => (
                    <p key={index}>{msg}</p>
                ))}
            </div>
            <input
                type="text"
                value={inputMessage}
                onChange={(e) => setInputMessage(e.target.value)}
                style={{ width: '80%', padding: '10px', marginRight: '10px' }}
            />
            <button onClick={sendMessage}>Enviar</button>
        </div>
    );
};

export default ChatBox;
