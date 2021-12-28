import * as vscode from 'vscode';
import { SidebarProvider } from './SidebarProvider';
import { authenticate } from "./authenticate";
import { TokenManager } from './TokenManager';

export function activate(context: vscode.ExtensionContext) {
	TokenManager.globalState = context.globalState;
	const sidebarProvider = new SidebarProvider(context.extensionUri);

	context.subscriptions.push(
		vscode.window.registerWebviewViewProvider("deversus-sidebar", sidebarProvider)
	);

	context.subscriptions.push(vscode.commands.registerCommand('deversus.helloWorld', () => {
		vscode.window.showInformationMessage('Hello World from Deversus!');
	}));

	context.subscriptions.push(
		vscode.commands.registerCommand("deversus.authenticate", () => {
			authenticate(() => {});
		})
	);
}

export function deactivate() { }
