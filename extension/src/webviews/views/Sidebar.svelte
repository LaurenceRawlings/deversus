<script lang="ts">
    import { onMount } from 'svelte';
    import Login from '../pages/Login.svelte';
    import Main from '../pages/Main.svelte';
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
                    if (accessToken !== '') {
                        const response = await api('GET', '/user', accessToken);
                        const data = await response.json();
                        user = data;
                    }
                    loading = false;
            }
        });
        tsvscode.postMessage({ type: 'get-token', value: undefined });
    });

    async function api(
        method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE',
        route: string,
        accessToken: string,
    ): Promise<Response> {
        return fetch(`${apiBaseUrl}/api${route}`, {
            method: method,
            headers: {
                // eslint-disable-next-line @typescript-eslint/naming-convention
                Accept: 'application/json;charset=UTF-8',
                Authorization: `Bearer ${accessToken}`,
            },
        });
    }

    function logout() {
        accessToken = '';
        user = null;
        tsvscode.postMessage({ type: 'logout', value: undefined });
    }
</script>

{#if loading}
    <h1>Loading...</h1>
{:else if user }
    {#if page === 'main'}
        <Main on:logout={logout} {user} />
    {:else}
        <h1>Other pages</h1>
    {/if}
{:else}
    <Login />
{/if}

<style>
</style>
