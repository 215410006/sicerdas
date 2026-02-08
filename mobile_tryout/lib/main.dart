import 'package:flutter/material.dart';
import 'package:mobile_tryout/screens/latihan_soal_page.dart';
import 'package:mobile_tryout/screens/materi_page.dart';
import 'package:mobile_tryout/screens/profile_page.dart';
import 'package:mobile_tryout/screens/login_page.dart';
import 'package:mobile_tryout/screens/register_page.dart';
import 'package:mobile_tryout/screens/dashboard_page.dart';
import 'package:mobile_tryout/screens/tryout_history_page.dart';
import 'package:mobile_tryout/screens/tryout_schedule_page.dart';
import 'package:mobile_tryout/screens/splash_screen.dart'; 


void main() {
  runApp(const StudentApp());
}

class StudentApp extends StatelessWidget {
  const StudentApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Si Cerdas',
      debugShowCheckedModeBanner: false,
      // SplashScreen sebagai halaman pertama
      home: const SplashScreen(),
      routes: {
        '/login': (context) => LoginPage(),
        '/register': (context) => RegisterPage(),
        '/dashboard': (context) => DashboardPage(),
        '/profile': (context) => ProfilePage(),
        '/materi': (context) => MateriPage(),
        '/tryout': (context) => TryoutSchedulePage(),
        '/latihan': (context) => LatihanSoalPage(),
        '/tryout-history': (context) => TryoutHistoryPage(),


      },
    );
  }
}
