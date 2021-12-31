<script lang="ts">
    import type { Lobby } from "../types";
    import Avatar from "./Avatar.svelte";
import Icon from "./Icon.svelte";

    export let lobby: Lobby;
</script>

<div class="avatars">
    {#each lobby.users as user}
        <Avatar size={50} {user} />
    {/each}
    {#each Array(8 - lobby.users.length) as _, i }
        <button class="empty round">
            <Icon width="20" icon="add" />
        </button>
    {/each}
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
</style>