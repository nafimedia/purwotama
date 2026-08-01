<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import {
        Sparkles,
        Zap,
        ShieldCheck,
        Layers,
        Cpu,
        Code2,
        ArrowRight,
        CheckCircle2,
        Star,
        Smartphone,
        Lock,
        Terminal,
        Globe,
        Rocket,
        LayoutDashboard,
        Newspaper,
        Calendar,
        Clock,
        Eye,
        BookOpen,
        PhoneCall,
        MessageSquare,
        User,
        Briefcase,
        Server,
        Database,
        Check,
        ExternalLink,
        Send,
        Laptop,
        GraduationCap,
        FileCheck2,
        Binary,
        ShoppingCart,
        ChevronRight,
        Calculator,
        HelpCircle,
        ChevronDown,
        Award,
        ShieldAlert,
        Clock3,
        HeartHandshake,
        ThumbsUp,
        Activity,
        Truck,
        Building2,
        CreditCard,
        Building,
        TrendingUp,
    } from 'lucide-svelte';

    import ThemeToggle from '@/Components/UI/ThemeToggle.svelte';
    import type { PageProps } from '@/lib/types';

    interface Props {
        dynamicSections?: any[];
        themeSettings?: any;
        seoSettings?: any;
        latestPosts?: any[];
        navMenu?: any;
    }

    let {
        dynamicSections = [],
        themeSettings = {},
        seoSettings = {},
        latestPosts = [],
        navMenu = null,
    }: Props = $props();

    const pageProps = $derived(page.props as unknown as PageProps);
    const authUser = $derived(pageProps.auth?.user);
    const site = $derived(pageProps.site || { name: 'Purwotama Satria', description: '' });
    const branding = $derived(pageProps.branding || {});

    // WhatsApp Base URLs
    const fairuzWaBase = 'https://wa.me/6282243317522';
    const afifWaBase = 'https://wa.me/6282134397280';

    const fairuzWa = `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20ingin%20konsultasi%20teknis%20pembuatan%20software%20di%20Purwotama%20Satria.`;
    const afifWa = `${afifWaBase}?text=Halo%20Mas%20Afif,%20saya%20tertarik%20diskusi%20kerjasama%20proyek%20di%20Purwotama%20Satria.`;

    // Portfolio Filtering State
    let activePortfolioTab = $state('all');

    const portfolios = [
        {
            id: 1,
            title: 'LMS (Learning Management System)',
            category: 'education',
            categoryLabel: 'EdTech & Edukasi',
            badge: 'Platform Pembelajaran',
            desc: 'Platform pembelajaran interaktif dengan manajemen kelas, materi video, kuis, evaluasi peserta, rekap nilai otomatis, dan sertifikat digital.',
            features: [
                'Live Progress Tracking',
                'Bank Soal & Kuis Interaktif',
                'Generate Sertifikat PDF',
                'Modul Multi-Tingkat',
            ],
            gradient: 'from-indigo-600 via-purple-600 to-pink-500',
            bgGlow: 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border-indigo-500/30',
            icon: GraduationCap,
        },
        {
            id: 2,
            title: 'Eptunu CBT (Computer Based Test)',
            category: 'education',
            categoryLabel: 'Assessment Engine',
            badge: 'Engine Ujian Online',
            desc: 'Sistem ujian berbasis komputer berkapasitas tinggi dengan proteksi anti-cheat, bank soal acak, waktu otomatis, dan pemrosesan hasil seketika.',
            features: [
                'Proteksi Anti-Curang (Tab Lock)',
                'Pengacakan Soal & Opsi',
                'Nilai Real-time & Analisis',
                'Kapasitas Ribuan Peserta',
            ],
            gradient: 'from-amber-500 via-orange-500 to-red-500',
            bgGlow: 'bg-amber-500/15 text-amber-600 dark:text-amber-300 border-amber-500/30',
            icon: FileCheck2,
        },
        {
            id: 3,
            title: 'Website Resmi UNU Purwokerto',
            category: 'education',
            categoryLabel: 'University Portal',
            badge: 'Portal Kampus Resmi',
            desc: 'Website portal resmi Universitas Nahdlatul Ulama Purwokerto terintegrasi dengan CMS berita kampus dinamis, informasi PMB, publikasi akademik, dan direktori prodi.',
            features: [
                'Portal Informasi PMB Kampus',
                'CMS Berita & Pengumuman',
                'Direktori Fakultas & Prodi',
                'High Speed & SEO Optimized',
            ],
            gradient: 'from-emerald-600 via-teal-600 to-green-500',
            bgGlow: 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-300 border-emerald-500/30',
            icon: Globe,
        },
        {
            id: 4,
            title: 'SIAKAD UNU Purwokerto (Sistem Akademik)',
            category: 'education',
            categoryLabel: 'Academic ERP Engine',
            badge: 'Sistem Akademik Kampus',
            desc: 'Sistem Informasi Akademik terpadu UNU Purwokerto untuk pengisian KRS online, transkrip nilai KHS, kurikulum, presensi dosen & mahasiswa, serta sinkronisasi PDDIKTI.',
            features: [
                'KRS & KHS Online Real-Time',
                'Manajemen Transkrip Nilai',
                'Portal Dosen & Mahasiswa',
                'Integrasi PDDIKTI Feeder',
            ],
            gradient: 'from-blue-600 via-indigo-600 to-cyan-500',
            bgGlow: 'bg-blue-500/15 text-blue-600 dark:text-blue-300 border-blue-500/30',
            icon: GraduationCap,
        },
        {
            id: 5,
            title: 'Sistem Informasi Pendataan Ternak',
            category: 'enterprise',
            categoryLabel: 'Government & ERP',
            badge: 'Manajemen Populasi',
            desc: 'Platform sistem informasi inventarisasi populasi ternak, integrasi riwayat kesehatan hewan, siklus reproduksi, dan pemetaan wilayah peternakan.',
            features: [
                'Peta Geografis Peternakan',
                'Rekam Medis & Vaksinasi',
                'Ear-Tag Barcode Tracking',
                'Laporan Populasi Daerah',
            ],
            gradient: 'from-teal-500 via-emerald-500 to-cyan-500',
            bgGlow: 'bg-teal-500/15 text-teal-600 dark:text-teal-300 border-teal-500/30',
            icon: Binary,
        },
        {
            id: 6,
            title: 'AAFI Official Website & Portal',
            category: 'corporate',
            categoryLabel: 'Corporate & Web',
            badge: 'Web Portal Resmi',
            desc: 'Website portal asosiasi profesional terintegrasi dengan CMS berita dinamis, direktori registrasi anggota, agenda kegiatan, dan galeri publikasi.',
            features: [
                'CMS Berita & Event Studio',
                'Direktori Anggota Terverifikasi',
                'Desain Modern & Responsif',
                'SEO & High Speed Score',
            ],
            gradient: 'from-purple-600 via-pink-600 to-indigo-600',
            bgGlow: 'bg-purple-500/15 text-purple-600 dark:text-purple-300 border-purple-500/30',
            icon: Globe,
        },
        {
            id: 7,
            title: 'Sistem Kasir & POS (Point of Sale)',
            category: 'pos',
            categoryLabel: 'Retail & Multi-Branch',
            badge: 'Kasir & Inventaris',
            desc: 'Sistem aplikasi kasir bisnis modern terintegrasi dengan manajemen stok multi-cabang, barcode scanner, cetak struk thermal, dan laporan laba rugi.',
            features: [
                'Multi-Cabang & Multi-Kasir',
                'Stok Barang Real-time',
                'Integrasi Printer Thermal',
                'Laporan Keuangan Otomatis',
            ],
            gradient: 'from-rose-500 via-pink-500 to-purple-600',
            bgGlow: 'bg-rose-500/15 text-rose-600 dark:text-rose-300 border-rose-500/30',
            icon: ShoppingCart,
        },
        {
            id: 8,
            title: 'SIMRS (Sistem Manajemen Rumah Sakit & Klinik)',
            category: 'health',
            categoryLabel: 'Healthcare & Medical',
            badge: 'Rekam Medis & SIMRS',
            desc: 'Sistem informasi manajemen fasilitas kesehatan terintegrasi Rekam Medis Elektronik (RME), manajemen antrean, apotek/farmasi, dan bridging API BPJS.',
            features: [
                'Rekam Medis Elektronik (RME)',
                'Bridging BPJS & SATUSEHAT',
                'Manajemen Obat & Laboratorium',
                'Kasir Pasien & Billing',
            ],
            gradient: 'from-cyan-500 via-blue-500 to-indigo-600',
            bgGlow: 'bg-cyan-500/15 text-cyan-600 dark:text-cyan-300 border-cyan-500/30',
            icon: Activity,
        },
        {
            id: 9,
            title: 'Smart Fleet & Logistics Tracking System',
            category: 'enterprise',
            categoryLabel: 'Logistics & Supply Chain',
            badge: 'Logistik & Ekspedisi',
            desc: 'Platform pelacakan armada armada pengiriman dan manifest kargo secara real-time terintegrasi GPS, rute jalan teroptimasi, dan surat jalan digital.',
            features: [
                'Live GPS & Fleet Tracking',
                'Surat Jalan Digital (e-POD)',
                'Optimalisasi Rute Pengiriman',
                'Manajemen Bahan Bakar',
            ],
            gradient: 'from-lime-500 via-emerald-500 to-teal-500',
            bgGlow: 'bg-lime-500/15 text-lime-600 dark:text-lime-300 border-lime-500/30',
            icon: Truck,
        },
        {
            id: 10,
            title: 'Hotel & Resort Management Engine',
            category: 'corporate',
            categoryLabel: 'Hospitality & Travel',
            badge: 'Sistem Perhotelan',
            desc: 'Aplikasi manajemen reservasi hotel, sistem check-in/out cepat, jadwal housekeeping, POS restoran hotel, serta analisis tingkat okupansi kamar.',
            features: [
                'Engine Reservasi Online',
                'POS Resto & Minibar',
                'Housekeeping Task Live',
                'Laporan Occupancy Rate',
            ],
            gradient: 'from-pink-600 via-rose-500 to-orange-500',
            bgGlow: 'bg-pink-500/15 text-pink-600 dark:text-pink-300 border-pink-500/30',
            icon: Building2,
        },
        {
            id: 11,
            title: 'Fintech Core Credit & Microfinance System',
            category: 'enterprise',
            categoryLabel: 'Finance & Banking',
            badge: 'Sistem Keuangan',
            desc: 'Sistem informasi akuntansi dan simpan pinjam lembaga keuangan/koperasi dengan kalkulasi bunga otomatis, jadwal angsuran, dan audit OJK ready.',
            features: [
                'Kalkulator Angsuran Pinjaman',
                'Akuntansi Neraca Otomatis',
                'Manajemen Tabungan & Deposito',
                'Laporan Keuangan Standar OJK',
            ],
            gradient: 'from-indigo-600 via-blue-600 to-cyan-500',
            bgGlow: 'bg-indigo-500/15 text-indigo-600 dark:text-indigo-300 border-indigo-500/30',
            icon: CreditCard,
        },
    ];

    const filteredPortfolios = $derived(
        activePortfolioTab === 'all' ? portfolios : portfolios.filter((p) => p.category === activePortfolioTab)
    );

    // Interactive Project Estimator State
    let selectedProjectType = $state('Web App & System ERP');
    let selectedPlatform = $state('Web Dashboard & REST API');
    let selectedComplexity = $state('Menengah (Multi-User & Reporting)');

    const estimatedBudget = $derived.by(() => {
        let base = 45000000;
        if (selectedProjectType === 'Mobile App (Android & iOS)') base += 15000000;
        if (selectedProjectType === 'EdTech LMS & CBT Engine') base += 10000000;
        if (selectedProjectType === 'Sistem Kasir & Multi-Branch POS') base += 8000000;
        if (selectedProjectType === 'SIMRS / Logistics Fleet ERP') base += 20000000;

        if (selectedComplexity === 'Kompleks (Multi-Branch, Custom API & Security)') base += 15000000;
        if (selectedComplexity === 'Enterprise High Scalability') base += 35000000;

        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(
            base
        );
    });

    const estimatorWaUrl = $derived.by(() => {
        const text = `Halo%20Purwotama%20Satria,%20saya%20ingin%20konsultasi%20estimasi%20proyek:%0A-%20Tipe:%20${encodeURIComponent(selectedProjectType)}%0A-%20Platform:%20${encodeURIComponent(selectedPlatform)}%0A-%20Skala:%20${encodeURIComponent(selectedComplexity)}%0A-%20Estimasi%20Anggaran:%20${encodeURIComponent(estimatedBudget)}.%20Bisa%20diskusi%20lebih%20lanjut?`;
        return `${fairuzWaBase}?text=${text}`;
    });

    // Accordion FAQ State
    let activeFaq = $state<number | null>(0);

    function toggleFaq(index: number) {
        activeFaq = activeFaq === index ? null : index;
    }

    const faqs = [
        {
            q: 'Mengapa memilih Purwotama Satria dibanding agency software lain?',
            a: 'Di Purwotama Satria, Anda berkonsultasi dan ditangani langsung oleh Chief Developer (Fairuz) dan Owner (Afif). Kami menjamin kode 100% milik Anda tanpa royalti tersembunyi, arsitektur modern super cepat (Laravel 13 + Svelte 5), serta garansi pendampingan pasca rilis.',
        },
        {
            q: 'Apakah source code dan database sepenuhnya menjadi hak milik saya?',
            a: 'YA, 100%! Seluruh kode sumber (source code), struktur basis data, dokumen arsitektur, dan kredensial server sepenuhnya diserahkan kepada Anda setelah proyek selesai.',
        },
        {
            q: 'Berapa lama waktu pengerjaan untuk sebuah sistem kustom?',
            a: 'Durasi pengerjaan bervariasi tergantung skala proyek. Untuk aplikasi web sedang (seperti POS Kasir / Web Portal) memerlukan waktu 2-4 minggu. Untuk sistem enterprise kompleks (ERP / LMS & CBT / SIMRS) berkisar antara 4-8 minggu dengan metode Agile Sprint transparan.',
        },
        {
            q: 'Bagaimana dengan dukungan garansi & maintenance setelah rilis?',
            a: 'Kami memberikan Garansi Pemeliharaan Gratis selama 3-6 bulan setelah peluncuran untuk memastikan sistem bebas dari bug, aman dari celah cyber, dan berjalan 100% stabil di server Anda.',
        },
        {
            q: 'Apakah bisa melakukan konsultasi atau meeting online/offline terlebih dahulu?',
            a: 'Sangat bisa! Anda dapat melakukan konsultasi gratis via Zoom, Google Meet, atau WhatsApp call bersama Afif & Fairuz untuk membedah ide dan kebutuhan teknis bisnis Anda sebelum membuat kesepakatan.',
        },
    ];

    const services = [
        {
            title: 'Custom Web & SaaS Development',
            desc: 'Pengembangan aplikasi web sesuai alur bisnis kustom berbasis Laravel 13, Svelte 5, dan Inertia.js untuk performa luar biasa.',
            icon: Laptop,
            color: 'text-indigo-600 dark:text-indigo-400 bg-indigo-500/15 border-indigo-500/30',
        },
        {
            title: 'Enterprise ERP & Business Systems',
            desc: 'Digitalisasi sistem manajemen operasional, inventaris, HRIS, hingga modul akuntansi terpadu.',
            icon: Server,
            color: 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/15 border-emerald-500/30',
        },
        {
            title: 'Mobile App Development',
            desc: 'Aplikasi Android dan iOS native & cross-platform berkinerja tinggi menggunakan Flutter dan React Native.',
            icon: Smartphone,
            color: 'text-amber-600 dark:text-amber-400 bg-amber-500/15 border-amber-500/30',
        },
        {
            title: 'System Integration & API Automation',
            desc: 'Integrasi sistem pembayaran (Payment Gateway), ekspedisi, WhatsApp Bot, dan arsitektur API kustom.',
            icon: Zap,
            color: 'text-cyan-600 dark:text-cyan-400 bg-cyan-500/15 border-cyan-500/30',
        },
        {
            title: 'Dynamic Form & CBT Studio',
            desc: 'Sistem ujian online, survei kepuasan, dan formulir pengumpulan data dinamis berbasis web.',
            icon: Layers,
            color: 'text-purple-600 dark:text-purple-400 bg-purple-500/15 border-purple-500/30',
        },
        {
            title: 'DevOps & Security Audit',
            desc: 'Penyetelan VPS/Cloud server, isolasi keamanan, proteksi data, serta garansi pemeliharaan berkelanjutan.',
            icon: ShieldCheck,
            color: 'text-rose-600 dark:text-rose-400 bg-rose-500/15 border-rose-500/30',
        },
    ];

    const processSteps = [
        {
            step: '01',
            title: 'Konsultasi & Analisis',
            desc: 'Diskusi kebutuhan teknis bersama Afif & Fairuz untuk menentukan scope dan solusi terbaik.',
        },
        {
            step: '02',
            title: 'Blueprint & UI/UX Design',
            desc: 'Penyusunan arsitektur sistem, alur basis data, dan prototype antarmuka visual yang estetik.',
        },
        {
            step: '03',
            title: 'Clean Development',
            desc: 'Pengkodean modular berstandar industri dengan proteksi type safety dan pengujian berulang.',
        },
        {
            step: '04',
            title: 'Security Audit & QA',
            desc: 'Pengujian celah keamanan, optimasi beban server, serta audit performa secara ketat.',
        },
        {
            step: '05',
            title: 'Deployment & Training',
            desc: 'Peluncuran server produksi, pelatihan penggunaan sistem, dan pendampingan pasca rilis.',
        },
    ];

    const stats = [
        { value: '50+', label: 'Proyek Sistem Selesai' },
        { value: '99.9%', label: 'Uptime & Keandalan' },
        { value: '100%', label: 'Source Code Kustom' },
        { value: '24/7', label: 'Dukungan Garansi' },
    ];
</script>

<svelte:head>
    <title>Purwotama Satria — Studio Jasa Pembuatan Software & Sistem Informasi Profesional</title>
    <meta
        name="description"
        content="Purwotama Satria menyediakan jasa pembuatan software kustom, sistem informasi enterprise, LMS, CBT, POS Kasir, SIMRS, dan aplikasi mobile dengan arsitektur modern."
    />
    {#if branding?.public_favicon}
        <link rel="icon" href={branding.public_favicon} />
    {/if}
</svelte:head>

<div
    class="relative min-h-screen overflow-x-hidden bg-slate-50 font-sans text-slate-900 transition-colors duration-300 selection:bg-indigo-500 selection:text-white dark:bg-slate-950 dark:text-slate-100"
>
    <!-- ULTRA VIBRANT NEON AMBIENT MESH ORBS -->
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <div
            class="animate-float-slow absolute -top-40 -left-40 h-[700px] w-[700px] rounded-full bg-gradient-to-tr from-indigo-600/30 via-purple-600/25 to-pink-500/20 blur-[130px]"
        ></div>
        <div
            class="animate-float-delayed absolute top-1/3 -right-40 h-[700px] w-[700px] rounded-full bg-gradient-to-tr from-cyan-500/25 via-blue-600/25 to-purple-600/20 blur-[150px]"
        ></div>
        <div
            class="animate-float-slow absolute bottom-10 left-1/3 h-[750px] w-[750px] rounded-full bg-gradient-to-tr from-emerald-500/20 via-teal-500/25 to-indigo-600/20 blur-[160px]"
        ></div>
    </div>

    <!-- Top Announcement Bar -->
    <div
        class="relative z-50 border-b border-indigo-500/30 bg-gradient-to-r from-indigo-900 via-purple-950 to-indigo-900 px-4 py-2.5 text-center text-xs font-bold text-white shadow-md"
    >
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-center gap-2">
            <span
                class="inline-flex items-center gap-1 rounded-full border border-indigo-400/40 bg-indigo-500/30 px-3 py-0.5 text-[11px] font-extrabold text-indigo-200 shadow-[0_0_12px_rgba(99,102,241,0.4)]"
            >
                <Sparkles class="h-3.5 w-3.5 animate-spin text-amber-300" /> Studio Software Kustom
            </span>
            <span>Solusi Sistem Informasi Enterprise, LMS, CBT, POS Kasir & SIMRS. Konsultasi Gratis!</span>
            <a
                href="#estimator"
                class="inline-flex items-center gap-0.5 font-extrabold text-indigo-300 underline hover:text-white"
            >
                Hitung Estimasi Proyek <ChevronRight class="h-3 w-3" />
            </a>
        </div>
    </div>

    <!-- Navigation Header with Theme Toggle -->
    <header
        class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 shadow-sm backdrop-blur-2xl transition-all dark:border-slate-800/80 dark:bg-slate-950/90"
    >
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Brand Logo with High-Contrast White Background Badge for Crisp Visibility -->
            <Link href="/" class="group flex items-center gap-3">
                <div
                    class="h-12 w-12 flex-shrink-0 rounded-2xl border border-indigo-200 bg-white p-1.5 shadow-md shadow-indigo-500/40 transition-transform duration-300 group-hover:scale-105 group-hover:shadow-indigo-500/60 dark:border-indigo-500/40"
                >
                    <img
                        src="/images/branding/purwotama_logo.png"
                        alt="Purwotama Satria Logo"
                        class="h-full w-full object-contain"
                    />
                </div>
                <div class="flex flex-col">
                    <span
                        class="bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-800 bg-clip-text text-xl font-black tracking-tight text-transparent dark:from-white dark:via-slate-100 dark:to-indigo-200"
                    >
                        Purwotama Satria
                    </span>
                    <span class="text-[10px] font-black tracking-widest text-indigo-600 uppercase dark:text-indigo-400"
                        >Software & System Studio</span
                    >
                </div>
            </Link>

            <!-- Navigation Links -->
            <nav class="hidden items-center gap-8 text-sm font-bold text-slate-700 md:flex dark:text-slate-200">
                <a href="#why-us" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400"
                    >Keunggulan</a
                >
                <a href="#services" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400"
                    >Layanan</a
                >
                <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400"
                    >Portofolio</a
                >
                <a
                    href="#estimator"
                    class="flex items-center gap-1 font-extrabold text-indigo-600 transition-colors hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-400"
                >
                    <Calculator class="h-4 w-4 text-indigo-500" /> Estimator
                </a>
                <a href="#faq" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">FAQ</a>
                <a href="#contact" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Kontak</a>
            </nav>

            <!-- Action Buttons & Theme Switcher -->
            <div class="flex items-center gap-3">
                <ThemeToggle />

                <a
                    href={fairuzWa}
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hidden items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-4 py-2.5 text-xs font-black text-slate-950 shadow-lg shadow-emerald-500/30 transition-all duration-300 hover:from-emerald-400 hover:to-cyan-400 active:scale-95 sm:inline-flex"
                >
                    <MessageSquare class="h-4 w-4 fill-slate-950 text-emerald-500" />
                    <span>Konsultasi WA</span>
                </a>

                {#if authUser}
                    <Link
                        href="/admin/dashboard"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-2.5 text-xs font-bold text-white shadow-md shadow-indigo-500/25 transition-all duration-300 hover:from-indigo-500 hover:to-purple-500 active:scale-95"
                    >
                        <LayoutDashboard class="h-4 w-4" />
                        <span>Dashboard</span>
                    </Link>
                {:else}
                    <Link
                        href="/login"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-slate-100 px-4 py-2.5 text-xs font-bold text-slate-800 transition-colors hover:bg-slate-200 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800"
                    >
                        <span>Login Admin</span>
                    </Link>
                {/if}
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative z-10 overflow-hidden pt-16 pb-24 lg:pt-24 lg:pb-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
                <!-- Hero Left Info -->
                <div class="text-center lg:col-span-7 lg:text-left">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-indigo-500/40 bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 px-4 py-1.5 text-xs font-extrabold text-indigo-700 shadow-[0_0_20px_rgba(99,102,241,0.25)] backdrop-blur-md dark:text-indigo-300"
                    >
                        <Rocket class="h-3.5 w-3.5 animate-bounce text-indigo-500" />
                        <span>Partner Software & Sistem Informasi Terpercaya</span>
                    </div>

                    <h1
                        class="mt-6 text-4xl leading-[1.15] font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl dark:text-white"
                    >
                        Sistem Informasi & <span
                            class="bg-gradient-to-r from-indigo-600 via-pink-500 via-purple-600 to-emerald-500 bg-clip-text text-transparent dark:from-indigo-400 dark:via-pink-400 dark:via-purple-300 dark:to-emerald-400"
                            >Software Custom</span
                        > Skala Enterprise
                    </h1>

                    <p
                        class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed font-medium text-slate-700 lg:mx-0 dark:text-slate-300"
                    >
                        <strong class="font-bold text-slate-900 dark:text-white">Purwotama Satria</strong> membantu perusahaan,
                        instansi, dan bisnis berkembang merancang sistem web, mobile apps, ERP/CRM, LMS, CBT, POS Kasir, hingga
                        SIMRS yang cepat, aman, dan tanpa lisensi rutin.
                    </p>

                    <!-- Contact Pills -->
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4 lg:justify-start">
                        <a
                            href={fairuzWa}
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-6 py-3.5 text-sm font-black text-slate-950 shadow-xl shadow-emerald-500/35 transition-all duration-300 hover:scale-105 active:scale-95"
                        >
                            <MessageSquare class="h-5 w-5 fill-slate-950 text-emerald-500" />
                            <div class="text-left">
                                <div class="text-xs font-bold tracking-wider uppercase opacity-80">
                                    Konsultasi Teknis
                                </div>
                                <div class="text-sm font-black">Fairuz (Chief Developer)</div>
                            </div>
                        </a>

                        <a
                            href={afifWa}
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 rounded-2xl border border-indigo-500/40 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-6 py-3.5 text-sm font-black text-white shadow-xl shadow-purple-500/30 transition-all duration-300 hover:scale-105 active:scale-95"
                        >
                            <User class="h-5 w-5 text-indigo-200" />
                            <div class="text-left">
                                <div class="text-xs font-bold tracking-wider text-indigo-200 uppercase">
                                    Kerjasama & Business
                                </div>
                                <div class="text-sm font-black text-white">Afif (Owner)</div>
                            </div>
                        </a>
                    </div>

                    <!-- Trust Checklist -->
                    <div
                        class="mt-10 grid grid-cols-2 gap-4 border-t border-slate-200 pt-6 text-xs font-bold text-slate-700 sm:grid-cols-3 dark:border-slate-800/80 dark:text-slate-300"
                    >
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 flex-shrink-0 text-emerald-500" />
                            <span>Source Code 100% Hak Milik</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 flex-shrink-0 text-emerald-500" />
                            <span>Arsitektur Svelte 5 + Laravel</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 flex-shrink-0 text-emerald-500" />
                            <span>Garansi Support & Maintenance</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right Interactive Card with Vibrant Border & Neon Shadow -->
                <div class="lg:col-span-5">
                    <div
                        class="relative rounded-3xl border border-indigo-500/40 bg-white/95 p-6 shadow-[0_0_40px_rgba(99,102,241,0.25)] backdrop-blur-xl dark:bg-slate-900/95"
                    >
                        <div
                            class="mb-4 flex items-center justify-between border-b border-slate-200 pb-4 dark:border-slate-800"
                        >
                            <div class="flex items-center gap-2">
                                <div class="h-3 w-3 rounded-full bg-rose-500"></div>
                                <div class="h-3 w-3 rounded-full bg-amber-500"></div>
                                <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                                <span class="ml-2 font-mono text-xs font-bold text-slate-500 dark:text-slate-400"
                                    >purwotama-satria-stack.ts</span
                                >
                            </div>
                            <span
                                class="rounded-full border border-emerald-500/40 bg-emerald-500/20 px-2.5 py-0.5 font-mono text-[10px] font-extrabold text-emerald-600 dark:text-emerald-300"
                                >100% Verified</span
                            >
                        </div>

                        <div class="space-y-2 font-mono text-xs leading-relaxed text-slate-800 dark:text-slate-300">
                            <p class="font-bold text-purple-600 dark:text-purple-400">
                                <span class="text-blue-600 dark:text-blue-400">import</span> &#123; PurwotamaEngine
                                &#125; <span class="text-blue-600 dark:text-blue-400">from</span>
                                <span class="text-emerald-600 dark:text-emerald-300">'@purwotama/studio'</span>;
                            </p>
                            <p class="text-slate-400 dark:text-slate-500">
                                // Initialize Professional Custom Software Solution
                            </p>
                            <p class="text-blue-600 dark:text-blue-400">
                                const <span class="text-amber-600 dark:text-amber-300">clientProject</span> =
                                <span class="text-blue-600 dark:text-blue-400">await</span> PurwotamaEngine.build(&#123;
                            </p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">
                                architect: <span class="text-emerald-600 dark:text-emerald-300">'Fairuz & Afif'</span>,
                            </p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">
                                speed: <span class="text-emerald-600 dark:text-emerald-300"
                                    >'Ultra High Performance (0.02s)'</span
                                >,
                            </p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">
                                security: <span class="text-emerald-600 dark:text-emerald-300"
                                    >'Spatie RBAC + Encrypted API'</span
                                >,
                            </p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">
                                ownership: <span class="font-black text-emerald-600 dark:text-emerald-300"
                                    >'100% Full Source Code Transfer'</span
                                >
                            </p>
                            <p class="text-blue-600 dark:text-blue-400">&#125;);</p>
                            <p class="mt-3 font-black text-emerald-600 dark:text-emerald-400">
                                ✓ System ready for deployment & scale!
                            </p>
                        </div>

                        <!-- Highlights Grid -->
                        <div class="mt-6 grid grid-cols-2 gap-3 border-t border-slate-200 pt-4 dark:border-slate-800">
                            <div
                                class="rounded-2xl border border-indigo-500/20 bg-indigo-500/10 p-3.5 dark:bg-slate-950/80"
                            >
                                <div class="text-lg font-black text-indigo-600 dark:text-indigo-400">
                                    Laravel + Svelte 5
                                </div>
                                <div class="text-[11px] font-bold text-slate-500 dark:text-slate-400">
                                    Tech Stack Modern
                                </div>
                            </div>
                            <div
                                class="rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-3.5 dark:bg-slate-950/80"
                            >
                                <div class="text-lg font-black text-emerald-600 dark:text-emerald-400">
                                    Zero Licensing
                                </div>
                                <div class="text-[11px] font-bold text-slate-500 dark:text-slate-400">
                                    Bebas Biaya Rutin
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS COUNTER BAR -->
    <section
        class="relative z-10 border-y border-slate-200 bg-white/80 py-10 backdrop-blur-md dark:border-slate-800/80 dark:bg-slate-900/80"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 text-center md:grid-cols-4">
                {#each stats as stat}
                    <div>
                        <div
                            class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-3xl font-black text-transparent sm:text-4xl dark:from-indigo-400 dark:via-purple-300 dark:to-pink-400"
                        >
                            {stat.value}
                        </div>
                        <div class="mt-1 text-xs font-bold text-slate-700 sm:text-sm dark:text-slate-300">
                            {stat.label}
                        </div>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US / VALUE PROPOSITIONS -->
    <section id="why-us" class="relative z-10 bg-slate-50 py-24 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-500/40 bg-emerald-500/15 px-4 py-1.5 text-xs font-black text-emerald-700 dark:text-emerald-400"
                >
                    <Award class="h-4 w-4" /> Jaminan Kualitas Software
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Mengapa Klien Percaya Pada <span
                        class="bg-gradient-to-r from-emerald-600 via-cyan-500 via-teal-500 to-indigo-600 bg-clip-text text-transparent dark:from-emerald-400 dark:via-teal-300 dark:to-cyan-400"
                        >Purwotama Satria</span
                    >?
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-400">
                    Kami tidak hanya membuat software yang berjalan, tetapi merancang aset teknologi berjangka panjang
                    yang memberikan dampak nyata bagi efisiensi bisnis Anda.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- 1. Pengembangan Cepat & Terukur -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500/50 dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-none"
                >
                    <div
                        class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"
                    ></div>
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-500/30 bg-emerald-500/15 text-emerald-600 dark:text-emerald-400"
                        >
                            <Rocket class="h-7 w-7" />
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Pengembangan Cepat & Terukur</h3>
                    <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Kami menerapkan proses pengembangan yang terstruktur, mulai dari analisis kebutuhan,
                        perancangan, hingga implementasi. Hasilnya, proyek selesai tepat waktu dengan kualitas yang
                        tetap terjaga.
                    </p>
                </div>

                <!-- 2. UI/UX Modern & Responsif -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/50 dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-none"
                >
                    <div
                        class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"
                    ></div>
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl border border-indigo-500/30 bg-indigo-500/15 text-indigo-600 dark:text-indigo-400"
                        >
                            <Laptop class="h-7 w-7" />
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">UI/UX Modern & Responsif</h3>
                    <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Setiap aplikasi dirancang dengan antarmuka yang intuitif, mudah digunakan, dan responsif di
                        berbagai perangkat untuk memberikan pengalaman terbaik bagi pengguna.
                    </p>
                </div>

                <!-- 3. Keamanan & Skalabilitas -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-amber-500/50 dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-none"
                >
                    <div
                        class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500"
                    ></div>
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl border border-amber-500/30 bg-amber-500/15 text-amber-600 dark:text-amber-400"
                        >
                            <ShieldCheck class="h-7 w-7" />
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Keamanan & Skalabilitas</h3>
                    <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Aplikasi dibangun dengan standar keamanan yang baik dan arsitektur yang fleksibel, sehingga siap
                        berkembang mengikuti kebutuhan bisnis Anda di masa depan.
                    </p>
                </div>

                <!-- 4. Maintenance & Dukungan Berkelanjutan -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-rose-500/50 dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-none"
                >
                    <div
                        class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r from-rose-500 via-pink-500 to-purple-500"
                    ></div>
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl border border-rose-500/30 bg-rose-500/15 text-rose-600 dark:text-rose-400"
                        >
                            <Clock3 class="h-7 w-7" />
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">
                        Maintenance & Dukungan Berkelanjutan
                    </h3>
                    <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Kami menyediakan layanan pemeliharaan, perbaikan, dan pengembangan lanjutan agar sistem tetap
                        stabil, aman, dan selalu relevan dengan kebutuhan bisnis Anda.
                    </p>
                </div>

                <!-- 5. Arsitektur Siap Berkembang -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-8 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-cyan-500/50 md:col-span-2 lg:col-span-1 dark:border-slate-800 dark:bg-slate-900/70 dark:shadow-none"
                >
                    <div
                        class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500"
                    ></div>
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl border border-cyan-500/30 bg-cyan-500/15 text-cyan-600 dark:text-cyan-400"
                        >
                            <TrendingUp class="h-7 w-7" />
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">Arsitektur Siap Berkembang</h3>
                    <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Kami merancang sistem dengan arsitektur modular yang mudah dipelihara, dikembangkan, dan
                        diintegrasikan dengan kebutuhan baru seiring pertumbuhan bisnis Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE PROJECT ESTIMATOR WIDGET (CONVERSION BOOSTER) -->
    <section
        id="estimator"
        class="relative z-10 border-y border-slate-200 bg-gradient-to-b from-indigo-50/50 via-slate-50 to-white py-24 dark:border-slate-800 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-indigo-500/40 bg-indigo-500/15 px-4 py-1.5 text-xs font-black text-indigo-700 dark:text-indigo-300"
                >
                    <Calculator class="h-4 w-4" /> Interactive Cost Estimator
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Simulasi Estimasi Proyek <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent dark:from-indigo-400 dark:via-purple-300 dark:to-pink-400"
                        >Software Anda</span
                    >
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-400">
                    Pilih spesifikasi sistem yang Anda butuhkan di bawah ini untuk mendapatkan gambaran perkiraan ruang
                    lingkup dan penawaran resmi.
                </p>
            </div>

            <div
                class="mx-auto mt-12 max-w-4xl rounded-3xl border border-indigo-500/40 bg-white p-6 shadow-2xl backdrop-blur-xl sm:p-10 dark:bg-slate-900/95"
            >
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <!-- Option 1: Project Type -->
                    <div>
                        <label
                            for="project-type-select"
                            class="mb-2 block text-xs font-black tracking-wider text-indigo-600 uppercase dark:text-indigo-400"
                            >1. Jenis Sistem / Software</label
                        >
                        <select
                            id="project-type-select"
                            bind:value={selectedProjectType}
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                        >
                            <option value="Web App & System ERP">Custom Web App / ERP</option>
                            <option value="EdTech LMS & CBT Engine">LMS & CBT Engine Ujian</option>
                            <option value="Sistem Kasir & Multi-Branch POS">Sistem Kasir & POS Multi-Cabang</option>
                            <option value="SIMRS / Logistics Fleet ERP">SIMRS Rumah Sakit / Logistics Fleet</option>
                            <option value="Mobile App (Android & iOS)">Mobile App (Android & iOS)</option>
                        </select>
                    </div>

                    <!-- Option 2: Platform -->
                    <div>
                        <label
                            for="platform-type-select"
                            class="mb-2 block text-xs font-black tracking-wider text-indigo-600 uppercase dark:text-indigo-400"
                            >2. Target Platform</label
                        >
                        <select
                            id="platform-type-select"
                            bind:value={selectedPlatform}
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                        >
                            <option value="Web Dashboard & REST API">Web Dashboard & REST API</option>
                            <option value="Full Cross-Platform (Web + Mobile)"
                                >Full Cross-Platform (Web + Mobile)</option
                            >
                            <option value="Desktop Hybrid & Cloud Server">Desktop Hybrid & Cloud Server</option>
                        </select>
                    </div>

                    <!-- Option 3: Complexity -->
                    <div>
                        <label
                            for="complexity-select"
                            class="mb-2 block text-xs font-black tracking-wider text-indigo-600 uppercase dark:text-indigo-400"
                            >3. Skala & Fitur Kustom</label
                        >
                        <select
                            id="complexity-select"
                            bind:value={selectedComplexity}
                            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none dark:border-slate-700 dark:bg-slate-950 dark:text-white"
                        >
                            <option value="Standar (Manajemen Data & User)">Standar (Manajemen Data & User)</option>
                            <option value="Menengah (Multi-User & Reporting)">Menengah (Multi-User & Reporting)</option>
                            <option value="Kompleks (Multi-Branch, Custom API & Security)"
                                >Kompleks (Multi-Branch & API)</option
                            >
                            <option value="Enterprise High Scalability">Enterprise High Scalability</option>
                        </select>
                    </div>
                </div>

                <!-- Estimator Result Card -->
                <div
                    class="mt-8 flex flex-col items-center justify-between gap-6 border-t border-slate-200 pt-6 sm:flex-row dark:border-slate-800"
                >
                    <div>
                        <div class="text-xs font-bold text-slate-500 dark:text-slate-400">Perkiraan Mulai Dari:</div>
                        <div class="mt-1 text-3xl font-black tracking-tight text-emerald-600 dark:text-emerald-400">
                            {estimatedBudget}
                        </div>
                        <div class="mt-1 text-[11px] font-medium text-slate-500 dark:text-slate-400">
                            *Termasuk Source Code, Setup Server, & Garansi Support
                        </div>
                    </div>

                    <a
                        href={estimatorWaUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-8 py-4 text-sm font-black text-slate-950 shadow-xl shadow-emerald-500/35 transition-all hover:scale-105 active:scale-95 sm:w-auto"
                    >
                        <MessageSquare class="h-5 w-5 fill-slate-950 text-emerald-500" />
                        <span>Kirim Estimasi Ini ke WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PORTFOLIO SHOWCASE WITH EXPANDED DUMMY PROJECTS & TABS -->
    <section id="portfolio" class="relative z-10 py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-indigo-500/40 bg-indigo-500/15 px-4 py-1.5 text-xs font-black text-indigo-700 dark:text-indigo-300"
                >
                    <Briefcase class="h-4 w-4" /> Real & Showcase Work (11 Projects)
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Katalog Portofolio Sistem <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent dark:from-indigo-400 dark:via-purple-300 dark:to-blue-400"
                        >Purwotama Satria</span
                    >
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-400">
                    Jelajahi portofolio sistem informasi, web aplikasi, dan engine kustom yang telah kami rancang untuk
                    berbagai industri.
                </p>

                <!-- Filter Tabs -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                    <button
                        onclick={() => (activePortfolioTab = 'all')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'all' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        Semua ({portfolios.length})
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'education')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'education' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        LMS & CBT Edukasi
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'enterprise')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'enterprise' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        Government & ERP
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'health')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'health' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        SIMRS & Kesehatan
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'pos')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'pos' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        Kasir & POS
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'corporate')}
                        class={`rounded-xl px-4 py-2 text-xs font-black transition-all ${activePortfolioTab === 'corporate' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/35' : 'border border-slate-200 bg-white text-slate-700 hover:text-indigo-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400'}`}
                    >
                        Corporate Portal
                    </button>
                </div>
            </div>

            <!-- Portfolio Cards Grid -->
            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {#each filteredPortfolios as item}
                    <div
                        class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/50 hover:shadow-2xl hover:shadow-indigo-500/15 dark:border-slate-800 dark:bg-slate-900/80 dark:shadow-none"
                    >
                        <div class={`h-1.5 w-full bg-gradient-to-r ${item.gradient} absolute top-0 left-0`}></div>
                        <div>
                            <!-- Header Icon & Badge -->
                            <div class="mt-2 flex items-center justify-between">
                                <div
                                    class={`h-12 w-12 rounded-2xl bg-gradient-to-tr ${item.gradient} p-2.5 text-white shadow-lg`}
                                >
                                    <item.icon class="h-full w-full" />
                                </div>
                                <span class={`rounded-full border px-3 py-1 text-[11px] font-extrabold ${item.bgGlow}`}>
                                    {item.badge}
                                </span>
                            </div>

                            <div class="mt-5">
                                <div
                                    class="text-xs font-black tracking-wider text-indigo-600 uppercase dark:text-indigo-400"
                                >
                                    {item.categoryLabel}
                                </div>
                                <h3
                                    class="mt-1 text-xl font-black text-slate-900 transition-colors group-hover:text-indigo-600 dark:text-white dark:group-hover:text-indigo-300"
                                >
                                    {item.title}
                                </h3>
                                <p class="mt-3 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                                    {item.desc}
                                </p>
                            </div>

                            <!-- Key Features Pills -->
                            <div class="mt-5 space-y-2 border-t border-slate-200 pt-4 dark:border-slate-800/80">
                                {#each item.features as feat}
                                    <div
                                        class="flex items-center gap-2 text-xs font-bold text-slate-700 dark:text-slate-300"
                                    >
                                        <Check class="h-3.5 w-3.5 flex-shrink-0 text-emerald-500" />
                                        <span>{feat}</span>
                                    </div>
                                {/each}
                            </div>
                        </div>

                        <div
                            class="mt-6 flex items-center justify-between border-t border-slate-200 pt-4 dark:border-slate-800"
                        >
                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400"
                                >Purwotama Satria Built</span
                            >
                            <a
                                href={fairuzWa}
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-1 text-xs font-black text-indigo-600 hover:underline dark:text-indigo-400"
                            >
                                Tanyakan Sistem Ini <ArrowRight class="h-3.5 w-3.5" />
                            </a>
                        </div>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- SERVICES SHOWCASE -->
    <section
        id="services"
        class="relative z-10 border-y border-slate-200 bg-white py-24 dark:border-slate-800/80 dark:bg-slate-900/40"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-indigo-500/40 bg-indigo-500/15 px-4 py-1.5 text-xs font-black text-indigo-700 dark:text-indigo-300"
                >
                    <Code2 class="h-4 w-4" /> Core Services
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Layanan Pengembangan Software <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-300"
                        >Profesional</span
                    >
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-400">
                    Kami merancang dan membangun setiap sistem secara modular, scalable, dan sesuai dengan kebutuhan
                    unik alur bisnis Anda.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                {#each services as svc}
                    <div
                        class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-md shadow-slate-200/50 transition-all duration-300 hover:border-indigo-500/50 dark:border-slate-800 dark:bg-slate-950/90 dark:shadow-none"
                    >
                        <div class={`inline-flex rounded-2xl border p-3 ${svc.color}`}>
                            <svc.icon class="h-6 w-6" />
                        </div>
                        <h3 class="mt-4 text-lg font-extrabold text-slate-900 dark:text-white">{svc.title}</h3>
                        <p class="mt-2 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-400">
                            {svc.desc}
                        </p>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- FAQ ACCORDION SECTION -->
    <section id="faq" class="relative z-10 bg-slate-50 py-24 dark:bg-slate-950">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-purple-500/40 bg-purple-500/15 px-4 py-1.5 text-xs font-black text-purple-700 dark:text-purple-300"
                >
                    <HelpCircle class="h-4 w-4" /> FAQ & Pertanyaan Umum
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Pertanyaan Yang Sering <span
                        class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent dark:from-purple-400 dark:via-pink-300 dark:to-indigo-400"
                        >Diajukan Klien</span
                    >
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-400">
                    Segala jawaban atas kekhawatiran Anda sebelum memulai kerjasama proyek pembuatan sistem bersama
                    kami.
                </p>
            </div>

            <div class="mt-12 space-y-4">
                {#each faqs as faq, idx}
                    <div
                        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-colors dark:border-slate-800 dark:bg-slate-900/80"
                    >
                        <button
                            onclick={() => toggleFaq(idx)}
                            class="flex w-full items-center justify-between gap-4 p-6 text-left font-extrabold text-slate-900 transition-colors hover:text-indigo-600 dark:text-white dark:hover:text-indigo-300"
                        >
                            <span class="text-base sm:text-lg">{faq.q}</span>
                            <ChevronDown
                                class={`h-5 w-5 text-indigo-500 transition-transform duration-300 ${activeFaq === idx ? 'rotate-180' : ''}`}
                            />
                        </button>
                        {#if activeFaq === idx}
                            <div
                                class="border-t border-slate-200 px-6 pt-4 pb-6 text-sm leading-relaxed font-medium text-slate-600 dark:border-slate-800/60 dark:text-slate-300"
                            >
                                {faq.a}
                            </div>
                        {/if}
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- DIRECT CONTACT TEAM SECTION -->
    <section
        id="contact"
        class="relative z-10 border-t border-slate-200 bg-gradient-to-b from-slate-100 via-white to-slate-100 py-24 dark:border-slate-800 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-500/40 bg-emerald-500/15 px-4 py-1.5 text-xs font-black text-emerald-700 dark:text-emerald-400"
                >
                    <PhoneCall class="h-4 w-4" /> Hubungi Tim Langsung
                </div>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                    Diskusi Proyek Langsung Bersama <span
                        class="bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-600 bg-clip-text text-transparent dark:from-emerald-400 dark:to-teal-300"
                        >Tim Purwotama Satria</span
                    >
                </h2>
                <p class="mt-4 text-base font-medium text-slate-600 dark:text-slate-300">
                    Tidak perlu ragu. Kami siap memberikan penawaran dan konsultasi teknis terbaik secara ramah dan
                    profesional.
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="mx-auto mt-12 grid max-w-4xl grid-cols-1 gap-8 md:grid-cols-2">
                <!-- Fairuz Card -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-emerald-500/40 bg-white p-8 shadow-2xl backdrop-blur-xl dark:bg-slate-900/95"
                >
                    <div
                        class="absolute top-0 right-0 h-32 w-32 rounded-full bg-emerald-500/15 blur-3xl transition-all group-hover:bg-emerald-500/25"
                    ></div>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-xl font-black text-white shadow-lg"
                        >
                            F
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white">Fairuz</h3>
                            <p class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400">
                                Chief Developer & Tech Lead
                            </p>
                            <p class="mt-0.5 text-xs font-bold text-slate-600 dark:text-slate-400">+62 822-4331-7522</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Hubungi Fairuz untuk diskusi kebutuhan teknis, arsitektur database, integrasi API, atau estimasi
                        durasi pengerjaan koding.
                    </p>
                    <a
                        href={fairuzWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-5 py-3.5 text-sm font-black text-slate-950 shadow-lg shadow-emerald-500/35 transition-all hover:from-emerald-400 hover:to-cyan-400"
                    >
                        <MessageSquare class="h-4 w-4 fill-slate-950 text-emerald-500" />
                        <span>Chat WhatsApp (Fairuz)</span>
                    </a>
                </div>

                <!-- Afif Card -->
                <div
                    class="group relative overflow-hidden rounded-3xl border border-indigo-500/40 bg-white p-8 shadow-2xl backdrop-blur-xl dark:bg-slate-900/95"
                >
                    <div
                        class="absolute top-0 right-0 h-32 w-32 rounded-full bg-indigo-500/15 blur-3xl transition-all group-hover:bg-indigo-500/25"
                    ></div>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 text-xl font-black text-white shadow-lg"
                        >
                            A
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white">Afif</h3>
                            <p class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400">
                                Owner & Business Consultant
                            </p>
                            <p class="mt-0.5 text-xs font-bold text-slate-600 dark:text-slate-400">+62 821-3439-7280</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed font-medium text-slate-600 dark:text-slate-300">
                        Hubungi Afif untuk konsultasi skema kerjasama bisnis, negosiasi penawaran proyek, garansi
                        maintenance, & legalitas.
                    </p>
                    <a
                        href={afifWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-5 py-3.5 text-sm font-black text-white shadow-lg shadow-purple-500/30 transition-all hover:from-indigo-500 hover:to-pink-500"
                    >
                        <MessageSquare class="h-4 w-4" />
                        <span>Chat WhatsApp (Afif)</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STICKY FLOATING WHATSAPP BUTTON (CONVERSION BOOSTER) -->
    <div class="fixed right-6 bottom-6 z-50 flex items-center gap-2">
        <a
            href={fairuzWa}
            target="_blank"
            rel="noopener noreferrer"
            class="group flex items-center gap-3 rounded-full bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-5 py-3.5 text-xs font-black text-slate-950 shadow-2xl shadow-emerald-500/50 transition-all hover:scale-105 active:scale-95"
        >
            <MessageSquare class="h-5 w-5 fill-slate-950 text-emerald-500 transition-transform group-hover:rotate-12" />
            <span class="hidden sm:inline">Konsultasi WA Fast-Response</span>
        </a>
    </div>

    <!-- FOOTER -->
    <footer
        class="relative z-10 border-t border-slate-200 bg-white py-12 text-xs text-slate-600 dark:border-slate-800/80 dark:bg-slate-950 dark:text-slate-400"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-9 w-9 flex-shrink-0 rounded-xl border border-indigo-200 bg-white p-1 shadow-md shadow-indigo-500/30 dark:border-indigo-500/30"
                        >
                            <img
                                src="/images/branding/purwotama_logo.png"
                                alt="Purwotama Satria Logo"
                                class="h-full w-full object-contain"
                            />
                        </div>
                        <span class="text-lg font-black text-slate-900 dark:text-white">Purwotama Satria</span>
                    </div>
                    <p class="mt-3 max-w-md text-xs leading-relaxed font-medium text-slate-600 dark:text-slate-400">
                        Studio Pengembangan Software, Sistem Informasi Enterprise, LMS, CBT, POS Kasir, SIMRS & Aplikasi
                        Mobile Kustom Professional dengan mengutamakan performa, keamanan, dan kode yang bersih.
                    </p>
                    <div class="mt-4 flex items-center gap-4 text-xs font-bold text-slate-700 dark:text-slate-300">
                        <span>Fairuz (+62 822-4331-7522)</span>
                        <span>•</span>
                        <span>Afif (+62 821-3439-7280)</span>
                    </div>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-bold text-slate-900 dark:text-white">Sistem Unggulan</h4>
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >LMS Platform</a
                            >
                        </li>
                        <li>
                            <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Eptunu CBT Engine</a
                            >
                        </li>
                        <li>
                            <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >SIMRS Rumah Sakit</a
                            >
                        </li>
                        <li>
                            <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Pendataan Ternak ERP</a
                            >
                        </li>
                        <li><a href="#portfolio" class="transition-colors hover:text-white">Sistem Kasir POS</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-bold text-slate-900 dark:text-white">Tautan Cepat</h4>
                    <ul class="space-y-2 font-medium">
                        <li>
                            <a href="#services" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Layanan</a
                            >
                        </li>
                        <li>
                            <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Portofolio (11 Proyek)</a
                            >
                        </li>
                        <li>
                            <a href="#estimator" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Estimator Proyek</a
                            >
                        </li>
                        <li>
                            <a href="#faq" class="transition-colors hover:text-indigo-600 dark:hover:text-white">FAQ</a>
                        </li>
                        <li>
                            <Link href="/login" class="transition-colors hover:text-indigo-600 dark:hover:text-white"
                                >Admin Portal</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-slate-200 pt-6 font-medium sm:flex-row dark:border-slate-800/80"
            >
                <p>&copy; 2010 - {new Date().getFullYear()} Purwotama Satria. All rights reserved.</p>
                <p class="text-slate-500 dark:text-slate-400">Developed with Laravel 13 + Svelte 5</p>
            </div>
        </div>
    </footer>
</div>

<!-- STYLES FOR HIGH-VIBRANCY MESH ANIMATIONS -->
<style>
    @keyframes floatOrb {
        0%,
        100% {
            transform: translateY(0px) rotate(0deg) scale(1);
        }
        50% {
            transform: translateY(-25px) rotate(5deg) scale(1.08);
        }
    }
    @keyframes pulseGlow {
        0%,
        100% {
            opacity: 0.5;
            transform: scale(1);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.12);
        }
    }
    .animate-float-slow {
        animation: floatOrb 8s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: floatOrb 11s ease-in-out 3s infinite;
    }
    .animate-pulse-glow {
        animation: pulseGlow 6s ease-in-out infinite;
    }
</style>
