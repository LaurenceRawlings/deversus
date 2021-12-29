export type User = {
    id: number;
    name: string;
    avatar: string;
};

export type Lobby = {
    accessCode: string;
    status: string;
    countdown: number;
    users: User[];
};
