<script lang="ts">
    import type { User } from "../types";

    export let size = 50;
    export let user: User;
</script>

<img on:click alt={user.name} title={user.name} style="width: {size}px; height: {size}px;" src={user.avatar} />

<style>
    img {
        border-radius: 50%;
        border: 2px solid currentColor;
        padding: 2px;
    }
</style>
