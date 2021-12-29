<script lang="ts">
    import type { User } from "../types";
    import Avatar from "./Avatar.svelte";

    export let user: User;
    export let friends: boolean = false;
</script>

<div class="player">
    <Avatar size={40} {user} />
    <span class="ml-16">{user.name}</span>
    <div class="end player">
        {#if friends}
        <button class="ml-8">x</button>
        {/if}
    </div>
</div>

<style>
    .player {
        display: flex;
        align-items: center;
    }

    .end {
        margin-left: auto;
    }

    button {
        padding-left: 8px;
        padding-right: 8px;
    }

    span {
        font-size: medium;
    }
</style>