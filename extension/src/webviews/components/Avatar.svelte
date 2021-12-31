<script lang="ts">
import { onMount } from "svelte";

    import type { User } from "../types";

    export let size = 50;
    export let user: User;

    let avatar = '';

    onMount(() => {
        if (user.avatar) {
            avatar = user.avatar;
        } else {
            avatar = `https://eu.ui-avatars.com/api/name=${user.name}`;
        }
    });
</script>

<div style="position: relative">
    <img class="avatar" alt={user.name} title={user.name} style="width: {size}px; height: {size}px;" src={avatar} />
    <img class="region" alt={user.region.name} title={user.region.name} style="width: {size/3}px;" src={`https://hatscripts.github.io/circle-flags/flags/${user.region.iso}.svg`} />
</div>

<style>
    .avatar {
        border-radius: 50%;
        border: 2px solid currentColor;
        padding: 2px;
    }

    .region {
        border-radius: 50%;
        border: 2px solid var(--vscode-editor-background);
        position: absolute;
        bottom: 0;
        right: 0;
        min-width: 20px;
    }
</style>
