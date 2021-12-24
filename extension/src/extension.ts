import * as vscode from 'vscode';

export function activate(context: vscode.ExtensionContext) {
	context.subscriptions.push(vscode.commands.registerCommand('deversus.helloWorld', () => {
		vscode.window.showInformationMessage('Hello World from Deversus!');
	}));
}

export function deactivate() {}
