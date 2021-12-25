import * as vscode from 'vscode';
import { SidebarProvider } from './SidebarProvider';

export function activate(context: vscode.ExtensionContext) {
	const sidebarProvider = new SidebarProvider(context.extensionUri);

	context.subscriptions.push(
		vscode.window.registerWebviewViewProvider("deversus-sidebar", sidebarProvider)
	);

	context.subscriptions.push(vscode.commands.registerCommand('deversus.helloWorld', () => {
		vscode.window.showInformationMessage('Hello World from Deversus!');
	}));
}

export function deactivate() { }
