<script lang="ts">
    import { Link, page } from '@inertiajs/svelte';
    import {
        Layers,
        Code2,
        CheckCircle2,
        Star,
        MessageSquare,
        User,
        Users,
        Database,
        ExternalLink,
        GraduationCap,
        FileCheck2,
        ShoppingCart,
        ChevronRight,
        ChevronDown,
        Activity,
        Truck,
        CreditCard,
        Building,
        TrendingUp,
        ShieldCheck,
        Clock,
        Menu as MenuIcon,
        X,
        ArrowUpRight,
        PhoneCall,
        Check,
        Server,
        Smartphone,
        Briefcase,
        Receipt,
        ShoppingBag,
        Kanban,
        Factory,
        LifeBuoy,
        FileText,
        BookOpen,
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

    // State
    let mobileMenuOpen = $state(false);
    let openFaqIndex = $state<number | null>(0);
    let selectedModuleId = $state('pos');

    // Modul Sistem
    const modules = [
        {
            id: 'pos',
            category: 'ritel',
            name: 'Kasir & Ritel (POS)',
            shortName: 'Kasir POS',
            badge: 'Toko & Ritel',
            color: 'bg-[#E58A3C]',
            tagline: 'Transaksi kasir kilat, cetak nota otomatis, dan sinkronisasi stok toko.',
            desc: 'Aplikasi kasir modern untuk kecepatan transaksi di meja kasir. Mendukung barcode scanner, printer nota thermal, pembayaran QRIS/tunai, dan rekap omzet harian otomatis.',
            icon: ShoppingCart,
            features: [
                'Pencatatan nota kasir cepat (kurang dari 2 detik)',
                'Stok barang otomatis berkurang setiap transaksi',
                'Dukungan multi-kasir dan multi-cabang terpusat',
                'Rekap omzet harian otomatis dikirim ke ponsel pemilik',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Kasir%20POS%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'inventory',
            category: 'operasional',
            name: 'Stok & Gudang Terpadu',
            shortName: 'Gudang & Stok',
            badge: 'Inventaris & Gudang',
            color: 'bg-[#457B9D]',
            tagline: 'Pantau persediaan barang real-time, cegah selisih, dan mutasi rapi.',
            desc: 'Sistem tata kelola stok cerdas yang menghubungkan gudang utama dengan cabang penjualan. Menghitung mutasi masuk-keluar secara presisi dan memberi notifikasi saat barang hampir habis.',
            icon: Database,
            features: [
                'Peringatan otomatis saat stok barang mendekati batas minimum',
                'Riwayat mutasi keluar-masuk barang terlacak per petugas',
                'Kartu stok digital otomatis tanpa hitung manual',
                'Surat jalan transfer barang antar gudang resmi & rapi',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Gudang%20dan%20Stok%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'finance',
            category: 'manajemen',
            name: 'Akuntansi & Keuangan',
            shortName: 'Akuntansi',
            badge: 'Pembukuan Usaha',
            color: 'bg-[#2A9D8F]',
            tagline: 'Buku kas otomatis, pencatatan piutang, dan laporan laba rugi real-time.',
            desc: 'Hilangkan kerumitan rekap pembukuan akhir bulan. Setiap transaksi langsung tercatat rapi ke dalam laporan laba rugi, neraca, dan arus kas usaha.',
            icon: CreditCard,
            features: [
                'Laporan laba rugi, arus kas, dan neraca tersaji instan kapan saja',
                'Riwayat pengeluaran operasional terdokumentasi dengan bukti nota',
                'Pencatatan piutang pelanggan dan utang suplier dengan pengingat tempo',
                'Pencatatan otomatis dari sistem operasional tanpa selisih',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Keuangan%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'crm',
            category: 'ritel',
            name: 'CRM & Pipeline Penjualan',
            shortName: 'CRM & Prospek',
            badge: 'Penjualan & Klien',
            color: 'bg-[#714B67]',
            tagline: 'Catat prospek calon pembeli, jadwalkan tindak lanjut, dan pantau closing deal.',
            desc: 'Membantu tim penjualan mengelola calon pembeli dari kontak awal hingga transaksi berhasil. Tidak ada lagi data prospek atau janji temu yang terlewat.',
            icon: Briefcase,
            features: [
                'Pencatatan data kontak prospek dan sumber kedatangan calon pembeli',
                'Tahapan pipeline visual (Prospek Masuk, Negosiasi, Penawaran, Kesepakatan)',
                'Pengingat jadwal janji temu dan tindak lanjut (follow-up) otomatis',
                'Riwayat percakapan dan kebutuhan spesifik tiap calon klien tersimpan rapi',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20CRM%20Penjualan%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'purchase',
            category: 'ritel',
            name: 'Pengadaan & Pembelian Suplier (PO)',
            shortName: 'Pembelian & PO',
            badge: 'Pengadaan Barang',
            color: 'bg-[#875A7B]',
            tagline: 'Penerbitan surat pesanan suplier (PO), kontrol faktur beli, dan cek barang masuk.',
            desc: 'Kendali penuh atas pembelian bahan baku dan barang dagangan. Cegah selisih harga dari suplier dan pastikan barang yang diterima sesuai persis dengan pesanan.',
            icon: Receipt,
            features: [
                'Penerbitan surat Purchase Order (PO) resmi siap cetak dan kirim PDF',
                'Pencatatan perbandingan harga suplier untuk efisiensi modal belanja',
                'Verifikasi penerimaan barang yang langsung menambah stok gudang',
                'Pengingat jatuh tempo pembayaran tagihan suplier agar arus kas terjaga',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Pengadaan%20PO%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'ecommerce',
            category: 'ritel',
            name: 'Toko Online Terpadu (eCommerce)',
            shortName: 'Toko Online',
            badge: 'Katalog Belanja',
            color: 'bg-[#E76F51]',
            tagline: 'Website belanja mandiri 24 jam yang tersambung langsung dengan kasir dan stok fisik.',
            desc: 'Perluas jangkauan pembeli dengan toko online merek Anda sendiri. Setiap pesanan online yang masuk otomatis memotong stok fisik tanpa perlu update manual ganda.',
            icon: ShoppingBag,
            features: [
                'Katalog produk visual dengan varian ukuran, warna, dan harga grosir',
                'Sinkronisasi otomatis stok fisik (mencegah order ganda saat stok habis)',
                'Hitung estimasi ongkos kirim ekspedisi otomatis ke seluruh Indonesia',
                'Notifikasi pesanan baru masuk langsung ke WhatsApp pengelola toko',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Toko%20Online%20eCommerce%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'project',
            category: 'operasional',
            name: 'Manajemen Proyek & Tugas Tim',
            shortName: 'Proyek & Tugas',
            badge: 'Kolaborasi Kerja',
            color: 'bg-[#009688]',
            tagline: 'Papan tugas Kanban, batas waktu pekerjaan, dan kejelasan tanggung jawab staf.',
            desc: 'Visualisasikan alur proyek kantor atau operasional lapangan. Setiap anggota tim mengetahui tugas harian yang menjadi tanggung jawabnya tanpa harus rapat panjang.',
            icon: Kanban,
            features: [
                'Papan kerja Kanban visual dengan kolom alur (Rencana, Berjalan, Review, Selesai)',
                'Penetapan penanggung jawab tugas dan batas waktu penyelesaian (deadline)',
                'Lampiran berkas pekerjaan, catatan instruksi, dan progres persentase',
                'Notifikasi pengingat sebelum tugas mendekati batas waktu',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Manajemen%20Proyek%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'manufacturing',
            category: 'operasional',
            name: 'Manufaktur & Produksi Pabrik',
            shortName: 'Manufaktur',
            badge: 'Pabrik & UMKM',
            color: 'bg-[#D47A4A]',
            tagline: 'Perencanaan bahan baku (BOM), jadwal lini produksi, dan kalkulasi HPP akurat.',
            desc: 'Dirancang untuk industri konveksi, manufaktur olahan makanan, bengkel perakitan, dan pabrik UMKM. Pantau pemakaian bahan baku dan hitung biaya pokok produksi per unit.',
            icon: Factory,
            features: [
                'Formulasi resep / komposisi bahan baku (Bill of Materials) per produk',
                'Pemotongan otomatis stok bahan mentah saat Surat Perintah Kerja (SPK) terbit',
                'Pencatatan biaya tenaga kerja dan operasional untuk penentuan HPP akurat',
                'Pemantauan status pengerjaan barang di tiap pos produksi secara real-time',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Manufaktur%20Produksi%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'helpdesk',
            category: 'operasional',
            name: 'Pusat Bantuan & Layanan Aduan',
            shortName: 'Pusat Bantuan',
            badge: 'Layanan Pelanggan',
            color: 'bg-[#017E84]',
            tagline: 'Penerimaan tiket aduan pelanggan, delegasi teknisi, dan pemantauan solusi tuntas.',
            desc: 'Pastikan keluhan dan permintaan bantuan pelanggan tertangani cepat. Setiap aduan memiliki nomor tiket pelacakan sehingga progresnya terpantau jelas bagi pemilik usaha.',
            icon: LifeBuoy,
            features: [
                'Penerbitan nomor tiket aduan otomatis dari form website atau pesan masuk',
                'Pembagian tiket ke teknisi yang bertugas sesuai keahlian masalah',
                'Riwayat penanganan masalah tersimpan rapi untuk evaluasi kualitas layanan',
                'Penilaian kepuasan pelanggan bintang setelah masalah selesai ditangani',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Pusat%20Bantuan%20Helpdesk%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'documents',
            category: 'manajemen',
            name: 'Arsip Surat & Tanda Tangan Digital',
            shortName: 'Arsip Dokumen',
            badge: 'Dokumen & Legal',
            color: 'bg-[#3D8DAE]',
            tagline: 'Tata kelola arsip digital aman, pencarian cepat, dan verifikasi tanda tangan QR.',
            desc: 'Tinggalkan lemari dokumen fisik yang memakan tempat. Simpan surat keputusan, kontrak kerjasama, faktur, dan berkas penting dengan keamanan terjamin dan pencarian instan.',
            icon: FileText,
            features: [
                'Pencarian kilat dokumen berdasarkan nomor surat, tanggal, atau perihal',
                'Pemberian tanda tangan digital resmi dilengkapi kode QR pembuktian keaslian',
                'Hak akses berkas berjenjang untuk melindungi dokumen rahasia instansi',
                'Penyimpanan digital aman dan pencadangan berkala otomatis',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Arsip%20Dokumen%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'knowledge',
            category: 'manajemen',
            name: 'Pusat Pengetahuan & SOP Kerja',
            shortName: 'SOP & Panduan',
            badge: 'Standar Operasional',
            color: 'bg-[#5B629A]',
            tagline: 'Dokumentasi SOP kerja karyawan, panduan penanganan kendala, dan basis pengetahuan.',
            desc: 'Bangun budaya kerja yang terstandar. Simpan instruksi kerja, pedoman penggunaan alat, dan SOP operasional di satu tempat yang mudah diakses seluruh karyawan baru.',
            icon: BookOpen,
            features: [
                'Penyusunan artikel SOP terstruktur per divisi dan departemen kerja',
                'Pencarian kata kunci cepat saat karyawan menghadapi kendala operasional',
                'Pembaruan versi dokumen panduan terdokumentasi rapi',
                'Akses baca dari ponsel memudahkan staf lapangan memeriksa prosedur',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20modul%20Knowledge%20SOP%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'hris',
            category: 'manajemen',
            name: 'Kepegawaian & Presensi',
            shortName: 'Presensi & HR',
            badge: 'Manajemen Pegawai',
            color: 'bg-[#588B76]',
            tagline: 'Presensi foto GPS dari ponsel, pengajuan izin cuti, dan slip gaji rapi.',
            desc: 'Aplikasi kehadiran staf dengan verifikasi lokasi GPS dan swafoto. Mempermudah persetujuan cuti secara transparan dan rekap kehadiran periodik siap pakai.',
            icon: Users,
            features: [
                'Validasi lokasi GPS dan swafoto memastikan kehadiran di tempat kerja',
                'Pengajuan izin dan cuti langsung disetujui pimpinan via ponsel',
                'Rekap kehadiran periodik siap ekspor tanpa input manual',
                'Transparansi slip gaji dan rincian tunjangan staf',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Presensi%20HRIS%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'cbt',
            category: 'khusus',
            name: 'Ujian Komputer (CBT)',
            shortName: 'Ujian CBT',
            badge: 'Sekolah & Kampus',
            color: 'bg-[#264653]',
            tagline: 'Ujian online kapasitas ribuan peserta dengan sistem proteksi anti-curang.',
            desc: 'Platform ujian berbasis komputer untuk sekolah, kampus, atau tes seleksi kerja. Stabil menampung ribuan peserta serentak dengan pengacakan soal dan nilai instan.',
            icon: FileCheck2,
            features: [
                'Proteksi layar kunci (tab-lock) mencegah peserta browsing jawaban',
                'Pengacakan nomor soal dan opsi jawaban untuk tiap peserta',
                'Hasil nilai dan analisis butir soal langsung keluar seketika',
                'Tetap menyimpan jawaban meskipun koneksi internet terputus',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Ujian%20Online%20CBT%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'simrs',
            category: 'khusus',
            name: 'Klinik & Faskes (SIMRS)',
            shortName: 'SIMRS Medis',
            badge: 'Klinik & Medis',
            color: 'bg-[#D1495B]',
            tagline: 'Antrean poli, Rekam Medis Elektronik (RME), dan apotek farmasi terpadu.',
            desc: 'Tata kelola fasilitas kesehatan terpadu mulai dari loket pendaftaran, antrean dokter poli, rekam medis digital (RME), laboratorium, hingga kasir apotek tanpa tumpukan kertas.',
            icon: Activity,
            features: [
                'Rekam Medis Elektronik (RME) rapi & riwayat pasien mudah dicari',
                'Alur resep dokter langsung terhubung ke bagian farmasi',
                'Kalkulasi tagihan dan rincian obat akurat tanpa selisih',
                'Siap integrasi data layanan kesehatan standar pemerintah',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Klinik%20SIMRS%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'lms',
            category: 'khusus',
            name: 'Akademik & Belajar (LMS)',
            shortName: 'LMS Belajar',
            badge: 'Portal Belajar',
            color: 'bg-[#6A4C93]',
            tagline: 'Distribusi materi, tugas daring, absensi kelas, dan sertifikat otomatis.',
            desc: 'Portal belajar digital untuk lembaga kursus, sekolah, dan kampus. Memfasilitasi materi video terstruktur, kuis mandiri, rekap kehadiran, serta sertifikat digital.',
            icon: GraduationCap,
            features: [
                'Materi tersusun rapi per bab dengan video & kuis pemahaman',
                'Pemantauan progres belajar siswa secara transparan bagi pendidik',
                'Sertifikat kelulusan digital otomatis berformat resmi',
                'Forum diskusi kelas dan pengumpulan tugas tanpa kertas',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20LMS%20Belajar%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'logistics',
            category: 'operasional',
            name: 'Ekspedisi & Armada',
            shortName: 'Ekspedisi',
            badge: 'Distribusi & Armada',
            color: 'bg-[#E07A5F]',
            tagline: 'Surat jalan digital kode QR, pemantauan sopir, dan efisiensi pengantaran.',
            desc: 'Solusi lengkap bagi distributor dan pengusaha ekspedisi untuk mengatur rute kirim barang, bukti foto penerima paket, dan pencatatan operasional armada.',
            icon: Truck,
            features: [
                'Penerbitan surat jalan cepat dengan kode QR tanda bukti penerima',
                'Status pengiriman terlacak secara transparan dari gudang ke tujuan',
                'Pencatatan riwayat servis kendaraan dan penggantian oli berkala',
                'Pengendalian biaya operasional bahan bakar per kilometer',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Logistik%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'website',
            category: 'manajemen',
            name: 'Profil Bisnis & Portal Web',
            shortName: 'Website Profil',
            badge: 'Branding & Profil',
            color: 'bg-[#4F5D75]',
            tagline: 'Website profil perusahaan cepat, elegan, ramah ponsel, dan mudah dikelola.',
            desc: 'Membangun kehadiran digital profesional untuk perusahaan, instansi, atau sekolah. Dilengkapi pengelola konten mandiri yang mudah digunakan tanpa perlu paham koding.',
            icon: Building,
            features: [
                'Desain elegan, responsif di HP, dan kecepatan loading tinggi',
                'Manajemen artikel berita, portofolio, dan galeri kegiatan mandiri',
                'Teroptimasi ramah mesin pencari (SEO) untuk mudah ditemukan calon klien',
                'Terhubung langsung dengan tombol WhatsApp dan formulir kontak',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20Website%20Profil%20Bisnis%20di%20Purwotama%20Satria.`,
        },
        {
            id: 'form',
            category: 'manajemen',
            name: 'Formulir & Pendaftaran Online',
            shortName: 'Formulir Online',
            badge: 'Registrasi Online',
            color: 'bg-[#C05C7E]',
            tagline: 'Formulir pendaftaran murid baru, rekrutmen pegawai, dan survei digital.',
            desc: 'Tinggalkan formulir kertas yang rentan tercecer. Kumpulkan data pendaftaran, survei kepuasan, atau permohonan layanan secara digital dengan rekap otomatis.',
            icon: Layers,
            features: [
                'Pembuatan form online kustom sesuai kebutuhan data formulir',
                'Rekap hasil pendaftaran tersusun rapi otomatis siap unduh',
                'Dukungan unggah berkas PDF/foto KTP/ijazah secara aman',
                'Notifikasi pemberitahuan masuk otomatis via WhatsApp pengurus',
            ],
            waUrl: `${fairuzWaBase}?text=Halo%20Mas%20Fairuz,%20saya%20tertarik%20dengan%20sistem%20Formulir%20Pendaftaran%20di%20Purwotama%20Satria.`,
        },
    ];

    const selectedModule = $derived(
        modules.find((m) => m.id === selectedModuleId) || modules[0]
    );

    // Keunggulan
    const advantages = [
        {
            title: '100% Milik Anda Seutuhnya',
            desc: 'Sistem menjadi aset digital penuh milik bisnis Anda tanpa batasan pengguna atau ketergantungan lisensi.',
            icon: ShieldCheck,
        },
        {
            title: 'Sesuai Alur Kerja Anda',
            desc: 'Sistem kami rancang mengikuti SOP kerja usaha Anda, bukan sebaliknya.',
            icon: Layers,
        },
        {
            title: 'Ringan & Ramah Ponsel',
            desc: 'Aplikasi cepat dimuat dan nyaman digunakan dari laptop maupun smartphone.',
            icon: Smartphone,
        },
        {
            title: 'Dukungan Langsung Pengembang',
            desc: 'Konsultasi teknis langsung bersama Fairuz & Afif secara cepat tanpa birokrasi berbelit.',
            icon: User,
        },
    ];

    // FAQ
    const faqs = [
        {
            q: 'Berapa biaya dan lama waktu pembuatan sistem?',
            a: 'Biaya dan durasi disesuaikan dengan modul yang Anda butuhkan, mulai dari hitungan minggu untuk modul standar hingga sistem kustom skala besar. Hubungi kami untuk estimasi transparan.',
        },
        {
            q: 'Bagaimana model kepemilikan sistem yang dibangun?',
            a: 'Sistem sepenuhnya menjadi aset digital milik bisnis Anda (putus beli) dengan kendali penuh atas data dan operasional.',
        },
        {
            q: 'Bagaimana jika alur bisnis kami memiliki aturan khusus?',
            a: 'Kami mendiskusikan kebutuhan Anda secara detail sebelum pengerjaan agar seluruh fitur dan alur persetujuan sesuai persis dengan SOP operasional Anda.',
        },
        {
            q: 'Apakah sistem bisa diakses dari smartphone atau tablet?',
            a: 'Tentu. Seluruh sistem dirancang responsif sehingga nyaman diakses dari ponsel, tablet, kasir, hingga komputer kantor.',
        },
        {
            q: 'Bagaimana dengan pelatihan staf dan bantuan teknis?',
            a: 'Kami menyertakan sesi panduan bagi staf, buku panduan tertulis, serta masa garansi perawatan teknis berkala.',
        },
    ];

    function toggleFaq(index: number) {
        openFaqIndex = openFaqIndex === index ? null : index;
    }
</script>

<svelte:head>
    <title>Purwotama Satria — Solusi Sistem Informasi & Software Bisnis Kustom</title>
    <meta
        name="description"
        content="Purwotama Satria menyediakan layanan pembuatan software bisnis, kasir POS, stok gudang, ujian CBT, SIMRS klinik, LMS, dan sistem operasional kustom untuk bisnis dan instansi."
    />
    {#if branding?.public_favicon}
        <link rel="icon" href={branding.public_favicon} />
    {/if}
</svelte:head>

<div class="min-h-screen bg-[#FAF8F5] font-sans text-slate-800 antialiased selection:bg-[#714B67] selection:text-white dark:bg-[#0E0D15] dark:text-slate-200">

    <!-- NAVBAR (PASTEL HEADER MINIMALIS) -->
    <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-[#FAF8F5]/90 backdrop-blur-md dark:border-slate-800/80 dark:bg-[#0E0D15]/90">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
            <!-- Brand Logo -->
            <Link href="/" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white p-1.5 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <img
                        src="/images/branding/purwotama_logo.png"
                        alt="Purwotama Logo"
                        class="h-full w-full object-contain"
                    />
                </div>
                <div class="flex flex-col">
                    <span class="text-base font-bold tracking-tight text-slate-900 dark:text-white">
                        Purwotama Satria
                    </span>
                    <span class="text-[10px] font-medium text-slate-500 dark:text-slate-400">
                        Software & Sistem Informasi
                    </span>
                </div>
            </Link>

            <!-- Desktop Navigation Links -->
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex dark:text-slate-300">
                <a href="#modul" class="transition-colors hover:text-[#714B67] dark:hover:text-[#E8D6E3]">Apps</a>
                <a href="#keunggulan" class="transition-colors hover:text-[#714B67] dark:hover:text-[#E8D6E3]">Keunggulan</a>
                <a href="#faq" class="transition-colors hover:text-[#714B67] dark:hover:text-[#E8D6E3]">Tanya Jawab</a>
                <a href="#kontak" class="transition-colors hover:text-[#714B67] dark:hover:text-[#E8D6E3]">Kontak</a>
            </nav>

            <!-- Actions & Theme Toggle -->
            <div class="flex items-center gap-2.5">
                <ThemeToggle />

                <a
                    href={fairuzWa}
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hidden items-center gap-1.5 rounded-lg bg-emerald-600 px-3.5 py-2 text-xs font-semibold text-white shadow-xs transition-all hover:bg-emerald-700 sm:inline-flex"
                >
                    <MessageSquare class="h-3.5 w-3.5" />
                    <span>WhatsApp</span>
                </a>

                {#if authUser}
                    <Link
                        href="/admin/dashboard"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-[#714B67] px-3.5 py-2 text-xs font-semibold text-white transition-all hover:bg-[#5C3C54]"
                    >
                        <span>Dashboard</span>
                    </Link>
                {/if}

                <!-- Mobile Hamburger Toggle -->
                <button
                    type="button"
                    class="rounded-lg p-2 text-slate-600 hover:bg-white md:hidden dark:text-slate-300 dark:hover:bg-slate-800"
                    onclick={() => (mobileMenuOpen = !mobileMenuOpen)}
                    aria-label="Buka Menu"
                >
                    {#if mobileMenuOpen}
                        <X class="h-5 w-5" />
                    {:else}
                        <MenuIcon class="h-5 w-5" />
                    {/if}
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        {#if mobileMenuOpen}
            <div class="border-b border-slate-200 bg-[#FAF8F5] px-4 py-4 md:hidden dark:border-slate-800 dark:bg-[#0E0D15]">
                <nav class="flex flex-col space-y-3 text-sm font-medium">
                    <a
                        href="#modul"
                        class="py-1 text-slate-700 dark:text-slate-200"
                        onclick={() => (mobileMenuOpen = false)}
                    >
                        Apps
                    </a>
                    <a
                        href="#keunggulan"
                        class="py-1 text-slate-700 dark:text-slate-200"
                        onclick={() => (mobileMenuOpen = false)}
                    >
                        Keunggulan
                    </a>
                    <a
                        href="#faq"
                        class="py-1 text-slate-700 dark:text-slate-200"
                        onclick={() => (mobileMenuOpen = false)}
                    >
                        Tanya Jawab
                    </a>
                    <a
                        href="#kontak"
                        class="py-1 text-slate-700 dark:text-slate-200"
                        onclick={() => (mobileMenuOpen = false)}
                    >
                        Kontak Developer
                    </a>

                    <div class="flex flex-col gap-2 pt-3 border-t border-slate-200 dark:border-slate-800">
                        <a
                            href={fairuzWa}
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-center gap-2 rounded-lg bg-emerald-600 py-2.5 text-xs font-semibold text-white shadow-xs"
                        >
                            <MessageSquare class="h-4 w-4" />
                            <span>Konsultasi WhatsApp (Fairuz)</span>
                        </a>
                        {#if authUser}
                            <Link
                                href="/admin/dashboard"
                                class="flex items-center justify-center rounded-lg bg-[#714B67] py-2 text-xs font-semibold text-white"
                            >
                                Dashboard
                            </Link>
                        {/if}
                    </div>
                </nav>
            </div>
        {/if}
    </header>

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden border-b border-slate-200/80 bg-[#FAF8F5] py-16 sm:py-20 lg:py-24 dark:border-slate-800/80 dark:bg-[#0E0D15]">
        <!-- ABSTRACT VECTOR BACKGROUND -->
        <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden select-none">
            <!-- Subtle Dot Matrix Pattern -->
            <div
                class="absolute inset-0 opacity-[0.20] dark:opacity-[0.10]"
                style="background-image: radial-gradient(#714B67 0.8px, transparent 0.8px); background-size: 24px 24px;"
            ></div>

            <!-- Soft Pastel Organic Shapes (Plum, Teal & Peach Warmth) -->
            <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-[#714B67]/10 blur-3xl dark:bg-[#714B67]/15"></div>
            <div class="absolute top-1/4 -right-20 h-96 w-96 rounded-full bg-[#017E84]/10 blur-3xl dark:bg-[#017E84]/15"></div>
            <div class="absolute -bottom-20 left-1/3 h-80 w-80 rounded-full bg-[#E58A3C]/10 blur-3xl dark:bg-[#E58A3C]/10"></div>

            <!-- Architectural Geometric SVG Curved Lines -->
            <svg class="absolute top-0 right-0 h-full w-full opacity-[0.25] dark:opacity-[0.12]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none">
                <path d="M-100 200 C300 100, 600 450, 1500 150" stroke="#714B67" stroke-width="1.5" stroke-dasharray="4 6"/>
                <path d="M-50 350 C400 250, 800 550, 1600 300" stroke="#017E84" stroke-width="1.5"/>
                <path d="M200 -50 C600 300, 1100 100, 1500 400" stroke="#E58A3C" stroke-width="1" stroke-dasharray="2 4"/>
                <circle cx="1180" cy="180" r="140" stroke="#714B67" stroke-width="1" stroke-dasharray="3 3"/>
                <circle cx="1180" cy="180" r="80" stroke="#017E84" stroke-width="0.75"/>
            </svg>
        </div>

        <div class="relative z-10 mx-auto max-w-5xl px-4 text-center sm:px-6">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 rounded-full border border-[#714B67]/20 bg-[#714B67]/10 px-3.5 py-1 text-xs font-semibold text-[#714B67] dark:border-[#714B67]/40 dark:bg-[#714B67]/25 dark:text-[#E8D6E3]">
                <Layers class="h-3.5 w-3.5" />
                <span>Software & Sistem Informasi Bisnis</span>
            </div>

            <!-- Headline -->
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl lg:text-5xl dark:text-white">
                Level Up <span class="text-[#714B67] dark:text-[#E2C3DB]">Your Quality of Work</span>
            </h1>

            <!-- Subtitle -->
            <p class="mx-auto mt-4 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg dark:text-slate-300">
                Sistem operasional terpadu untuk merapikan transaksi kasir, stok gudang, akuntansi, hingga alur kerja tim Anda.
            </p>

            <!-- Hero Action Buttons -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a
                    href={fairuzWa}
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#714B67] px-6 py-3 text-sm font-semibold text-white shadow-xs shadow-[#714B67]/25 transition-all hover:bg-[#5C3C54] active:scale-95"
                >
                    <MessageSquare class="h-4 w-4" />
                    <span>Konsultasi Proyek (Gratis)</span>
                </a>
                <a
                    href="#modul"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white/90 px-5 py-3 text-sm font-semibold text-slate-700 shadow-xs transition-all hover:bg-white dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700/80"
                >
                    <span>Lihat Pilihan Apps</span>
                    <ChevronDown class="h-4 w-4" />
                </a>
            </div>

            <!-- Key Trust Badges -->
            <div class="mt-12 flex flex-wrap items-center justify-center gap-6 border-t border-slate-200/80 pt-6 text-xs font-medium text-slate-600 sm:gap-10 dark:border-slate-800/80 dark:text-slate-400">
                <div class="flex items-center gap-2">
                    <CheckCircle2 class="h-4 w-4 text-[#017E84] dark:text-[#64D2D7]" />
                    <span>100% Hak Milik</span>
                </div>
                <div class="flex items-center gap-2">
                    <CheckCircle2 class="h-4 w-4 text-[#017E84] dark:text-[#64D2D7]" />
                    <span>Lisensi Permanen</span>
                </div>
                <div class="flex items-center gap-2">
                    <CheckCircle2 class="h-4 w-4 text-[#017E84] dark:text-[#64D2D7]" />
                    <span>Kustom Sesuai Kebutuhan</span>
                </div>
                <div class="flex items-center gap-2">
                    <CheckCircle2 class="h-4 w-4 text-[#017E84] dark:text-[#64D2D7]" />
                    <span>Garansi & Dukungan Teknis</span>
                </div>
            </div>
        </div>
    </section>

    <!-- METRICS SECTION (RINGKAS & PROFESIONAL) -->
    <section class="border-b border-slate-200/80 bg-white/70 py-10 dark:border-slate-800 dark:bg-slate-900/30">
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-4 text-center">
                <div class="rounded-xl border border-slate-200/70 bg-white p-4 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="text-2xl font-black text-slate-900 sm:text-3xl dark:text-white">50+</div>
                    <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Sistem & Modul Terpasang</div>
                </div>
                <div class="rounded-xl border border-slate-200/70 bg-white p-4 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="text-2xl font-black text-slate-900 sm:text-3xl dark:text-white">100%</div>
                    <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Kepemilikan Hak Cipta</div>
                </div>
                <div class="rounded-xl border border-slate-200/70 bg-white p-4 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="text-2xl font-black text-[#714B67] sm:text-3xl dark:text-[#E2C3DB]">Terpadu</div>
                    <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">1 Ekosistem Database</div>
                </div>
                <div class="rounded-xl border border-slate-200/70 bg-white p-4 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="text-2xl font-black text-[#017E84] sm:text-3xl dark:text-[#64D2D7]">Langsung</div>
                    <div class="mt-1 text-xs font-medium text-slate-500 dark:text-slate-400">Dukungan Tim Pengembang</div>
                </div>
            </div>
        </div>
    </section>

    <!-- APPS SECTION -->
    <section id="modul" class="py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <!-- Header Section -->
            <div class="max-w-2xl">
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
                    Pilihan Apps
                </h2>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                    Pilih aplikasi untuk melihat fitur dan manfaat operasionalnya.
                </p>
            </div>

            <!-- APP ICONS GRID -->
                <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-5 sm:p-8 shadow-xs dark:border-slate-800 dark:bg-slate-900/70">
                    <!-- App Squircle Grid: 3 cols on mobile, 6 cols on sm, md, lg -->
                    <div class="grid grid-cols-3 gap-3.5 sm:grid-cols-6 sm:gap-4 md:grid-cols-6 lg:grid-cols-6">
                        {#each modules as mod}
                            <button
                                type="button"
                                class="group flex flex-col items-center text-center transition-all focus:outline-none"
                                onclick={() => (selectedModuleId = mod.id)}
                            >
                                <!-- Icon Container -->
                                <div
                                    class={`relative flex h-13 w-13 sm:h-16 sm:w-16 items-center justify-center rounded-2xl sm:rounded-3xl transition-all duration-200 ${mod.color} ${
                                        selectedModuleId === mod.id
                                            ? 'scale-105 shadow-md shadow-[#714B67]/20 ring-4 ring-[#714B67]/30 ring-offset-2 dark:ring-offset-slate-900'
                                            : 'opacity-85 hover:scale-105 hover:opacity-100 hover:shadow-xs'
                                    }`}
                                >
                                    <mod.icon class="h-6 w-6 sm:h-7 sm:w-7 text-white" />
                                </div>

                                <!-- App Title Label -->
                                <span
                                    class={`mt-2 block w-full truncate text-[10px] sm:text-xs font-semibold ${
                                        selectedModuleId === mod.id
                                            ? 'text-[#714B67] dark:text-[#E2C3DB] font-bold'
                                            : 'text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200'
                                    }`}
                                >
                                    {mod.shortName}
                                </span>

                                <!-- Active Dot Indicator -->
                                {#if selectedModuleId === mod.id}
                                    <span class="mt-1 h-1 w-1 rounded-full bg-[#714B67] dark:bg-[#E2C3DB]"></span>
                                {/if}
                            </button>
                        {/each}
                    </div>

                    <!-- SELECTED MODULE DETAIL CARD (SKELETON UI CLEAN SURFACE) -->
                    <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50/70 p-6 sm:p-8 dark:border-slate-800 dark:bg-slate-950/60 transition-all">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                            <!-- Left: Icon & Description -->
                            <div class="flex-1">
                                <div class="flex items-center gap-4">
                                    <div class={`flex h-14 w-14 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-2xl sm:rounded-3xl ${selectedModule.color} shadow-xs`}>
                                        <selectedModule.icon class="h-7 w-7 sm:h-8 sm:w-8 text-white" />
                                    </div>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">
                                                {selectedModule.name}
                                            </h3>
                                            <span class="rounded-full border border-slate-200 bg-white px-2.5 py-0.5 text-[11px] font-semibold text-slate-600 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                                                {selectedModule.badge}
                                            </span>
                                        </div>
                                        <p class="mt-0.5 text-xs sm:text-sm font-medium text-slate-500 dark:text-slate-400">
                                            {selectedModule.tagline}
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-4 text-xs sm:text-sm leading-relaxed text-slate-600 dark:text-slate-300 max-w-2xl">
                                    {selectedModule.desc}
                                </p>
                            </div>

                            <!-- Right: Quick CTA Button -->
                            <div class="flex-shrink-0">
                                <a
                                    href={selectedModule.waUrl}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#714B67] px-5 py-3 text-xs font-semibold text-white shadow-xs transition-all hover:bg-[#5C3C54] active:scale-95"
                                >
                                    <MessageSquare class="h-4 w-4" />
                                    <span>Konsultasi Modul Ini</span>
                                </a>
                            </div>
                        </div>

                        <!-- Benefits Checklist -->
                        <div class="mt-6 border-t border-slate-200/80 pt-6 dark:border-slate-800/80">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-3">
                                Fitur Utama:
                            </h4>
                            <div class="grid grid-cols-1 gap-2.5 sm:grid-cols-2">
                                {#each selectedModule.features as feat}
                                    <div class="flex items-start gap-2 text-xs font-medium text-slate-700 dark:text-slate-300">
                                        <CheckCircle2 class="h-4 w-4 flex-shrink-0 text-[#017E84] dark:text-[#64D2D7] mt-0.5" />
                                        <span>{feat}</span>
                                    </div>
                                {/each}
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Custom Module Request Banner -->
            <div class="mt-10 rounded-2xl border border-[#714B67]/15 bg-[#714B67]/8 p-5 sm:p-6 dark:border-[#714B67]/30 dark:bg-[#714B67]/15">
                <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                    <div>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">
                            Butuh Modul Khusus?
                        </h4>
                        <p class="mt-0.5 text-xs text-slate-600 dark:text-slate-300">
                            Kami siap merancang fitur dari nol sesuai alur kerja spesifik kantor atau usaha Anda.
                        </p>
                    </div>
                    <a
                        href={fairuzWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex flex-shrink-0 items-center gap-2 rounded-xl bg-[#714B67] px-4 py-2 text-xs font-semibold text-white shadow-xs hover:bg-[#5C3C54]"
                    >
                        <span>Konsultasi Kustom</span>
                        <ArrowUpRight class="h-4 w-4" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN SECTION -->
    <section id="keunggulan" class="border-y border-slate-200/80 bg-white/70 py-16 sm:py-20 dark:border-slate-800 dark:bg-slate-900/40">
        <div class="mx-auto max-w-5xl px-4 sm:px-6">
            <div class="text-center">
                <span class="text-xs font-bold text-[#714B67] uppercase dark:text-[#E2C3DB]">Komitmen Kami</span>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
                    Mengapa Memilih Purwotama Satria?
                </h2>
                <p class="mx-auto mt-2 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                    Sistem yang dirancang awet, mudah digunakan, dan fleksibel mengikuti alur kerja Anda.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2">
                {#each advantages as adv}
                    <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs transition-all hover:border-[#714B67]/30 dark:border-slate-800 dark:bg-slate-900/60 dark:hover:border-[#714B67]/40">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#714B67]/10 text-[#714B67] dark:bg-[#714B67]/25 dark:text-[#E2C3DB]">
                            <adv.icon class="h-5 w-5" />
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-900 dark:text-white">
                            {adv.title}
                        </h3>
                        <p class="mt-2 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                            {adv.desc}
                        </p>
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- FAQ SECTION (ACCORDION BERSIH) -->
    <section id="faq" class="py-16 sm:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6">
            <div class="text-center">
                <span class="text-xs font-bold text-[#017E84] uppercase dark:text-[#64D2D7]">Transparansi Informasi</span>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
                    Pertanyaan Yang Sering Diajukan
                </h2>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                    Hal-hal penting yang perlu Anda ketahui sebelum memulai kerjasama proyek pembuatan software.
                </p>
            </div>

            <div class="mt-10 divide-y divide-slate-200/80 border-y border-slate-200/80 dark:divide-slate-800 dark:border-slate-800">
                {#each faqs as item, index}
                    <div class="py-4">
                        <button
                            type="button"
                            class="flex w-full items-center justify-between text-left text-sm font-semibold text-slate-900 transition-colors hover:text-[#714B67] dark:text-white dark:hover:text-[#E2C3DB]"
                            onclick={() => toggleFaq(index)}
                        >
                            <span>{item.q}</span>
                            <ChevronDown
                                class={`h-4 w-4 flex-shrink-0 text-slate-500 transition-transform duration-200 ${
                                    openFaqIndex === index ? 'rotate-180 text-[#714B67] dark:text-[#E2C3DB]' : ''
                                }`}
                            />
                        </button>

                        {#if openFaqIndex === index}
                            <div class="mt-3 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                                {item.a}
                            </div>
                        {/if}
                    </div>
                {/each}
            </div>
        </div>
    </section>

    <!-- KONTAK / PROFIL DIRECT CTA SECTION -->
    <section id="kontak" class="border-t border-slate-200/80 bg-white/70 py-16 sm:py-20 dark:border-slate-800 dark:bg-slate-900/50">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="text-center">
                <span class="text-xs font-bold text-[#714B67] uppercase dark:text-[#E2C3DB]">Diskusi Langsung</span>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl dark:text-white">
                    Mulai Konsultasi Kebutuhan Sistem Anda
                </h2>
                <p class="mx-auto mt-2 max-w-xl text-sm text-slate-600 dark:text-slate-400">
                    Hubungi kami melalui WhatsApp untuk berdiskusi santai mengenai kendala operasional bisnis Anda dan solusi sistem yang tepat.
                </p>
            </div>

            <!-- Two Contact Cards (Fairuz & Afif) -->
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Fairuz Card -->
                <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#017E84] text-base font-bold text-white shadow-xs">
                            F
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Fairuz</h3>
                            <p class="text-xs font-medium text-[#017E84] dark:text-[#64D2D7]">Lead Software Developer</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">+62 822-4331-7522</p>
                        </div>
                    </div>
                    <p class="mt-4 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                        Konsultasi seputar fitur teknis, alur database, demo sistem, spesifikasi server, dan arsitektur aplikasi.
                    </p>
                    <a
                        href={fairuzWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#017E84] py-2.5 text-xs font-semibold text-white shadow-xs transition-all hover:bg-[#01686D]"
                    >
                        <MessageSquare class="h-4 w-4" />
                        <span>Chat WhatsApp (Mas Fairuz)</span>
                    </a>
                </div>

                <!-- Afif Card -->
                <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-xs dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#714B67] text-base font-bold text-white shadow-xs">
                            A
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Afif</h3>
                            <p class="text-xs font-medium text-[#714B67] dark:text-[#E2C3DB]">Konsultan Kerjasama & Bisnis</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">+62 821-3439-7280</p>
                        </div>
                    </div>
                    <p class="mt-4 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                        Konsultasi mengenai penawaran proyek, skema anggaran, termin pembayaran, serta legalitas kerjasama.
                    </p>
                    <a
                        href={afifWa}
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#714B67] py-2.5 text-xs font-semibold text-white shadow-xs transition-all hover:bg-[#5C3C54]"
                    >
                        <MessageSquare class="h-4 w-4" />
                        <span>Chat WhatsApp (Mas Afif)</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FLOATING WHATSAPP BUTTON (CONVERSION DI MOBILE) -->
    <div class="fixed right-5 bottom-5 z-40">
        <a
            href={fairuzWa}
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-3 text-xs font-semibold text-white shadow-lg transition-transform hover:scale-105 active:scale-95 sm:px-4 sm:py-2.5"
            aria-label="Konsultasi WhatsApp"
        >
            <MessageSquare class="h-4 w-4" />
            <span class="hidden sm:inline">Tanya Kami di WA</span>
        </a>
    </div>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200/80 bg-[#F4F1EB] py-10 text-xs text-slate-600 dark:border-slate-800 dark:bg-[#0A0910] dark:text-slate-400">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white p-1 dark:border-slate-800 dark:bg-slate-900">
                        <img
                            src="/images/branding/purwotama_logo.png"
                            alt="Purwotama Logo"
                            class="h-full w-full object-contain"
                        />
                    </div>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Purwotama Satria</span>
                    <span class="text-slate-400 dark:text-slate-600">|</span>
                    <span>Purwokerto, Jawa Tengah</span>
                </div>

                <div class="flex flex-wrap items-center gap-5 font-medium text-slate-600 dark:text-slate-400">
                    <a href="#modul" class="hover:text-[#714B67] dark:hover:text-white">Apps</a>
                    <a href="#keunggulan" class="hover:text-[#714B67] dark:hover:text-white">Keunggulan</a>
                    <a href="#faq" class="hover:text-[#714B67] dark:hover:text-white">FAQ</a>
                    <a href="#kontak" class="hover:text-[#714B67] dark:hover:text-white">Kontak</a>
                </div>
            </div>

            <div class="mt-8 border-t border-slate-300/60 pt-6 text-center text-[11px] sm:text-left sm:flex sm:justify-between dark:border-slate-800/80">
                <p>&copy; 2010 - {new Date().getFullYear()} Purwotama Satria. Seluruh hak cipta dilindungi undang-undang.</p>
                <p class="mt-2 sm:mt-0 text-slate-500">Solusi Perangkat Lunak & Sistem Informasi Terpadu</p>
            </div>
        </div>
    </footer>
</div>
