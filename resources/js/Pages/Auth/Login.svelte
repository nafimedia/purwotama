<script lang="ts">
    import { useForm, Link, page } from '@inertiajs/svelte';
    import GuestLayout from '@/Layouts/GuestLayout.svelte';
    import Input from '@/Components/UI/Input.svelte';
    import Button from '@/Components/UI/Button.svelte';
    import { LogIn, KeyRound, ShieldAlert } from 'lucide-svelte';
    import type { PageProps } from '@/lib/types';

    const pageProps = $derived(page.props as unknown as PageProps);
    const appEnv = $derived(pageProps.app_env || {
        mode: 'development',
        is_production: false,
        is_demo: false,
        is_development: true,
        show_demo_credentials: true
    });

    const showDemo = (page.props as unknown as PageProps).app_env?.show_demo_credentials ?? true;

    const form = useForm({
        email: showDemo ? 'admin@example.com' : '',
        password: showDemo ? 'password' : '',
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
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">Selamat Datang Kembali</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Masukan email & kata sandi untuk mengakses dashboard</p>

        {#if appEnv.is_demo}
            <div class="mt-2 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                <span>Mode Demo Preview</span>
            </div>
        {:else if appEnv.is_development}
            <div class="mt-2 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20">
                <span>Mode Development</span>
            </div>
        {/if}
    </div>

    <form onsubmit={submit} class="space-y-4">
        <Input
            id="email"
            type="email"
            label="Alamat Email"
            placeholder="nama@perusahaan.com"
            bind:value={form.email}
            error={form.errors.email}
            required
        />

        <Input
            id="password"
            type="password"
            label="Kata Sandi"
            placeholder="••••••••"
            bind:value={form.password}
            error={form.errors.password}
            required
        />

        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer">
                <input
                    type="checkbox"
                    bind:checked={form.remember}
                    class="rounded border-slate-300 dark:border-slate-800 text-indigo-600 focus:ring-indigo-500"
                />
                <span>Ingat saya</span>
            </label>
        </div>

        <Button
            type="submit"
            variant="primary"
            class="w-full"
            disabled={form.processing}
        >
            <LogIn class="w-4 h-4" />
            <span>{form.processing ? 'Memproses...' : 'Masuk ke Dashboard'}</span>
        </Button>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400">
        Belum memiliki akun?
        <Link href="/register" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
            Daftar di sini
        </Link>
    </div>

    <!-- Quick Demo Credentials Box (ONLY SHOWN IN DEVELOPMENT / DEMO MODE, HIDDEN IN PRODUCTION) -->
    {#if appEnv.show_demo_credentials}
        <div class="mt-6 p-3.5 bg-indigo-50/80 dark:bg-indigo-950/40 border border-indigo-200/80 dark:border-indigo-800/60 rounded-xl text-xs space-y-2">
            <div class="flex items-center justify-between">
                <p class="font-bold text-indigo-900 dark:text-indigo-300 flex items-center gap-1.5">
                    <KeyRound class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" /> Kredensial Demo Bawaan:
                </p>
                <span class="text-[10px] font-extrabold uppercase px-1.5 py-0.5 rounded bg-indigo-200/60 dark:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300">
                    {appEnv.mode}
                </span>
            </div>
            <div class="font-mono text-[11px] text-indigo-800 dark:text-indigo-300 space-y-1">
                <div class="flex items-center justify-between bg-white/60 dark:bg-slate-900/60 p-1.5 rounded-lg border border-indigo-100 dark:border-indigo-900/50">
                    <div>
                        <span class="font-bold text-slate-700 dark:text-slate-300">Admin:</span> admin@example.com / password
                    </div>
                    <button
                        type="button"
                        onclick={() => fillDemo('admin@example.com')}
                        class="px-2 py-0.5 text-[10px] font-bold bg-indigo-600 text-white rounded hover:bg-indigo-500 transition-colors"
                    >
                        Gunakan
                    </button>
                </div>

                <div class="flex items-center justify-between bg-white/60 dark:bg-slate-900/60 p-1.5 rounded-lg border border-indigo-100 dark:border-indigo-900/50">
                    <div>
                        <span class="font-bold text-slate-700 dark:text-slate-300">User:</span> user@example.com / password
                    </div>
                    <button
                        type="button"
                        onclick={() => fillDemo('user@example.com')}
                        class="px-2 py-0.5 text-[10px] font-bold bg-indigo-600 text-white rounded hover:bg-indigo-500 transition-colors"
                    >
                        Gunakan
                    </button>
                </div>
            </div>
        </div>
    {/if}
</GuestLayout>
