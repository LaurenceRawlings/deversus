<script lang="ts">
    import Avatar from '../components/Avatar.svelte';
    import { createEventDispatcher } from 'svelte';
import type { User } from '../types';
    const dispatch = createEventDispatcher();

    export let user: User;
</script>

<div class="mt-16 center">
    <Avatar size={80} src={user.avatar} />
    <h2 class="mt-8">{user.name}</h2>
</div>

<button on:click={() => {
    dispatch('logout');
}}>Logout</button>

<style>
    .center {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .mt-16 {
        margin-top: 16px;
    }

    .mt-8 {
        margin-top: 8px;
    }
</style>
