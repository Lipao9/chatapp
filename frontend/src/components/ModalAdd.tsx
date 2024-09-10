import React, {FC, ReactNode, useEffect, useState} from 'react';
import {FontAwesomeIcon} from '@fortawesome/react-fontawesome';
import '../../lib/fontAwesome'; // Importe o arquivo de configuração
import InviteList from "@/components/InviteList";
import '../app/globals.css';
import axios from "axios";

interface ModalProps {
    isOpen: boolean;
    onClose: () => void;
    userId: number;
    children: ReactNode;
}

const Modal: FC<ModalProps> = ({isOpen, onClose, userId, children}) => {
    if (!isOpen) return null;

    useEffect(() => {
        const checkAuth = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/add-friend', {
                    withCredentials: true // Permite o envio de cookies e credenciais
                });

            } catch (err) {
                console.log('Erro:' + err);
            }
        };
        checkAuth();
    }, []);

    const [friend, setFriend] = useState('');

    const handleFriend = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFriend(event.target.value);
    };

    const AddFriend = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const response = await axios.post(`http://localhost:8000/api/add-friend`, {
                user_id: userId,
                friend: friend
            });
            alert(response.data.mensage);
        } catch (error) {
            alert(error);
        }
    };

    return (
        <div
            className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            onClick={onClose}
        >
            <div className="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm" onClick={(e) => e.stopPropagation()}>
                <form action="" onSubmit={AddFriend}>
                    <div className="flex items-center">
                        <div className="relative w-5/6">
                            <input
                                placeholder="Aninha"
                                className="peer h-10 w-full border-b-2 border-gray-300 bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500 text-gray-400"
                                required
                                id="friend"
                                name="friend"
                                type="text"
                                value={friend}
                                onChange={handleFriend}
                            />
                            <label
                                className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="email">
                                Procure um amigo...
                            </label>
                        </div>
                        <button
                            className="w-1/6 mx-3 bg-gradient-to-r hover:bg-gradient-to-l transition ease-in-out delay-150 cursor-pointer from-blue-800 to-purple-600 flex justify-center py-2 px-10 rounded"
                            type="submit"
                        >
                            Enviar
                        </button>
                    </div>
                </form>
                <div className="p-2">
                    <InviteList userId={userId}/>
                </div>
                <button className="absolute top-2 right-2 text-gray-600 hover:text-gray-900" onClick={onClose}>
                    &times;
                </button>
                {children}
            </div>
        </div>
    )
        ;
};

export default Modal;