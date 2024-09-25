import React, { useState, useEffect, useRef } from 'react';
import '../app/globals.css';

interface ChatBoxProps {
    userId: number;
    friendId: number;
    friendName: string;
}

const ChatBox: React.FC<ChatBoxProps> = ({ userId, friendId, friendName }) => {
    const [messages, setMessages] = useState<string[]>([]);
    const [inputMessage, setInputMessage] = useState('');
    const ws = useRef<WebSocket | null>(null);

    useEffect(() => {
        // Estabelecer conexão WebSocket com o chatId
        const socket = new WebSocket(`ws://localhost:8080?chatId=${friendId}&userId=${userId}`);
        ws.current = socket;

        socket.onopen = () => {
            console.log('Conectado ao servidor WebSocket');
        };

        socket.onmessage = (event) => {
            setMessages((prev) => [...prev, event.data]);
        };

        socket.onclose = () => {
            console.log('Conexão fechada');
        };

        socket.onerror = (error) => {
            console.error('WebSocket error:', error);
        };

        return () => {
            socket.close();
        };
    }, [friendId]);

    const sendMessage = () => {
        if (inputMessage.trim() !== '' && ws.current && ws.current.readyState === WebSocket.OPEN) {
            ws.current.send(inputMessage);
            setMessages((prev) => [...prev, `Você: ${inputMessage}`]);
            setInputMessage('');
        }
    };

    return (
        <div className="w-full">
            <h2 className="text-gray-800 py-2 px-5 text-xl">Chat com {friendName}</h2>
            <div className="overflow-y-auto border border-t-purple-600 p-5 h-99">
                {messages.map((msg, index) => (
                    <p className="text-xl text-gray-600" key={index}>{msg}</p>
                ))}
            </div>
            <div className="w-full flex justify-center">
                <input
                    type="text"
                    value={inputMessage}
                    onChange={(e) => setInputMessage(e.target.value)}
                    className="text-gray-600 px-5 py-2 rounded-md border-gray-500 w-4/5 border mx-2"
                    onKeyDown={(e) => {
                        if (e.key === 'Enter') {
                            sendMessage();
                        }
                    }}
                />
                <button onClick={sendMessage} className="bg-gradient-to-r from-blue-800 to-purple-600 w-1/5 rounded mx-2 hover:bg-gradient-to-l py-2 px-5">Enviar</button>
            </div>
        </div>
    );
};

export default ChatBox;
