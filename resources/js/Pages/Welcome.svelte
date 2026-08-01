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
        TrendingUp
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

    let { dynamicSections = [], themeSettings = {}, seoSettings = {}, latestPosts = [], navMenu = null }: Props = $props();

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
            features: ['Live Progress Tracking', 'Bank Soal & Kuis Interaktif', 'Generate Sertifikat PDF', 'Modul Multi-Tingkat'],
            gradient: 'from-indigo-600 via-purple-600 to-pink-500',
            bgGlow: 'bg-indigo-500/10 text-indigo-500 border-indigo-500/30',
            icon: GraduationCap
        },
        {
            id: 2,
            title: 'Eptunu CBT (Computer Based Test)',
            category: 'education',
            categoryLabel: 'Assessment Engine',
            badge: 'Engine Ujian Online',
            desc: 'Sistem ujian berbasis komputer berkapasitas tinggi dengan proteksi anti-cheat, bank soal acak, waktu otomatis, dan pemrosesan hasil seketika.',
            features: ['Proteksi Anti-Curang (Tab Lock)', 'Pengacakan Soal & Opsi', 'Nilai Real-time & Analisis', 'Kapasitas Ribuan Peserta'],
            gradient: 'from-amber-500 via-orange-500 to-red-500',
            bgGlow: 'bg-amber-500/10 text-amber-500 border-amber-500/30',
            icon: FileCheck2
        },
        {
            id: 3,
            title: 'Website Resmi UNU Purwokerto',
            category: 'education',
            categoryLabel: 'University Portal',
            badge: 'Portal Kampus Resmi',
            desc: 'Website portal resmi Universitas Nahdlatul Ulama Purwokerto terintegrasi dengan CMS berita kampus dinamis, informasi PMB, publikasi akademik, dan direktori prodi.',
            features: ['Portal Informasi PMB Kampus', 'CMS Berita & Pengumuman', 'Direktori Fakultas & Prodi', 'High Speed & SEO Optimized'],
            gradient: 'from-emerald-600 via-teal-600 to-green-500',
            bgGlow: 'bg-emerald-500/10 text-emerald-500 border-emerald-500/30',
            icon: Globe
        },
        {
            id: 4,
            title: 'SIAKAD UNU Purwokerto (Sistem Akademik)',
            category: 'education',
            categoryLabel: 'Academic ERP Engine',
            badge: 'Sistem Akademik Kampus',
            desc: 'Sistem Informasi Akademik terpadu UNU Purwokerto untuk pengisian KRS online, transkrip nilai KHS, kurikulum, presensi dosen & mahasiswa, serta sinkronisasi PDDIKTI.',
            features: ['KRS & KHS Online Real-Time', 'Manajemen Transkrip Nilai', 'Portal Dosen & Mahasiswa', 'Integrasi PDDIKTI Feeder'],
            gradient: 'from-blue-600 via-indigo-600 to-emerald-500',
            bgGlow: 'bg-blue-500/10 text-blue-500 border-blue-500/30',
            icon: GraduationCap
        },
        {
            id: 5,
            title: 'Sistem Informasi Pendataan Ternak',
            category: 'enterprise',
            categoryLabel: 'Government & ERP',
            badge: 'Manajemen Populasi',
            desc: 'Platform sistem informasi inventarisasi populasi ternak, integrasi riwayat kesehatan hewan, siklus reproduksi, dan pemetaan wilayah peternakan.',
            features: ['Peta Geografis Peternakan', 'Rekam Medis & Vaksinasi', 'Ear-Tag Barcode Tracking', 'Laporan Populasi Daerah'],
            gradient: 'from-emerald-500 via-teal-500 to-cyan-500',
            bgGlow: 'bg-emerald-500/10 text-emerald-500 border-emerald-500/30',
            icon: Binary
        },
        {
            id: 6,
            title: 'AAFI Official Website & Portal',
            category: 'corporate',
            categoryLabel: 'Corporate & Web',
            badge: 'Web Portal Resmi',
            desc: 'Website portal asosiasi profesional terintegrasi dengan CMS berita dinamis, direktori registrasi anggota, agenda kegiatan, dan galeri publikasi.',
            features: ['CMS Berita & Event Studio', 'Direktori Anggota Terverifikasi', 'Desain Modern & Responsif', 'SEO & High Speed Score'],
            gradient: 'from-violet-600 via-purple-500 to-indigo-600',
            bgGlow: 'bg-violet-500/10 text-violet-500 border-violet-500/30',
            icon: Globe
        },
        {
            id: 7,
            title: 'Sistem Kasir & POS (Point of Sale)',
            category: 'pos',
            categoryLabel: 'Retail & Multi-Branch',
            badge: 'Kasir & Inventaris',
            desc: 'Sistem aplikasi kasir bisnis modern terintegrasi dengan manajemen stok multi-cabang, barcode scanner, cetak struk thermal, dan laporan laba rugi.',
            features: ['Multi-Cabang & Multi-Kasir', 'Stok Barang Real-time', 'Integrasi Printer Thermal', 'Laporan Keuangan Otomatis'],
            gradient: 'from-rose-500 via-pink-500 to-purple-600',
            bgGlow: 'bg-rose-500/10 text-rose-500 border-rose-500/30',
            icon: ShoppingCart
        },
        {
            id: 8,
            title: 'SIMRS (Sistem Manajemen Rumah Sakit & Klinik)',
            category: 'health',
            categoryLabel: 'Healthcare & Medical',
            badge: 'Rekam Medis & SIMRS',
            desc: 'Sistem informasi manajemen fasilitas kesehatan terintegrasi Rekam Medis Elektronik (RME), manajemen antrean, apotek/farmasi, dan bridging API BPJS.',
            features: ['Rekam Medis Elektronik (RME)', 'Bridging BPJS & SATUSEHAT', 'Manajemen Obat & Laboratorium', 'Kasir Pasien & Billing'],
            gradient: 'from-cyan-500 via-blue-500 to-indigo-600',
            bgGlow: 'bg-cyan-500/10 text-cyan-500 border-cyan-500/30',
            icon: Activity
        },
        {
            id: 9,
            title: 'Smart Fleet & Logistics Tracking System',
            category: 'enterprise',
            categoryLabel: 'Logistics & Supply Chain',
            badge: 'Logistik & Ekspedisi',
            desc: 'Platform pelacakan armada armada pengiriman dan manifest kargo secara real-time terintegrasi GPS, rute jalan teroptimasi, dan surat jalan digital.',
            features: ['Live GPS & Fleet Tracking', 'Surat Jalan Digital (e-POD)', 'Optimalisasi Rute Pengiriman', 'Manajemen Bahan Bakar'],
            gradient: 'from-teal-500 via-emerald-500 to-lime-500',
            bgGlow: 'bg-teal-500/10 text-teal-500 border-teal-500/30',
            icon: Truck
        },
        {
            id: 10,
            title: 'Hotel & Resort Management Engine',
            category: 'corporate',
            categoryLabel: 'Hospitality & Travel',
            badge: 'Sistem Perhotelan',
            desc: 'Aplikasi manajemen reservasi hotel, sistem check-in/out cepat, jadwal housekeeping, POS restoran hotel, serta analisis tingkat okupansi kamar.',
            features: ['Engine Reservasi Online', 'POS Resto & Minibar', 'Housekeeping Task Live', 'Laporan Occupancy Rate'],
            gradient: 'from-purple-600 via-pink-600 to-rose-500',
            bgGlow: 'bg-purple-500/10 text-purple-500 border-purple-500/30',
            icon: Building2
        },
        {
            id: 11,
            title: 'Fintech Core Credit & Microfinance System',
            category: 'enterprise',
            categoryLabel: 'Finance & Banking',
            badge: 'Sistem Keuangan',
            desc: 'Sistem informasi akuntansi dan simpan pinjam lembaga keuangan/koperasi dengan kalkulasi bunga otomatis, jadwal angsuran, dan audit OJK ready.',
            features: ['Kalkulator Angsuran Pinjaman', 'Akuntansi Neraca Otomatis', 'Manajemen Tabungan & Deposito', 'Laporan Keuangan Standar OJK'],
            gradient: 'from-blue-600 via-indigo-600 to-cyan-500',
            bgGlow: 'bg-blue-500/10 text-blue-500 border-blue-500/30',
            icon: CreditCard
        }
    ];

    const filteredPortfolios = $derived(
        activePortfolioTab === 'all'
            ? portfolios
            : portfolios.filter(p => p.category === activePortfolioTab)
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

        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(base);
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
            a: 'Di Purwotama Satria, Anda berkonsultasi dan ditangani langsung oleh Chief Developer (Fairuz) dan Owner (Afif). Kami menjamin kode 100% milik Anda tanpa royalti tersembunyi, arsitektur modern super cepat (Laravel 13 + Svelte 5), serta garansi pendampingan pasca rilis.'
        },
        {
            q: 'Apakah source code dan database sepenuhnya menjadi hak milik saya?',
            a: 'YA, 100%! Seluruh kode sumber (source code), struktur basis data, dokumen arsitektur, dan kredensial server sepenuhnya diserahkan kepada Anda setelah proyek selesai.'
        },
        {
            q: 'Berapa lama waktu pengerjaan untuk sebuah sistem kustom?',
            a: 'Durasi pengerjaan bervariasi tergantung skala proyek. Untuk aplikasi web sedang (seperti POS Kasir / Web Portal) memerlukan waktu 2-4 minggu. Untuk sistem enterprise kompleks (ERP / LMS & CBT / SIMRS) berkisar antara 4-8 minggu dengan metode Agile Sprint transparan.'
        },
        {
            q: 'Bagaimana dengan dukungan garansi & maintenance setelah rilis?',
            a: 'Kami memberikan Garansi Pemeliharaan Gratis selama 3-6 bulan setelah peluncuran untuk memastikan sistem bebas dari bug, aman dari celah cyber, dan berjalan 100% stabil di server Anda.'
        },
        {
            q: 'Apakah bisa melakukan konsultasi atau meeting online/offline terlebih dahulu?',
            a: 'Sangat bisa! Anda dapat melakukan konsultasi gratis via Zoom, Google Meet, atau WhatsApp call bersama Afif & Fairuz untuk membedah ide dan kebutuhan teknis bisnis Anda sebelum membuat kesepakatan.'
        }
    ];

    const services = [
        {
            title: 'Custom Web & SaaS Development',
            desc: 'Pengembangan aplikasi web sesuai alur bisnis kustom berbasis Laravel 13, Svelte 5, dan Inertia.js untuk performa luar biasa.',
            icon: Laptop,
            color: 'text-indigo-600 dark:text-indigo-400 bg-indigo-500/10 border-indigo-500/20',
        },
        {
            title: 'Enterprise ERP & Business Systems',
            desc: 'Digitalisasi sistem manajemen operasional, inventaris, HRIS, hingga modul akuntansi terpadu.',
            icon: Server,
            color: 'text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
        },
        {
            title: 'Mobile App Development',
            desc: 'Aplikasi Android dan iOS native & cross-platform berkinerja tinggi menggunakan Flutter dan React Native.',
            icon: Smartphone,
            color: 'text-amber-600 dark:text-amber-400 bg-amber-500/10 border-amber-500/20',
        },
        {
            title: 'System Integration & API Automation',
            desc: 'Integrasi sistem pembayaran (Payment Gateway), ekspedisi, WhatsApp Bot, dan arsitektur API kustom.',
            icon: Zap,
            color: 'text-cyan-600 dark:text-cyan-400 bg-cyan-500/10 border-cyan-500/20',
        },
        {
            title: 'Dynamic Form & CBT Studio',
            desc: 'Sistem ujian online, survei kepuasan, dan formulir pengumpulan data dinamis berbasis web.',
            icon: Layers,
            color: 'text-purple-600 dark:text-purple-400 bg-purple-500/10 border-purple-500/20',
        },
        {
            title: 'DevOps & Security Audit',
            desc: 'Penyetelan VPS/Cloud server, isolasi keamanan, proteksi data, serta garansi pemeliharaan berkelanjutan.',
            icon: ShieldCheck,
            color: 'text-rose-600 dark:text-rose-400 bg-rose-500/10 border-rose-500/20',
        },
    ];

    const processSteps = [
        { step: '01', title: 'Konsultasi & Analisis', desc: 'Diskusi kebutuhan teknis bersama Afif & Fairuz untuk menentukan scope dan solusi terbaik.' },
        { step: '02', title: 'Blueprint & UI/UX Design', desc: 'Penyusunan arsitektur sistem, alur basis data, dan prototype antarmuka visual yang estetik.' },
        { step: '03', title: 'Clean Development', desc: 'Pengkodean modular berstandar industri dengan proteksi type safety dan pengujian berulang.' },
        { step: '04', title: 'Security Audit & QA', desc: 'Pengujian celah keamanan, optimasi beban server, serta audit performa secara ketat.' },
        { step: '05', title: 'Deployment & Training', desc: 'Peluncuran server produksi, pelatihan penggunaan sistem, dan pendampingan pasca rilis.' }
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
    <meta name="description" content="Purwotama Satria menyediakan jasa pembuatan software kustom, sistem informasi enterprise, LMS, CBT, POS Kasir, SIMRS, dan aplikasi mobile dengan arsitektur modern." />
    {#if branding?.public_favicon}
        <link rel="icon" href={branding.public_favicon} />
    {/if}
</svelte:head>

<!-- STYLES FOR DYNAMIC VIBRANT ANIMATIONS -->
<style>
    @keyframes floatOrb {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-20px) scale(1.05); }
    }
    @keyframes pulseGlow {
        0%, 100% { opacity: 0.4; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }
    .animate-float-slow {
        animation: floatOrb 8s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: floatOrb 10s ease-in-out 3s infinite;
    }
    .animate-pulse-glow {
        animation: pulseGlow 6s ease-in-out infinite;
    }
</style>

<div class="relative min-h-screen overflow-x-hidden bg-slate-50 dark:bg-slate-950 font-sans text-slate-900 dark:text-slate-100 selection:bg-indigo-500 selection:text-white transition-colors duration-300">
    <!-- Dynamic Animated Ambient Glow Spheres (Light & Dark Compatible) -->
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <div class="animate-float-slow absolute -top-40 -left-40 h-[650px] w-[650px] rounded-full bg-indigo-500/20 dark:bg-indigo-600/20 blur-[150px]"></div>
        <div class="animate-float-delayed absolute top-1/3 -right-40 h-[650px] w-[650px] rounded-full bg-purple-500/15 dark:bg-purple-600/15 blur-[160px]"></div>
        <div class="animate-float-slow absolute bottom-10 left-1/3 h-[700px] w-[700px] rounded-full bg-emerald-500/15 dark:bg-emerald-600/10 blur-[180px]"></div>
    </div>

    <!-- Top Announcement Bar -->
    <div class="relative z-50 border-b border-indigo-500/20 bg-gradient-to-r from-indigo-900 via-indigo-950 to-purple-950 px-4 py-2.5 text-center text-xs font-medium text-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-center gap-2 flex-wrap">
            <span class="inline-flex items-center gap-1 rounded-full bg-indigo-500/30 px-2.5 py-0.5 text-[11px] font-semibold text-indigo-200 border border-indigo-400/30">
                <Sparkles class="h-3 w-3 animate-spin" /> Studio Software Kustom
            </span>
            <span>Solusi Sistem Informasi Enterprise, LMS, CBT, POS Kasir & SIMRS. Konsultasi Gratis!</span>
            <a href="#estimator" class="font-semibold text-indigo-300 hover:text-white underline inline-flex items-center gap-0.5">
                Hitung Estimasi Proyek <ChevronRight class="w-3 h-3" />
            </a>
        </div>
    </div>

    <!-- Navigation Header with Theme Toggle -->
    <header class="sticky top-0 z-40 border-b border-slate-200/80 dark:border-slate-800/80 bg-white/85 dark:bg-slate-950/85 backdrop-blur-xl transition-all shadow-xs">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Brand Logo -->
            <Link href="/" class="group flex items-center gap-3">
                <div class="h-11 w-11 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 p-0.5 shadow-lg shadow-indigo-500/30 transition-transform duration-300 group-hover:scale-105">
                    <div class="flex h-full w-full items-center justify-center rounded-[10px] bg-white dark:bg-slate-950">
                        <ShieldCheck class="h-6 w-6 text-indigo-600 dark:text-indigo-400 transition-transform duration-300 group-hover:rotate-12" />
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="bg-gradient-to-r from-slate-900 via-indigo-950 to-indigo-700 dark:from-white dark:via-slate-100 dark:to-indigo-200 bg-clip-text text-xl font-black tracking-tight text-transparent">
                        Purwotama Satria
                    </span>
                    <span class="text-[10px] font-bold tracking-wider text-indigo-600 dark:text-indigo-400 uppercase">Software & System Studio</span>
                </div>
            </Link>

            <!-- Navigation Links -->
            <nav class="hidden items-center gap-8 text-sm font-semibold text-slate-700 dark:text-slate-300 md:flex">
                <a href="#why-us" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Keunggulan</a>
                <a href="#services" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Layanan</a>
                <a href="#portfolio" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Portofolio</a>
                <a href="#estimator" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400 text-indigo-600 dark:text-indigo-300 flex items-center gap-1 font-bold">
                    <Calculator class="w-4 h-4 text-indigo-500" /> Estimator
                </a>
                <a href="#faq" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">FAQ</a>
                <a href="#contact" class="transition-colors hover:text-indigo-600 dark:hover:text-indigo-400">Kontak</a>
            </nav>

            <!-- Action Buttons & Theme Switcher -->
            <div class="flex items-center gap-3">
                <!-- Theme Toggle Button -->
                <ThemeToggle />

                <a
                    href={fairuzWa}
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-emerald-500/20 transition-all duration-300 hover:from-emerald-500 hover:to-teal-500 active:scale-95"
                >
                    <MessageSquare class="h-4 w-4" />
                    <span>Konsultasi WA</span>
                </a>

                {#if authUser}
                    <Link
                        href="/admin/dashboard"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-indigo-500/25 transition-all duration-300 hover:from-indigo-500 hover:to-violet-500 active:scale-95"
                    >
                        <LayoutDashboard class="h-4 w-4" />
                        <span>Dashboard</span>
                    </Link>
                {:else}
                    <Link
                        href="/login"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-800 px-4 py-2 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors"
                    >
                        <span>Login Admin</span>
                    </Link>
                {/if}
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative z-10 pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
                <!-- Hero Left Info -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-4 py-1.5 text-xs font-bold text-indigo-600 dark:text-indigo-300 backdrop-blur-md">
                        <Rocket class="h-3.5 w-3.5 text-indigo-500 animate-bounce" />
                        <span>Partner Pengembangan Software & Sistem Informasi Terpercaya</span>
                    </div>

                    <h1 class="mt-6 text-4xl font-black tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl leading-[1.15]">
                        Sistem Informasi & <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-400 dark:via-purple-300 dark:to-emerald-400 bg-clip-text text-transparent">Software Custom</span> Skala Enterprise
                    </h1>

                    <p class="mt-6 text-lg text-slate-700 dark:text-slate-300 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-medium">
                        <strong class="text-slate-900 dark:text-white">Purwotama Satria</strong> membantu perusahaan, instansi, dan bisnis berkembang merancang sistem web, mobile apps, ERP/CRM, LMS, CBT, POS Kasir, hingga SIMRS yang cepat, aman, dan tanpa lisensi rutin.
                    </p>

                    <!-- Contact Pills -->
                    <div class="mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        <a
                            href={fairuzWa}
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 rounded-2xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-600 px-6 py-3.5 text-sm font-bold text-white shadow-xl shadow-emerald-600/30 transition-all duration-300 hover:scale-105 active:scale-95"
                        >
                            <MessageSquare class="h-5 w-5" />
                            <div class="text-left">
                                <div class="text-xs font-normal opacity-90">Konsultasi Teknis</div>
                                <div class="text-sm font-bold">Fairuz (Chief Developer)</div>
                            </div>
                        </a>

                        <a
                            href={afifWa}
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/90 px-6 py-3.5 text-sm font-bold text-slate-800 dark:text-slate-100 shadow-xl shadow-slate-200/50 dark:shadow-slate-950/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-300 hover:scale-105 active:scale-95"
                        >
                            <User class="h-5 w-5 text-indigo-600 dark:text-indigo-400" />
                            <div class="text-left">
                                <div class="text-xs font-normal text-slate-500 dark:text-slate-400">Kerjasama & Business</div>
                                <div class="text-sm font-bold text-slate-900 dark:text-white">Afif (Owner)</div>
                            </div>
                        </a>
                    </div>

                    <!-- Trust Checklist -->
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-4 pt-6 border-t border-slate-200 dark:border-slate-800/80 text-xs text-slate-600 dark:text-slate-400 font-semibold">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-emerald-500" />
                            <span>Source Code 100% Hak Milik</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-emerald-500" />
                            <span>Arsitektur Svelte 5 + Laravel</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-emerald-500" />
                            <span>Garansi Support & Maintenance</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right Interactive Card -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/90 p-6 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4 mb-4">
                            <div class="flex items-center gap-2">
                                <div class="h-3 w-3 rounded-full bg-rose-500"></div>
                                <div class="h-3 w-3 rounded-full bg-amber-500"></div>
                                <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                                <span class="ml-2 text-xs font-mono text-slate-500 dark:text-slate-400">purwotama-satria-stack.ts</span>
                            </div>
                            <span class="rounded bg-emerald-500/20 px-2 py-0.5 text-[10px] font-mono text-emerald-600 dark:text-emerald-300 font-bold">100% Verified</span>
                        </div>

                        <div class="font-mono text-xs leading-relaxed text-slate-800 dark:text-slate-300 space-y-2">
                            <p class="text-purple-600 dark:text-purple-400"><span class="text-blue-600 dark:text-blue-400">import</span> &#123; PurwotamaEngine &#125; <span class="text-blue-600 dark:text-blue-400">from</span> <span class="text-emerald-600 dark:text-emerald-300">'@purwotama/studio'</span>;</p>
                            <p class="text-slate-400 dark:text-slate-500">// Initialize Professional Custom Software Solution</p>
                            <p class="text-blue-600 dark:text-blue-400">const <span class="text-amber-600 dark:text-amber-300">clientProject</span> = <span class="text-blue-600 dark:text-blue-400">await</span> PurwotamaEngine.build(&#123;</p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">architect: <span class="text-emerald-600 dark:text-emerald-300">'Fairuz & Afif'</span>,</p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">speed: <span class="text-emerald-600 dark:text-emerald-300">'Ultra High Performance (0.02s)'</span>,</p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">security: <span class="text-emerald-600 dark:text-emerald-300">'Spatie RBAC + Encrypted API'</span>,</p>
                            <p class="pl-4 text-slate-700 dark:text-slate-300">ownership: <span class="text-emerald-600 dark:text-emerald-300 font-bold">'100% Full Source Code Transfer'</span></p>
                            <p class="text-blue-600 dark:text-blue-400">&#125;);</p>
                            <p class="text-emerald-600 dark:text-emerald-400 mt-3 font-semibold">✓ System ready for deployment & scale!</p>
                        </div>

                        <!-- Highlights Grid -->
                        <div class="mt-6 grid grid-cols-2 gap-3 pt-4 border-t border-slate-200 dark:border-slate-800">
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-950/80 p-3 border border-slate-200 dark:border-slate-800/80">
                                <div class="text-lg font-bold text-indigo-600 dark:text-indigo-400">Laravel + Svelte 5</div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400">Tech Stack Modern</div>
                            </div>
                            <div class="rounded-xl bg-slate-50 dark:bg-slate-950/80 p-3 border border-slate-200 dark:border-slate-800/80">
                                <div class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Zero Licensing</div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400">Bebas Biaya Rutin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS COUNTER BAR -->
    <section class="relative z-10 border-y border-slate-200 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/60 py-10 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                {#each stats as stat}
                    <div>
                        <div class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-300 bg-clip-text text-transparent">
                            {stat.value}
                        </div>
                        <div class="mt-1 text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-400">{stat.label}</div>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US / VALUE PROPOSITIONS -->
    <section id="why-us" class="relative z-10 py-24 bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-600 dark:text-emerald-400">
                    <Award class="h-3.5 w-3.5" /> Jaminan Kualitas Software
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Mengapa Klien Percaya Pada <span class="bg-gradient-to-r from-emerald-600 via-teal-500 to-indigo-600 dark:from-emerald-400 dark:via-teal-300 dark:to-indigo-400 bg-clip-text text-transparent">Purwotama Satria</span>?
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-base font-medium">
                    Kami tidak hanya membuat software yang berjalan, tetapi merancang aset teknologi berjangka panjang yang memberikan dampak nyata bagi efisiensi bisnis Anda.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/60 p-8 hover:border-emerald-500/40 transition-all duration-300 hover:-translate-y-1 shadow-lg shadow-slate-200/50 dark:shadow-none">
                    <div class="h-14 w-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-6">
                        <Lock class="h-7 w-7" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Source Code 100% Hak Milik</h3>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Seluruh kode sumber, basis data, dan dokumentasi arsitektur menjadi aset milik Anda sepenuhnya tanpa sistem sewa lisensi yang mengikat.
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/60 p-8 hover:border-indigo-500/40 transition-all duration-300 hover:-translate-y-1 shadow-lg shadow-slate-200/50 dark:shadow-none">
                    <div class="h-14 w-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-6">
                        <Zap class="h-7 w-7" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Teknologi Terdepan Svelte 5 + Laravel</h3>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Kecepatan render frontend Svelte 5 Runes dipadukan dengan keamanan backend Laravel 13 menghadirkan pengalaman pengguna super responsif.
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/60 p-8 hover:border-purple-500/40 transition-all duration-300 hover:-translate-y-1 shadow-lg shadow-slate-200/50 dark:shadow-none">
                    <div class="h-14 w-14 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6">
                        <HeartHandshake class="h-7 w-7" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Komunikasi Direct dengan Founder</h3>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Anda berdiskusi dan berkonsultasi langsung bersama Fairuz (Chief Developer) dan Afif (Owner). Respon cepat tanpa birokrasi perantara.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE PROJECT ESTIMATOR WIDGET (CONVERSION BOOSTER) -->
    <section id="estimator" class="relative z-10 py-24 bg-gradient-to-b from-indigo-50/50 via-slate-50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 border-y border-slate-200 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-300">
                    <Calculator class="h-3.5 w-3.5" /> Interactive Cost Estimator
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Simulasi Estimasi Proyek <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-400 dark:via-purple-300 dark:to-pink-400 bg-clip-text text-transparent">Software Anda</span>
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-base font-medium">
                    Pilih spesifikasi sistem yang Anda butuhkan di bawah ini untuk mendapatkan gambaran perkiraan ruang lingkup dan penawaran resmi.
                </p>
            </div>

            <div class="mt-12 max-w-4xl mx-auto rounded-3xl border border-indigo-500/30 bg-white dark:bg-slate-900/90 p-6 sm:p-10 shadow-2xl backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Option 1: Project Type -->
                    <div>
                        <label for="project-type-select" class="block text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">1. Jenis Sistem / Software</label>
                        <select
                            id="project-type-select"
                            bind:value={selectedProjectType}
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
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
                        <label for="platform-type-select" class="block text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">2. Target Platform</label>
                        <select
                            id="platform-type-select"
                            bind:value={selectedPlatform}
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        >
                            <option value="Web Dashboard & REST API">Web Dashboard & REST API</option>
                            <option value="Full Cross-Platform (Web + Mobile)">Full Cross-Platform (Web + Mobile)</option>
                            <option value="Desktop Hybrid & Cloud Server">Desktop Hybrid & Cloud Server</option>
                        </select>
                    </div>

                    <!-- Option 3: Complexity -->
                    <div>
                        <label for="complexity-select" class="block text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">3. Skala & Fitur Kustom</label>
                        <select
                            id="complexity-select"
                            bind:value={selectedComplexity}
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 py-3 text-sm font-semibold text-slate-900 dark:text-white focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        >
                            <option value="Standar (Manajemen Data & User)">Standar (Manajemen Data & User)</option>
                            <option value="Menengah (Multi-User & Reporting)">Menengah (Multi-User & Reporting)</option>
                            <option value="Kompleks (Multi-Branch, Custom API & Security)">Kompleks (Multi-Branch & API)</option>
                            <option value="Enterprise High Scalability">Enterprise High Scalability</option>
                        </select>
                    </div>
                </div>

                <!-- Estimator Result Card -->
                <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        <div class="text-xs font-bold text-slate-500 dark:text-slate-400">Perkiraan Mulai Dari:</div>
                        <div class="text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mt-1">
                            {estimatedBudget}
                        </div>
                        <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">*Termasuk Source Code, Setup Server, & Garansi Support</div>
                    </div>

                    <a
                        href={estimatorWaUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-600 px-8 py-4 text-sm font-bold text-white shadow-xl shadow-emerald-600/30 hover:scale-105 active:scale-95 transition-all"
                    >
                        <MessageSquare class="h-5 w-5" />
                        <span>Kirim Estimasi Ini ke WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PORTFOLIO SHOWCASE WITH EXPANDED DUMMY PROJECTS & TABS -->
    <section id="portfolio" class="relative z-10 py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-300">
                    <Briefcase class="h-3.5 w-3.5" /> Real & Dummy Work Showcase (9 Projects)
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Katalog Portofolio Sistem <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-400 dark:via-purple-300 dark:to-blue-400 bg-clip-text text-transparent">Purwotama Satria</span>
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-base font-medium">
                    Jelajahi portofolio sistem informasi, web aplikasi, dan engine kustom yang telah kami rancang untuk berbagai industri.
                </p>

                <!-- Filter Tabs -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                    <button
                        onclick={() => (activePortfolioTab = 'all')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'all' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        Semua ({portfolios.length})
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'education')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'education' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        LMS & CBT Edukasi
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'enterprise')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'enterprise' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        Government & ERP
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'health')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'health' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        SIMRS & Kesehatan
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'pos')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'pos' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        Kasir & POS
                    </button>
                    <button
                        onclick={() => (activePortfolioTab = 'corporate')}
                        class={`rounded-xl px-4 py-2 text-xs font-bold transition-all ${activePortfolioTab === 'corporate' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30' : 'bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-400 hover:text-indigo-600'}`}
                    >
                        Corporate Portal
                    </button>
                </div>
            </div>

            <!-- Portfolio Cards Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {#each filteredPortfolios as item}
                    <div class="group relative rounded-3xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/70 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/50 hover:shadow-2xl hover:shadow-indigo-500/10 flex flex-col justify-between shadow-lg shadow-slate-200/50 dark:shadow-none">
                        <div>
                            <!-- Header Icon & Badge -->
                            <div class="flex items-center justify-between">
                                <div class={`h-12 w-12 rounded-2xl bg-gradient-to-tr ${item.gradient} p-2.5 text-white shadow-lg`}>
                                    <item.icon class="h-full w-full" />
                                </div>
                                <span class={`rounded-full px-3 py-1 text-[11px] font-bold border ${item.bgGlow}`}>
                                    {item.badge}
                                </span>
                            </div>

                            <div class="mt-5">
                                <div class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{item.categoryLabel}</div>
                                <h3 class="mt-1 text-xl font-extrabold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-300 transition-colors">{item.title}</h3>
                                <p class="mt-3 text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-medium">{item.desc}</p>
                            </div>

                            <!-- Key Features Pills -->
                            <div class="mt-5 pt-4 border-t border-slate-200 dark:border-slate-800/80 space-y-2">
                                {#each item.features as feat}
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-600 dark:text-slate-400">
                                        <Check class="h-3.5 w-3.5 text-emerald-500 flex-shrink-0" />
                                        <span>{feat}</span>
                                    </div>
                                {/each}
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Purwotama Satria Built</span>
                            <a href={fairuzWa} target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-1">
                                Tanyakan Sistem Ini <ArrowRight class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- SERVICES SHOWCASE -->
    <section id="services" class="relative z-10 py-24 bg-white dark:bg-slate-900/40 border-y border-slate-200 dark:border-slate-800/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-300">
                    <Code2 class="h-3.5 w-3.5" /> Core Services
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Layanan Pengembangan Software <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 dark:from-indigo-400 dark:to-purple-300 bg-clip-text text-transparent">Profesional</span>
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-base font-medium">
                    Kami merancang dan membangun setiap sistem secara modular, scalable, dan sesuai dengan kebutuhan unik alur bisnis Anda.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {#each services as svc}
                    <div class="rounded-3xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950/80 p-6 transition-all duration-300 hover:border-indigo-500/40 shadow-md shadow-slate-200/50 dark:shadow-none">
                        <div class={`inline-flex rounded-2xl p-3 border ${svc.color}`}>
                            <svc.icon class="h-6 w-6" />
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">{svc.title}</h3>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-medium">{svc.desc}</p>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- FAQ ACCORDION SECTION -->
    <section id="faq" class="relative z-10 py-24 bg-slate-50 dark:bg-slate-950">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-purple-500/30 bg-purple-500/10 px-3.5 py-1 text-xs font-bold text-purple-600 dark:text-purple-300">
                    <HelpCircle class="h-3.5 w-3.5" /> FAQ & Pertanyaan Umum
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Pertanyaan Yang Sering <span class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 dark:from-purple-400 dark:via-pink-300 dark:to-indigo-400 bg-clip-text text-transparent">Diajukan Klien</span>
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-400 text-base font-medium">
                    Segala jawaban atas kekhawatiran Anda sebelum memulai kerjasama proyek pembuatan sistem bersama kami.
                </p>
            </div>

            <div class="mt-12 space-y-4">
                {#each faqs as faq, idx}
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/70 overflow-hidden transition-colors shadow-sm">
                        <button
                            onclick={() => toggleFaq(idx)}
                            class="w-full p-6 text-left flex items-center justify-between gap-4 font-bold text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-300 transition-colors"
                        >
                            <span class="text-base sm:text-lg">{faq.q}</span>
                            <ChevronDown class={`w-5 h-5 text-indigo-500 transition-transform duration-300 ${activeFaq === idx ? 'rotate-180' : ''}`} />
                        </button>
                        {#if activeFaq === idx}
                            <div class="px-6 pb-6 text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200 dark:border-slate-800/60 pt-4 font-medium">
                                {faq.a}
                            </div>
                        {/if}
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- DIRECT CONTACT TEAM SECTION -->
    <section id="contact" class="relative z-10 py-24 bg-gradient-to-b from-slate-100 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 border-t border-slate-200 dark:border-slate-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1 text-xs font-bold text-emerald-600 dark:text-emerald-400">
                    <PhoneCall class="h-3.5 w-3.5" /> Hubungi Tim Langsung
                </div>
                <h2 class="mt-4 text-3xl font-black text-slate-900 dark:text-white sm:text-4xl tracking-tight">
                    Diskusi Proyek Langsung Bersama <span class="bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-600 dark:from-emerald-400 dark:to-teal-300 bg-clip-text text-transparent">Tim Purwotama Satria</span>
                </h2>
                <p class="mt-4 text-slate-600 dark:text-slate-300 text-base font-medium">
                    Tidak perlu ragu. Kami siap memberikan penawaran dan konsultasi teknis terbaik secara ramah dan profesional.
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Fairuz Card -->
                <div class="rounded-3xl border border-emerald-500/30 bg-white dark:bg-slate-900/90 p-8 shadow-2xl backdrop-blur-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-emerald-500/10 blur-3xl group-hover:bg-emerald-500/20 transition-all"></div>
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 flex items-center justify-center text-white font-black text-xl shadow-lg">
                            F
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Fairuz</h3>
                            <p class="text-xs font-bold text-emerald-600 dark:text-emerald-400">Chief Developer & Tech Lead</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 font-semibold">+62 822-4331-7522</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                        Hubungi Fairuz untuk diskusi kebutuhan teknis, arsitektur database, integrasi API, atau estimasi durasi pengerjaan koding.
                    </p>
                    <a
                        href={fairuzWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 hover:from-emerald-500 hover:to-teal-500 transition-all"
                    >
                        <MessageSquare class="h-4 w-4" />
                        <span>Chat WhatsApp (Fairuz)</span>
                    </a>
                </div>

                <!-- Afif Card -->
                <div class="rounded-3xl border border-indigo-500/30 bg-white dark:bg-slate-900/90 p-8 shadow-2xl backdrop-blur-xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 h-32 w-32 rounded-full bg-indigo-500/10 blur-3xl group-hover:bg-indigo-500/20 transition-all"></div>
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center text-white font-black text-xl shadow-lg">
                            A
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Afif</h3>
                            <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400">Owner & Business Consultant</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 font-semibold">+62 821-3439-7280</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                        Hubungi Afif untuk konsultasi skema kerjasama bisnis, negosiasi penawaran proyek, garansi maintenance, & legalitas.
                    </p>
                    <a
                        href={afifWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-6 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/30 hover:from-indigo-500 hover:to-purple-500 transition-all"
                    >
                        <MessageSquare class="h-4 w-4" />
                        <span>Chat WhatsApp (Afif)</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STICKY FLOATING WHATSAPP BUTTON (CONVERSION BOOSTER) -->
    <div class="fixed bottom-6 right-6 z-50 flex items-center gap-2">
        <a
            href={fairuzWa}
            target="_blank"
            rel="noopener noreferrer"
            class="group flex items-center gap-3 rounded-full bg-emerald-500 px-4 py-3 text-xs font-extrabold text-slate-950 shadow-2xl shadow-emerald-500/50 hover:bg-emerald-400 hover:scale-105 active:scale-95 transition-all"
        >
            <MessageSquare class="h-5 w-5 fill-slate-950 text-emerald-500 group-hover:rotate-12 transition-transform" />
            <span class="hidden sm:inline">Konsultasi WA Fast-Response</span>
        </a>
    </div>

    <!-- FOOTER -->
    <footer class="relative z-10 border-t border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-950 py-12 text-slate-600 dark:text-slate-400 text-xs">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2">
                        <ShieldCheck class="h-6 w-6 text-indigo-600 dark:text-indigo-400" />
                        <span class="text-lg font-bold text-slate-900 dark:text-white">Purwotama Satria</span>
                    </div>
                    <p class="mt-3 text-slate-600 dark:text-slate-400 text-xs max-w-md leading-relaxed font-medium">
                        Studio Pengembangan Software, Sistem Informasi Enterprise, LMS, CBT, POS Kasir, SIMRS & Aplikasi Mobile Kustom Professional dengan mengutamakan performa, keamanan, dan kode yang bersih.
                    </p>
                    <div class="mt-4 flex items-center gap-4 text-xs font-semibold text-slate-700 dark:text-slate-300">
                        <span>Fairuz (+62 822-4331-7522)</span>
                        <span>•</span>
                        <span>Afif (+62 821-3439-7280)</span>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Sistem Unggulan</h4>
                    <ul class="space-y-2 font-medium">
                        <li><a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-white transition-colors">LMS Platform</a></li>
                        <li><a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Eptunu CBT Engine</a></li>
                        <li><a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-white transition-colors">SIMRS Rumah Sakit</a></li>
                        <li><a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Pendataan Ternak ERP</a></li>
                        <li><a href="#portfolio" class="hover:text-white transition-colors">Sistem Kasir POS</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Tautan Cepat</h4>
                    <ul class="space-y-2 font-medium">
                        <li><a href="#services" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#portfolio" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Portofolio (11 Proyek)</a></li>
                        <li><a href="#estimator" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Estimator Proyek</a></li>
                        <li><a href="#faq" class="hover:text-indigo-600 dark:hover:text-white transition-colors">FAQ</a></li>
                        <li><Link href="/login" class="hover:text-indigo-600 dark:hover:text-white transition-colors">Admin Portal</Link></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-slate-200 dark:border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 font-medium">
                <p>&copy; 2010 - {new Date().getFullYear()} Purwotama Satria. All rights reserved.</p>
                <p class="text-slate-500 dark:text-slate-400">Developed with Laravel 13 + Svelte 5</p>
            </div>
        </div>
    </footer>
</div>
