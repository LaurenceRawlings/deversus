<script lang="ts">
    function authenticate(provider: string) {
        tsvscode.postMessage({ type: 'authenticate', value: provider });
    }
</script>

<h1>De[vs]</h1>
<p>
    Welcome to Deversus, the compeitive coding game built right into VSCode. To get started login with one of the
    providers below.
</p>
<button
    on:click={() => {
        authenticate('github');
    }}>Login with GitHub</button
>
