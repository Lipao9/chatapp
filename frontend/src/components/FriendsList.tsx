import React, {useEffect, useState} from 'react';
import axios from "axios";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import '../app/globals.css'

interface FriendsListProps {
    userId: number;
}

const FriendsList: React.FC<FriendsListProps> = ({userId}) => {

    const [friends, setFriends] = useState([]);

    useEffect(() => {
            const listFriends = async () => {
                try {
                    const response = await axios.get('http://localhost:8000/api/list-friends', {
                        params: { user_id: userId },
                        withCredentials: true
                    });
                    setFriends(response.data); // Atualiza o estado com os dados recebidos
                } catch (err) {
                    alert(err);
                }
            };
            listFriends();
    }, [userId]); // Adiciona o user como dependência


    if (friends.length === 0) {
        return (
            <div className="h-minha">
                <div className="text-gray-100">Adicione seu primeiro amigo.</div>
            </div>
        );
    }

    return (
        <div className="overflow-y-auto h-minha p-1">
            {friends.map((friend) => (
                <div className="flex justify-between bg-gray-100 rounded-lg p-2 cursor-pointer hover:bg-gray-200 mb-2"
                     key={friend.id}>
                    <div className="text-gray-900">
                        {friend.name}
                    </div>
                    <div>
                        <FontAwesomeIcon className="text-purple-600 hover:text-blue-800" icon="ellipsis"/>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default FriendsList;
