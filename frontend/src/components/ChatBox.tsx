import React, { useState, useEffect, useRef } from 'react';
import '../app/globals.css';

interface ChatBoxProps {
    userId: number;
    friendId: number;
    friendName: string;
}

const ChatBox: React.FC<ChatBoxProps> = ({ userId, friendId, friendName }) => {
    const [messages, setMessages] = useState<{ userId: number; message: string }[]>([]);
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
            try {
                const parsedMessage = JSON.parse(event.data);
                setMessages((prev) => [...prev, { userId: parsedMessage.userId, message: parsedMessage.message }]);
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
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
            const messageObject = JSON.stringify({ userId, message: inputMessage });
            ws.current.send(messageObject);
            setInputMessage('');
        }
    };

    return (
        <div className="w-full flex flex-col">
            <h2 className="text-gray-800 py-2 px-5 text-xl">Chat com {friendName}</h2>
            <div className="overflow-y-auto border border-t-purple-600 p-5 grow">
                {messages.map((msg, index) => (
                    msg.userId === userId ? (
                        // Div para mensagens do usuário
                        <div className="flex justify-end mb-2" key={index}>
                            <div className="bg-gradient-to-r from-blue-800 to-purple-600 text-white p-3 rounded-lg max-w-xs">
                                <p>{msg.message}</p>
                            </div>
                        </div>
                    ) : (
                        // Div para mensagens do amigo
                        <div className="flex justify-start mb-2" key={index}>
                            <div className="bg-gray-300 text-black p-3 rounded-lg max-w-xs">
                                <p>{msg.message}</p>
                            </div>
                        </div>
                    )
                ))}
            </div>
            <div className="w-full flex justify-center py-2">
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
