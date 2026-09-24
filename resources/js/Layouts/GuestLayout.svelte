<script lang="ts">
    import { page, Link } from '@inertiajs/svelte';
    import ThemeToggle from '@/Components/UI/ThemeToggle.svelte';
    import { Toaster, toast } from 'svelte-sonner';
    import { ArrowLeft } from 'lucide-svelte';
    import type { Snippet } from 'svelte';
    import type { PageProps } from '@/lib/types';

    interface Props {
        title?: string;
        children?: Snippet;
    }

    let { title = 'Masuk Akun', children }: Props = $props();

    const pageProps = $derived(page.props as unknown as PageProps);
    const site = $derived(pageProps.site);
    const branding = $derived(pageProps.branding);
    const flash = $derived(pageProps.flash);

    $effect(() => {
        if (flash?.success) toast.success(flash.success);
        if (flash?.error) toast.error(flash.error);
        if (flash?.info) toast.info(flash.info);
    });
</script>

<svelte:head>
    <title>{title} - {site?.name || 'Purwotama'}</title>
    {#if branding?.admin_favicon || branding?.public_favicon}
        <link rel="icon" href={branding?.admin_favicon || branding?.public_favicon} />
    {/if}
    {#if branding?.public_apple_touch_icon}
        <link rel="apple-touch-icon" href={branding.public_apple_touch_icon} />
    {/if}
</svelte:head>

<div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-amber-50/30 via-slate-50/70 to-indigo-50/40 dark:from-[#090d14] dark:via-[#0d121c] dark:to-[#090d14] flex flex-col justify-between p-4 sm:p-6 transition-colors">
    <!-- Ambient Pastel Glowing Orbs -->
    <div class="pointer-events-none absolute -top-24 -left-24 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-gradient-to-br from-rose-200/40 to-pink-100/30 dark:from-rose-950/20 dark:to-pink-950/10 blur-3xl opacity-70"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-24 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-gradient-to-tl from-indigo-200/40 to-purple-100/30 dark:from-indigo-950/25 dark:to-purple-950/15 blur-3xl opacity-70"></div>
    <div class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 sm:w-[480px] sm:h-[480px] rounded-full bg-gradient-to-r from-teal-100/35 to-sky-100/35 dark:from-teal-950/15 dark:to-sky-950/15 blur-3xl opacity-60"></div>

    <Toaster position="top-right" richColors />

    <!-- Top Navigation Bar -->
    <header class="relative z-20 flex items-center justify-between max-w-md w-full mx-auto pt-2">
        <Link
            href="/"
            class="group inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium text-slate-600 dark:text-slate-300 bg-white/70 dark:bg-slate-900/70 hover:bg-white dark:hover:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs backdrop-blur-md transition-all hover:text-indigo-600 dark:hover:text-indigo-400 active:scale-95"
            title="Kembali ke halaman beranda"
        >
            <ArrowLeft class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" />
            <span>Beranda</span>
        </Link>

        <Link href="/" class="flex items-center gap-2 group">
            {#if branding?.admin_login_logo}
                <img src={branding.admin_login_logo} alt={site?.name || 'Purwotama'} class="h-8 object-contain transition-transform group-hover:scale-105" />
            {:else if branding?.admin_logo_dark || branding?.admin_logo_light}
                <img src={branding.admin_logo_dark} alt={site?.name || 'Purwotama'} class="h-8 object-contain hidden dark:block transition-transform group-hover:scale-105" />
                <img src={branding.admin_logo_light || branding.admin_logo_dark} alt={site?.name || 'Purwotama'} class={`h-8 object-contain ${branding.admin_logo_dark ? 'dark:hidden' : ''} transition-transform group-hover:scale-105`} />
            {:else}
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-indigo-500/20 transition-transform group-hover:scale-105">
                    {(site?.name || 'PW').slice(0, 2).toUpperCase()}
                </div>
                <span class="font-bold text-sm tracking-tight text-slate-900 dark:text-slate-100">{site?.name || 'Purwotama'}</span>
            {/if}
        </Link>

        <ThemeToggle />
    </header>

    <!-- Centered Card Container -->
    <main class="relative z-10 w-full max-w-md mx-auto my-auto py-6 sm:py-8">
        <div class="bg-white/85 dark:bg-slate-900/85 border border-slate-200/70 dark:border-slate-800/80 rounded-3xl shadow-[0_20px_50px_-15px_rgba(99,102,241,0.06),0_10px_25px_-5px_rgba(0,0,0,0.03)] dark:shadow-[0_20px_50px_-15px_rgba(0,0,0,0.5)] p-6 sm:p-8 backdrop-blur-xl transition-all">
            {#if children}
                {@render children()}
            {/if}
        </div>
    </main>

    <!-- Bottom Footer -->
    <footer class="relative z-10 text-center text-xs text-slate-400 dark:text-slate-500 pb-2">
        &copy; {new Date().getFullYear()} {site?.name || 'Purwotama'}. Seluruh hak cipta dilindungi.
    </footer>
</div>
