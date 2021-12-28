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
                    const response = await api("GET", "/user", message.value);
                    const data = await response.json();
                    user = data;
                    loading = false;
            }
        });
        tsvscode.postMessage({ type: 'get-token', value: undefined });
    });

    async function api(method: "GET" | "POST" | "PUT" | "PATCH" | "DELETE", route: string, accessToken: string): Promise<Response> {
        return fetch(`${apiBaseUrl}/api${route}`, {
            method: method,
            headers: {
                // eslint-disable-next-line @typescript-eslint/naming-convention
                'Accept': 'application/json;charset=UTF-8',
                'Authorization': `Bearer ${accessToken}`,
            },
        });
    }
</script>

{#if loading}
    <h1>Loading...</h1>
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
        }}>Logout</button
    >
{:else}
    <button
        on:click={() => {
            tsvscode.postMessage({ type: 'authenticate', value: undefined });
        }}>Login with GitHub</button
    >
{/if}
