import React, {useEffect, useState} from 'react';
import axios from "axios";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

interface InviteListProps {
    userId: number;
}

const InviteList: React.FC<InviteListProps> = ({userId}) => {

    const [invites, setInvites] = useState([]);

    useEffect(() => {
        const getInvites = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/invites', {
                    params: {user_id: userId},
                    withCredentials: true // Permite o envio de cookies e credenciais
                });
                setInvites(response.data); // Atualiza o estado com os dados recebidos
            } catch (err) {
                alert(err);
            }
        };
        getInvites();
    }, [userId]); // Adiciona userId como dependência

    const responseInvite = async (inviteId: number, response: 'accept' | 'reject') => {
        try {
            const res = await axios.post('http://localhost:8000/api/respond-invite', {
                user_id: userId,
                friend_id: inviteId,
                response: response // 'accept' ou 'reject'
            }, {
                withCredentials: true
            });

            alert(res.data.mensage);
            // Atualize o estado após a resposta ou remova o convite aceito/recusado
            setInvites(invites.filter(invite => invite.id !== inviteId));
        } catch (err) {
            alert('Erro ao responder convite.');
        }
    };

    if (invites.length === 0) {
        return <div className="text-gray-500">Você não tem convites no momento.</div>;
    }

    return (
        <div>
            {invites.map((invite) => (
                <div className="flex justify-between">
                    <div
                        className="text-gray-600"
                        key={invite.id}
                    >
                        {invite.name}
                    </div>
                    <div>
                        <FontAwesomeIcon
                            className="text-purple-600 cursor-pointer hover:text-purple-400 mr-2"
                            icon="check"
                            onClick={() => responseInvite(invite.id, 'accept')}
                        />
                        <FontAwesomeIcon
                            className="text-blue-800 cursor-pointer hover:text-blue-600"
                            icon="x"
                            onClick={() => responseInvite(invite.id, 'reject')}
                        />
                    </div>
                </div>
            ))}
        </div>
    );
};

export default InviteList;
