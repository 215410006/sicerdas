import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../services/auth_service.dart';
import '../utils/api.dart';
import 'materi_detail_page.dart';
import 'dashboard_page.dart';

class MateriPage extends StatefulWidget {
  const MateriPage({super.key});

  @override
  State<MateriPage> createState() => _MateriPageState();
}

class _MateriPageState extends State<MateriPage> {
  final authService = AuthService();
  bool isLoading = true;
  List<dynamic> materiList = [];

  @override
  void initState() {
    super.initState();
    fetchMateri();
  }

  Future<void> fetchMateri() async {
    final token = await authService.getToken();
    final response = await http.get(
      Api.materi(),
      headers: {'Authorization': 'Bearer $token'},
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      setState(() {
        materiList = data['data']; // Asumsi response pakai pagination
        isLoading = false;
      });
    } else {
      await authService.clearToken();
      if (mounted) {
        Navigator.pushReplacementNamed(context, '/login');
      }
    }
  }

  Widget buildMateriCard(Map<String, dynamic> materi) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 8),
      elevation: 4,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
      child: InkWell(
        borderRadius: BorderRadius.circular(16),
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (_) => MateriDetailPage(materi: materi),
            ),
          );
        },
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
          child: Row(
            children: [
              const Icon(Icons.book, color: Color(0xFF134866), size: 32),
              const SizedBox(width: 16),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      materi['judul'] ?? '-',
                      style: const TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                        fontFamily: 'Poppins',
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      "Kategori: ${materi['kategori']['nama'] ?? '-'}",
                      style: const TextStyle(
                        fontSize: 13,
                        color: Colors.black54,
                        fontFamily: 'Poppins',
                      ),
                    ),
                  ],
                ),
              ),
              const Icon(Icons.chevron_right, color: Colors.grey),
            ],
          ),
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFDFCEA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF134866),
        elevation: 0,
        title: const Text(
          'Materi Siswa',
          style: TextStyle(fontFamily: 'Poppins', color: Colors.white, fontWeight: FontWeight.bold),
        ),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (_) => const DashboardPage()),
            );
          },
        ),
      ),
      body: isLoading
          ? const Center(child: CircularProgressIndicator())
          : RefreshIndicator(
              onRefresh: fetchMateri,
              child: ListView.builder(
                padding: const EdgeInsets.all(16),
                itemCount: materiList.length,
                itemBuilder: (context, index) {
                  final materi = materiList[index];
                  return buildMateriCard(materi);
                },
              ),
            ),
    );
  }
}
