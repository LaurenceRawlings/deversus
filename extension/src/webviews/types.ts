export type User = {
    id: number;
    name: string;
    avatar: string | null;
    currentGameId: number | null;
    region: {
        iso: string,
        name: string,
    };
};

export type Game = {
    code: string | null;
    status: string;
    countdown: number | null;
    start: number | null;
    question: string | null;
    tests: Test[] | null;
    users: User[];
};

export type Test = {
    stdin: string;
};
