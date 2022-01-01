<script lang="ts">
import { getContext } from 'svelte';

    import { api } from '../stores';

    import type { Game } from '../types';
    import Avatar from './Avatar.svelte';
    import Countdown from './Countdown.svelte';
    import Icon from './Icon.svelte';

    export let game: Game;
    export let readOnly: boolean;

    const { getUser } = getContext('user');

    $: {
        if (!game.users) {
            game.users = [];
        }
    }

    async function join() {
        await $api.get('/game/join/public').then((res) => {            
            game = res.data;          
        });
        readOnly = true;
    }
</script>

<div class="avatars">
    {#each game.users as user}
        <Avatar size={50} {user} />
    {/each}

    {#if !readOnly}
        {#each Array(8 - game.users.length) as _, i}
            <button on:click={join} class="empty round" title="Join">
                <Icon width="20" icon="add" />
            </button>
        {/each}
    {:else}
        {#each Array(8 - game.users.length) as _, i}
            <div class="empty" />
        {/each}
    {/if}
    {#if game.countdown}
        <Countdown countdown={game.countdown} />
    {/if}
</div>

<style>
    .avatars {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .empty {
        background: var(--vscode-input-background);
        width: 50px;
        height: 50px;
        color: var(--vscode-input-placeholderForeground);
        border-radius: 50%;
    }
</style>
