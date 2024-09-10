import React, {useEffect, useState} from 'react';
import axios from "axios";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

interface InviteListProps {
    userId: number;
}

const InviteList: React.FC<InviteListProps> = ({ userId }) => {

    const [invites, setInvites] = useState([]);

    useEffect(() => {
        const getInvites = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/invites', {
                    params: { user_id: userId },
                    withCredentials: true // Permite o envio de cookies e credenciais
                });
                setInvites(response.data); // Atualiza o estado com os dados recebidos
            } catch (err) {
                alert(err);
            }
        };
        getInvites();
    }, [userId]); // Adiciona userId como dependência

    console.log(invites);

    return (
        // <div>
        //     <ul>
        //         {friends.map((friend) => (
        //             <li key={friend.id} onClick={() => onSelectFriend(friend)}
        //                 style={{cursor: 'pointer', padding: '10px 0'}}>
        //                 {friend.name}
        //             </li>
        //         ))}
        //     </ul>
        // </div>

        <div className="flex justify-between">
            <div className="text-gray-600">
                Nome
            </div>
            <div>
                <FontAwesomeIcon className="text-blue-800 cursor-pointer hover:text-blue-400" icon="check"/>
                <FontAwesomeIcon className="text-purple-600 cursor-pointer hover:text-purple-300 mx-4" icon="x"/>
            </div>
        </div>
    );
};

export default InviteList;
