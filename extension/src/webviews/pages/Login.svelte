<h1>De[vs]</h1>
<p>
    Welcome to Deversus, the compeitive coding game built right into VSCode. To get started login with one of the
    providers below.
</p>
<button
    on:click={() => {
        tsvscode.postMessage({ type: 'authenticate', value: undefined });
    }}>Login with GitHub</button
>
