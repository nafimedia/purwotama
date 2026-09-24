<script lang="ts">
    import { useForm, Link, page } from '@inertiajs/svelte';
    import GuestLayout from '@/Layouts/GuestLayout.svelte';
    import { UserPlus, User, Mail, Lock, Eye, EyeOff, AlertCircle } from 'lucide-svelte';
    import type { PageProps } from '@/lib/types';

    const pageProps = $derived(page.props as unknown as PageProps);
    const site = $derived(pageProps.site);

    let showPassword = $state(false);
    let showConfirmPassword = $state(false);

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    function submit(e: Event) {
        e.preventDefault();
        form.post('/register', {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
</script>

<GuestLayout title="Daftar Akun Baru">
    <!-- Header with soft pastel badge -->
    <div class="text-center mb-6">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-100 via-teal-100 to-indigo-100 dark:from-emerald-950/60 dark:via-teal-950/40 dark:to-indigo-950/30 border border-emerald-200/50 dark:border-emerald-800/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mx-auto mb-3 shadow-xs">
            <UserPlus class="w-5 h-5" />
        </div>
        <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100">Daftar Akun Baru</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Lengkapi informasi di bawah untuk mulai menggunakan sistem</p>
    </div>

    <!-- Segmented Tab Switcher (Masuk / Daftar) -->
    <div class="p-1 rounded-2xl bg-slate-100/90 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-800 flex items-center mb-6">
        <Link
            href="/login"
            class="flex-1 py-1.5 text-center text-xs font-medium text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 rounded-xl transition-all"
        >
            Masuk
        </Link>
        <span class="flex-1 py-1.5 text-center text-xs font-semibold rounded-xl bg-white dark:bg-slate-900 text-emerald-600 dark:text-emerald-400 shadow-xs">
            Daftar Akun
        </span>
    </div>

    {#if site?.enable_registration === false}
        <div class="p-4 bg-amber-50/80 dark:bg-amber-950/30 border border-amber-200/60 dark:border-amber-800/40 rounded-2xl text-xs text-amber-800 dark:text-amber-300 space-y-2 text-center">
            <AlertCircle class="w-5 h-5 mx-auto text-amber-600 dark:text-amber-400" />
            <p class="font-medium">Pendaftaran Pengguna Ditutup</p>
            <p class="text-[11px] text-amber-700/80 dark:text-amber-400/80">Saat ini registrasi mandiri sedang tidak aktif. Silakan hubungi administrator sistem untuk pembuatan akun.</p>
            <div class="pt-2">
                <Link href="/login" class="inline-flex px-3.5 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-medium text-xs shadow-xs transition-colors">
                    Kembali ke Halaman Masuk
                </Link>
            </div>
        </div>
    {:else}
        <form onsubmit={submit} class="space-y-4">
            <!-- Full Name -->
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-medium text-slate-700 dark:text-slate-300">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <div class="relative rounded-xl shadow-xs transition-all">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                        <User class="w-4 h-4" />
                    </div>
                    <input
                        id="name"
                        type="text"
                        bind:value={form.name}
                        placeholder="Nama lengkap Anda"
                        required
                        class="w-full pl-10 pr-3.5 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-emerald-100/70 dark:focus:ring-emerald-950/60 focus:border-emerald-400 dark:focus:border-emerald-500 transition-all"
                        class:border-rose-400={form.errors.name}
                        class:focus:ring-rose-100={form.errors.name}
                    />
                </div>
                {#if form.errors.name}
                    <p class="text-xs text-rose-500 font-medium mt-1">{form.errors.name}</p>
                {/if}
            </div>

            <!-- Email Address -->
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
                        class="w-full pl-10 pr-3.5 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-emerald-100/70 dark:focus:ring-emerald-950/60 focus:border-emerald-400 dark:focus:border-emerald-500 transition-all"
                        class:border-rose-400={form.errors.email}
                        class:focus:ring-rose-100={form.errors.email}
                    />
                </div>
                {#if form.errors.email}
                    <p class="text-xs text-rose-500 font-medium mt-1">{form.errors.email}</p>
                {/if}
            </div>

            <!-- Password -->
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
                        placeholder="Minimal 8 karakter"
                        required
                        class="w-full pl-10 pr-10 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-emerald-100/70 dark:focus:ring-emerald-950/60 focus:border-emerald-400 dark:focus:border-emerald-500 transition-all"
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

            <!-- Password Confirmation -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-xs font-medium text-slate-700 dark:text-slate-300">
                    Konfirmasi Kata Sandi <span class="text-rose-500">*</span>
                </label>
                <div class="relative rounded-xl shadow-xs transition-all">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                        <Lock class="w-4 h-4" />
                    </div>
                    <input
                        id="password_confirmation"
                        type={showConfirmPassword ? 'text' : 'password'}
                        bind:value={form.password_confirmation}
                        placeholder="Ulangi kata sandi"
                        required
                        class="w-full pl-10 pr-10 py-2.5 text-xs sm:text-sm rounded-xl border bg-slate-50/50 dark:bg-slate-900/60 border-slate-200 dark:border-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:bg-white dark:focus:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-emerald-100/70 dark:focus:ring-emerald-950/60 focus:border-emerald-400 dark:focus:border-emerald-500 transition-all"
                        class:border-rose-400={form.errors.password_confirmation}
                        class:focus:ring-rose-100={form.errors.password_confirmation}
                    />
                    <button
                        type="button"
                        onclick={() => (showConfirmPassword = !showConfirmPassword)}
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors cursor-pointer"
                        aria-label={showConfirmPassword ? 'Sembunyikan konfirmasi kata sandi' : 'Tampilkan konfirmasi kata sandi'}
                    >
                        {#if showConfirmPassword}
                            <EyeOff class="w-4 h-4" />
                        {:else}
                            <Eye class="w-4 h-4" />
                        {/if}
                    </button>
                </div>
                {#if form.errors.password_confirmation}
                    <p class="text-xs text-rose-500 font-medium mt-1">{form.errors.password_confirmation}</p>
                {/if}
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                disabled={form.processing}
                class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-500 via-teal-600 to-indigo-600 hover:from-emerald-600 hover:to-indigo-700 text-white font-medium text-xs sm:text-sm shadow-md shadow-teal-500/20 hover:shadow-lg hover:shadow-teal-500/30 active:scale-[0.99] transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <UserPlus class="w-4 h-4" />
                <span>{form.processing ? 'Mendaftarkan Akun...' : 'Daftar Sekarang'}</span>
            </button>
        </form>
    {/if}

    <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 text-center text-xs text-slate-500 dark:text-slate-400">
        Sudah memiliki akun?
        <Link href="/login" class="font-semibold text-emerald-600 dark:text-emerald-400 hover:underline ml-1">
            Masuk di sini
        </Link>
    </div>
</GuestLayout>
