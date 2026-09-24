<script lang="ts">
    import { useForm, Link, page } from '@inertiajs/svelte';
    import GuestLayout from '@/Layouts/GuestLayout.svelte';
    import { LogIn, KeyRound, Mail, Lock, Eye, EyeOff } from 'lucide-svelte';
    import type { PageProps } from '@/lib/types';

    const pageProps = $derived(page.props as unknown as PageProps);
    const site = $derived(pageProps.site);
    const appEnv = $derived(pageProps.app_env || {
        mode: 'production',
        is_production: true,
        is_demo: false,
        is_development: false,
        show_demo_credentials: false
    });

    const isProduction = $derived(Boolean(appEnv.is_production || appEnv.mode === 'production'));
    const showDemo = $derived(Boolean(appEnv.show_demo_credentials && !isProduction));

    let showPassword = $state(false);

    // Initial check to avoid pre-filling when in production
    const initialShowDemo = Boolean(
        (page.props as unknown as PageProps)?.app_env?.show_demo_credentials &&
        !(page.props as unknown as PageProps)?.app_env?.is_production &&
        (page.props as unknown as PageProps)?.app_env?.mode !== 'production'
    );

    const form = useForm({
        email: initialShowDemo ? 'admin@example.com' : '',
        password: initialShowDemo ? 'password' : '',
        remember: true,
    });

    function submit(e: Event) {
        e.preventDefault();
        form.post('/login', {
            onFinish: () => form.reset('password'),
        });
    }

    function fillDemo(emailStr: string) {
        form.email = emailStr;
        form.password = 'password';
    }
</script>

<GuestLayout title="Masuk Akun">
    <!-- Header with soft pastel badge -->
    <div class="text-center mb-6">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-100 via-purple-100 to-rose-100 dark:from-indigo-950/60 dark:via-purple-950/40 dark:to-rose-950/30 border border-indigo-200/50 dark:border-indigo-800/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mx-auto mb-3 shadow-xs">
            <LogIn class="w-5 h-5" />
        </div>
        <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Selamat Datang</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Masuk untuk mengelola sistem dan operasional bisnis</p>

        {#if !isProduction && appEnv.is_demo}
            <div class="mt-2.5 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 dark:bg-amber-950/30 text-amber-700 dark:text-amber-300 border border-amber-200/60 dark:border-amber-800/40">
                <span>Mode Demo Preview</span>
            </div>
        {:else if !isProduction && appEnv.is_development}
            <div class="mt-2.5 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-300 border border-indigo-200/60 dark:border-indigo-800/40">
                <span>Mode Pengembangan</span>
            </div>
        {/if}
    </div>

    <!-- Segmented Tab Switcher (Masuk / Daftar) -->
    {#if site?.enable_registration !== false}
        <div class="p-1 rounded-2xl bg-slate-100/90 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-800 flex items-center mb-6">
            <span class="flex-1 py-1.5 text-center text-xs font-semibold rounded-xl bg-white dark:bg-slate-900 text-indigo-600 dark:text-indigo-400 shadow-xs">
                Masuk
            </span>
            <Link
                href="/register"
                class="flex-1 py-1.5 text-center text-xs font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 rounded-xl transition-all"
            >
                Daftar Akun
            </Link>
        </div>
    {/if}

    <form onsubmit={submit} class="space-y-4">
        <!-- Email Input -->
        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-medium text-slate-700 dark:text-slate-300">
                Alamat Email <span class="text-rose-500">*</span>
            </label>
            <div class="relative rounded-xl shadow-xs transition-all">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                    <Mail class="w-4 h-4" />
                </div>
                <input
                    id="email"
                    type="email"
                    bind:value={form.email}
                    placeholder="nama@perusahaan.com"
                    required
                    class="w-full pl-10 pr-3.5 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-indigo-100/70 dark:focus:ring-indigo-950/60 focus:border-indigo-400 dark:focus:border-indigo-500 transition-all"
                    class:border-rose-400={form.errors.email}
                    class:focus:ring-rose-100={form.errors.email}
                />
            </div>
            {#if form.errors.email}
                <p class="text-xs text-rose-500 font-medium mt-1">{form.errors.email}</p>
            {/if}
        </div>

        <!-- Password Input -->
        <div class="space-y-1.5">
            <label for="password" class="block text-xs font-medium text-slate-700 dark:text-slate-300">
                Kata Sandi <span class="text-rose-500">*</span>
            </label>
            <div class="relative rounded-xl shadow-xs transition-all">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                    <Lock class="w-4 h-4" />
                </div>
                <input
                    id="password"
                    type={showPassword ? 'text' : 'password'}
                    bind:value={form.password}
                    placeholder="••••••••"
                    required
                    class="w-full pl-10 pr-10 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-indigo-100/70 dark:focus:ring-indigo-950/60 focus:border-indigo-400 dark:focus:border-indigo-500 transition-all"
                    class:border-rose-400={form.errors.password}
                    class:focus:ring-rose-100={form.errors.password}
                />
                <button
                    type="button"
                    onclick={() => (showPassword = !showPassword)}
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors cursor-pointer"
                    aria-label={showPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'}
                >
                    {#if showPassword}
                        <EyeOff class="w-4 h-4" />
                    {:else}
                        <Eye class="w-4 h-4" />
                    {/if}
                </button>
            </div>
            {#if form.errors.password}
                <p class="text-xs text-rose-500 font-medium mt-1">{form.errors.password}</p>
            {/if}
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between text-xs pt-0.5">
            <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer select-none">
                <input
                    type="checkbox"
                    bind:checked={form.remember}
                    class="w-4 h-4 rounded-md border-slate-300 dark:border-slate-700 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 transition-all cursor-pointer"
                />
                <span>Ingat saya di perangkat ini</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            disabled={form.processing}
            class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-indigo-500 via-indigo-600 to-violet-600 hover:from-indigo-600 hover:to-violet-700 text-white font-medium text-xs sm:text-sm shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.99] transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed"
        >
            <LogIn class="w-4 h-4" />
            <span>{form.processing ? 'Memproses Masuk...' : 'Masuk ke Dashboard'}</span>
        </button>
    </form>

    {#if site?.enable_registration !== false}
        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 text-center text-xs text-slate-500 dark:text-slate-400">
            Belum memiliki akun?
            <Link href="/register" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline ml-1">
                Daftar sekarang
            </Link>
        </div>
    {/if}

    <!-- Quick Demo Credentials Box: ONLY SHOWN IN LOCAL / DEVELOPMENT / DEMO MODE, STRICTLY HIDDEN IN PRODUCTION -->
    {#if showDemo}
        <div class="mt-6 p-4 bg-gradient-to-br from-indigo-50/80 via-purple-50/50 to-slate-50/80 dark:from-indigo-950/30 dark:via-purple-950/20 dark:to-slate-900/40 border border-indigo-100/90 dark:border-indigo-900/50 rounded-2xl text-xs space-y-2.5 transition-all">
            <div class="flex items-center justify-between">
                <p class="font-semibold text-indigo-900 dark:text-indigo-200 flex items-center gap-1.5 text-xs">
                    <KeyRound class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" />
                    <span>Kredensial Demo Bawaan:</span>
                </p>
                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-indigo-100/80 dark:bg-indigo-900/70 text-indigo-700 dark:text-indigo-300 border border-indigo-200/50 dark:border-indigo-800/50">
                    {appEnv.mode}
                </span>
            </div>

            <div class="space-y-1.5 text-[11px]">
                <div class="flex items-center justify-between bg-white/80 dark:bg-slate-900/80 p-2 rounded-xl border border-indigo-100/70 dark:border-indigo-900/40 shadow-2xs">
                    <div>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">Admin:</span>
                        <span class="font-mono text-slate-600 dark:text-slate-400 ml-1">admin@example.com / password</span>
                    </div>
                    <button
                        type="button"
                        onclick={() => fillDemo('admin@example.com')}
                        class="px-2.5 py-1 text-[10px] font-semibold bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg shadow-xs transition-colors cursor-pointer"
                    >
                        Gunakan
                    </button>
                </div>

                <div class="flex items-center justify-between bg-white/80 dark:bg-slate-900/80 p-2 rounded-xl border border-indigo-100/70 dark:border-indigo-900/40 shadow-2xs">
                    <div>
                        <span class="font-semibold text-slate-800 dark:text-slate-200">Pengguna:</span>
                        <span class="font-mono text-slate-600 dark:text-slate-400 ml-1">user@example.com / password</span>
                    </div>
                    <button
                        type="button"
                        onclick={() => fillDemo('user@example.com')}
                        class="px-2.5 py-1 text-[10px] font-semibold bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg shadow-xs transition-colors cursor-pointer"
                    >
                        Gunakan
                    </button>
                </div>
            </div>
        </div>
    {/if}
</GuestLayout>
