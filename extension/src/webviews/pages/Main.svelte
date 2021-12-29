<script lang="ts">
    import Avatar from '../components/Avatar.svelte';
    import { createEventDispatcher, getContext } from 'svelte';
    import type { User, Api } from '../types';
    const dispatch = createEventDispatcher();
    const api: Api = getContext('api');

    export let user: User;
</script>

<div class="mt-16 center">
    <Avatar size={80} src={user.avatar} />
    <h2 class="mt-8">{user.name}</h2>
</div>

<button
    on:click={() => {
        dispatch('logout');
    }}>Logout</button
>
