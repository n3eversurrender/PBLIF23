<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KursusSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Daftar kursus untuk 10 perusahaan
        $kursus_data = [
            // Perusahaan 3: Batam Steel Works
            [
                'judul' => 'Pelatihan Pengelasan Listrik untuk Pemula',
                'deskripsi' => 'Pelatihan ini dirancang bagi pemula yang ingin belajar dasar-dasar pengelasan listrik, termasuk pengenalan alat dan teknik pengelasan yang aman.',
                'pengguna_id' => 3, // Batam Steel Works
            ],
            [
                'judul' => 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan pemrograman mesin CNC untuk memproduksi komponen presisi, sangat berguna bagi industri manufaktur di Batam.',
                'pengguna_id' => 3,
            ],
            [
                'judul' => 'Desain dan Prototyping 3D dalam Proses Fabrikasi',
                'deskripsi' => 'Peserta akan belajar cara menggunakan CAD dan 3D printing untuk membuat prototipe produk yang dapat digunakan dalam produksi massal.',
                'pengguna_id' => 3,
            ],
            [
                'judul' => 'Pengenalan Mesin Pemotong Laser untuk Fabrikasi',
                'deskripsi' => 'Pelatihan ini memperkenalkan peserta dengan mesin pemotong laser, mempelajari pengaturan dan pemrogramannya untuk memotong material dengan presisi.',
                'pengguna_id' => 3,
            ],
            [
                'judul' => 'Pembuatan Mold dan Die untuk Produksi Massal',
                'deskripsi' => 'Kursus ini berfokus pada pembuatan mold dan die untuk produksi massal, teknik yang krusial untuk meningkatkan efisiensi di industri manufaktur.',
                'pengguna_id' => 3,
            ],

            // Perusahaan 4: Mega Baja Utama
            [
                'judul' => 'Pelatihan Pengelasan Stainless Steel dan Inox',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik pengelasan pada stainless steel dan material inox, yang banyak digunakan dalam industri pembuatan peralatan tahan karat.',
                'pengguna_id' => 4, // Mega Baja Utama
            ],
            [
                'judul' => 'Teknik Pengelasan MIG dan TIG untuk Fabrikasi',
                'deskripsi' => 'Kursus ini memberikan pelatihan tentang pengelasan MIG dan TIG untuk fabrikasi logam, teknik yang banyak digunakan untuk menghasilkan sambungan yang kuat.',
                'pengguna_id' => 4,
            ],
            [
                'judul' => 'Teknik Finishing dan Polishing untuk Produk Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik finishing untuk produk logam yang difabrikasi, termasuk polishing untuk hasil akhir yang halus dan estetis.',
                'pengguna_id' => 4,
            ],
            [
                'judul' => 'Proses Manufaktur Komponen Elektronik untuk Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan proses pembuatan komponen elektronik presisi yang digunakan dalam perakitan sistem elektronik dan perangkat industri.',
                'pengguna_id' => 4,
            ],
            [
                'judul' => 'Pembuatan Prototipe dengan Teknologi Additive Manufacturing',
                'deskripsi' => 'Peserta akan mempelajari penggunaan teknologi additive manufacturing, termasuk printer 3D, untuk menghasilkan prototipe produk dengan cepat.',
                'pengguna_id' => 4,
            ],

            // Perusahaan 5: PT Fabrikasi Prima
            [
                'judul' => 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi',
                'deskripsi' => 'Pelatihan tentang pemrograman mesin CNC untuk industri fabrikasi, sangat penting untuk menghasilkan komponen presisi dengan metode otomatis.',
                'pengguna_id' => 5, // PT Fabrikasi Prima
            ],
            [
                'judul' => 'Teknik Pengoperasian Mesin Milling untuk Fabrikasi',
                'deskripsi' => 'Peserta akan mempelajari teknik pengoperasian mesin milling untuk memproduksi komponen dengan toleransi presisi yang tinggi.',
                'pengguna_id' => 5,
            ],
            [
                'judul' => 'Manajemen Proyek di Industri Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan keterampilan manajerial untuk mengelola proyek-proyek fabrikasi mulai dari perencanaan hingga pengawasan produksi.',
                'pengguna_id' => 5,
            ],
            [
                'judul' => 'Pembuatan Alat Ukur untuk Konstruksi dan Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan pembuatan alat ukur presisi untuk digunakan dalam proyek-proyek konstruksi dan fabrikasi.',
                'pengguna_id' => 5,
            ],
            [
                'judul' => 'Pelatihan Menggunakan Mesin Bubut untuk Fabrikasi',
                'deskripsi' => 'Pelatihan tentang pengoperasian mesin bubut untuk memotong dan membentuk bahan logam, digunakan untuk menciptakan komponen presisi.',
                'pengguna_id' => 5,
            ],

            // Perusahaan 6: Batam Metal Engineering
            [
                'judul' => 'Pelatihan Pengelasan Aluminium dan Baja untuk Fabrikasi',
                'deskripsi' => 'Pelatihan pengelasan untuk material aluminium dan baja yang digunakan dalam pembuatan komponen struktural untuk berbagai industri.',
                'pengguna_id' => 6, // Batam Metal Engineering
            ],
            [
                'judul' => 'Teknik Pengelasan dan Pembuatan Struktur Baja',
                'deskripsi' => 'Pelatihan pengelasan untuk pembuatan struktur baja, banyak digunakan untuk pembangunan jembatan dan bangunan tinggi.',
                'pengguna_id' => 6,
            ],
            [
                'judul' => 'Pelatihan Pengoperasian Mesin Laser Cutting di Batam',
                'deskripsi' => 'Peserta akan mempelajari pengoperasian mesin laser cutting untuk memotong bahan logam dan non-logam dengan akurasi tinggi.',
                'pengguna_id' => 6,
            ],
            [
                'judul' => 'Pembuatan Jembatan dan Struktur Baja untuk Infrastruktur',
                'deskripsi' => 'Kursus ini berfokus pada desain dan pembuatan jembatan dan struktur baja untuk proyek infrastruktur besar.',
                'pengguna_id' => 6,
            ],
            [
                'judul' => 'Desain Cetakan untuk Fabrikasi Plastik di Batam',
                'deskripsi' => 'Pelatihan desain cetakan untuk fabrikasi plastik, digunakan untuk pembuatan komponen plastik dalam industri manufaktur.',
                'pengguna_id' => 6,
            ],

            // Perusahaan 7: Sei Beduk Steel Fabricators
            [
                'judul' => 'Pelatihan Pengelasan Aluminium dan Baja untuk Fabrikasi',
                'deskripsi' => 'Pelatihan tentang pengelasan aluminium dan baja untuk fabrikasi komponen struktural yang digunakan dalam berbagai aplikasi.',
                'pengguna_id' => 7, // Sei Beduk Steel Fabricators
            ],
            [
                'judul' => 'Pengoperasian Mesin CNC untuk Produksi Massal',
                'deskripsi' => 'Pelatihan mesin CNC untuk produksi massal komponen presisi, menggunakan teknik pengoperasian yang efisien.',
                'pengguna_id' => 7,
            ],
            [
                'judul' => 'Teknik Finishing untuk Produk Fabrikasi Logam',
                'deskripsi' => 'Kursus ini mengajarkan teknik finishing untuk produk logam, menghasilkan produk akhir yang siap pakai.',
                'pengguna_id' => 7,
            ],
            [
                'judul' => 'Proses Pengelasan Baja Karbon untuk Industri',
                'deskripsi' => 'Kursus ini mengajarkan pengelasan baja karbon, digunakan untuk membuat komponen yang kuat dan tahan lama.',
                'pengguna_id' => 7,
            ],
            [
                'judul' => 'Pelatihan Manufaktur Komponen Logam Presisi',
                'deskripsi' => 'Pelatihan dalam proses manufaktur untuk menciptakan komponen logam presisi, yang digunakan dalam berbagai aplikasi industri.',
                'pengguna_id' => 7,
            ],

            // Perusahaan 8: PT Galang Fabrikasi
            [
                'judul' => 'Pembuatan Mold dan Die untuk Produksi Massal',
                'deskripsi' => 'Pelatihan mengenai teknik pembuatan mold dan die untuk produksi massal, memungkinkan produksi komponen dalam jumlah besar.',
                'pengguna_id' => 8, // PT Galang Fabrikasi
            ],
            [
                'judul' => 'Teknik Pengoperasian Mesin Bubut untuk Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan penggunaan mesin bubut untuk memotong bahan logam, penting untuk produksi komponen presisi.',
                'pengguna_id' => 8,
            ],
            [
                'judul' => 'Manajemen Proyek dalam Industri Pengelasan',
                'deskripsi' => 'Kursus ini mengajarkan bagaimana mengelola proyek pengelasan, termasuk perencanaan, pengawasan, dan kontrol kualitas.',
                'pengguna_id' => 8,
            ],
            [
                'judul' => 'Desain dan Pembuatan Struktur Baja untuk Infrastruktur',
                'deskripsi' => 'Kursus ini berfokus pada desain dan pembuatan struktur baja yang digunakan dalam pembangunan infrastruktur besar.',
                'pengguna_id' => 8,
            ],
            [
                'judul' => 'Teknik Perawatan Mesin dalam Industri Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik perawatan mesin industri untuk memastikan mesin tetap berfungsi dengan baik di lingkungan fabrikasi.',
                'pengguna_id' => 8,
            ],
            // Perusahaan 9: Lubuk Baja Industrial
            [
                'judul' => 'Pelatihan Pengelasan Listrik untuk Pemula',
                'deskripsi' => 'Pelatihan ini ditujukan bagi pemula yang ingin mempelajari dasar-dasar pengelasan listrik, termasuk pengenalan alat dan teknik pengelasan yang aman.',
                'pengguna_id' => 9,
            ],
            [
                'judul' => 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi',
                'deskripsi' => 'Kursus ini memberikan pemahaman mendalam tentang pengoperasian mesin CNC (Computer Numerical Control), termasuk cara membaca gambar teknik dan pemrograman mesin untuk produksi komponen presisi.',
                'pengguna_id' => 9,
            ],
            [
                'judul' => 'Pembuatan Mold dan Die untuk Produksi Massal',
                'deskripsi' => 'Pelatihan ini dirancang untuk mengajarkan pembuatan mold dan die yang digunakan dalam proses produksi massal. Peserta akan mempelajari teknik merancang dan membuat cetakan yang dapat digunakan untuk memproduksi komponen dalam jumlah besar.',
                'pengguna_id' => 9,
            ],
            [
                'judul' => 'Desain dan Pembuatan Produk untuk Industri Konstruksi',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik desain dan pembuatan produk-produk untuk industri konstruksi menggunakan bahan-bahan yang sesuai dan teknologi fabrikasi yang efisien.',
                'pengguna_id' => 9,
            ],
            [
                'judul' => 'Teknik Finishing dan Polishing untuk Produk Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan teknik finishing untuk produk logam yang difabrikasi, menghasilkan produk akhir yang siap pakai dengan permukaan halus dan estetis.',
                'pengguna_id' => 9,
            ],

            // Perusahaan 10: Bengkong Steel Fabricators
            [
                'judul' => 'Teknik Pengelasan MIG dan TIG untuk Fabrikasi',
                'deskripsi' => 'Kursus ini memberikan pelatihan tentang pengelasan MIG dan TIG untuk fabrikasi logam, teknik yang banyak digunakan untuk menghasilkan sambungan yang kuat dan tahan lama.',
                'pengguna_id' => 10,
            ],
            [
                'judul' => 'Pelatihan Pengoperasian Mesin Laser Cutting di Batam',
                'deskripsi' => 'Peserta akan mempelajari pengoperasian mesin laser cutting untuk memotong bahan logam dan non-logam dengan akurasi tinggi, teknik yang banyak digunakan di industri manufaktur.',
                'pengguna_id' => 10,
            ],
            [
                'judul' => 'Pelatihan Pengelasan Stainless Steel dan Inox',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik pengelasan pada stainless steel dan material inox yang banyak digunakan dalam pembuatan peralatan tahan karat untuk berbagai industri.',
                'pengguna_id' => 10,
            ],
            [
                'judul' => 'Pembuatan Jembatan dan Struktur Baja untuk Infrastruktur',
                'deskripsi' => 'Kursus ini berfokus pada desain dan pembuatan jembatan serta struktur baja untuk proyek infrastruktur besar, dengan memperhatikan kekuatan dan daya tahan.',
                'pengguna_id' => 10,
            ],
            [
                'judul' => 'Proses Manufaktur Komponen Elektronik untuk Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan proses pembuatan komponen elektronik presisi yang digunakan dalam perakitan sistem elektronik dan perangkat industri.',
                'pengguna_id' => 10,
            ],

            // Perusahaan 11: Nongsa Metal Works
            [
                'judul' => 'Pelatihan Pengelasan dan Pembuatan Struktur Baja',
                'deskripsi' => 'Kursus ini berfokus pada pengelasan untuk pembuatan struktur baja, teknik yang banyak digunakan dalam industri konstruksi dan manufaktur besar.',
                'pengguna_id' => 11,
            ],
            [
                'judul' => 'Teknik Pengoperasian Mesin Milling untuk Fabrikasi',
                'deskripsi' => 'Pelatihan ini memberikan keterampilan praktis dalam pengoperasian mesin milling, yang digunakan untuk memotong dan membentuk bahan logam dan plastik.',
                'pengguna_id' => 11,
            ],
            [
                'judul' => 'Desain dan Pembuatan Produk untuk Industri Konstruksi',
                'deskripsi' => 'Pelatihan ini mengajarkan keterampilan desain produk untuk industri konstruksi, dengan fokus pada material dan teknik fabrikasi yang efisien.',
                'pengguna_id' => 11,
            ],
            [
                'judul' => 'Pembuatan Prototipe dengan Teknologi Additive Manufacturing',
                'deskripsi' => 'Peserta akan mempelajari penggunaan teknologi additive manufacturing untuk membuat prototipe produk secara cepat, menghemat waktu dan biaya.',
                'pengguna_id' => 11,
            ],
            [
                'judul' => 'Teknik Finishing dan Polishing untuk Produk Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan teknik finishing untuk produk logam yang difabrikasi, memastikan hasil akhir yang berkualitas tinggi dan estetis.',
                'pengguna_id' => 11,
            ],

            // Perusahaan 12: Barelang Fabrication Tech
            [
                'judul' => 'Pembuatan Mold dan Die untuk Produksi Massal',
                'deskripsi' => 'Kursus ini berfokus pada teknik pembuatan mold dan die yang digunakan dalam produksi massal, memungkinkan penghematan waktu dan biaya dalam proses manufaktur.',
                'pengguna_id' => 12,
            ],
            [
                'judul' => 'Manajemen Proyek di Industri Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan bagaimana mengelola proyek-proyek fabrikasi, mulai dari perencanaan hingga pelaksanaan, dengan fokus pada kontrol biaya dan kualitas.',
                'pengguna_id' => 12,
            ],
            [
                'judul' => 'Pelatihan Pengoperasian Mesin Bubut untuk Fabrikasi',
                'deskripsi' => 'Kursus ini mengajarkan penggunaan mesin bubut untuk memotong dan membentuk bahan logam, digunakan untuk menghasilkan komponen presisi dalam industri fabrikasi.',
                'pengguna_id' => 12,
            ],
            [
                'judul' => 'Pelatihan Pengelasan Listrik untuk Pemula',
                'deskripsi' => 'Kursus ini memberikan pengenalan dasar pengelasan listrik bagi pemula, penting bagi mereka yang ingin memulai karir di industri fabrikasi.',
                'pengguna_id' => 12,
            ],
            [
                'judul' => 'Desain dan Prototyping 3D dalam Proses Fabrikasi',
                'deskripsi' => 'Pelatihan ini mengajarkan peserta cara menggunakan CAD dan printer 3D untuk membuat prototipe produk, yang sangat penting dalam industri fabrikasi modern.',
                'pengguna_id' => 12,
            ],
        ];

        // Insert data kursus ke dalam database
        foreach ($kursus_data as $index => $data) {
            DB::table('kursus')->insert([
                'pengguna_id' => $data['pengguna_id'], // ID Perusahaan
                'kategori_id' => rand(1, 5),  // Mengambil kategori acak
                'judul' => $data['judul'], // Judul kursus sesuai dengan data
                'deskripsi' => $data['deskripsi'], // Deskripsi kursus sesuai dengan data
                'harga' => rand(3100000, 10000000), // Harga acak
                'tingkat_kesulitan' => rand(1, 3) == 1 ? 'Pemula' : (rand(1, 3) == 2 ? 'Menengah' : 'Lanjutan'),
                'status' => 'Aktif',
                'tgl_mulai' => now()->addDays(rand(1, 365)),  // Tanggal mulai acak
                'tgl_selesai' => now()->addDays(rand(365, 730)),  // Tanggal selesai acak
                'kapasitas' => rand(10, 30), // Kapasitas acak
                'lokasi' => 'Batam ' . $this->generateLocation(), // Lokasi acak
                // Set foto_kursus sesuai urutan: kursus1.jpg, kursus2.jpg, dst
                'foto_kursus' => 'kursus/kursus' . ($index + 1) . '.jpg',
            ]);
        }
    }

    // Fungsi untuk generate lokasi acak
    private function generateLocation()
    {
        $lokasi_batam = [
            'Nagoya' => 'Jl. Nagoya No.1, Batam Center',
            'Batam Center' => 'Jl. Batam Center No.5, Batam Center',
            'Baloi' => 'Jl. Baloi No.3, Baloi',
            'Muka Kuning' => 'Jl. Muka Kuning No.7, Muka Kuning',
            'Sei Beduk' => 'Jl. Sei Beduk No.9, Sei Beduk',
            'Teban' => 'Jl. Teban No.4, Teban',
            'Batu Aji' => 'Jl. Batu Aji No.2, Batu Aji',
            'Lubuk Baja' => 'Jl. Lubuk Baja No.8, Lubuk Baja',
            'Simpang Base' => 'Jl. Simpang Base No.6, Simpang Base',
            'Tanjung Uncang' => 'Jl. Tanjung Uncang No.11, Tanjung Uncang',
            'Kabil' => 'Jl. Kabil No.12, Kabil',
            'Bintan Center' => 'Jl. Bintan Center No.14, Bintan',
            'Bintan' => 'Jl. Bintan No.16, Bintan',
            'Tiban' => 'Jl. Tiban No.19, Tiban',
            'Kampung Belian' => 'Jl. Kampung Belian No.13, Kampung Belian',
            'Batam Kota' => 'Jl. Batam Kota No.15, Batam Kota',
            'Jodoh' => 'Jl. Jodoh No.10, Jodoh',
            'Batu Besar' => 'Jl. Batu Besar No.17, Batu Besar',
            'Batu Ampar' => 'Jl. Batu Ampar No.20, Batu Ampar',
            'Teluk Tering' => 'Jl. Teluk Tering No.21, Teluk Tering'
        ];

        return $lokasi_batam[array_rand($lokasi_batam)];
    }
}
