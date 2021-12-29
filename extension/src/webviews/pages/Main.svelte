<script lang="ts">
    import Avatar from '../components/Avatar.svelte';
    import { createEventDispatcher, getContext } from 'svelte';
    import type { User, Api } from '../types';
    import Icon from '../components/Icon.svelte';
    import LobbyView from '../components/LobbyView.svelte';
    import Player from '../components/Player.svelte';
    const dispatch = createEventDispatcher();
    const api: Api = getContext('api');

    export let user: User;

    let testUsers: User[] = [
        {
            name: 'Samuel-Roach',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Samuel+Roach',
        },
        {
            name: 'FraserGrandfield',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Fraser+Grandfield',
        },
        {
            name: 'TobyPlunkett',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Toby+Plunkett',
        },
        {
            name: 'jamesreprise',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=jamesreprise',
        },
        {
            name: 'SirGandhi',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Sir+Gandhi',
        },
    ];
</script>

<div class="mt-16 center">
    <Avatar size={80} {user} />
    <span class="mt-8 name">{user.name}</span>
    <div class="buttons mt-8">
        <button title="Account">
            <Icon width="20px" icon="user" />
        </button>
        <button title="Game History">
            <Icon width="20px" icon="history" />
        </button>
        <button title="Leaderboards">
            <Icon width="20px" icon="trophy" />
        </button>
        <button
            title="Log out"
            on:click={() => {
                dispatch('logout');
            }}
        >
            <Icon width="20px" icon="logout" />
        </button>
    </div>
</div>

<h1 class="mt-16">Join a Game</h1>
<h2 class="mt-16">Public lobby</h2>
<div class="mt-8">
    <LobbyView
        lobby={{
            status: 'waiting',
            accessCode: 'AAAA',
            countdown: 60,
            users: testUsers,
        }}
    />
</div>
<button class="mt-8">Join</button>
<h2 class="mt-16">Custom lobby</h2>
<div class="mt-8 access">
    <input class="access-code" maxlength="4" title="Access Code" placeholder="CODE" />
    <button>Join</button>
</div>

<div class="mt-8">
    <button>Create</button>
</div>

<h1 class="mt-16">Friends</h1>
<div class="mt-8 friends">
    {#each testUsers as friend}
        <Player user={friend} friends={true} />
    {/each}
</div>

<style>
    .buttons {
        display: flex;
        gap: 8px;
    }

    .buttons > button {
        padding: 4px;
        display: grid;
        justify-content: center;
        align-content: center;
    }

    .access {
        display: flex;
        gap: 8px;
    }

    .access-code {
        text-align: center;
        letter-spacing: 1ch;
        text-transform: uppercase;
    }

    .name {
        font-size: x-large;
    }

    .friends {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
</style>
