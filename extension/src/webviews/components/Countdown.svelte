<script lang="ts">
    import { onMount } from 'svelte';

    export let countdown: number;

    let degrees: number;

    $: {
        degrees = (countdown / 60) * 180;
    }

    onMount(() => {
        let x = setInterval(() => {
            countdown--;

            if (countdown <= 0) {
                clearInterval(x);
            }
        }, 1000);
    });
</script>

<div class="circle-wrap">
    <div class="countdown">
        <span>{countdown}</span>
    </div>
    <div class="circle-bg" />
    <div class="circle">
        <div class="mask full" style="transform: rotate({degrees}deg)">
            <div class="fill" style="transform: rotate({degrees}deg)" />
        </div>

        <div class="mask half">
            <div class="fill" style="transform: rotate({degrees}deg)" />
        </div>
    </div>
</div>

<style>
    .circle-wrap {
        position: relative;
        display: grid;
        justify-content: center;
        align-content: center;
        width: 50px;
        height: 50px;
    }

    .circle {
        position: absolute;
        z-index: -1;
    }

    .circle-bg {
        position: absolute;
        background-color: var(--vscode-input-background);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        z-index: -2;
    }

    .countdown {
        font-size: large;
        width: 45px;
        height: 45px;
        color: var(--vscode-editor-background);
        background: #ddd;
        border-radius: 50%;
        border: 2px solid var(--vscode-editor-background);
        display: grid;
        justify-content: center;
        align-content: center;
    }

    .circle-wrap .circle .mask,
    .circle-wrap .circle .fill {
        width: 50px;
        height: 50px;
        position: absolute;
        border-radius: 50%;
    }

    .circle-wrap .circle .mask {
        clip: rect(0px, 50px, 50px, 25px);
    }

    .circle-wrap .circle .mask .fill {
        clip: rect(0px, 25px, 50px, 0px);
        background-color: var(--vscode-editor-foreground);
    }
</style>
