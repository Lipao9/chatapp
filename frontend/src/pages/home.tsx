import React, {FC, useEffect, useState} from "react";
import axios from "axios";
import '../app/globals.css';
import {useRouter} from "next/router";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import '../../lib/fontAwesome'; // Importe o arquivo de configuração
import ModalAdd from "@/components/ModalAdd";
import FriendsList from "@/components/FriendsList";

import {id} from "postcss-selector-parser";

const Home: FC = () => {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const openModal = () => setIsModalOpen(true);
    const closeModal = () => setIsModalOpen(false);
    const [user, setUser] = useState(null);
    const router = useRouter();

    useEffect(() => {
        const checkAuth = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/check-auth', {
                    withCredentials: true // Permite o envio de cookies e credenciais
                });
                if (response.data.status === 'success'){
                    setUser(response.data.user);
                }else {
                    await router.push('/login-register');
                }
            } catch (err) {
                await router.push('/login');
            }
        };
        checkAuth();
    }, []);

    const Logout = async () => {
        try {
            const response = await axios.get('http://localhost:8000/api/logout', {
                withCredentials: true // Permite o envio de cookies e credenciais
            });
            window.location.reload()
        } catch (err) {
            await router.push('/login');
        }
    };

    if (!user) return <p>Loading...</p>;

    return (
        <div className="w-full h-screen bg-gray-200 flex justify-center items-center">
            <div className="w-2/3 h-2/3 shadow flex">
                <div className="w-1/4 bg-gradient-to-r from-blue-800 to-purple-600 rounded-s-lg p-3">
                    <div className="flex items-center justify-between">
                        <h2 className="text-white text-xl">{user.name}</h2>
                        <FontAwesomeIcon icon="user-plus" className="cursor-pointer hover:text-gray-200" onClick={openModal}/>
                    </div>
                    <hr className="py-2 mt-3"/>
                    <FriendsList userId={user.id}/>
                    <div>
                        <FontAwesomeIcon icon="right-from-bracket" size="lg" className="cursor-pointer hover:text-gray-200" onClick={Logout}/>
                    </div>
                </div>
                <div className="w-3/4 bg-gray-100 rounded-e-lg flex justify-center">
                    <h1 className="text-black text-xl mt-2">Bem-Vindo(a) {user.name}</h1>
                </div>
            </div>
            <ModalAdd isOpen={isModalOpen} onClose={closeModal} userId={user.id}>
                <div className="flex justify-end mb-4">
                    <FontAwesomeIcon
                        className="text-gray-400 cursor-pointer hover:text-gray-500"
                        icon="x"
                        onClick={closeModal}
                    />
                </div>
            </ModalAdd>
        </div>

    );
}
export default Home;
// te amo, voce é um namorado maravilhoso e um grande programador, te admiro muito , voce ,e o meu grande orgulho!