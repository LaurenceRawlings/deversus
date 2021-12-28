<script lang="ts">
    import { onMount } from 'svelte';
    import type { User } from '../types';
    let accessToken = '';
    let loading = true;
    let user: User | null = null;
    let page: 'main' = tsvscode.getState()?.page || 'main';

    $: {
        tsvscode.setState({ page });
    }

    onMount(async () => {
        window.addEventListener('message', async (event) => {
            const message = event.data;
            switch (message.type) {
                case 'token':
                    accessToken = message.value;
                    const response = await fetch(`${apiBaseUrl}/api/user`, {
                        headers: {
                            authorization: `Bearer ${accessToken}`,
                        },
                    });
                    const data = await response.json();
                    user = data.user;
                    loading = false;
            }
        });
        tsvscode.postMessage({ type: 'get-token', value: undefined });
    });
</script>

{#if loading}
    <div>loading...</div>
{:else if user}
    {#if page === 'main'}
        <h1>Logged in!</h1>
    {:else}
        <h1>Other pages</h1>
    {/if}
    <button
        on:click={() => {
            accessToken = '';
            user = null;
            tsvscode.postMessage({ type: 'logout', value: undefined });
        }}>logout</button
    >
{:else}
    <button
        on:click={() => {
            tsvscode.postMessage({ type: 'authenticate', value: undefined });
        }}>Login with GitHub</button
    >
{/if}
