<script lang="ts">
    import { createEventDispatcher, getContext } from 'svelte';
    import Avatar from "./Avatar.svelte";
    import Icon from '../components/Icon.svelte';
    import { api } from '../stores';
    const dispatch = createEventDispatcher();
    const { getUser } = getContext('user');

</script>

<div class="mt-16 center">
    <Avatar size={80} user={getUser()} />
    <span class="mt-8 name">{getUser().name}</span>
    <span class="mt-4 rank"><em>Global Ranking: <strong>#10293</strong></em></span>
    <div class="buttons mt-8">
        <button class="round" on:click={async () => console.log(await $api.get('/user'))} title="Account">
            <Icon width="20px" icon="user" />
        </button>
        <button class="round" title="Game History">
            <Icon width="20px" icon="history" />
        </button>
        <button class="round" title="Leaderboards">
            <Icon width="20px" icon="trophy" />
        </button>
        <button class="round"
            title="Log out"
            on:click={() => {
                dispatch('logout');
            }}
        >
            <Icon width="20px" icon="logout" />
        </button>
    </div>
</div>

<style>
    .buttons {
        display: flex;
        gap: 8px;
    }

    .buttons button {
        width: 28px;
        height: 28px;
    }

    .name {
        font-size: x-large;
    }

    .rank {
        font-size: medium;
    }
</style>