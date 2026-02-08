import 'package:flutter/material.dart';

class StudentBottomNav extends StatelessWidget {
  final int currentIndex;

  const StudentBottomNav({super.key, required this.currentIndex});

  @override
  Widget build(BuildContext context) {
    return BottomNavigationBar(
      currentIndex: currentIndex,
      onTap: (index) {
        switch (index) {
          case 0:
            Navigator.pushReplacementNamed(context, '/dashboard');
            break;
          case 1:
            Navigator.pushReplacementNamed(context, '/tryout');
            break;
          case 2:
            Navigator.pushReplacementNamed(context, '/latihan'); 
            break;
          case 3:
            Navigator.pushReplacementNamed(context, '/materi');
            break;
          case 4:
            Navigator.pushReplacementNamed(context, '/tryout-history'); 
            break;
          case 5:
            Navigator.pushReplacementNamed(context, '/profile');
            break;
        }
      },
      selectedItemColor: Colors.blue[300],
      unselectedItemColor: Colors.grey,
      type: BottomNavigationBarType.fixed,
      items: const [
        BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Beranda'),
        BottomNavigationBarItem(icon: Icon(Icons.assignment), label: 'Tryout'),
        BottomNavigationBarItem(icon: Icon(Icons.create), label: 'Latihan'),
        BottomNavigationBarItem(icon: Icon(Icons.book), label: 'Materi'),
        BottomNavigationBarItem(icon: Icon(Icons.history), label: 'Riwayat'),
        BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profil'),
      ],
    );
  }
}
