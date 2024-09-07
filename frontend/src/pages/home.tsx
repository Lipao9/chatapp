import React, {FC, useEffect, useState} from "react";
import axios from "axios";
import '../app/globals.css';
import {useRouter} from "next/router";

const Home: FC = () => {
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
                <div className="w-1/4 bg-gradient-to-r from-blue-800 to-purple-600 rounded-s-lg">

                </div>
                <div className="w-3/4 bg-gray-100 rounded-e-lg flex justify-center">
                    <h1 className="text-black text-xl mt-2">Bem-Vindo(a) {user.name}</h1>
                </div>
            </div>
        </div>

    );
}

export default Home;