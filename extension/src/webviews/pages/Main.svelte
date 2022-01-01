<script lang="ts">
    import type { Game, User } from '../types';
    import PublicGame from '../components/PublicGame.svelte';
    import Player from '../components/Player.svelte';
    import { getContext, onMount } from 'svelte';
    import { api } from '../stores';

    let testUsers: User[] = [
        {
            id: 0,
            name: 'Samuel-Roach',
            avatar: null,
            currentGameId: null,
            region: {
                iso: 'us',
                name: 'United States',
            }
        },
        {
            id: 0,
            name: 'FraserGrandfield',
            avatar: null,
            currentGameId: null,
            region: {
                iso: 'no',
                name: 'Norway',
            }
        },
        {
            id: 0,
            name: 'TobyPlunkett',
            avatar: null,
            currentGameId: null,
            region: {
                iso: 'ca',
                name: 'Canada',
            }
        },
        {
            id: 0,
            name: 'jamesreprise',
            avatar: null,
            currentGameId: null,
            region: {
                iso: 'au',
                name: 'Australia',
            }
        },
        {
            id: 0,
            name: 'SirGandhi',
            avatar: null,
            currentGameId: null,
            region: {
                iso: 'pl',
                name: 'Poland',
            }
        },
    ];

    let publicGame: Game;

    const { getUser } = getContext('user');

    onMount(async () => {
        await $api.get('/game').then(res => {
            publicGame = res.data;
        });
    });
</script>

<h1 class="mt-16">Join a Game</h1>
<h2 class="mt-8">Public game</h2>
<div class="mt-8">
    {#if publicGame}
        <PublicGame
            readOnly={getUser().currentGameId !== null}
            game={publicGame}
        />
    {/if}
</div>
<h2 class="mt-8">Custom game</h2>
<div class="mt-8 access">
    <input class="access-code" maxlength="4" title="Access Code" placeholder="CODE" />
    <button class="join">Join</button>
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
    }

    .access-code {
        text-align: center;
        letter-spacing: 1ch;
        text-transform: uppercase;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .join {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .friends {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
</style>
