import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faEllipsisH, faTrash } from '@fortawesome/free-solid-svg-icons';
import '../app/globals.css';
import { useOutsideClick } from '@/hooks/OutSideClick';

interface FriendsListProps {
    userId: number;
    onSelectFriend: (friend: Friend) => void;
}

interface Friend {
    id: number;
    name: string;
}

const FriendsList: React.FC<FriendsListProps> = ({ userId, onSelectFriend }) => {
    const [friends, setFriends] = useState<Friend[]>([]);
    const [showOptions, setShowOptions] = useState<{ [key: number]: boolean }>({});

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
    }, [userId]);

    const removeFriend = async (friendId: number) => {
        try {
            await axios.post('http://localhost:8000/api/remove-friend', {
                user_id: userId,
                friend_id: friendId
            });
            setFriends(friends.filter(friend => friend.id !== friendId)); // Remove o amigo da lista localmente
        } catch (error) {
            alert(error);
        }
    };

    const handleOptionClick = (friendId: number) => {
        setShowOptions(prev => ({ ...prev, [friendId]: !prev[friendId] }));
    };

    const handleClickOutside = () => {
        setShowOptions({});
    };

    const ref = useOutsideClick(handleClickOutside);

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
                <div
                    className="relative flex justify-between bg-gray-100 rounded-lg p-2 cursor-pointer hover:bg-gray-200 mb-2"
                    onClick={() => onSelectFriend(friend)}
                    key={friend.id}
                >
                    <div className="text-gray-900">{friend.name}</div>
                    <div className="relative" ref={ref}>
                        <FontAwesomeIcon
                            className="text-purple-600 hover:text-blue-800"
                            icon={faEllipsisH}
                            onClick={() => handleOptionClick(friend.id)}
                        />
                        {showOptions[friend.id] && (
                            <div
                                className="fixed w-44 bg-white rounded shadow-xl z-50 hover:bg-gray-200"
                                onClick={() => removeFriend(friend.id)}
                            >
                                <div className="w-full px-4 flex justify-between items-center py-2 text-red-600">
                                    <FontAwesomeIcon
                                        className="text-red-500"
                                        icon={faTrash}
                                    />
                                    <div className="text-gray-600">Remover amigo</div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            ))}
        </div>
    );
};

export default FriendsList;
