<script lang="ts">
    import type { User } from '../types';
    import LobbyView from '../components/LobbyView.svelte';
    import Player from '../components/Player.svelte';

    let testUsers: User[] = [
        {
            id: 0,
            name: 'Samuel-Roach',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Samuel+Roach',
        },
        {
            id: 0,
            name: 'FraserGrandfield',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Fraser+Grandfield',
        },
        {
            id: 0,
            name: 'TobyPlunkett',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Toby+Plunkett',
        },
        {
            id: 0,
            name: 'jamesreprise',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=jamesreprise',
        },
        {
            id: 0,
            name: 'SirGandhi',
            avatar: 'https://eu.ui-avatars.com/api/?background=random&name=Sir+Gandhi',
        },
    ];
</script>

<h1 class="mt-16">Join a Game</h1>
<h2 class="mt-8">Public lobby</h2>
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
<h2 class="mt-8">Custom lobby</h2>
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
    .access {
        display: flex;
        gap: 8px;
    }

    .access-code {
        text-align: center;
        letter-spacing: 1ch;
        text-transform: uppercase;
    }

    .friends {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
</style>
