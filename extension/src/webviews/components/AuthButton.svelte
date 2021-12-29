<script lang="ts">
    import Icon from "./Icon.svelte";

    export let provider = 'GitHub'

    function authenticate(provider: string) {
        tsvscode.postMessage({ type: 'authenticate', value: provider });
    }
</script>

<button
    on:click={() => {
        authenticate(provider.toLowerCase());
    }}>
    <div class="button">
        <Icon width="20px" icon={provider.toLowerCase()} />
        <span class="ml-8">Login with <strong>{provider}</strong></span>
    </div>
</button>

<style>
    .button {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>