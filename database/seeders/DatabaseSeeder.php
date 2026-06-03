<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Event;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN (Wajib ada untuk Modul 8)
        User::create([
            'name' => 'Admin Amikom',
            'email' => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        $this->command->info('Akun Admin berhasil dibuat!');

        // 2. BUAT DATA KATEGORI
        $catKonser = Category::create(['name' => 'Konser Musik', 'slug' => Str::slug('Konser Musik')]);
        $catSeminar = Category::create(['name' => 'Seminar Teknologi', 'slug' => Str::slug('Seminar Teknologi')]);
        $catWorkshop = Category::create(['name' => 'Workshop & Pelatihan', 'slug' => Str::slug('Workshop & Pelatihan')]);
        $catOlahraga = Category::create(['name' => 'Olahraga & E-Sports', 'slug' => Str::slug('Olahraga & E-Sports')]);
        $this->command->info('Data Kategori berhasil dibuat!');

        // 3. BUAT DATA PARTNER
        Partner::create([
            'name' => 'Tokopedia', 
            'logo_url' => 'https://placehold.co/200x200/47B95B/FFF?text=Tokopedia&font=Montserrat'
        ]);
        Partner::create([
            'name' => 'Gojek', 
            'logo_url' => 'https://placehold.co/200x200/00AA13/FFF?text=Gojek&font=Montserrat'
        ]);
        Partner::create([
            'name' => 'Traveloka', 
            'logo_url' => 'https://placehold.co/200x200/1BA0E2/FFF?text=Traveloka&font=Montserrat'
        ]);
        Partner::create([
            'name' => 'Bank BCA', 
            'logo_url' => 'https://placehold.co/200x200/0066AE/FFF?text=BCA&font=Montserrat'
        ]);
        $this->command->info('Data Partner berhasil dibuat!');

        // 4. BUAT DATA EVENT (Masing-masing kategori ada 3 event, Total 12 Event)
        
        // ==========================================
        // KATEGORI 1: KONSER MUSIK (3 Event)
        // ==========================================
        
        // Event Musik 1
        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Jazz Night Concert 2026',
            'description' => 'Nikmati malam yang syahdu dengan alunan musik jazz dari musisi-musisi papan atas Indonesia. Jangan lewatkan penawaran spesial untuk tiket early bird!',
            'date' => '2026-05-25 19:00:00',
            'location' => 'Jogja Expo Center (JEC)',
            'price' => 150000,
            'stock' => 500,
            'poster_path' => 'https://images.unsplash.com/photo-1540039155732-68cbd737e8f4?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Musik 2
        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Rock Nation Festival',
            'description' => 'Festival musik rock terbesar tahun ini yang akan menampilkan 10 band rock legendaris tanah air di satu panggung spektakuler.',
            'date' => '2026-08-20 16:00:00',
            'location' => 'Stadion Mandala Krida',
            'price' => 250000,
            'stock' => 1000,
            'poster_path' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Musik 3
        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Indie Music Fiesta',
            'description' => 'Berkumpul dan bernyanyi bersama musisi indie lokal dan nasional favoritmu dalam suasana yang hangat dan intim.',
            'date' => '2026-09-15 18:30:00',
            'location' => 'Taman Budaya Yogyakarta',
            'price' => 100000,
            'stock' => 800,
            // DIPERBAIKI: Menggunakan Placehold.co agar dijamin tidak error
            'poster_path' => 'https://placehold.co/800x1000/4F46E5/FFFFFF?text=Indie+Music+Fiesta&font=Montserrat'
        ]);


        // ==========================================
        // KATEGORI 2: SEMINAR TEKNOLOGI (3 Event)
        // ==========================================
        
        // Event Seminar 1
        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'AI & Future Tech Summit',
            'description' => 'Seminar eksklusif yang membahas perkembangan Artificial Intelligence (AI) dan bagaimana dampaknya terhadap karir di masa depan. Cocok untuk mahasiswa dan profesional IT.',
            'date' => '2026-06-10 08:00:00',
            'location' => 'Ruang Citra 2, Universitas AMIKOM',
            'price' => 75000,
            'stock' => 200,
            'poster_path' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Seminar 2
        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'Cyber Security Awareness 101',
            'description' => 'Pelajari bahaya kejahatan siber yang marak terjadi saat ini dan bagaimana cara melindungi data pribadi maupun perusahaan Anda.',
            'date' => '2026-10-05 09:00:00',
            'location' => 'Auditorium Kampus Terpadu',
            'price' => 50000,
            'stock' => 300,
            'poster_path' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Seminar 3
        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'Startup & Innovation Talk',
            'description' => 'Sesi berbagi pengalaman dari para Founder dan CEO Startup sukses. Mengupas tuntas dari tahap ideasi hingga mendapatkan pendanaan.',
            'date' => '2026-11-12 13:00:00',
            'location' => 'Hotel Marriot Yogyakarta',
            'price' => 120000,
            'stock' => 250,
            // DIPERBAIKI: Menggunakan Placehold.co agar dijamin tidak error
            'poster_path' => 'https://placehold.co/800x1000/10B981/FFFFFF?text=Startup+Talk&font=Montserrat'
        ]);


        // ==========================================
        // KATEGORI 3: WORKSHOP & PELATIHAN (3 Event)
        // ==========================================
        
        // Event Workshop 1
        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'Masterclass Web Development',
            'description' => 'Pelatihan intensif full-stack web development menggunakan framework Laravel dan React JS. Peserta akan dibimbing membuat project nyata dari nol sampai di-hosting.',
            'date' => '2026-07-15 09:00:00',
            'location' => 'Hotel Tentrem Yogyakarta',
            'price' => 250000,
            'stock' => 50,
            'poster_path' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Workshop 2
        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'UI/UX Design Sprint Bootcamp',
            'description' => 'Belajar metode Design Sprint yang digunakan oleh perusahaan teknologi dunia seperti Google. Tingkatkan kemampuan riset dan prototyping Anda.',
            'date' => '2026-09-01 08:30:00',
            'location' => 'Coworking Space Sinergi',
            'price' => 150000,
            'stock' => 40,
            'poster_path' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Workshop 3
        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'Digital Marketing Masterclass',
            'description' => 'Praktik langsung strategi beriklan di Meta Ads dan Google Ads, serta teknik SEO untuk menaikkan penjualan produk Anda secara signifikan.',
            'date' => '2026-10-20 10:00:00',
            'location' => 'Lab Komputer Universitas AMIKOM',
            'price' => 200000,
            'stock' => 60,
            'poster_path' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop'
        ]);


        // ==========================================
        // KATEGORI 4: OLAHRAGA & E-SPORTS (3 Event)
        // ==========================================
        
        // Event Olahraga 1
        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'AMIKOM E-Sports Tournament',
            'description' => 'Turnamen E-Sports tingkat nasional memperebutkan piala bergilir dan total hadiah puluhan juta rupiah. Game yang dipertandingkan: Mobile Legends dan Valorant.',
            'date' => '2026-08-01 10:00:00',
            'location' => 'Gor AMONGROGO',
            'price' => 35000,
            'stock' => 1000,
            'poster_path' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Olahraga 2
        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'Amikom Fun Run 5K & 10K',
            'description' => 'Ajang lomba lari terbesar untuk civitas akademika dan masyarakat umum. Dapatkan medali eksklusif dan doorprize menarik.',
            'date' => '2026-08-15 05:30:00',
            'location' => 'Alun-Alun Kidul Yogyakarta',
            'price' => 75000,
            'stock' => 500,
            'poster_path' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?q=80&w=800&auto=format&fit=crop'
        ]);

        // Event Olahraga 3
        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'National Futsal Championship',
            'description' => 'Kompetisi futsal antar Universitas seluruh Indonesia. Dukung tim jagoanmu untuk menjadi yang terbaik di lapangan hijau!',
            'date' => '2026-11-01 08:00:00',
            'location' => 'Gedung Olahraga UNY',
            'price' => 15000,
            'stock' => 1500,
            'poster_path' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=800&auto=format&fit=crop'
        ]);

        $this->command->info('Data Event berhasil dibuat!');
        
        $this->command->info('Semua data Dummy berhasil di-restore!');
    }
}