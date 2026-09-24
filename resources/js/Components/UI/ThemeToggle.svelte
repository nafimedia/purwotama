<script lang="ts">
    import { onMount } from 'svelte';
    import { Sun, Moon } from 'lucide-svelte';
    import { getTheme, setTheme, applyTheme, isDarkMode } from '@/lib/theme';

    interface Props {
        class?: string;
    }

    let { class: className = '' }: Props = $props();

    let isDark = $state(false);

    onMount(() => {
        isDark = isDarkMode();
        const savedTheme = getTheme();
        if (savedTheme === 'system') {
            setTheme(isDark ? 'dark' : 'light');
        } else {
            applyTheme(isDark ? 'dark' : 'light');
        }
    });

    function toggleTheme() {
        isDark = !isDark;
        setTheme(isDark ? 'dark' : 'light');
    }
</script>

<!-- ONE-CLICK FAST THEME TOGGLE (NO DROPDOWN / NO SYSTEM MODE) -->
<button
    type="button"
    onclick={toggleTheme}
    class={`flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200/80 bg-white/90 text-slate-700 shadow-xs transition-all duration-200 hover:border-[#714B67]/40 hover:text-[#714B67] active:scale-90 dark:border-slate-800 dark:bg-slate-900/90 dark:text-slate-300 dark:hover:border-[#714B67]/60 dark:hover:text-[#E2C3DB] ${className}`}
    title={isDark ? 'Klik untuk beralih ke Mode Terang' : 'Klik untuk beralih ke Mode Gelap'}
    aria-label={isDark ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap'}
>
    {#if isDark}
        <Sun class="h-4 w-4 text-amber-500 transition-transform duration-300 hover:rotate-45" />
    {:else}
        <Moon class="h-4 w-4 text-[#714B67] transition-transform duration-300 hover:-rotate-12" />
    {/if}
</button>
