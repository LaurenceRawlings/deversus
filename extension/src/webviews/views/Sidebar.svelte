<script lang="ts">
    import { onMount, setContext } from 'svelte';
    import Login from '../pages/Login.svelte';
    import Main from '../pages/Main.svelte';
    import { api, echo } from '../stores';
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
                        $api.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
                        const response = await $api.get('/user');
                        const data = await response.data;
                        user = data;

                        $echo.private(`User.${user?.id}`).notification((notification: any) => {
                            console.log(notification);
                        });
                    }
                    loading = false;
            }
        });

        tsvscode.postMessage({ type: 'get-token', value: undefined });
    });

    function logout() {
        accessToken = '';
        user = null;
        tsvscode.postMessage({ type: 'logout', value: undefined });
    }

    setContext('user', { getUser: () => user });
</script>

{#if loading}
    <h1>Loading...</h1>
{:else if user}
    {#if page === 'main'}
        <Main on:logout={logout} />
    {:else}
        <h1>Other pages</h1>
    {/if}
{:else}
    <Login />
{/if}

<style>
</style>
