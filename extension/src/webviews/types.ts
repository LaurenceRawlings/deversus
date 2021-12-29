export type User = {
    name: string;
    avatar: string;
};

export type Lobby = {
    accessCode: string;
    status: string;
    countdown: number;
    users: User[];
};

export type Api = (method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE', route: string) => Promise<Response>;