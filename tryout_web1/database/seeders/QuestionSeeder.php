<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $data = [
// =========================
// PENALARAN UMUM
// =========================
'Penalaran Umum' => [
    [
        'question' => 'Semua mamalia bernapas dengan paru-paru. Paus adalah mamalia. Kesimpulan yang benar adalah...',
        'options' => ["Paus hidup di darat", "Paus bertelur", "Paus bernapas dengan paru-paru", "Paus tidak bernapas"],
        'answer' => 'Paus bernapas dengan paru-paru'
    ],
    [
        'question' => 'Jika hujan turun, maka jalanan basah. Sekarang hujan turun. Kesimpulan yang logis adalah...',
        'options' => ["Jalanan kering", "Jalanan basah", "Tidak terjadi apa-apa", "Cuaca panas"],
        'answer' => 'Jalanan basah'
    ],
    [
        'question' => 'Semua burung bisa terbang. Penguin adalah burung. Pernyataan ini...',
        'options' => ["Benar", "Salah", "Tidak selalu benar", "Tidak dapat ditentukan"],
        'answer' => 'Tidak selalu benar'
    ],
    [
        'question' => 'Semua siswa rajin belajar. Dika adalah siswa. Maka...',
        'options' => ["Dika pasti malas", "Dika mungkin belajar", "Dika rajin belajar", "Dika bukan siswa"],
        'answer' => 'Dika rajin belajar'
    ],
    [
        'question' => 'Tidak ada ikan yang hidup di gurun. Paus bukan ikan. Kesimpulan yang benar...',
        'options' => ["Paus hidup di gurun", "Paus adalah ikan", "Tidak dapat disimpulkan", "Paus bisa hidup di gurun"],
        'answer' => 'Tidak dapat disimpulkan'
    ],
    [
        'question' => 'Semua A adalah B. Semua B adalah C. Kesimpulan yang benar...',
        'options' => ["Semua A adalah C", "Semua C adalah A", "Tidak semua A adalah C", "Tidak ada hubungan"],
        'answer' => 'Semua A adalah C'
    ],
    [
        'question' => 'Jika hari ini libur, maka toko tutup. Hari ini tidak libur. Kesimpulan yang benar adalah...',
        'options' => ["Toko tutup", "Toko buka", "Toko pasti tutup", "Tidak dapat disimpulkan"],
        'answer' => 'Tidak dapat disimpulkan'
    ],
    [
        'question' => 'Semua manusia adalah makhluk hidup. Socrates adalah manusia. Maka...',
        'options' => ["Socrates bukan makhluk hidup", "Socrates adalah makhluk hidup", "Socrates bukan manusia", "Tidak dapat disimpulkan"],
        'answer' => 'Socrates adalah makhluk hidup'
    ],
    [
        'question' => 'Jika belajar maka lulus. Budi tidak lulus. Maka...',
        'options' => ["Budi belajar", "Budi tidak belajar", "Budi lulus", "Tidak dapat disimpulkan"],
        'answer' => 'Budi tidak belajar'
    ],
    [
        'question' => 'Semua buah mengandung vitamin. Apel adalah buah. Maka...',
        'options' => ["Apel mengandung vitamin", "Apel tidak bergizi", "Apel bukan buah", "Apel berbahaya"],
        'answer' => 'Apel mengandung vitamin'
    ],
    [
        'question' => 'Ani mendapat nilai A setelah belajar 3 jam. Budi belajar 3 jam dan mendapat A. Simpulan induktif yang tepat...',
        'options' => ["Semua orang yang belajar 3 jam akan dapat A", "Nilai A didapat tanpa belajar", "Belajar 3 jam mungkin memberi nilai A", "Tidak ada hubungan"],
        'answer' => 'Belajar 3 jam mungkin memberi nilai A'
    ],
    [
        'question' => 'Setiap kali burung gagak berbunyi, hujan turun. Kesimpulan yang tepat...',
        'options' => ["Bunyi gagak menyebabkan hujan", "Hujan menyebabkan gagak berbunyi", "Ada korelasi antara bunyi gagak dan hujan", "Tidak ada hubungan"],
        'answer' => 'Ada korelasi antara bunyi gagak dan hujan'
    ],
    [
        'question' => 'Listrik padam setiap malam Sabtu. Hari ini malam Sabtu. Maka...',
        'options' => ["Listrik akan menyala", "Listrik mungkin padam", "Listrik pasti menyala", "Tidak mungkin padam"],
        'answer' => 'Listrik mungkin padam'
    ],
    [
        'question' => 'Tiga hari berturut-turut nasi goreng warung A enak. Simpulan yang tepat...',
        'options' => ["Nasi goreng A selalu enak", "Nasi goreng A tidak enak", "Mungkin enak besok juga", "Tidak bisa disimpulkan"],
        'answer' => 'Mungkin enak besok juga'
    ],
    [
        'question' => 'Satu dari lima orang suka membaca novel. Dari 100 orang, kira-kira...',
        'options' => ["5 orang", "10 orang", "20 orang", "25 orang"],
        'answer' => '25 orang'
    ],
    [
        'question' => 'Lima siswa yang mengikuti kursus bahasa lulus UTBK. Simpulan induktif yang logis...',
        'options' => ["Kursus menjamin kelulusan", "Semua siswa harus ikut kursus", "Kursus mungkin membantu kelulusan", "Kursus tidak berguna"],
        'answer' => 'Kursus mungkin membantu kelulusan'
    ],
    [
        'question' => 'Empat buah mangga dari satu pohon terasa manis. Kesimpulan induktif yang logis...',
        'options' => ["Semua mangga dari pohon itu manis", "Pohon itu selalu menghasilkan mangga manis", "Mungkin mangga dari pohon itu manis", "Tidak dapat disimpulkan"],
        'answer' => 'Mungkin mangga dari pohon itu manis'
    ],
    [
        'question' => 'Selama seminggu, bus jurusan A selalu terlambat. Maka...',
        'options' => ["Bus A tidak pernah tepat waktu", "Bus A pasti terlambat besok", "Kemungkinan bus A terlambat lagi", "Tidak bisa diketahui"],
        'answer' => 'Kemungkinan bus A terlambat lagi'
    ],
    [
        'question' => 'Setiap kali Pak Budi mengajar, kelas menjadi tenang. Simpulan logis...',
        'options' => ["Pak Budi adalah guru yang baik", "Kelas tenang karena takut", "Pak Budi mungkin memberi pengaruh tenang", "Tidak ada hubungan"],
        'answer' => 'Pak Budi mungkin memberi pengaruh tenang'
    ],
    [
        'question' => 'Lima siswa dengan nilai tinggi rajin mencatat. Simpulan yang mungkin...',
        'options' => ["Mencatat menyebabkan nilai tinggi", "Mungkin ada hubungan antara mencatat dan nilai", "Mencatat tidak ada gunanya", "Siswa lain tidak mencatat"],
        'answer' => 'Mungkin ada hubungan antara mencatat dan nilai'
    ],
    [
        'question' => 'Mata : Melihat = Telinga : ...',
        'options' => ["Mendengar", "Bicara", "Mencium", "Merasa"],
        'answer' => 'Mendengar'
    ],
    [
        'question' => 'Api : Panas = Es : ...',
        'options' => ["Air", "Dingin", "Salju", "Membeku"],
        'answer' => 'Dingin'
    ],
    [
        'question' => 'Pisang : Kuning = Semangka : ...',
        'options' => ["Merah", "Hijau", "Manis", "Bulat"],
        'answer' => 'Merah'
    ],
    [
        'question' => 'Guru : Sekolah = Dokter : ...',
        'options' => ["Pasien", "Rumah Sakit", "Suntikan", "Obat"],
        'answer' => 'Rumah Sakit'
    ],
    [
        'question' => 'Pena : Menulis = Sapu : ...',
        'options' => ["Membersihkan", "Menggambar", "Mengangkat", "Menyiram"],
        'answer' => 'Membersihkan'
    ],
    [
        'question' => 'Jika semua siswa hadir, maka kelas dimulai. Hari ini kelas tidak dimulai. Maka...',
        'options' => ["Semua siswa hadir", "Sebagian siswa tidak hadir", "Tidak ada siswa", "Semua siswa tidak hadir"],
        'answer' => 'Sebagian siswa tidak hadir'
    ],
    [
        'question' => 'Jika hujan turun maka jalanan licin. Sekarang jalanan tidak licin. Kesimpulan yang benar...',
        'options' => ["Hujan turun", "Tidak hujan", "Tidak dapat disimpulkan", "Jalanan rusak"],
        'answer' => 'Tidak hujan'
    ],
    [
        'question' => 'Semua A adalah B, tapi tidak semua B adalah A. Maka...',
        'options' => ["A subset dari B", "B subset dari A", "A dan B identik", "Tidak ada hubungan"],
        'answer' => 'A subset dari B'
    ],
    [
        'question' => 'Jika saya belajar, maka saya lulus. Saya tidak lulus. Kesimpulan logis...',
        'options' => ["Saya belajar", "Saya tidak belajar", "Saya pasti belajar", "Tidak dapat disimpulkan"],
        'answer' => 'Saya tidak belajar'
    ],
    [
        'question' => 'Jika A maka B. Jika B maka C. A terjadi. Kesimpulan...',
        'options' => ["C pasti terjadi", "B tidak terjadi", "C belum pasti", "A tidak terjadi"],
        'answer' => 'C pasti terjadi'
    ],
],
// =========================
// PENALARAN MATEMATIKA
// =========================
'Penalaran Matematika' => [
    [
        'question' => 'SOAL-SOAL UTBK YANG DIMASUKKAN KE SICERDAS Penalaran Matematika Soal 1 Jika 3x−5=163x - 5 = 163x−5=16, maka nilai dari xxx adalah...',
        'options' => ["6", "7", "8", "9"],
        'answer' => '7'
    ],
    [
        'question' => 'Soal 2 Suatu bilangan dikurangi 4 hasilnya sama dengan dua kali bilangan itu ditambah 8. Bilangan itu adalah...',
        'options' => ["–12", "–8", "4", "6"],
        'answer' => '–12'
    ],
    [
        'question' => 'Soal 3 Jika x=2x = 2x=2 dan y=3y = 3y=3, maka nilai dari 2x2+3y2x^2 + 3y2x2+3y adalah...',
        'options' => ["14", "19", "21", "18"],
        'answer' => '21'
    ],
    [
        'question' => 'Soal 4 Jika f(x)=x2−3x+2f(x) = x^2 - 3x + 2f(x)=x2−3x+2, maka nilai f(4)f(4)f(4) adalah...',
        'options' => ["6", "4", "2", "1"],
        'answer' => '6'
    ],
    [
        'question' => 'Soal 5 Panjang sisi alas sebuah balok adalah 10 cm dan lebarnya 5 cm. Jika tinggi balok 6 cm, maka volumenya adalah...',
        'options' => ["300 cm³", "320 cm³", "280 cm³", "250 cm³"],
        'answer' => '300 cm³'
    ],
    [
        'question' => 'Soal 6 Jika x+y=10x + y = 10x+y=10 dan x−y=2x - y = 2x−y=2, maka nilai dari xxx dan yyy adalah...',
        'options' => ["x = 4, y = 6", "x = 5, y = 5", "x = 6, y = 4", "x = 7, y = 3"],
        'answer' => 'x = 6, y = 4'
    ],
    [
        'question' => 'Soal 7 Dalam suatu kelas terdapat 12 siswa laki-laki dan 18 siswa perempuan. Peluang terpilih siswa perempuan secara acak adalah...',
        'options' => ["3/5", "2/3", "3/4", "1/2"],
        'answer' => '3/5'
    ],
    [
        'question' => 'Soal 8 Rata-rata dari 6, 8, 10, 12, dan 14 adalah...',
        'options' => ["9", "10", "11", "12"],
        'answer' => '10'
    ],
    [
        'question' => 'Soal 9 Jika grafik fungsi y=2x+1y = 2x + 1y=2x+1, maka nilai y ketika x = –2 adalah...',
        'options' => ["–3", "–2", "0", "1"],
        'answer' => '–3'
    ],
    [
        'question' => 'Soal 10 Jika a=3a = 3a=3, b=4b = 4b=4, dan c=5c = 5c=5, maka nilai dari a2+b2=c2a^2 + b^2 = c^2a2+b2=c2 menyatakan bahwa segitiga tersebut adalah...',
        'options' => ["Siku-siku", "Sama kaki", "Sama sisi", "Tumpul"],
        'answer' => 'Siku-siku'
    ],
    [
        'question' => 'Soal 11 Pola bilangan: 2, 4, 7, 11, 16, ... Suku ke-6 adalah...',
        'options' => ["20", "22", "25", "26"],
        'answer' => '22'
    ],
    [
        'question' => 'Soal 12 Sebuah toko memberi diskon 20% dari harga Rp250.000. Harga yang harus dibayar adalah...',
        'options' => ["Rp220.000", "Rp210.000", "Rp200.000", "Rp190.000"],
        'answer' => 'Rp200.000'
    ],
    [
        'question' => 'Soal 13 Hasil dari (3x+2)(x−1)(3x + 2)(x - 1)(3x+2)(x−1) adalah...',
        'options' => ["3x2+2x−23x^2 + 2x - 23x2+2x−2", "3x2−x−23x^2 - x - 23x2−x−2", "3x2−x+23x^2 - x + 23x2−x+2", "3x2+x−23x^2 + x - 23x2+x−2"],
        'answer' => '3x2+x−23x^2 + x - 23x2+x−2'
    ],
    [
        'question' => 'Soal 14 Jika 3x=6\frac{3}{x} = 6x3​=6, maka nilai x adalah...',
        'options' => ["1", "2", "0.5", "0.25"],
        'answer' => '0.5'
    ],
    [
        'question' => 'Soal 15 Perbandingan umur Ani dan Budi adalah 3:5. Jika jumlah umur mereka 64 tahun, maka umur Budi adalah...',
        'options' => ["36", "38", "40", "48"],
        'answer' => '40'
    ],
    [
        'question' => 'Soal 16 Jika diketahui x2+y2=100x^2 + y^2 = 100x2+y2=100 dan x = 6, maka y = ...',
        'options' => ["6", "8", "10", "12"],
        'answer' => '8'
    ],
    [
        'question' => 'Soal 17 Berapakah median dari data: 5, 8, 10, 12, 13, 15, 17?',
        'options' => ["10", "11", "12", "13"],
        'answer' => '12'
    ],
    [
        'question' => 'Soal 18 Rumus luas permukaan kubus dengan panjang sisi s adalah...',
        'options' => ["4s24s^24s2", "5s25s^25s2", "6s26s^26s2", "s2s^2s2"],
        'answer' => '6s26s^26s2'
    ],
    [
        'question' => 'Soal 19 Jika diketahui a=2a = 2a=2, b=3b = 3b=3, maka nilai dari (a+b)2(a + b)^2(a+b)2 adalah...',
        'options' => ["13", "16", "25", "20"],
        'answer' => '25'
    ],
    [
        'question' => 'Soal 20 Suku ke-5 dari barisan aritmetika dengan suku pertama 7 dan beda 3 adalah...',
        'options' => ["15", "16", "18", "19"],
        'answer' => '19'
    ],
],
// =========================
// PEMAHAMAN BACAAN DAN MENULIS
// =========================
'Pemahaman Bacaan dan Menulis' => [
    [
        'question' => 'SOAL-SOAL UTBK YANG DIMASUKKAN KE SICERDAS Pemahaman Bacaan dan Menulis Teks 1 (Soal 1–5): Bacaan: Perubahan gaya hidup masyarakat perkotaan berdampak besar terhadap pola konsumsi makanan. Kesibukan yang tinggi menyebabkan banyak orang memilih makanan cepat saji karena dianggap praktis dan menghemat waktu. Namun, konsumsi makanan cepat saji secara berlebihan dapat meningkatkan risiko penyakit kronis seperti obesitas dan diabetes. 1. Ide pokok paragraf tersebut adalah...',
        'options' => ["Penyakit akibat makanan cepat saji", "Perubahan gaya hidup dan dampaknya pada pola konsumsi", "Masyarakat kota yang sibuk bekerja", "Kelebihan makanan cepat saji"],
        'answer' => 'Perubahan gaya hidup dan dampaknya pada pola konsumsi'
    ],
    [
        'question' => '2. Kata "praktis" dalam paragraf tersebut memiliki arti...',
        'options' => ["Mahal", "Tidak sehat", "Sederhana dan mudah digunakan", "Sulit diperoleh"],
        'answer' => 'Sederhana dan mudah digunakan'
    ],
    [
        'question' => '3. Apa dampak negatif dari makanan cepat saji?',
        'options' => ["Mengurangi stres", "Menambah energi", "Menyebabkan penyakit kronis", "Menghemat pengeluaran"],
        'answer' => 'Menyebabkan penyakit kronis'
    ],
    [
        'question' => '4. Mengapa masyarakat memilih makanan cepat saji?',
        'options' => ["Karena rasanya pedas", "Karena mudah dan hemat waktu", "Karena lebih sehat", "Karena tidak memerlukan bahan baku"],
        'answer' => 'Karena mudah dan hemat waktu'
    ],
    [
        'question' => '5. Kalimat utama paragraf tersebut terletak pada...',
        'options' => ["Awal paragraf", "Tengah paragraf", "Akhir paragraf", "Tidak ada kalimat utama"],
        'answer' => 'Awal paragraf'
    ],
    [
        'question' => 'Teks 2 (Soal 6–10): Bacaan: Banyak siswa menganggap pelajaran matematika sulit dipahami. Hal ini mungkin disebabkan oleh cara pengajaran yang kurang menarik serta minimnya latihan soal yang menantang. Oleh karena itu, diperlukan pendekatan yang lebih kreatif dalam mengajar matematika, seperti penggunaan media digital atau permainan edukatif. 6. Permasalahan utama dalam paragraf adalah...',
        'options' => ["Siswa tidak menyukai matematika", "Guru tidak memahami matematika", "Pembelajaran matematika kurang menarik", "Permainan edukatif tidak efektif"],
        'answer' => 'Pembelajaran matematika kurang menarik'
    ],
    [
        'question' => '7. Solusi yang ditawarkan dalam paragraf adalah...',
        'options' => ["Memberikan hukuman jika tidak paham", "Mengurangi jam pelajaran matematika", "Menggunakan media digital dan permainan", "Menyuruh siswa belajar sendiri"],
        'answer' => 'Menggunakan media digital dan permainan'
    ],
    [
        'question' => '8. Kata "menantang" pada paragraf berarti...',
        'options' => ["Mudah diselesaikan", "Membuat takut", "Sulit dan mendorong berpikir keras", "Tidak berguna"],
        'answer' => 'Sulit dan mendorong berpikir keras'
    ],
    [
        'question' => '9. Jenis paragraf tersebut termasuk...',
        'options' => ["Naratif", "Persuasif", "Eksposisi", "Deskripsi"],
        'answer' => 'Eksposisi'
    ],
    [
        'question' => '10. Simpulan yang sesuai dengan paragraf adalah...',
        'options' => ["Matematika selalu membosankan", "Pengajaran kreatif dapat membantu pemahaman matematika", "Matematika tidak penting dalam kehidupan", "Guru sebaiknya menghindari permainan"],
        'answer' => 'Pengajaran kreatif dapat membantu pemahaman matematika'
    ],
    [
        'question' => 'Soal Kalimat & Paragraf Efektif (Soal 11–15) 11. Kalimat manakah yang paling efektif?',
        'options' => ["Dalam rangka untuk meningkatkan kualitas pendidikan yang lebih baik lagi, maka pemerintah mengambil tindakan.", "Pemerintah mengambil tindakan untuk meningkatkan kualitas pendidikan.", "Dalam rangka meningkatkan kualitas pendidikan, maka pemerintah bertindak.", "Untuk meningkatkan pendidikan, maka pemerintah mengambil tindakan."],
        'answer' => 'Pemerintah mengambil tindakan untuk meningkatkan kualitas pendidikan.'
    ],
    [
        'question' => '12. Kalimat yang memiliki penggunaan kata baku adalah...',
        'options' => ["Sekolah itu berakreditasi “A”.", "Mereka mengapresiasi hasil karya siswa.", "Program itu di launching tahun lalu.", "Saya mengantri sejak pagi."],
        'answer' => 'Mereka mengapresiasi hasil karya siswa.'
    ],
    [
        'question' => '13. Manakah yang merupakan kalimat tidak efektif?',
        'options' => ["Ia bekerja dengan giat dan tekun.", "Demi untuk mencapai cita-cita, ia belajar keras.", "Mereka pergi ke sekolah bersama-sama.", "Semua murid berkumpul di lapangan."],
        'answer' => 'Demi untuk mencapai cita-cita, ia belajar keras.'
    ],
    [
        'question' => '14. Kata tidak baku dalam kalimat "Dia tidak bisa mengefektifkan waktunya" adalah...',
        'options' => ["Dia", "tidak", "mengefektifkan", "waktunya"],
        'answer' => 'mengefektifkan'
    ],
    [
        'question' => '15. Perbaikan kalimat "Saya harap kamu dapat menyampaikan aspirasi kepada pihak yang bersangkutan dengan baik dan benar." adalah...',
        'options' => ["Saya harapkan kamu bisa menyampaikan aspirasi secara baik dan benar.", "Saya berharap kamu dapat menyampaikan aspirasi kepada pihak terkait dengan baik.", "Saya harap kamu bisa menyampaikan aspirasi kepada siapa saja dengan baik.", "Saya harapkan agar kamu menyampaikan aspirasi dengan baik dan benar."],
        'answer' => 'Saya berharap kamu dapat menyampaikan aspirasi kepada pihak terkait dengan baik.'
    ],
    [
        'question' => 'Soal Koherensi Paragraf (Soal 16–20) 16. Urutan kalimat acak berikut yang tepat adalah... (1) Ia pun mulai bangkit dan berusaha menjalani hidupnya kembali. (2) Meski berat, perlahan ia mulai bisa berdamai dengan kenyataan. (3) Kepergian ayahnya membuat Raka terpukul dan jatuh dalam kesedihan mendalam. (4) Awalnya ia mengurung diri dan enggan berbicara dengan siapa pun.',
        'options' => ["3 - 4 - 2 - 1", "3 - 2 - 4 - 1", "4 - 3 - 1 - 2", "2 - 3 - 4 - 1"],
        'answer' => '3 - 4 - 2 - 1'
    ],
    [
        'question' => '17. Kalimat tidak padu dalam paragraf berikut adalah... "Kegiatan ekstrakurikuler di sekolah memiliki banyak manfaat. Salah satunya adalah melatih keterampilan sosial siswa. Selain itu, siswa dapat menyalurkan minat dan bakat. Gedung sekolah ini terdiri dari tiga lantai dan cukup luas."',
        'options' => ["Kegiatan ekstrakurikuler di sekolah...", "Salah satunya adalah melatih keterampilan...", "Selain itu, siswa dapat menyalurkan...", "Gedung sekolah ini terdiri dari tiga lantai..."],
        'answer' => 'Gedung sekolah ini terdiri dari tiga lantai...'
    ],
    [
        'question' => '18. Kata penghubung antarkalimat yang tepat untuk menyatakan pertentangan adalah...',
        'options' => ["Oleh karena itu", "Akan tetapi", "Selain itu", "Sehingga"],
        'answer' => 'Akan tetapi'
    ],
    [
        'question' => '19. Manakah yang merupakan paragraf deduktif?',
        'options' => ["Oleh karena itu, masalah ini harus segera ditangani.", "Menjaga kesehatan sangat penting. Dengan tubuh yang sehat, kita bisa belajar dan bekerja lebih baik. Selain itu, kita terhindar dari berbagai penyakit.", "Karena udara kotor, banyak orang terkena ISPA. Hal ini membuktikan pentingnya menjaga kualitas udara.", "Liburan ke pegunungan menyenangkan. Udara segar, pemandangan indah, dan suasana tenang membuat hati senang."],
        'answer' => 'Menjaga kesehatan sangat penting. Dengan tubuh yang sehat, kita bisa belajar dan bekerja lebih baik. Selain itu, kita terhindar dari berbagai penyakit.'
    ],
    [
        'question' => '20. Kalimat penutup paragraf yang tepat untuk paragraf tentang pentingnya membaca buku adalah...',
        'options' => ["Oleh karena itu, mari kita tanamkan kebiasaan membaca sejak dini.", "Membaca memang sangat menyenangkan jika dilakukan di malam hari.", "Buku adalah jendela dunia yang perlu dijaga kerapihannya.", "Membaca lebih baik daripada menonton TV."],
        'answer' => 'Oleh karena itu, mari kita tanamkan kebiasaan membaca sejak dini.'
    ],
],
// =========================
// LITERASI DALAM BAHASA INGGRIS
// =========================
'Literasi dalam Bahasa Inggris' => [
],
// =========================
// LITERASI DALAM BAHASA INDONESIA
// =========================
'Literasi dalam Bahasa Indonesia' => [
    [
        'question' => 'SOAL-SOAL UTBK YANG DIMASUKKAN KE SICERDAS Literasi dalam Bahasa Indonesia Teks 1 (Soal 1–5) Teks: Energi terbarukan menjadi isu penting di tengah meningkatnya kebutuhan energi global. Sumber energi seperti matahari, angin, dan air dapat digunakan secara berkelanjutan tanpa mencemari lingkungan. Pemerintah Indonesia mendorong pemanfaatan energi terbarukan untuk mengurangi ketergantungan terhadap bahan bakar fosil. 1. Ide pokok paragraf tersebut adalah...',
        'options' => ["Dampak energi terhadap lingkungan", "Pentingnya energi fosil", "Pemanfaatan energi terbarukan", "Kebutuhan energi global"],
        'answer' => 'Pemanfaatan energi terbarukan'
    ],
    [
        'question' => '2. Kata "berkelanjutan" dalam konteks paragraf berarti...',
        'options' => ["Dapat diulang terus-menerus", "Dapat diganti", "Diperoleh secara gratis", "Bersifat sementara"],
        'answer' => 'Dapat diulang terus-menerus'
    ],
    [
        'question' => '3. Tujuan utama pemanfaatan energi terbarukan adalah...',
        'options' => ["Meningkatkan pendapatan negara", "Mengurangi pencemaran air", "Mengurangi ketergantungan pada energi fosil", "Mengurangi penggunaan listrik"],
        'answer' => 'Mengurangi ketergantungan pada energi fosil'
    ],
    [
        'question' => '4. Manakah simpulan yang tepat dari paragraf tersebut?',
        'options' => ["Energi terbarukan lebih mahal daripada fosil", "Pemerintah Indonesia mengabaikan energi alternatif", "Energi fosil tidak akan habis", "Energi terbarukan penting untuk keberlanjutan"],
        'answer' => 'Energi terbarukan penting untuk keberlanjutan'
    ],
    [
        'question' => '5. Kalimat penjelas yang tidak sesuai jika ditambahkan ke dalam paragraf tersebut adalah...',
        'options' => ["Energi angin telah digunakan di banyak negara maju", "Panel surya adalah salah satu bentuk energi alternatif", "Mobil listrik mengurangi emisi karbon", "Harga BBM naik setiap tahun"],
        'answer' => 'Harga BBM naik setiap tahun'
    ],
    [
        'question' => 'Teks 2 (Soal 6–10) Teks: Perkembangan teknologi digital telah mengubah cara masyarakat mengakses informasi. Dahulu, orang bergantung pada surat kabar dan televisi, namun kini internet telah menjadi sumber utama berita. Meski demikian, informasi di internet belum tentu benar sehingga penting bagi masyarakat untuk memiliki literasi digital. 6. Masalah yang diangkat dalam paragraf tersebut adalah...',
        'options' => ["Sulitnya mengakses televisi", "Dominasi surat kabar", "Literasi digital yang rendah", "Banyaknya televisi lokal"],
        'answer' => 'Literasi digital yang rendah'
    ],
    [
        'question' => '7. Informasi dalam teks menunjukkan bahwa...',
        'options' => ["Internet menggantikan semua media", "Informasi dari internet selalu benar", "Masyarakat tidak butuh literasi", "Literasi digital penting untuk memilah informasi"],
        'answer' => 'Literasi digital penting untuk memilah informasi'
    ],
    [
        'question' => '8. Sinonim dari kata "mengakses" adalah...',
        'options' => ["Menyalurkan", "Menerima", "Memperoleh", "Menghindari"],
        'answer' => 'Memperoleh'
    ],
    [
        'question' => '9. Kalimat utama paragraf tersebut adalah...',
        'options' => ["Dahulu orang bergantung pada surat kabar", "Internet menjadi sumber utama berita", "Perkembangan teknologi digital mengubah cara mengakses informasi", "Informasi di internet belum tentu benar"],
        'answer' => 'Perkembangan teknologi digital mengubah cara mengakses informasi'
    ],
    [
        'question' => '10. Apa hubungan antara perkembangan teknologi dan literasi digital?',
        'options' => ["Teknologi menghilangkan literasi", "Literasi digital menurun karena teknologi", "Teknologi menuntut peningkatan literasi digital", "Teknologi membuat semua informasi valid"],
        'answer' => 'Teknologi menuntut peningkatan literasi digital'
    ],
    [
        'question' => '11. Kalimat efektif berikut ini adalah...',
        'options' => ["Dalam rangka untuk menanggulangi kemacetan, maka pemerintah mengeluarkan kebijakan.", "Pemerintah mengeluarkan kebijakan untuk mengatasi kemacetan.", "Kebijakan telah dikeluarkan oleh pemerintah untuk dalam rangka kemacetan.", "Kemacetan diatasi oleh kebijakan yang dikeluarkan."],
        'answer' => 'Pemerintah mengeluarkan kebijakan untuk mengatasi kemacetan.'
    ],
    [
        'question' => '12. Kalimat yang mengandung kata tidak baku adalah...',
        'options' => ["Ia mengunduh data dari internet", "Acara itu dibatalkan secara mendadak", "Kami mengantri di depan pintu", "Rapat dilaksanakan pukul delapan"],
        'answer' => 'Kami mengantri di depan pintu'
    ],
    [
        'question' => '13. Perbaikan kalimat: “Ibu pergi ke pasar membawa tas dan dompet yang baru” adalah...',
        'options' => ["Ibu ke pasar membawa tas dan dompet baru", "Ibu membawa tas dan dompet baru ke pasar", "Ibu ke pasar yang baru membawa tas dan dompet", "Ibu pergi ke pasar dengan membawa tas dan dompet baru"],
        'answer' => 'Ibu pergi ke pasar dengan membawa tas dan dompet baru'
    ],
    [
        'question' => '14. Manakah kalimat tidak efektif berikut ini?',
        'options' => ["Mahasiswa harus mampu berkomunikasi dan bekerja sama", "Dia mampu bekerja dengan baik dalam tim", "Dalam konteks pekerjaan, kemampuan komunikasi sangatlah penting", "Setiap hari ia selalu rutin membaca koran"],
        'answer' => 'Setiap hari ia selalu rutin membaca koran'
    ],
    [
        'question' => '15. Kalimat dengan struktur tidak logis adalah...',
        'options' => ["Dia duduk sambil membaca buku", "Buku itu saya pinjam di perpustakaan", "Mereka pulang setelah selesai bermain", "Sepatu itu membeli saya kemarin"],
        'answer' => 'Sepatu itu membeli saya kemarin'
    ],
    [
        'question' => '16. Urutan kalimat acak yang tepat: (1) Ia pun memulai usahanya dari rumah (2) Banyak tantangan yang ia hadapi di awal (3) Sekarang usahanya telah berkembang (4) Dini adalah seorang pengusaha muda',
        'options' => ["4 - 1 - 2 - 3", "4 - 3 - 2 - 1", "1 - 4 - 2 - 3", "2 - 4 - 1 - 3"],
        'answer' => '4 - 1 - 2 - 3'
    ],
    [
        'question' => '17. Kalimat tidak padu dalam paragraf: “Olahraga secara rutin dapat meningkatkan daya tahan tubuh. Selain itu, dapat membantu menjaga berat badan. Di samping itu, makanan cepat saji kini semakin digemari.”**',
        'options' => ["Olahraga secara rutin...", "Dapat membantu menjaga berat badan", "Makanan cepat saji kini semakin digemari", "Daya tahan tubuh meningkat"],
        'answer' => 'Makanan cepat saji kini semakin digemari'
    ],
    [
        'question' => '18. Kata penghubung yang tepat untuk menyatakan perbandingan adalah...',
        'options' => ["Sebab", "Seperti", "Oleh karena itu", "Namun"],
        'answer' => 'Seperti'
    ],
    [
        'question' => '19. Kata penghubung yang menyatakan akibat adalah...',
        'options' => ["Karena", "Meskipun", "Sehingga", "Namun"],
        'answer' => 'Sehingga'
    ],
    [
        'question' => '20. Kata penghubung penyebab adalah...',
        'options' => ["Supaya", "Karena", "Namun", "Maka"],
        'answer' => 'Karena'
    ],
    [
        'question' => '21. Simpulan yang tepat dari teks yang membahas tentang bahaya merokok adalah...',
        'options' => ["Rokok hanya berbahaya bagi orang tua", "Merokok adalah gaya hidup", "Merokok memiliki dampak kesehatan serius", "Merokok membuat badan gemuk"],
        'answer' => 'Merokok memiliki dampak kesehatan serius'
    ],
    [
        'question' => '22. Judul yang paling tepat untuk teks tentang polusi udara adalah...',
        'options' => ["Mengatasi Macet di Jakarta", "Polusi Udara dan Dampaknya Bagi Kesehatan", "Cuaca Hari Ini", "Harga BBM Turun"],
        'answer' => 'Polusi Udara dan Dampaknya Bagi Kesehatan'
    ],
    [
        'question' => '23. Teks eksposisi biasanya bertujuan untuk...',
        'options' => ["Menceritakan suatu peristiwa", "Mengajak pembaca melakukan sesuatu", "Menjelaskan suatu topik secara logis", "Menggambarkan suasana"],
        'answer' => 'Menjelaskan suatu topik secara logis'
    ],
    [
        'question' => '24. Teks narasi biasanya mengandung...',
        'options' => ["Penjelasan ilmiah", "Fakta dan opini", "Alur, tokoh, dan konflik", "Argumentasi"],
        'answer' => 'Alur, tokoh, dan konflik'
    ],
    [
        'question' => '25. Paragraf induktif memiliki kalimat utama di...',
        'options' => ["Awal paragraf", "Tengah paragraf", "Akhir paragraf", "Tidak ada"],
        'answer' => 'Akhir paragraf'
    ],
    [
        'question' => '26. Kata baku dari “analisa” adalah...',
        'options' => ["Analisa", "Analize", "Analis", "Analisis"],
        'answer' => 'Analisis'
    ],
    [
        'question' => '27. Kata “efektifitas” tidak baku. Bentuk yang benar adalah...',
        'options' => ["Efektifitas", "Efektivitas", "Efektifisasi", "Efektifi"],
        'answer' => 'Efektivitas'
    ],
    [
        'question' => '28. Kalimat dengan ejaan yang benar adalah...',
        'options' => ["Saya menghadiri rapat dirumah Pak Budi", "Kami akan pergi kepasar", "Ia tinggal di Jakarta Selatan", "Mereka berasal dari Bandung,jawa barat"],
        'answer' => 'Ia tinggal di Jakarta Selatan'
    ],
    [
        'question' => '29. Kata “kwalitas” merupakan bentuk tidak baku. Kata baku yang tepat adalah...',
        'options' => ["Kualitas", "Kwaliti", "Kualita", "Kwalitaz"],
        'answer' => 'Kualitas'
    ],
    [
        'question' => '30. Kata “resiko” yang tepat penulisannya menurut PUEBI adalah...',
        'options' => ["Resiko", "Risko", "Risiko", "Reseco"],
        'answer' => 'Risiko'
    ],
],
// =========================
// PENGETAHUAN KUANTITATIF
// =========================
'Pengetahuan Kuantitatif' => [
    [
        'question' => 'SOAL-SOAL UTBK YANG DIMASUKKAN KE SICERDAS Pengetahuan Kuantitatif 1. Hasil dari 36 ÷ 3 + 2 × 5 = ...',
        'options' => ["18", "22", "26", "32"],
        'answer' => '22'
    ],
    [
        'question' => '2. Jika harga sebuah buku adalah Rp80.000 dan mendapat diskon 25%, maka harga setelah diskon adalah...',
        'options' => ["Rp20.000", "Rp60.000", "Rp65.000", "Rp70.000"],
        'answer' => 'Rp60.000'
    ],
    [
        'question' => '3. Jika 2x – 5 = 11, maka nilai x adalah...',
        'options' => ["6", "7", "8", "9"],
        'answer' => '6'
    ],
    [
        'question' => '4. Bilangan ganjil antara 40 dan 50 adalah...',
        'options' => ["4", "5", "6", "7"],
        'answer' => '5'
    ],
    [
        'question' => '5. Hasil dari 15% × 200 adalah...',
        'options' => ["25", "30", "35", "40"],
        'answer' => '30'
    ],
    [
        'question' => '6. Jika x² = 64, maka x = ...',
        'options' => ["6", "±8", "16", "±6"],
        'answer' => '±8'
    ],
    [
        'question' => '7. Selesaikan: 3(x + 2) = 21',
        'options' => ["5", "6", "7", "8"],
        'answer' => '5'
    ],
    [
        'question' => '8. Nilai dari (2x – 1)(x + 3) jika x = 2 adalah...',
        'options' => ["15", "10", "11", "17"],
        'answer' => '15'
    ],
    [
        'question' => '9. Bentuk sederhana dari (2x + 3x – x) adalah...',
        'options' => ["4x", "5x", "3x", "2x"],
        'answer' => '4x'
    ],
    [
        'question' => '10. Jika a = 5 dan b = –3, maka nilai dari a² – b² adalah...',
        'options' => ["34", "16", "25", "9"],
        'answer' => '34'
    ],
    [
        'question' => '11. Modus dari data berikut: 3, 5, 7, 5, 9, 5, 4, 7 adalah...',
        'options' => ["5", "7", "9", "3"],
        'answer' => '5'
    ],
    [
        'question' => '12. Median dari data: 10, 12, 14, 16, 18, 20 adalah...',
        'options' => ["14", "16", "15", "13"],
        'answer' => '15'
    ],
    [
        'question' => 'Median = (14 + 16)/2 = 15 13. Rata-rata dari 7, 8, 10, 5 adalah...',
        'options' => ["7.5", "7", "8", "6.5"],
        'answer' => '7.5'
    ],
    [
        'question' => '14. Peluang muncul angka 3 dari sebuah dadu adalah...',
        'options' => ["1/6", "2/6", "1/3", "1/2"],
        'answer' => '1/6'
    ],
    [
        'question' => '15. Dalam satu kantong terdapat 3 bola merah dan 2 bola biru. Jika diambil 1 bola secara acak, peluang mendapatkan bola merah adalah...',
        'options' => ["2/5", "3/5", "1/5", "4/5"],
        'answer' => '3/5'
    ],
    [
        'question' => '16. Keliling persegi dengan panjang sisi 12 cm adalah...',
        'options' => ["36 cm", "44 cm", "48 cm", "52 cm"],
        'answer' => '48 cm'
    ],
    [
        'question' => '17. Luas lingkaran dengan jari-jari 7 cm adalah...',
        'options' => ["154 cm²", "144 cm²", "147 cm²", "133 cm²"],
        'answer' => '154 cm²'
    ],
    [
        'question' => '18. Panjang diagonal persegi dengan sisi 10 cm adalah...',
        'options' => ["10 cm", "15 cm", "10√2 cm", "5√2 cm"],
        'answer' => '10√2 cm'
    ],
    [
        'question' => '19. Skala peta 1:200.000. Jika jarak dua kota di peta adalah 6 cm, maka jarak sebenarnya adalah...',
        'options' => ["12 km", "10 km", "15 km", "20 km"],
        'answer' => '12 km'
    ],
    [
        'question' => '20. Perbandingan umur Ali dan Budi adalah 3:5. Jika jumlah umur mereka 48 tahun, maka umur Budi adalah...',
        'options' => ["18 tahun", "20 tahun", "30 tahun", "28 tahun"],
        'answer' => '30 tahun'
    ],
],
// =========================
// PENGETAHUAN DAN PEMAHAMAN UMUM
// =========================
'Pengetahuan dan Pemahaman Umum' => [
    [
        'question' => 'SOAL-SOAL UTBK YANG DIMASUKKAN KE SICERDAS Pengetahuan dan Pemahaman Umum Teks 1 (untuk soal 1–3): Indonesia merupakan negara kepulauan terbesar di dunia dengan lebih dari 17.000 pulau. Kondisi ini membuat pembangunan infrastruktur menjadi tantangan tersendiri. Salah satu program pemerintah yang menonjol dalam mengatasi tantangan tersebut adalah pembangunan tol laut, yang bertujuan menurunkan biaya logistik antarwilayah dan meningkatkan konektivitas nasional. Namun, program ini memerlukan dukungan sistem logistik dan pelabuhan yang efisien agar dampaknya maksimal. 1. Apa tujuan utama dari program tol laut?',
        'options' => ["Menambah jumlah kapal pengangkut", "Meningkatkan jumlah pelabuhan di Indonesia", "Menurunkan biaya logistik antarwilayah", "Meningkatkan kunjungan wisata antar pulau"],
        'answer' => 'Menurunkan biaya logistik antarwilayah'
    ],
    [
        'question' => '2. Apa tantangan utama dalam pembangunan infrastruktur di Indonesia menurut teks?',
        'options' => ["Kurangnya bahan bangunan", "Jumlah penduduk yang terlalu padat", "Letak geografis sebagai negara kepulauan", "Kekurangan tenaga kerja"],
        'answer' => 'Letak geografis sebagai negara kepulauan'
    ],
    [
        'question' => '3. Mengapa tol laut membutuhkan sistem logistik dan pelabuhan yang efisien?',
        'options' => ["Agar kapal bisa digunakan lebih sering", "Agar konektivitas antarwilayah menjadi tidak penting", "Agar tol laut tidak mengganggu distribusi udara", "Agar dampak positif dari tol laut dapat maksimal"],
        'answer' => 'Agar dampak positif dari tol laut dapat maksimal'
    ],
    [
        'question' => 'Teks 2 (untuk soal 4–6): Perubahan iklim menjadi isu global yang memengaruhi banyak aspek kehidupan, mulai dari kesehatan, pertanian, hingga ekonomi. Fenomena ini disebabkan oleh peningkatan emisi gas rumah kaca, terutama dari aktivitas manusia seperti pembakaran bahan bakar fosil dan deforestasi. Salah satu langkah mitigasi adalah transisi menuju energi terbarukan. 4. Apa penyebab utama perubahan iklim menurut teks?',
        'options' => ["Polusi udara dari kendaraan listrik", "Aktivitas manusia yang meningkatkan emisi gas rumah kaca", "Meningkatnya curah hujan", "Penggunaan pupuk kimia"],
        'answer' => 'Aktivitas manusia yang meningkatkan emisi gas rumah kaca'
    ],
    [
        'question' => '5. Apa arti kata “mitigasi” dalam konteks paragraf?',
        'options' => ["Penghindaran risiko", "Pengurangan dampak buruk", "Penambahan energi", "Pemanfaatan teknologi"],
        'answer' => 'Pengurangan dampak buruk'
    ],
    [
        'question' => '6. Apa solusi yang ditawarkan untuk mengatasi perubahan iklim?',
        'options' => ["Penebangan hutan secara legal", "Peningkatan penggunaan bahan bakar fosil", "Transisi ke energi terbarukan", "Penggunaan AC hemat listrik"],
        'answer' => 'Transisi ke energi terbarukan'
    ],
    [
        'question' => 'Teks 3 (untuk soal 7–10): Literasi digital merupakan kemampuan individu dalam memahami, menggunakan, dan mengevaluasi informasi dari berbagai platform digital. Di era informasi saat ini, literasi digital penting untuk mencegah penyebaran hoaks dan meningkatkan kualitas diskusi publik. Rendahnya literasi digital dapat menyebabkan masyarakat mudah terprovokasi oleh informasi yang salah. 7. Apa pengertian literasi digital menurut teks?',
        'options' => ["Kemampuan mengetik dan menggunakan aplikasi", "Kemampuan membeli barang secara online", "Kemampuan memahami dan mengevaluasi informasi digital", "Kemampuan membuat konten viral"],
        'answer' => 'Kemampuan memahami dan mengevaluasi informasi digital'
    ],
    [
        'question' => '8. Mengapa literasi digital penting dalam kehidupan saat ini?',
        'options' => ["Untuk mengurangi penggunaan kertas", "Untuk mencegah penyebaran hoaks", "Untuk meningkatkan belanja online", "Untuk memudahkan bermain gim"],
        'answer' => 'Untuk mencegah penyebaran hoaks'
    ],
    [
        'question' => '9. Apa akibat dari rendahnya literasi digital?',
        'options' => ["Masyarakat semakin cerdas", "Mudah percaya informasi benar", "Diskusi publik meningkat", "Mudah terprovokasi oleh informasi salah"],
        'answer' => 'Mudah terprovokasi oleh informasi salah'
    ],
    [
        'question' => '10. Kalimat utama paragraf adalah...',
        'options' => ["Literasi digital penting untuk diskusi publik", "Literasi digital membantu membuat konten", "Literasi digital adalah kemampuan mengevaluasi informasi digital", "Rendahnya literasi digital menyebabkan hoaks"],
        'answer' => 'Literasi digital adalah kemampuan mengevaluasi informasi digital'
    ],
    [
        'question' => 'Teks 4 (untuk soal 11–13): Kegiatan ekonomi berbasis digital terus berkembang seiring meningkatnya penggunaan internet dan perangkat pintar. Salah satu dampaknya adalah tumbuhnya ekonomi kreatif, seperti konten digital, desain grafis, hingga aplikasi mobile. Namun, tantangan seperti keamanan data dan hak kekayaan intelektual masih menjadi isu penting. 11. Apa hubungan antara perkembangan digital dan ekonomi kreatif?',
        'options' => ["Perkembangan digital menghambat ekonomi kreatif", "Perkembangan digital memperkuat pertumbuhan ekonomi kreatif", "Ekonomi kreatif tidak bergantung pada digital", "Ekonomi kreatif menggantikan industri tradisional"],
        'answer' => 'Perkembangan digital memperkuat pertumbuhan ekonomi kreatif'
    ],
    [
        'question' => '12. Apa contoh bidang ekonomi kreatif yang disebutkan?',
        'options' => ["Perbankan digital", "Jasa pengiriman barang", "Konten digital dan aplikasi mobile", "Perdagangan internasional"],
        'answer' => 'Konten digital dan aplikasi mobile'
    ],
    [
        'question' => '13. Tantangan yang dihadapi oleh ekonomi digital adalah...',
        'options' => ["Kurangnya minat masyarakat", "Tingginya pajak digital", "Keamanan data dan kekayaan intelektual", "Harga perangkat digital"],
        'answer' => 'Keamanan data dan kekayaan intelektual'
    ],
    [
        'question' => 'Teks 5 (untuk soal 14–16): Air bersih merupakan kebutuhan dasar manusia. Namun, tidak semua wilayah di Indonesia memiliki akses yang memadai terhadap air bersih. Hal ini dapat menyebabkan berbagai penyakit, terutama penyakit yang ditularkan melalui air, seperti diare dan kolera. Upaya pemerintah dan masyarakat dalam menyediakan sarana air bersih sangat penting untuk kesehatan publik. 14. Apa masalah utama yang diangkat dalam teks?',
        'options' => ["Air bersih terlalu mahal", "Air bersih tersedia melimpah", "Tidak semua wilayah punya akses air bersih", "Air bersih mengandung logam berat"],
        'answer' => 'Tidak semua wilayah punya akses air bersih'
    ],
    [
        'question' => '15. Penyakit yang berkaitan dengan kurangnya air bersih adalah...',
        'options' => ["Asma dan bronkitis", "Demam berdarah", "Diare dan kolera", "Malaria dan tipus"],
        'answer' => 'Diare dan kolera'
    ],
    [
        'question' => '16. Solusi untuk masalah air bersih menurut teks adalah...',
        'options' => ["Penggunaan air hujan", "Peran pemerintah dan masyarakat", "Pemindahan penduduk", "Menutup sungai tercemar"],
        'answer' => 'Peran pemerintah dan masyarakat'
    ],
    [
        'question' => 'Teks 6 (untuk soal 17–20): Pendidikan karakter menjadi bagian penting dari kurikulum nasional. Tujuannya adalah menanamkan nilai-nilai seperti kejujuran, tanggung jawab, dan kerja sama sejak dini. Dengan pendidikan karakter yang kuat, diharapkan generasi muda tumbuh menjadi pribadi yang berintegritas dan peduli terhadap lingkungan sosialnya. 17. Apa tujuan utama pendidikan karakter menurut teks?',
        'options' => ["Meningkatkan prestasi akademik", "Mengajarkan siswa membaca cepat", "Menanamkan nilai-nilai kepribadian positif", "Membuat siswa aktif di media sosial"],
        'answer' => 'Menanamkan nilai-nilai kepribadian positif'
    ],
    [
        'question' => '18. Nilai yang tidak disebutkan dalam teks adalah...',
        'options' => ["Kejujuran", "Kerja sama", "Integritas", "Kreativitas"],
        'answer' => 'Kreativitas'
    ],
    [
        'question' => '19. Apa manfaat pendidikan karakter bagi generasi muda?',
        'options' => ["Menjadi pribadi yang cepat belajar", "Menjadi pribadi yang berintegritas", "Menjadi siswa yang kaya", "Menjadi orang yang kuat fisik"],
        'answer' => 'Menjadi pribadi yang berintegritas'
    ],
    [
        'question' => '20. Paragraf tersebut bersifat...',
        'options' => ["Persuasif", "Deskriptif", "Naratif", "Argumentatif"],
        'answer' => 'Argumentatif'
    ],
],

// =========================
// Literasi dalam Bahasa Inggris
// =========================
'Literasi dalam Bahasa Inggris' => [
    [
        'question' => 'What is the main idea of the passage?',
        'options' => [
            'A. The internet has changed how people shop',
            'B. The internet brings both benefits and risks',
            'C. Newspapers are no longer used',
            'D. Video calls are better than texts'
        ],
        'answer' => 'B. The internet brings both benefits and risks'
    ],
    [
        'question' => 'According to the text, what can we do with the internet?',
        'options' => [
            'A. Visit libraries to find books',
            'B. Avoid all risks easily',
            'C. Hold video conferences',
            'D. Talk only in person'
        ],
        'answer' => 'C. Hold video conferences'
    ],
    [
        'question' => 'The word “transformed” in line 1 is closest in meaning to...',
        'options' => [
            'A. Limited',
            'B. Changed',
            'C. Damaged',
            'D. Repeated'
        ],
        'answer' => 'B. Changed'
    ],
    [
        'question' => 'Which of the following is a possible risk of using the internet?',
        'options' => [
            'A. Improved education',
            'B. Misinformation',
            'C. Meeting new people',
            'D. Writing books'
        ],
        'answer' => 'B. Misinformation'
    ],
    [
        'question' => 'What can be inferred from the passage?',
        'options' => [
            'A. Face-to-face communication is no longer needed',
            'B. People don’t read books anymore',
            'C. We should use the internet carefully',
            'D. Newspapers are faster than the internet'
        ],
        'answer' => 'C. We should use the internet carefully'
    ],
    [
        'question' => 'What is the best title for the story?',
        'options' => [
            'A. Maria’s First Speech',
            'B. A Nervous Teacher',
            'C. A Student’s Hard Work Pays Off',
            'D. How to Debate'
        ],
        'answer' => 'C. A Student’s Hard Work Pays Off'
    ],
    [
        'question' => 'How did Maria prepare for the audition?',
        'options' => [
            'A. By sleeping early',
            'B. By debating with friends',
            'C. By watching TV shows',
            'D. By reading and watching debates'
        ],
        'answer' => 'D. By reading and watching debates'
    ],
    [
        'question' => 'The word “overjoyed” most likely means...',
        'options' => [
            'A. Angry',
            'B. Very happy',
            'C. Bored',
            'D. Tired'
        ],
        'answer' => 'B. Very happy'
    ],
    [
        'question' => 'What can we learn from Maria’s experience?',
        'options' => [
            'A. Nervousness will lead to failure',
            'B. Only talented students win',
            'C. Hard work leads to success',
            'D. Teachers always choose winners'
        ],
        'answer' => 'C. Hard work leads to success'
    ],
    [
        'question' => 'Which of the following is true based on the passage?',
        'options' => [
            'A. Maria failed the audition',
            'B. Maria didn’t practice',
            'C. Maria was confident during the audition',
            'D. The teacher didn\'t support Maria'
        ],
        'answer' => 'C. Maria was confident during the audition'
    ],
    [
        'question' => 'She _____ to the market every Saturday.',
        'options' => [
            'A. go',
            'B. going',
            'C. goes',
            'D. gone'
        ],
        'answer' => 'C. goes'
    ],
    [
        'question' => 'If I _____ a bird, I would fly across the ocean.',
        'options' => [
            'A. was',
            'B. were',
            'C. am',
            'D. be'
        ],
        'answer' => 'B. were'
    ],
    [
        'question' => 'Choose the correct sentence:',
        'options' => [
            'A. He don’t like coffee.',
            'B. She doesn’t likes coffee.',
            'C. He doesn’t like coffee.',
            'D. She don’t likes coffee.'
        ],
        'answer' => 'C. He doesn’t like coffee.'
    ],
    [
        'question' => 'The book _____ on the table since yesterday.',
        'options' => [
            'A. is',
            'B. was',
            'C. has been',
            'D. have been'
        ],
        'answer' => 'C. has been'
    ],
    [
        'question' => 'The passive voice of “She writes a letter” is...',
        'options' => [
            'A. A letter was written by her',
            'B. A letter is written by her',
            'C. A letter wrote by her',
            'D. A letter is write by her'
        ],
        'answer' => 'B. A letter is written by her'
    ],
    [
        'question' => 'What is the purpose of this message?',
        'options' => [
            'A. To cancel a trip',
            'B. To apply for a job',
            'C. To respond to a friend’s email',
            'D. To ask for help with homework'
        ],
        'answer' => 'C. To respond to a friend’s email'
    ],
    [
        'question' => 'What has Anna been busy with?',
        'options' => [
            'A. Sports',
            'B. School and work',
            'C. Traveling',
            'D. Writing emails'
        ],
        'answer' => 'B. School and work'
    ],
    [
        'question' => 'The expression “Let’s plan something” shows...',
        'options' => [
            'A. Suggestion',
            'B. Complaint',
            'C. Apology',
            'D. Warning'
        ],
        'answer' => 'A. Suggestion'
    ],
    [
        'question' => 'Which of the following is a formal closing?',
        'options' => [
            'A. See you',
            'B. Bye',
            'C. Best regards',
            'D. Later'
        ],
        'answer' => 'C. Best regards'
    ],
    [
        'question' => 'The tone of the message is...',
        'options' => [
            'A. Angry',
            'B. Polite and friendly',
            'C. Sarcastic',
            'D. Formal and strict'
        ],
        'answer' => 'B. Polite and friendly'
    ],
],

];

        foreach ($data as $category => $questions) {
            $categoryId = DB::table('question_categories')->where('name', $category)->value('id');

            foreach ($questions as $question) {
                DB::table('questions')->insert([
                    'question_text'   => $question['question'],
                    'options'         => json_encode($question['options']),
                    'correct_answer'  => $question['answer'],
                    'category_id'     => $categoryId,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ]);
            }
        }
    }
}
