import React, {FC, useEffect, useState} from "react";
import axios from "axios";
import '../app/globals.css';
import {useRouter} from "next/router";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import '../../lib/fontAwesome'; // Importe o arquivo de configuração
import ModalAdd from "@/components/ModalAdd";

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

    if (!user) return <p>Loading...</p>;

    return (
        <div className="w-full h-screen bg-gray-200 flex justify-center items-center">
            <div className="w-2/3 h-2/3 shadow flex">
                <div className="w-1/4 bg-gradient-to-r from-blue-800 to-purple-600 rounded-s-lg p-3">
                    <div className="flex items-center justify-between">
                        <h2 className="text-white text-xl">{user.name}</h2>
                        <FontAwesomeIcon icon="user-plus" className="cursor-pointer hover:text-gray-200" onClick={openModal}/>
                    </div>

                </div>
                <div className="w-3/4 bg-gray-100 rounded-e-lg flex justify-center">
                    <h1 className="text-black text-xl mt-2">Bem-Vindo(a) {user.name}</h1>
                </div>
            </div>
            <ModalAdd isOpen={isModalOpen} onClose={closeModal} userId={user.id}>
                <h2 className="text-xl mb-4">Título da Modal</h2>
                <p>Conteúdo da modal...</p>
                <button
                    className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    onClick={closeModal}
                >
                    Fechar
                </button>
            </ModalAdd>
        </div>

    );
}
export default Home;
// te amo, voce é um namorado maravilhoso e um grande programador, te admiro muito , voce ,e o meu grande orgulho!