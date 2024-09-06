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

    return <div>Bem-vindo, usuário {user.name}!</div>;
}

export default Home;