<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Event;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Kategori
        $catKonser = Category::create([
            'name' => 'Konser Musik',
            'slug' => Str::slug('Konser Musik')
        ]);

        $catSeminar = Category::create([
            'name' => 'Seminar Teknologi',
            'slug' => Str::slug('Seminar Teknologi')
        ]);

        $catWorkshop = Category::create([
            'name' => 'Workshop & Pelatihan',
            'slug' => Str::slug('Workshop & Pelatihan')
        ]);

        $catOlahraga = Category::create([
            'name' => 'Olahraga & E-Sports',
            'slug' => Str::slug('Olahraga & E-Sports')
        ]);

        // 2. Buat Data Partner
        Partner::create([
            'name' => 'Tokopedia',
            'logo_url' => 'https://ui-avatars.com/api/?name=Tokopedia&background=47B95B&color=fff&size=200&font-size=0.33'
        ]);

        Partner::create([
            'name' => 'Gojek',
            'logo_url' => 'https://ui-avatars.com/api/?name=Gojek&background=00AA13&color=fff&size=200&font-size=0.33'
        ]);

        Partner::create([
            'name' => 'Traveloka',
            'logo_url' => 'https://ui-avatars.com/api/?name=Traveloka&background=1BA0E2&color=fff&size=200&font-size=0.33'
        ]);

        Partner::create([
            'name' => 'Bank BCA',
            'logo_url' => 'https://ui-avatars.com/api/?name=BCA&background=0066AE&color=fff&size=200&font-size=0.4'
        ]);

        // 3. Buat Data Event (Masing-masing kategori ada 3 event dengan GAMBAR BERBEDA)

        // --- KATEGORI: KONSER MUSIK ---
        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Jazz Night Concert 2026',
            'description' => 'Nikmati malam yang syahdu dengan alunan musik jazz dari musisi-musisi papan atas Indonesia. Jangan lewatkan penawaran spesial untuk tiket early bird!',
            'date' => '2026-05-25 19:00:00',
            'location' => 'Jogja Expo Center (JEC)',
            'price' => 150000,
            'stock' => 500,
            'poster_path' => 'https://images.unsplash.com/photo-1511192336575-5a79af67a629?q=80&w=800&auto=format&fit=crop' // Gambar Saksofon/Jazz
        ]);

        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Indie Rock Festival',
            'description' => 'Festival musik indie terbesar tahun ini! Menampilkan band-band lokal indie yang sedang naik daun. Siapkan energimu untuk bernyanyi bersama.',
            'date' => '2026-06-15 15:00:00',
            'location' => 'Stadion Mandala Krida',
            'price' => 200000,
            'stock' => 1500,
            'poster_path' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=800&auto=format&fit=crop' // Gambar Keramaian Konser
        ]);

        Event::create([
            'category_id' => $catKonser->id,
            'title' => 'Symphony of the Night: Orkestra Klasik',
            'description' => 'Sebuah pertunjukan orkestra klasik yang membawakan mahakarya komposer legendaris. Pengalaman musik yang elegan dan tak terlupakan.',
            'date' => '2026-07-20 20:00:00',
            'location' => 'Gedung Societet Militair Taman Budaya Yogyakarta',
            'price' => 350000,
            'stock' => 300,
            'poster_path' => 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?q=80&w=800&auto=format&fit=crop' // Gambar Biola/Orkestra
        ]);


        // --- KATEGORI: SEMINAR TEKNOLOGI ---
        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'AI & Future Tech Summit',
            'description' => 'Seminar eksklusif yang membahas perkembangan Artificial Intelligence (AI) dan bagaimana dampaknya terhadap karir di masa depan. Cocok untuk mahasiswa dan profesional IT.',
            'date' => '2026-06-10 08:00:00',
            'location' => 'Ruang Citra 2, Universitas AMIKOM',
            'price' => 75000,
            'stock' => 200,
            'poster_path' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=800&auto=format&fit=crop' // Gambar Abstrak AI
        ]);

        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'Cybersecurity Awareness Forum',
            'description' => 'Pelajari ancaman keamanan siber terkini dan cara melindungi data perusahaan Anda. Diisi oleh praktisi keamanan siber bersertifikat internasional.',
            'date' => '2026-08-05 09:00:00',
            'location' => 'Hotel Tentrem Yogyakarta',
            'price' => 150000,
            'stock' => 150,
            'poster_path' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=800&auto=format&fit=crop' // Gambar Gembok Siber
        ]);

        Event::create([
            'category_id' => $catSeminar->id,
            'title' => 'Cloud Computing for Beginners',
            'description' => 'Pengenalan teknologi Cloud Computing (AWS, GCP, Azure) bagi pemula. Pelajari bagaimana cloud mengubah cara perusahaan membangun infrastruktur IT.',
            'date' => '2026-09-12 10:00:00',
            'location' => 'Ruang Amikom 1',
            'price' => 50000,
            'stock' => 100,
            'poster_path' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=800&auto=format&fit=crop' // Gambar Planet/Data Cloud
        ]);


        // --- KATEGORI: WORKSHOP & PELATIHAN ---
        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'Masterclass Web Development',
            'description' => 'Pelatihan intensif full-stack web development menggunakan framework Laravel dan React JS. Peserta akan dibimbing membuat project nyata dari nol sampai di-hosting.',
            'date' => '2026-07-15 09:00:00',
            'location' => 'Hotel Tentrem Yogyakarta',
            'price' => 250000,
            'stock' => 50,
            'poster_path' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=800&auto=format&fit=crop' // Gambar Laptop Coding
        ]);

        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'Digital Marketing Bootcamp',
            'description' => 'Pelajari strategi Digital Marketing dari ahli industri. Materi meliputi SEO, Google Ads, Facebook Ads, dan Social Media Management. Cocok untuk pengusaha UMKM.',
            'date' => '2026-08-20 08:30:00',
            'location' => 'Ruang Inovasi AMIKOM',
            'price' => 300000,
            'stock' => 40,
            'poster_path' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=800&auto=format&fit=crop' // Gambar Catatan Marketing
        ]);

        Event::create([
            'category_id' => $catWorkshop->id,
            'title' => 'UI/UX Design Masterclass: Figma to Reality',
            'description' => 'Praktik langsung mendesain antarmuka pengguna yang menarik dan fungsional menggunakan Figma. Peserta akan membuat prototype aplikasi mobile yang interaktif.',
            'date' => '2026-09-05 13:00:00',
            'location' => 'Lab Komputer 4, Universitas AMIKOM',
            'price' => 120000,
            'stock' => 30,
            'poster_path' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800&auto=format&fit=crop' // Gambar Desain di Layar
        ]);


        // --- KATEGORI: OLAHRAGA & E-SPORTS ---
        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'AMIKOM E-Sports Tournament',
            'description' => 'Turnamen E-Sports tingkat nasional memperebutkan piala bergilir dan total hadiah puluhan juta rupiah. Game yang dipertandingkan: Mobile Legends dan Valorant.',
            'date' => '2026-08-01 10:00:00',
            'location' => 'Gor AMONGROGO',
            'price' => 35000,
            'stock' => 1000,
            'poster_path' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=800&auto=format&fit=crop' // Gambar Setup Gaming
        ]);

        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'Yogyakarta City Marathon 2026',
            'description' => 'Ajang lari marathon tahunan yang melintasi ikon-ikon kota Yogyakarta. Tersedia kategori 5K, 10K, Half-Marathon, dan Full Marathon.',
            'date' => '2026-10-25 05:00:00',
            'location' => 'Alun-Alun Utara Keraton Yogyakarta',
            'price' => 250000,
            'stock' => 5000,
            'poster_path' => 'https://images.unsplash.com/photo-1530143311094-34d807799e8f?q=80&w=800&auto=format&fit=crop' // Gambar Pelari Maraton
        ]);

        Event::create([
            'category_id' => $catOlahraga->id,
            'title' => 'Futsal Championship Antar Mahasiswa',
            'description' => 'Turnamen futsal bergengsi antar mahasiswa se-DIY. Tunjukkan bakat tim futsal kampusmu dan raih gelar juara!',
            'date' => '2026-11-10 08:00:00',
            'location' => 'Gedung Olahraga Universitas Negeri Yogyakarta',
            'price' => 50000,
            'stock' => 500,
            'poster_path' => 'https://images.unsplash.com/photo-1518605368461-1eb47b4d3c6c?q=80&w=800&auto=format&fit=crop' // Gambar Lapangan Bola/Futsal
        ]);
        
        // Cek terminal, akan muncul teks ini jika sukses
        $this->command->info('Data Dummy (Kategori, Partner, 12 Event) berhasil di-seed dengan gambar bervariasi!');
    }
}