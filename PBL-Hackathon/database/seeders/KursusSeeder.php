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

        // Daftar judul kursus yang berhubungan dengan dunia fabrikasi di Batam
        $kursus_titles = [
            'Pelatihan Pengelasan Listrik untuk Pemula',
            'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi',
            'Desain dan Prototyping 3D dalam Proses Fabrikasi',
            'Pengenalan Mesin Pemotong Laser untuk Fabrikasi',
            'Pembuatan Mold dan Die untuk Produksi Massal',
            'Teknik Pengelasan MIG dan TIG untuk Fabrikasi',
            'Manajemen Proyek di Industri Fabrikasi',
            'Teknik Pemrograman Robot Industri di Batam',
            'Pelatihan Pengoperasian Mesin Milling untuk Fabrikasi',
            'Pembuatan Prototipe dengan Teknologi Additive Manufacturing',
            'Kursus Pengelasan Aluminium dan Baja untuk Fabrikasi',
            'Pengoperasian Mesin Laser Cutting di Batam',
            'Pembuatan Alat Ukur untuk Konstruksi dan Fabrikasi',
            'Pelatihan Pengoperasian Mesin Gerinda di Industri Fabrikasi',
            'Teknik Perawatan Mesin dalam Industri Fabrikasi',
            'Pelatihan Pengelasan Stainless Steel dan Inox',
            'Desain Cetakan untuk Fabrikasi Plastik di Batam',
            'Kursus Pembuatan Alat-alat Konstruksi dari Logam',
            'Teknik Finishing dan Polishing untuk Produk Fabrikasi',
            'Pengantar Desain CAD untuk Produksi Fabrikasi',
            'Pelatihan Pengelasan dan Pembuatan Struktur Baja',
            'Proses Manufaktur Komponen Elektronik untuk Fabrikasi',
            'Pelatihan Pengoperasian Mesin Pabrik Komponen Logam',
            'Kursus Pengelasan Mig dan Tig untuk Profesional',
            'Pembuatan Jembatan dan Struktur Baja untuk Infrastruktur',
            'Teknik Penggunaan Printer 3D dalam Proses Fabrikasi',
            'Teknik Perawatan dan Reparasi Alat Fabrikasi',
            'Pelatihan Menggunakan Mesin Bubut untuk Fabrikasi',
            'Desain dan Pembuatan Produk untuk Industri Konstruksi',
            'Pelatihan Proses Pemotongan dan Perakitan Logam',
        ];

        $lokasi_batam = [
            'Nagoya',
            'Batam Center',
            'Baloi',
            'Muka Kuning',
            'Sei Beduk',
            'Teban',
            'Batu Aji',
            'Lubuk Baja',
            'Simpang Base',
            'Tanjung Uncang',
            'Kabil',
            'Bintan Center',
            'Bintan',
            'Tiban',
            'Kampung Belian',
            'Batam Kota',
            'Jodoh',
            'Batu Besar',
            'Batu Ampar',
            'Teluk Tering'
        ];

        foreach ($kursus_titles as $index => $judul) {
            // Generate tgl_mulai terlebih dahulu
            $tgl_mulai = $faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d');
            
            // Generate tgl_selesai setelah tgl_mulai, dengan memastikan tgl_selesai >= tgl_mulai
            $tgl_selesai = $faker->dateTimeBetween($tgl_mulai, '2025-12-31')->format('Y-m-d');

            DB::table('kursus')->insert([
                'pengguna_id' => $faker->numberBetween(3, 7),
                'kategori_id' => $faker->numberBetween(1, 5),
                'judul' => $judul,  // Judul kursus yang sudah disesuaikan
                'deskripsi' => $this->generateDescription($judul),  // Deskripsi yang disesuaikan dengan judul
                'harga' => $faker->randomElement([
                    3100000, 3200000, 3300000, 3400000, 3500000, 3600000, 3700000, 3800000, 3900000, 4000000,
                    4100000, 4200000, 4300000, 4400000, 4500000, 4600000, 4700000, 4800000, 4900000, 5000000,
                    5100000, 5200000, 5300000, 5400000, 5500000, 5600000, 5700000, 5800000, 5900000, 6000000,
                    6100000, 6200000, 6300000, 6400000, 6500000, 6600000, 6700000, 6800000, 6900000, 7000000,
                    7100000, 7200000, 7300000, 7400000, 7500000, 7600000, 7700000, 7800000, 7900000, 8000000,
                    8100000, 8200000, 8300000, 8400000, 8500000, 8600000, 8700000, 8800000, 8900000, 9000000,
                    9100000, 9200000, 9300000, 9400000, 9500000, 9600000, 9700000, 9800000, 9900000, 10000000
                ]),
                'tingkat_kesulitan' => $faker->randomElement(['Pemula', 'Menengah', 'Lanjutan']),
                'status' => $faker->randomElement(['Aktif']),
                'tgl_mulai' => $tgl_mulai,  // Gunakan tgl_mulai yang sudah di-generate
                'tgl_selesai' => $tgl_selesai,  // Gunakan tgl_selesai yang lebih besar atau sama dengan tgl_mulai
                'kapasitas' => $faker->numberBetween(10, 30),
                'lokasi' => 'Batam ' . $faker->randomElement($lokasi_batam),
                'foto_kursus' => null,  // Foto di-set null
            ]);
        }
    }

    // Fungsi untuk generate deskripsi sesuai dengan judul
    private function generateDescription($judul)
    {
        $faker = Faker::create('id_ID');  // Pindahkan Faker ke dalam fungsi

        switch ($judul) {
            case 'Pelatihan Pengelasan Listrik untuk Pemula':
                return "Pelatihan ini ditujukan bagi pemula yang ingin mempelajari dasar-dasar pengelasan listrik. Peserta akan dikenalkan dengan peralatan pengelasan, teknik dasar pengelasan yang aman, serta penerapannya dalam industri fabrikasi. Kursus ini sangat penting bagi mereka yang ingin memulai karir di industri manufaktur di Batam.";
            case 'Pelatihan Pemrograman Mesin CNC di Dunia Fabrikasi':
                return "Kursus ini memberikan pemahaman mendalam tentang pengoperasian mesin CNC (Computer Numerical Control), termasuk cara membaca gambar teknik dan pemrograman mesin untuk produksi komponen presisi. Pelatihan ini sangat relevan dengan kebutuhan industri manufaktur di Batam yang mengandalkan mesin CNC untuk produksi komponen presisi.";
            case 'Desain dan Prototyping 3D dalam Proses Fabrikasi':
                return "Pelatihan ini mengajarkan peserta cara mendesain produk menggunakan perangkat lunak CAD dan mencetak prototipe menggunakan printer 3D. Dengan keterampilan ini, peserta dapat menghasilkan prototipe untuk evaluasi dan pengujian, yang sangat dibutuhkan dalam industri fabrikasi di Batam.";
            case 'Pengenalan Mesin Pemotong Laser untuk Fabrikasi':
                return "Kursus ini memberikan pelatihan mengenai pengoperasian mesin pemotong laser untuk memotong bahan seperti logam, plastik, dan kayu. Peserta akan mempelajari cara pengaturan dan pemrograman mesin untuk menghasilkan potongan dengan presisi tinggi, sesuai dengan kebutuhan produksi di Batam.";
            case 'Pembuatan Mold dan Die untuk Produksi Massal':
                return "Pelatihan ini dirancang untuk mengajarkan pembuatan mold dan die yang digunakan dalam proses produksi massal. Peserta akan mempelajari teknik merancang dan membuat cetakan yang dapat digunakan untuk memproduksi komponen dalam jumlah besar, sangat diperlukan di industri besar di Batam.";
            case 'Teknik Pengelasan MIG dan TIG untuk Fabrikasi':
                return "Kursus ini berfokus pada teknik pengelasan MIG (Metal Inert Gas) dan TIG (Tungsten Inert Gas) yang banyak digunakan dalam industri fabrikasi. Peserta akan mempelajari cara mengelas berbagai jenis logam, termasuk baja dan aluminium, dengan teknik yang tepat untuk menghasilkan sambungan yang kuat dan tahan lama.";
            case 'Manajemen Proyek di Industri Fabrikasi':
                return "Pelatihan ini memberikan keterampilan manajerial yang dibutuhkan untuk mengelola proyek-proyek fabrikasi. Peserta akan mempelajari cara merencanakan, mengatur, dan mengendalikan proyek dari awal hingga akhir, termasuk pengelolaan anggaran, sumber daya, dan waktu yang sangat penting dalam industri fabrikasi di Batam.";
            case 'Teknik Pemrograman Robot Industri di Batam':
                return "Pelatihan ini mengajarkan peserta cara memprogram robot industri untuk tugas-tugas otomatisasi dalam proses fabrikasi. Peserta akan belajar cara mengoptimalkan penggunaan robot dalam lini produksi, sesuai dengan perkembangan pesat teknologi di Batam yang banyak menggunakan robot dalam produksi.";
            case 'Pelatihan Pengoperasian Mesin Milling untuk Fabrikasi':
                return "Pelatihan ini memberikan keterampilan praktis dalam pengoperasian mesin milling, yang digunakan untuk memotong dan membentuk bahan logam dan plastik. Peserta akan diajarkan cara mengoperasikan mesin dengan aman dan efektif untuk menghasilkan komponen presisi yang dibutuhkan di industri fabrikasi.";
            case 'Pembuatan Prototipe dengan Teknologi Additive Manufacturing':
                return "Kursus ini memberikan pemahaman tentang teknologi Additive Manufacturing (AM), termasuk penggunaan printer 3D untuk membuat prototipe. Peserta akan belajar cara memanfaatkan teknologi terbaru untuk mempercepat pengembangan produk dan inovasi di industri fabrikasi.";
            // Tambahkan deskripsi sesuai dengan kursus lainnya...
            default:
                return $faker->text(200);  // Deskripsi default jika tidak ada yang cocok
        }
    }
}
