<script lang="ts">
    export let size = 50;
    export let src: string;
</script>

<img on:click alt="avatar" style="width: {size}px; height: {size}px;" {src} />

<style>
    img {
        border-radius: 50%;
    }
</style>
