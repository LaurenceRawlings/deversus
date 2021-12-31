<script lang="ts">
    import { onMount } from 'svelte';

    import type { Lobby } from '../types';
    import Avatar from './Avatar.svelte';
    import Icon from './Icon.svelte';

    export let lobby: Lobby;

    let degrees: number;

    $: {
        degrees = (lobby.countdown / 60) * 180;
    }

    onMount(() => {
        let x = setInterval(() => {
            lobby.countdown--;

            if (lobby.countdown <= 0) {
                clearInterval(x);
            }
        }, 1000);
    });
</script>

<div class="avatars">
    {#each lobby.users as user}
        <Avatar size={50} {user} />
    {/each}
    {#each Array(8 - lobby.users.length) as _, i}
        <button class="empty round" title="Join">
            <Icon width="20" icon="add" />
        </button>
    {/each}
    <div class="circle-wrap">
        <div class="countdown">
            <span>{lobby.countdown}</span>
        </div>
        <div class="circle-bg" />
        <div class="circle">
            <div class="mask full" style="transform: rotate({degrees}deg)">
                <div class="fill" style="transform: rotate({degrees}deg)" />
            </div>

            <div class="mask half">
                <div class="fill" style="transform: rotate({degrees}deg)" />
            </div>
        </div>
    </div>
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
    }

    .circle-wrap {
        position: relative;
        display: grid;
        justify-content: center;
        align-content: center;
        width: 50px;
        height: 50px;
    }

    .circle {
        position: absolute;
        z-index: -1;
    }

    .circle-bg {
        position: absolute;
        background-color: var(--vscode-input-background);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        z-index: -2;
    }

    .countdown {
        font-size: large;
        width: 45px;
        height: 45px;
        color: var(--vscode-editor-background);
        background: #DDD;
        border-radius: 50%;
        border: 2px solid var(--vscode-editor-background);
        display: grid;
        justify-content: center;
        align-content: center;
    }

    .circle-wrap .circle .mask,
    .circle-wrap .circle .fill {
        width: 50px;
        height: 50px;
        position: absolute;
        border-radius: 50%;
    }

    .circle-wrap .circle .mask {
        clip: rect(0px, 50px, 50px, 25px);
    }

    .circle-wrap .circle .mask .fill {
        clip: rect(0px, 25px, 50px, 0px);
        background-color: var(--vscode-editor-foreground);
    }
</style>
