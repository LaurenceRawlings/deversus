import * as _vscode from "vscode";

declare global {
    const tsvscode: {
        getState: () => any;
        setState: (state: any) => void;
    };
    const apiBaseUrl: string;
}