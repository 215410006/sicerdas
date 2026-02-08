import 'package:flutter/material.dart';
import 'materi_preview_page.dart';

class MateriDetailPage extends StatelessWidget {
  final Map<String, dynamic> materi;

  const MateriDetailPage({super.key, required this.materi});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFDFCEA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF134866),
        elevation: 0,
        title: const Text(
          'Detail Materi',
          style: TextStyle(
            fontFamily: 'Poppins',
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Padding(
        padding: const EdgeInsets.all(24),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Icon(Icons.menu_book, size: 64, color: Color(0xFF134866)),
            const SizedBox(height: 20),

            Text(
              materi['judul'] ?? 'Judul tidak tersedia',
              style: const TextStyle(
                fontFamily: 'Poppins',
                fontSize: 22,
                fontWeight: FontWeight.bold,
                color: Color(0xFF091F5B),
              ),
            ),
            const SizedBox(height: 12),

            Row(
              children: [
                const Icon(Icons.category, size: 20, color: Colors.grey),
                const SizedBox(width: 8),
                Text(
                  "Kategori: ${materi['kategori']['nama'] ?? '-'}",
                  style: const TextStyle(
                    fontFamily: 'Poppins',
                    fontSize: 15,
                    color: Colors.black87,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 32),

            const Text(
              "Lampiran Materi:",
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 16,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 12),

            if (materi['file_url'] != null)
              Center(
                child: ElevatedButton.icon(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => MateriPreviewPage(
                          fileUrl: materi['file_url'],
                        ),
                      ),
                    );
                  },
                  icon: const Icon(Icons.picture_as_pdf, size: 20),
                  label: const Text(
                    "Lihat File Materi",
                    style: TextStyle(fontFamily: 'Poppins'),
                  ),
                  style: ElevatedButton.styleFrom(
                    padding: const EdgeInsets.symmetric(horizontal: 28, vertical: 12),
                    backgroundColor: const Color(0xFF134866),
                    foregroundColor: Colors.white,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(32),
                    ),
                  ),
                ),
              )
            else
              const Text(
                "File tidak tersedia.",
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 14,
                  color: Colors.redAccent,
                ),
              ),
          ],
        ),
      ),
    );
  }
}
