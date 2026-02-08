import 'package:flutter/material.dart';
import 'tryout_work_page.dart';

class TryoutRulesPage extends StatelessWidget {
  final int tryoutId;
  final String tryoutName;

  const TryoutRulesPage({super.key, required this.tryoutId, required this.tryoutName});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFDFCEA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF134866),
        elevation: 0,
        title: const Text(
          'Peraturan Tryout',
          style: TextStyle(
            fontFamily: 'Poppins',
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: SafeArea(
        child: Stack(
          children: [
            // Background header image
            Container(
              height: 220,
              decoration: const BoxDecoration(
                image: DecorationImage(
                  image: NetworkImage("https://placehold.co/393x220"),
                  fit: BoxFit.cover,
                ),
                borderRadius: BorderRadius.only(
                  bottomLeft: Radius.circular(28),
                  bottomRight: Radius.circular(28),
                ),
              ),
            ),

            // Main content
            SingleChildScrollView(
              padding: const EdgeInsets.only(top: 180, bottom: 40),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  // Tryout title
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 44),
                    child: Text(
                      'TRYOUT $tryoutName'.toUpperCase(),
                      textAlign: TextAlign.center,
                      style: const TextStyle(
                        color: Color(0xFF121046),
                        fontSize: 22,
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w800,
                        shadows: [
                          Shadow(
                            offset: Offset(0, 2),
                            blurRadius: 4,
                            color: Colors.black26,
                          ),
                        ],
                      ),
                    ),
                  ),

                  const SizedBox(height: 16),

                  // Date and time info
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 37),
                    child: Row(
                      children: [
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8),
                          height: 48,
                          decoration: BoxDecoration(
                            color: const Color(0x66322F35),
                            borderRadius: BorderRadius.circular(8),
                          ),
                          child: const Row(
                            children: [
                              Icon(Icons.calendar_today, size: 16),
                              SizedBox(width: 6),
                              Text(
                                '27 Jan 2025',
                                style: TextStyle(
                                  fontSize: 10,
                                  fontFamily: 'Poppins',
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ],
                          ),
                        ),
                        const Spacer(),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8),
                          height: 48,
                          decoration: BoxDecoration(
                            color: const Color(0x66322F35),
                            borderRadius: BorderRadius.circular(8),
                          ),
                          child: const Row(
                            children: [
                              Icon(Icons.access_time, size: 16),
                              SizedBox(width: 6),
                              Text(
                                '07.00 - 23.59 WIB',
                                style: TextStyle(
                                  fontSize: 10,
                                  fontFamily: 'Poppins',
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 24),

                  // Stats card
                  Container(
                    width: 345,
                    height: 121,
                    margin: const EdgeInsets.symmetric(horizontal: 22),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: const [
                        BoxShadow(
                          color: Color(0x3F000000),
                          blurRadius: 4,
                          offset: Offset(0, 4),
                        ),
                      ],
                    ),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                      children: [
                        // Jumlah Soal
                        Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Container(
                              width: 37,
                              height: 38,
                              decoration: BoxDecoration(
                                color: const Color(0xFFBDE2F0),
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: const Icon(Icons.format_list_numbered, size: 22),
                            ),
                            const SizedBox(height: 8),
                            const Text('Jumlah soal',
                                style: TextStyle(fontSize: 11, fontFamily: 'Poppins', fontWeight: FontWeight.w600)),
                            const Text('160 Soal',
                                style: TextStyle(fontSize: 11, fontFamily: 'Poppins', fontWeight: FontWeight.w600)),
                          ],
                        ),

                        // Waktu Pengerjaan
                        Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Container(
                              width: 37,
                              height: 38,
                              decoration: BoxDecoration(
                                color: const Color(0xFFBDE2F0),
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: const Icon(Icons.timer, size: 22),
                            ),
                            const SizedBox(height: 8),
                            const Text('Waktu Pengerjaan',
                                style: TextStyle(fontSize: 11, fontFamily: 'Poppins', fontWeight: FontWeight.w600)),
                            const Text('196 Menit',
                                style: TextStyle(fontSize: 11, fontFamily: 'Poppins', fontWeight: FontWeight.w600)),
                          ],
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 24),

                  // Warning Box
                  Container(
                    width: 304,
                    height: 36,
                    margin: const EdgeInsets.symmetric(horizontal: 44),
                    decoration: BoxDecoration(
                      color: const Color(0xFFBDE2F0),
                      borderRadius: BorderRadius.circular(6),
                    ),
                    child: const Center(
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Icon(Icons.warning, size: 16),
                          SizedBox(width: 8),
                          Expanded(
                            child: Text(
                              'Tryout ini harus diselesaikan dalam 1 kali pengerjaan.',
                              style: TextStyle(
                                fontSize: 10,
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                                color: Color(0xFF292D32),
                              ),
                              textAlign: TextAlign.center,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),

                  const SizedBox(height: 24),

                  // Rules Card
                  Container(
                    width: 345,
                    padding: const EdgeInsets.all(16),
                    margin: const EdgeInsets.symmetric(horizontal: 22),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: const [
                        BoxShadow(
                          color: Color(0x3F000000),
                          blurRadius: 4,
                          offset: Offset(0, 4),
                        ),
                      ],
                    ),
                    child: const Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Row(
                          children: [
                            Icon(Icons.list_alt),
                            SizedBox(width: 8),
                            Text(
                              'Peraturan Tryout',
                              style: TextStyle(
                                fontSize: 13,
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w700,
                              ),
                            ),
                          ],
                        ),
                        SizedBox(height: 16),
                        Text(
                          '• Klik "Start" jika kamu sudah siap mengerjakan soal.\n'
                          '• Tryout akan dimulai tepat saat kamu klik START.\n'
                          '• Subtes hanya dapat dikerjakan sekali tanpa pengulangan.\n'
                          '• Jawaban akan dikumpulkan otomatis jika waktu habis.\n'
                          '• Tryout menggunakan sistem IRT.\n'
                          '• Kerjakan dengan jujur dan fokus.\n'
                          '• Semangat dan selamat mengerjakan!',
                          style: TextStyle(
                            fontSize: 11,
                            fontFamily: 'Poppins',
                            fontWeight: FontWeight.w500,
                            height: 1.6,
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 32),

                  // Start Tryout Button
                  Container(
                    width: 329,
                    height: 44,
                    margin: const EdgeInsets.symmetric(horizontal: 32),
                    child: ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xFF134866),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(24),
                        ),
                      ),
                      onPressed: () {
                        Navigator.pushReplacement(
                          context,
                          MaterialPageRoute(
                            builder: (_) => TryoutWorkPage(tryoutId: tryoutId),
                          ),
                        );
                      },
                      child: const Text(
                        'START TRYOUT',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 16,
                          fontFamily: 'Poppins',
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
