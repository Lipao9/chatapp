import React, {FC, useState} from "react";
import axios from "axios";
import '../app/globals.css';
import { useRouter } from 'next/router';

const LoginRegister: FC = () => {
    const router = useRouter();

    const [formRegisterData, setformRegisterData] = useState({
        name: '',
        email: '',
        password: ''
    });

    const handleChangeRegister = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;
        setformRegisterData({
            ...formRegisterData,
            [name]: value
        })
    };

    const [formLogin, setformLogin] = useState({
        email: '',
        password: ''
    });

    const handleChangeLogin = (e: React.ChangeEvent<HTMLInputElement>) => {
        const { name, value } = e.target;
        setformLogin({
            ...formLogin,
            [name]: value
        })
    };

    const Login = async (e: React.FormEvent) => {
        e.preventDefault();

        try{
            const response = await axios.post(`http://localhost:8000/api/login`, formLogin, {
                withCredentials: true // Permite o envio de cookies e credenciais
            });

            if (response.data.status === 'success'){
                await router.push('/home');
            }
        }catch (error){
            console.error('Erro na requisição', error);
        }
    }

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const response = await axios.post(`http://localhost:8000/api/user-create`, formRegisterData);
            alert('Cadastro efetuado com sucesso!');
        } catch (error) {
            console.error('Erro na requisição:', error);
            alert('Erro ao cadastrar usuário');
        }
    };

    return (
        <div className="w-full bg-gray-200 min-h-screen flex justify-center items-center">
            <div className="flex w-1/2 shadow-2xl">
                <div className="bg-gradient-to-r from-blue-800 to-purple-600 rounded-s-xl animation-container overflow-hidden p-8 space-y-8 flex-1">
                    <h2 className="text-center text-4xl font-extrabold text-white animation-h2">
                        Bem Vindo
                    </h2>
                    <p className="text-center animation-p text-gray-200">
                        Acesse sua conta
                    </p>
                    <form method="POST" onSubmit={Login} className="space-y-6">
                        <div className="relative">
                            <input
                                placeholder="john@example.com"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-white bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500"
                                required
                                id="email"
                                name="email"
                                type="email"
                                value={formLogin.email}
                                onChange={handleChangeLogin}
                            />
                            <label className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="email">
                                Email
                            </label>
                        </div>
                        <div className="relative">
                            <input
                                placeholder="Senha"
                                className="peer h-10 w-full border-b-2 border-gray-300 text-white bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500"
                                required
                                id="password"
                                name="password"
                                type="password"
                                value={formLogin.password}
                                onChange={handleChangeLogin}
                            />
                            <label
                                className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="password"
                            >
                                Senha
                            </label>
                        </div>
                        <div className="flex justify-between">
                            <label className="flex items-center text-sm text-gray-200">
                                <input
                                    className="form-checkbox h-4 w-4 text-purple-600 bg-gray-800 border-gray-300 rounded"
                                    type="checkbox"
                                />
                                <span className="ml-2">Lembrar-me</span>
                            </label>
                            <a className="text-sm text-purple-200 hover:underline" href="#">Esqueceu sua senha?</a>
                        </div>
                        <button
                            className="w-full mt-muitos py-2 px-4 bg-purple-500 hover:bg-purple-700 rounded-md shadow-lg text-white font-semibold transition duration-200"
                            type="submit"
                        >
                            Entrar
                        </button>
                    </form>
                </div>
                <div className="bg-gray-100 rounded-e-xl animation-container overflow-hidden p-8 space-y-8 flex-1">
                    <h2 className="text-center text-4xl text-purple-500 font-extrabold animation-h2">
                        Cadastrar
                    </h2>
                    <p className="text-center text-purple-500 animation-p">
                        Crie a sua conta
                    </p>
                    <form onSubmit={handleSubmit} className="space-y-6" method="POST">
                         <div className="relative">
                            <input
                                placeholder="Aninha"
                                className="peer h-10 w-full border-b-2 border-gray-300 bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500 text-gray-400"
                                required
                                id="name"
                                name="name"
                                type="text"
                                value={formRegisterData.name}
                                onChange={handleChangeRegister}
                            />
                            <label
                                className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="email">
                                Nome
                            </label>
                        </div>
                        <div className="relative">
                            <input
                                placeholder="john@example.com"
                                className="peer h-10 w-full border-b-2 border-gray-300 bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500 text-gray-400"
                                required
                                id="email"
                                name="email"
                                type="email"
                                value={formRegisterData.email}
                                onChange={handleChangeRegister}
                            />
                            <label
                                className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="email"
                            >
                                Email
                            </label>
                        </div>
                        <div className="relative">
                            <input
                                placeholder="Senha"
                                className="peer h-10 w-full border-b-2 border-gray-300 bg-transparent placeholder-transparent focus:outline-none focus:border-purple-500 text-gray-400"
                                required
                                id="password"
                                name="password"
                                type="password"
                                value={formRegisterData.password}
                                onChange={handleChangeRegister}
                            />
                            <label
                                className="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-purple-500 peer-focus:text-sm"
                                htmlFor="password"
                            >
                                Senha
                            </label>
                        </div>
                        <button
                            className="w-full py-2 px-4 bg-purple-500 hover:bg-purple-700 rounded-md shadow-lg text-white font-semibold transition duration-200"
                            type="submit"
                        >
                            Cadastre-se
                        </button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default LoginRegister;
