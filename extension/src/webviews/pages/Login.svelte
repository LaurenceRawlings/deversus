<script lang="ts">
    import AuthButton from '../components/AuthButton.svelte';
    import Icon from '../components/Icon.svelte';
</script>

<div class="center mt-16">
    <Icon width="100px" icon="deversus" />
</div>
<p class="mt-16">
    Welcome to <strong>Deversus</strong>, the compeitive coding game built right into VSCode. To get started login with one of the
    providers below.
</p>

<div class="mt-16 buttons">
    <AuthButton provider="GitHub" />
    <AuthButton provider="Google" />
</div>

<style>
    .buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
</style>
