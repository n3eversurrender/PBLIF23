<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingPerusahaanSeeder extends Seeder
{
    public function run()
    {
        $perusahaanIds = range(1, 10); // Perusahaan ID dari 1 sampai 10
        $pemberiIds = range(3, 312); // Peserta ID dari 3 sampai 312

        $combinations = [];
        $data = [];

        // Array komentar positif dengan 100 komentar
        $positifKomentar = [
            'Pelatihan yang sangat membantu, saya belajar banyak tentang pengelolaan proyek!',
            'Pengalaman luar biasa, instruktur sangat berpengalaman dalam bidangnya.',
            'Proses administrasi yang cepat dan mudah, membuat saya lebih fokus pada pelatihan.',
            'Kursus ini memberi banyak wawasan, saya siap menerapkan ilmu yang didapat di lapangan!',
            'Pelatihan praktis yang sangat mendalam, saya merasa lebih percaya diri sekarang!',
            'Administrasi kursus sangat terorganisir, tidak ada kendala yang saya alami.',
            'Instruktur sangat sabar dan memahami kebutuhan peserta pelatihan.',
            'Materi yang diberikan sangat relevan dengan pekerjaan yang saya lakukan sekarang.',
            'Proses pelatihan yang berjalan lancar dan saya sangat puas dengan kualitasnya.',
            'Kursus ini memberikan banyak pengalaman praktis yang akan sangat berguna di pekerjaan.',
            'Pelatihan sangat aplikatif dan dapat langsung diterapkan di tempat kerja.',
            'Kualitas pengajaran sangat baik, instruktur menjelaskan materi dengan jelas.',
            'Sistem administrasi sangat efisien, tidak ada kendala dalam proses pendaftaran.',
            'Pelatihan ini memberikan banyak insight baru, sangat bermanfaat untuk perkembangan karir.',
            'Materi yang diberikan sangat lengkap, mencakup semua aspek yang dibutuhkan di lapangan.',
            'Pelatihan sangat terstruktur, memudahkan saya dalam mengikuti setiap sesi.',
            'Pengalaman saya dalam pelatihan ini sangat luar biasa, saya merasa lebih siap.',
            'Instruktur sangat responsif, siap membantu peserta kapan pun diperlukan.',
            'Pelatihan ini sesuai dengan ekspektasi, memberikan pengalaman yang saya cari.',
            'Proses pelatihan berjalan dengan baik, tidak ada masalah dalam implementasinya.',
            'Saya sangat puas dengan kualitas materi yang diberikan oleh pelatih.',
            'Pelatihan ini mempersiapkan saya dengan baik untuk tantangan di dunia profesional.',
            'Proses pendaftaran sangat mudah dan cepat, tidak ada masalah selama kursus.',
            'Pelatihan ini sangat membantu meningkatkan keterampilan teknis saya.',
            'Instruktur memiliki pengalaman yang luas, memberikan banyak contoh praktis.',
            'Proses administrasi sangat cepat, tidak ada kendala dalam pendaftaran dan pembayaran.',
            'Saya belajar banyak hal baru dalam pelatihan ini, sangat bermanfaat.',
            'Pelatihan ini memberikan saya pemahaman yang lebih dalam mengenai topik yang diajarkan.',
            'Materi pelatihan disusun dengan sangat baik dan mudah dipahami.',
            'Pelatihan berjalan dengan lancar, sangat memuaskan dan memberikan manfaat nyata.',
            'Instruktur memberikan penjelasan yang jelas dan mudah dimengerti.',
            'Kursus ini memberikan saya kesempatan untuk belajar langsung dari para ahli.',
            'Sistem administrasi yang sangat efisien, tidak ada hambatan dalam prosesnya.',
            'Pelatihan yang sangat interaktif, saya merasa lebih terlibat dalam setiap sesi.',
            'Pelatihan ini sangat praktikal dan memberikan keterampilan yang dapat langsung diterapkan.',
            'Saya merasa sangat dihargai dan didukung sepanjang pelatihan.',
            'Kursus ini memberikan kesempatan untuk bekerja langsung di lapangan, sangat membantu.',
            'Pelatihan ini memberi saya banyak insight tentang industri yang belum saya ketahui sebelumnya.',
            'Instruktur sangat menguasai materi dan memberikan penjelasan yang sangat mendalam.',
            'Pelatihan ini sangat terfokus pada pengembangan keterampilan yang dibutuhkan di industri.',
            'Saya merasa lebih percaya diri setelah mengikuti pelatihan ini.',
            'Materi pelatihan disampaikan dengan cara yang sangat menarik dan mudah dipahami.',
            'Proses pendaftaran sangat mudah dan cepat, sangat memudahkan saya.',
            'Saya mendapat banyak pengetahuan baru yang bisa langsung saya terapkan di tempat kerja.',
            'Instruktur selalu siap memberikan bantuan dan dukungan jika diperlukan.',
            'Pelatihan ini sangat membantu saya untuk berkembang dalam pekerjaan saya.',
            'Proses pelatihan sangat terorganisir, setiap materi diberikan sesuai dengan jadwal.',
            'Pelatihan ini sangat efektif dan memberikan hasil yang nyata.',
            'Kursus ini sangat bermanfaat, memberikan keterampilan yang dapat digunakan dalam pekerjaan.',
            'Pelatihan sangat mendalam, saya merasa lebih siap menghadapi tantangan kerja.',
            'Materi pelatihan sangat komprehensif dan memberikan gambaran yang jelas mengenai industri.',
            'Pelatihan ini sangat membantu saya dalam meningkatkan keterampilan teknis dan profesional.',
            'Kursus ini membantu saya memahami banyak konsep yang sebelumnya sulit dipahami.',
            'Pelatihan ini memberikan pengalaman belajar yang sangat berharga.',
            'Pelatihan ini memungkinkan saya untuk belajar langsung dari praktisi di lapangan.',
            'Instruktur sangat sabar dalam memberikan penjelasan, membuat saya merasa nyaman untuk bertanya.',
            'Materi yang diberikan sangat relevan dengan kebutuhan industri saat ini.',
            'Kursus ini memberi banyak wawasan yang sangat bermanfaat untuk pengembangan karir saya.',
            'Pelatihan ini sangat terstruktur dan memberikan banyak kesempatan untuk praktek langsung.',
            'Pelatihan ini memberikan banyak pengetahuan yang sangat berguna untuk pengembangan diri.',
            'Kursus ini sangat bermanfaat dan memberikan saya keterampilan baru yang sangat berguna.',
            'Instruktur sangat berdedikasi untuk memastikan setiap peserta mendapatkan pemahaman yang baik.',
            'Pelatihan berjalan dengan sangat lancar dan tidak ada kendala yang berarti.',
            'Saya merasa sangat terbantu dengan pengajaran yang disampaikan selama pelatihan.',
            'Pelatihan ini memberikan pengetahuan yang saya butuhkan untuk berkembang di industri.',
            'Pelatihan ini memberikan pengalaman yang sangat positif dan membuka wawasan saya.',
            'Kursus ini sangat sesuai dengan apa yang saya harapkan, memberikan saya keterampilan yang sangat dibutuhkan.',
            'Pelatihan ini memberikan kesempatan untuk berinteraksi langsung dengan profesional di bidangnya.',
            'Pengalaman saya mengikuti pelatihan ini sangat memuaskan, banyak ilmu yang saya dapatkan.',
            'Pelatihan ini sangat mendalam dan memberikan pemahaman yang kuat tentang industri.',
            'Kursus ini sangat membantu dalam meningkatkan keterampilan teknis saya.',
            'Saya merasa lebih siap menghadapi tantangan kerja setelah mengikuti pelatihan ini.',
            'Pelatihan ini memberikan wawasan yang sangat bernilai untuk pengembangan karir saya.',
            'Kursus ini sangat baik untuk meningkatkan keterampilan praktis yang dibutuhkan di lapangan.',
            'Pelatihan ini memberikan banyak kesempatan untuk belajar dan berlatih langsung di lapangan.',
            'Pelatihan ini sangat terorganisir dengan baik, memberikan pengalaman belajar yang menyenangkan.',
            'Pelatihan ini sangat memuaskan, memberikan banyak ilmu yang relevan dengan pekerjaan saya.',
            'Kursus ini memberi banyak kesempatan untuk bertanya dan berdiskusi langsung dengan instruktur.',
            'Pelatihan ini memberikan banyak pengetahuan yang aplikatif dan berguna dalam pekerjaan sehari-hari.',
            'Instruktur sangat berkompeten, memberikan pemahaman yang jelas tentang materi.',
            'Pelatihan ini sangat aplikatif dan sangat berguna dalam pekerjaan saya.',
            'Saya sangat puas dengan pelatihan ini, materi yang disampaikan sangat mendalam dan aplikatif.',
            'Kursus ini membantu saya mengembangkan keterampilan yang sangat dibutuhkan dalam pekerjaan saya.',
            'Pelatihan ini sangat menyeluruh dan sangat membantu saya dalam mengembangkan karir.',
            'Kursus ini sangat efektif dalam mengajarkan keterampilan praktis yang diperlukan di lapangan.',
            'Pelatihan ini memberikan wawasan yang luas dan bermanfaat untuk pengembangan profesional saya.',
            'Proses administrasi sangat cepat dan mudah, membuat saya tidak perlu khawatir soal administrasi.',
            'Pelatihan ini sangat bermanfaat, memberikan keterampilan yang langsung bisa diterapkan di lapangan.',
            'Pelatihan ini sangat bermanfaat, memberikan pengetahuan yang sangat relevan dengan pekerjaan saya.',
            'Materi yang diajarkan sangat lengkap dan aplikatif, sangat membantu perkembangan karir saya.',
            'Proses administrasi sangat cepat, saya sangat puas dengan pengalaman mengikuti pelatihan ini.',
            'Pelatihan ini sangat terstruktur, memberikan pemahaman yang jelas tentang apa yang perlu dipelajari.',
            'Saya sangat puas dengan kualitas instruktur yang sangat berpengalaman.',
        ];


        // Array komentar negatif dengan 100 komentar
        $negatifKomentar = [
            'Pelatihan terlalu teoritis, tidak ada cukup praktik yang diberikan.',
            'Pengurusan administrasi sangat lambat, membuat saya harus menunggu lama.',
            'Materi yang diberikan kurang aplikatif, sulit dipahami tanpa pengalaman lapangan.',
            'Saya kecewa dengan kurangnya kesempatan untuk langsung praktik di lapangan.',
            'Instruktur tidak cukup memberikan penjelasan mendalam tentang materi.',
            'Proses administrasi sangat berbelit-belit, banyak dokumen yang harus dipersiapkan.',
            'Pelatihan berjalan tidak sesuai jadwal, banyak keterlambatan.',
            'Kursus sangat terbatas, tidak ada ruang untuk tanya jawab.',
            'Saya merasa kurang puas dengan kurangnya praktik langsung di industri.',
            'Sangat mengecewakan karena tidak ada tindak lanjut setelah pelatihan selesai.',
            'Pelatihan terlalu singkat, saya merasa banyak hal yang belum diajarkan.',
            'Materi pelatihan terlalu dasar, saya ingin materi yang lebih mendalam.',
            'Proses administrasi sangat kacau, saya merasa bingung dengan semua dokumen yang harus disiapkan.',
            'Saya kecewa karena tidak ada cukup waktu untuk tanya jawab dengan instruktur.',
            'Pelatihan sangat monoton, tidak ada variasi dalam metode pengajaran.',
            'Instruktur tidak cukup komunikatif, banyak materi yang terlewat.',
            'Proses pelatihan sering terhambat oleh masalah teknis.',
            'Sangat sulit untuk mengikuti pelatihan ini karena kurangnya dukungan instruktur.',
            'Pelatihan ini lebih fokus pada teori daripada praktek yang lebih berguna.',
            'Sangat kecewa karena pelatihan tidak sesuai dengan apa yang dijanjikan.',
            'Pelatihan tidak memberikan pengalaman lapangan yang cukup.',
            'Tidak ada materi yang benar-benar baru, semuanya sudah saya ketahui sebelumnya.',
            'Kursus ini tidak memenuhi harapan saya, saya merasa tidak banyak belajar.',
            'Proses administrasi sangat rumit, membuat saya bingung dengan semua persyaratannya.',
            'Pelatihan tidak sesuai dengan ekspektasi saya, kurang banyak yang bisa dipelajari.',
            'Sangat kecewa karena tidak ada pelatihan praktek langsung di lapangan.',
            'Materi yang diberikan terlalu teknis dan sulit dipahami tanpa pengalaman.',
            'Pelatihan berjalan sangat lambat, instruktur tidak memberikan banyak informasi baru.',
            'Saya merasa pelatihan ini kurang lengkap dan terlalu banyak kekurangan.',
            'Materi yang diberikan tidak relevan dengan pekerjaan yang saya lakukan.',
            'Instruktur tidak bisa menjelaskan dengan baik, saya merasa kebingungan selama pelatihan.',
            'Pelatihan terlalu panjang dan tidak ada banyak interaksi.',
            'Proses administrasi sangat memakan waktu, membuat saya harus menunggu lama.',
            'Pelatihan kurang fokus pada apa yang dibutuhkan oleh peserta.',
            'Saya kecewa dengan ketidakteraturan selama pelatihan.',
            'Pelatihan terlalu banyak fokus pada teori, tidak cukup aplikasi nyata.',
            'Pelatihan ini hanya mengulang materi yang sudah saya ketahui, tidak ada hal baru.',
            'Saya merasa bahwa kursus ini tidak memberikan banyak nilai tambah.',
            'Tidak ada banyak interaksi antara peserta dan instruktur.',
            'Pelatihan ini terlalu banyak waktu untuk hal-hal yang tidak penting.',
            'Instruktur tidak cukup memberi penjelasan, saya merasa banyak materi yang hilang.',
            'Pelatihan ini sangat terbatas, saya berharap ada lebih banyak pilihan topik.',
            'Proses administrasi sangat membingungkan dan tidak terorganisir.',
            'Pelatihan ini tidak terlalu memberikan dampak positif pada pekerjaan saya.',
            'Kursus ini tidak sesuai dengan harapan saya, kurang mendalam.',
            'Pelatihan terlalu umum, tidak ada penekanan pada keterampilan teknis.',
            'Proses administrasi sangat memakan waktu, harus menunggu lama untuk konfirmasi.',
            'Pelatihan ini terlalu fokus pada aspek yang tidak terlalu relevan dengan pekerjaan.',
            'Saya merasa kecewa karena tidak ada praktik langsung di lapangan.',
            'Materi pelatihan terlalu rumit, dan instruktur tidak bisa menjelaskan dengan jelas.',
            'Pelatihan ini terlalu singkat, saya merasa tidak mendapatkan cukup waktu untuk belajar.',
            'Sangat mengecewakan karena tidak ada tindak lanjut setelah kursus selesai.',
            'Kursus ini tidak memenuhi standar yang saya harapkan.',
            'Instruktur tidak memberikan feedback yang cukup terhadap hasil kerja saya.',
            'Pelatihan terlalu bertele-tele, banyak waktu yang terbuang sia-sia.',
            'Pelatihan ini sangat membosankan dan tidak memberi banyak informasi baru.',
            'Sangat kecewa dengan kurangnya keterlibatan dari instruktur.',
            'Materi terlalu fokus pada hal-hal yang tidak relevan dengan pekerjaan.',
            'Pelatihan ini tidak memberikan pengalaman nyata yang saya harapkan.',
            'Instruktur terlalu cepat menjelaskan materi, sulit untuk mengikuti.',
            'Pelatihan ini sangat terbatas dalam hal praktik lapangan.',
            'Saya merasa kursus ini tidak mengajarkan hal yang saya harapkan.',
            'Proses administrasi sangat kacau, saya kesulitan dalam mengatur jadwal.',
            'Pelatihan ini tidak memberikan keterampilan yang saya butuhkan.',
            'Pelatihan ini tidak memberikan nilai tambah yang signifikan bagi saya.',
            'Kursus ini terlalu banyak teori, kurang banyak praktik langsung.',
            'Instruktur tidak memberikan perhatian yang cukup kepada peserta.',
            'Pelatihan ini terlalu panjang dan tidak efisien.',
            'Saya kecewa dengan kurangnya fokus pada masalah praktis yang nyata.',
            'Kursus ini terlalu fokus pada aspek yang tidak relevan.',
            'Pelatihan ini tidak sesuai dengan industri yang saya tuju.',
            'Proses administrasi sangat memakan waktu, membuat saya merasa frustasi.',
            'Saya merasa bahwa materi yang diajarkan tidak sesuai dengan kebutuhan saya.',
            'Pelatihan ini sangat mengecewakan, tidak memberikan banyak manfaat.',
            'Instruktur tidak bisa menjelaskan materi dengan cara yang mudah dipahami.',
            'Pelatihan terlalu umum dan tidak cukup mendalam.',
            'Saya kecewa karena tidak ada kesempatan untuk berinteraksi dengan peserta lainnya.',
            'Pelatihan ini terlalu fokus pada teori yang tidak bisa langsung diterapkan.',
            'Saya berharap pelatihan ini lebih banyak memberikan kesempatan untuk praktik.',
            'Pelatihan tidak cukup memberikan ruang untuk diskusi dan tanya jawab.',
            'Proses administrasi sangat membingungkan dan memakan waktu.',
        ];


        // Pembagian rating per perusahaan dengan jumlah ulasan tertentu
        $ratingDistribusi = [
            5.0 => [1 => 150],  // 1 perusahaan dengan rating 5.0, 150 ulasan
            4.7 => [2 => 250, 3 => 250],  // 2 perusahaan dengan rating 4.7, masing-masing 250 ulasan
            4.1 => [4 => 250, 5 => 250],  // 2 perusahaan dengan rating 4.1, masing-masing 250 ulasan
            3.7 => [7 => 300, 6 => 300],  // 2 perusahaan dengan rating 3.7, masing-masing 300 ulasan
            3.2 => [8 => 300, 9 => 300], // 2 perusahaan dengan rating 3.2, masing-masing 300 ulasan
            2.0 => [10 => 300],    // 1 perusahaan dengan rating 2.0, 300 ulasan
        ];

        $combinations = [];
        $data = [];

        // Setiap perusahaan akan mendapatkan ulasan sesuai dengan distribusi
        foreach ($ratingDistribusi as $rating => $companies) {
            foreach ($companies as $perusahaan_id => $ulasanCount) {
                for ($i = 0; $i < $ulasanCount; $i++) {
                    // Pilih acak peserta
                    $pemberi_id = $pemberiIds[array_rand($pemberiIds)];

                    // Tentukan komentar secara acak antara positif dan negatif
                    $komentar = (rand(1, 100) <= 50) // 50% positif atau negatif
                        ? $positifKomentar[array_rand($positifKomentar)]
                        : $negatifKomentar[array_rand($negatifKomentar)];

                    // Cek apakah kombinasi perusahaan dan peserta sudah ada untuk menghindari duplikasi
                    $key = $perusahaan_id . '-' . $pemberi_id;
                    if (!isset($combinations[$key])) {
                        $combinations[$key] = true;

                        // Masukkan data ke dalam array
                        $data[] = [
                            'pemberi_id' => $pemberi_id,
                            'perusahaan_id' => $perusahaan_id,
                            'rating' => $rating,
                            'komentar' => $komentar,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        // Masukkan data ke dalam tabel rating_perusahaan
        DB::table('rating_perusahaan')->insert($data);
    }
}