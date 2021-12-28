import * as vscode from "vscode";
import * as polka from "polka";
import { apiBaseUrl } from "./constants";
import { TokenManager } from "./TokenManager";

export const authenticate = (fn: () => void) => {
    const app = polka();

    app.get(`/auth/:token`, async (req, res) => {
        const { token } = req.params;
        if (!token) {
            res.end(`<h1>Something went wrong</h1>`);
            return;
        }

        await TokenManager.setToken(token);
        fn();

        res.end(`<h1>Auth was successful, you can close this now</h1>`);

        (app as any).server.close();
    });

    app.listen(121212, (err: Error) => {
        if (err) {
            vscode.window.showErrorMessage(err.message);
        } else {
            vscode.commands.executeCommand("vscode.open", vscode.Uri.parse(`${apiBaseUrl}/auth/github`));
        }
    });
};