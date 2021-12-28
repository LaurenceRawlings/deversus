export type User = {
    name: string;
    avatar: string;
};

export type Api = (method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE', route: string) => Promise<Response>;