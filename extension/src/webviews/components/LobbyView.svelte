<script lang="ts">
    import type { Lobby } from "../types";
    import Avatar from "./Avatar.svelte";

    export let lobby: Lobby;
</script>

<div class="avatars">
    {#each lobby.users as user}
        <Avatar size={50} {user} />
    {/each}
    {#each Array(8 - lobby.users.length) as _, i }
        <div class="empty"></div>
    {/each}
</div>

<style>
    .avatars {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .empty {
        border-radius: 50%;
        background: var(--vscode-input-background);
        width: 50px;
        height: 50px;
    }
</style>