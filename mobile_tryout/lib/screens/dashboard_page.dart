import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../utils/api.dart';
import '../services/auth_service.dart';
import '../widgets/student_bottom_nav.dart';

class DashboardPage extends StatefulWidget {
  const DashboardPage({super.key});

  @override
  State<DashboardPage> createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage> {
  final authService = AuthService();
  bool isLoading = true;
  Map<String, dynamic>? dashboardData;

  @override
  void initState() {
    super.initState();
    fetchDashboard();
  }

  Future<void> fetchDashboard() async {
    final token = await authService.getToken();
    final response = await http.get(Api.dashboard(), headers: {
      'Authorization': 'Bearer $token',
    });

    if (response.statusCode == 200) {
      setState(() {
        dashboardData = json.decode(response.body);
        isLoading = false;
      });
    } else {
      await authService.clearToken();
      Navigator.pushReplacementNamed(context, '/login');
    }
  }

  Widget cardStat({
    required IconData icon,
    required String label,
    required String value,
    Color? color,
  }) {
    return Expanded(
      child: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              color ?? Colors.blue,
              (color ?? Colors.blue).withOpacity(0.8),
            ],
          ),
          borderRadius: BorderRadius.circular(20),
          boxShadow: [
            BoxShadow(
              color: (color ?? Colors.blue).withOpacity(0.3),
              blurRadius: 10,
              offset: const Offset(0, 5),
            ),
          ],
        ),
        padding: const EdgeInsets.all(20),
        margin: const EdgeInsets.symmetric(horizontal: 8),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.2),
                shape: BoxShape.circle,
              ),
              child: Icon(icon, size: 28, color: Colors.white),
            ),
            const SizedBox(height: 12),
            Text(
              label,
              style: const TextStyle(
                fontSize: 13,
                color: Colors.white,
                fontFamily: 'Poppins',
                fontWeight: FontWeight.w500,
              ),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 8),
            Text(
              value,
              style: const TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
                color: Colors.white,
                fontFamily: 'Poppins',
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 20,
          fontFamily: 'Poppins',
          fontWeight: FontWeight.bold,
          color: Colors.white,
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final tryouts = dashboardData?['available_tryouts'] ?? [];
    final materials = dashboardData?['latest_materials'] ?? [];
    final result = dashboardData?['latest_result'];
    final doneTryouts = dashboardData?['done_tryouts']?.toString() ?? '0';
    final avgScore = dashboardData?['average_score']?.toString() ?? '0';
    final ranking = dashboardData?['ranking']?.toString() ?? '-';
    final leaderboard = dashboardData?['leaderboard'] ?? [];

    return Scaffold(
      backgroundColor: const Color(0xFFFDFCEA),
      appBar: AppBar(
        backgroundColor: const Color(0xFF134866),
        elevation: 0,
        title: const Text(
          'Dashboard Siswa',
          style: TextStyle(
            fontFamily: 'Poppins',
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.logout, color: Colors.white),
            onPressed: () async {
              await authService.logout();
              Navigator.pushReplacementNamed(context, '/login');
            },
          )
        ],
      ),
      body: isLoading
          ? const Center(
              child: CircularProgressIndicator(
                valueColor: AlwaysStoppedAnimation<Color>(Color(0xFF134866)),
              ),
            )
          : RefreshIndicator(
              onRefresh: fetchDashboard,
              color: const Color(0xFF134866),
              child: SingleChildScrollView(
                physics: const AlwaysScrollableScrollPhysics(),
                child: Column(
                  children: [
                    // HEADER IMAGE
                    Container(
                      height: 200,
                      decoration: const BoxDecoration(
                        image: DecorationImage(
                          image: NetworkImage("https://placehold.co/365x232"),
                          fit: BoxFit.cover,
                        ),
                      ),
                      child: Container(
                        decoration: BoxDecoration(
                          gradient: LinearGradient(
                            begin: Alignment.topCenter,
                            end: Alignment.bottomCenter,
                            colors: [
                              Colors.transparent,
                              Colors.black.withOpacity(0.3),
                            ],
                          ),
                        ),
                      ),
                    ),

                    // CONTENT AREA
                    Container(
                      width: double.infinity,
                      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 32),
                      decoration: const BoxDecoration(
                        gradient: LinearGradient(
                          begin: Alignment.topCenter,
                          end: Alignment.bottomCenter,
                          colors: [
                            Color(0xFF6FA2BD),
                            Color(0xFF5A8AA3),
                          ],
                        ),
                        borderRadius: BorderRadius.only(
                          topLeft: Radius.circular(32),
                          topRight: Radius.circular(32),
                        ),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            'Selamat Datang! 👋',
                            style: TextStyle(
                              fontSize: 28,
                              fontFamily: 'Poppins',
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(height: 32),

                          // STATS ROW 1
                          Row(
                            children: [
                              cardStat(
                                icon: Icons.list_alt,
                                label: 'Tersedia',
                                value: tryouts.length.toString(),
                                color: Colors.blue.shade600,
                              ),
                              cardStat(
                                icon: Icons.check_circle,
                                label: 'Dikerjakan',
                                value: doneTryouts,
                                color: Colors.orange.shade600,
                              ),
                            ],
                          ),

                          const SizedBox(height: 20),

                          // STATS ROW 2
                          Row(
                            children: [
                              cardStat(
                                icon: Icons.star,
                                label: 'Skor',
                                value: avgScore,
                                color: Colors.green.shade600,
                              ),
                              cardStat(
                                icon: Icons.emoji_events,
                                label: 'Peringkat',
                                value: ranking,
                                color: Colors.purple.shade600,
                              ),
                            ],
                          ),

                          const SizedBox(height: 40),

                          // MATERI TERBARU
                          _buildSectionTitle('📚 Materi Terbaru:'),
                          ...materials.map<Widget>((m) {
                            return Card(
                              margin: const EdgeInsets.symmetric(vertical: 8),
                              elevation: 4,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(16),
                              ),
                              child: Container(
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(16),
                                  gradient: LinearGradient(
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight,
                                    colors: [
                                      Colors.white,
                                      Colors.grey.shade50,
                                    ],
                                  ),
                                ),
                                child: ListTile(
                                  contentPadding: const EdgeInsets.all(16),
                                  leading: Container(
                                    padding: const EdgeInsets.all(10),
                                    decoration: BoxDecoration(
                                      color: Colors.blue.shade100,
                                      borderRadius: BorderRadius.circular(12),
                                    ),
                                    child: Icon(
                                      Icons.book,
                                      color: Colors.blue.shade600,
                                      size: 24,
                                    ),
                                  ),
                                  title: Text(
                                    m['judul'] ?? '-',
                                    style: const TextStyle(
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w600,
                                      fontSize: 16,
                                    ),
                                  ),
                                  subtitle: Padding(
                                    padding: const EdgeInsets.only(top: 4),
                                    child: Text(
                                      'Kategori: ${m['kategori'] ?? '-'}',
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        color: Colors.grey.shade600,
                                      ),
                                    ),
                                  ),
                                  trailing: Icon(
                                    Icons.arrow_forward_ios,
                                    color: Colors.grey.shade400,
                                    size: 16,
                                  ),
                                ),
                              ),
                            );
                          }),

                          const SizedBox(height: 40),

                          // HASIL TRYOUT
                          _buildSectionTitle('📊 Hasil Tryout Terakhir:'),
                          result != null
                              ? Card(
                                  margin: const EdgeInsets.only(bottom: 16),
                                  elevation: 4,
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(16),
                                  ),
                                  child: Container(
                                    decoration: BoxDecoration(
                                      borderRadius: BorderRadius.circular(16),
                                      gradient: LinearGradient(
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight,
                                        colors: [
                                          Colors.green.shade50,
                                          Colors.white,
                                        ],
                                      ),
                                    ),
                                    child: ListTile(
                                      contentPadding: const EdgeInsets.all(16),
                                      leading: Container(
                                        padding: const EdgeInsets.all(10),
                                        decoration: BoxDecoration(
                                          color: Colors.green.shade100,
                                          borderRadius: BorderRadius.circular(12),
                                        ),
                                        child: Icon(
                                          Icons.assignment_turned_in_rounded,
                                          color: Colors.green.shade600,
                                          size: 24,
                                        ),
                                      ),
                                      title: Text(
                                        'Tryout ID: ${result['tryout_id'] ?? '-'}',
                                        style: const TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                        ),
                                      ),
                                      subtitle: Padding(
                                        padding: const EdgeInsets.only(top: 4),
                                        child: Text(
                                          'Nilai: ${result['score'] ?? '0'}',
                                          style: TextStyle(
                                            fontFamily: 'Poppins',
                                            color: Colors.grey.shade600,
                                          ),
                                        ),
                                      ),
                                      trailing: Container(
                                        padding: const EdgeInsets.symmetric(
                                          horizontal: 12,
                                          vertical: 6,
                                        ),
                                        decoration: BoxDecoration(
                                          color: Colors.green.shade100,
                                          borderRadius: BorderRadius.circular(20),
                                        ),
                                        child: Text(
                                          '${result['score'] ?? '0'}',
                                          style: TextStyle(
                                            fontWeight: FontWeight.bold,
                                            color: Colors.green.shade700,
                                            fontFamily: 'Poppins',
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                )
                              : Container(
                                  padding: const EdgeInsets.all(20),
                                  decoration: BoxDecoration(
                                    color: Colors.white.withOpacity(0.1),
                                    borderRadius: BorderRadius.circular(16),
                                    border: Border.all(
                                      color: Colors.white.withOpacity(0.2),
                                      width: 1,
                                    ),
                                  ),
                                  child: const Center(
                                    child: Text(
                                      "Belum ada hasil tryout.",
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        color: Colors.white,
                                        fontSize: 16,
                                      ),
                                    ),
                                  ),
                                ),

                          const SizedBox(height: 40),

                          // LEADERBOARD
                          _buildSectionTitle('🏆 Top 10 Leaderboard:'),
                          ...leaderboard.map<Widget>((user) {
                            final name = user['student']['name'] ?? 'Siswa';
                            final score = double.tryParse(user['avg_score'].toString())?.toStringAsFixed(2) ?? '0.00';
                            final index = leaderboard.indexOf(user) + 1;

                            Color getPositionColor(int pos) {
                              switch (pos) {
                                case 1:
                                  return Colors.amber;
                                case 2:
                                  return Colors.grey;
                                case 3:
                                  return Colors.brown;
                                default:
                                  return Colors.indigo;
                              }
                            }

                            IconData getPositionIcon(int pos) {
                              switch (pos) {
                                case 1:
                                  return Icons.emoji_events;
                                case 2:
                                  return Icons.workspace_premium;
                                case 3:
                                  return Icons.military_tech;
                                default:
                                  return Icons.person;
                              }
                            }

                            return Card(
                              margin: const EdgeInsets.symmetric(vertical: 6),
                              elevation: index <= 3 ? 6 : 3,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(16),
                              ),
                              child: Container(
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(16),
                                  gradient: index <= 3
                                      ? LinearGradient(
                                          begin: Alignment.topLeft,
                                          end: Alignment.bottomRight,
                                          colors: [
                                            getPositionColor(index).withOpacity(0.1),
                                            Colors.white,
                                          ],
                                        )
                                      : LinearGradient(
                                          begin: Alignment.topLeft,
                                          end: Alignment.bottomRight,
                                          colors: [
                                            Colors.white,
                                            Colors.grey.shade50,
                                          ],
                                        ),
                                ),
                                child: ListTile(
                                  contentPadding: const EdgeInsets.symmetric(
                                    horizontal: 16,
                                    vertical: 12,
                                  ),
                                  leading: Container(
                                    padding: const EdgeInsets.all(8),
                                    decoration: BoxDecoration(
                                      color: getPositionColor(index),
                                      borderRadius: BorderRadius.circular(12),
                                    ),
                                    child: Icon(
                                      getPositionIcon(index),
                                      color: Colors.white,
                                      size: 20,
                                    ),
                                  ),
                                  title: Text(
                                    name,
                                    style: TextStyle(
                                      fontFamily: 'Poppins',
                                      fontWeight: index <= 3 ? FontWeight.bold : FontWeight.w600,
                                      fontSize: 16,
                                    ),
                                  ),
                                  subtitle: Padding(
                                    padding: const EdgeInsets.only(top: 4),
                                    child: Text(
                                      'Peringkat $index',
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        color: Colors.grey.shade600,
                                        fontSize: 12,
                                      ),
                                    ),
                                  ),
                                  trailing: Container(
                                    padding: const EdgeInsets.symmetric(
                                      horizontal: 12,
                                      vertical: 6,
                                    ),
                                    decoration: BoxDecoration(
                                      color: getPositionColor(index).withOpacity(0.1),
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                    child: Text(
                                      score,
                                      style: TextStyle(
                                        fontWeight: FontWeight.bold,
                                        color: getPositionColor(index),
                                        fontFamily: 'Poppins',
                                      ),
                                    ),
                                  ),
                                ),
                              ),
                            );
                          }).toList(),

                          const SizedBox(height: 20),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
      bottomNavigationBar: const StudentBottomNav(currentIndex: 0),
    );
  }
}