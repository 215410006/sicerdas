import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../services/auth_service.dart';
import '../utils/api.dart';
import 'dashboard_page.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  final authService = AuthService();
  final nameController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final confirmPasswordController = TextEditingController();

  bool isLoading = false;
  bool isLoadingProfile = true;
  String? message;
  bool _isPasswordVisible = false;
  bool _isConfirmPasswordVisible = false;

  @override
  void initState() {
    super.initState();
    fetchProfile();
  }

  @override
  void dispose() {
    nameController.dispose();
    emailController.dispose();
    passwordController.dispose();
    confirmPasswordController.dispose();
    super.dispose();
  }

  Future<void> fetchProfile() async {
    final token = await authService.getToken();
    if (token == null || token.isEmpty) {
      Navigator.pushReplacementNamed(context, '/login');
      return;
    }

    try {
      final response = await http.get(
        Api.profile(),
        headers: {'Authorization': 'Bearer $token'},
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          nameController.text = data['name'] ?? '';
          emailController.text = data['email'] ?? '';
          isLoadingProfile = false;
        });
      } else {
        await authService.clearToken();
        Navigator.pushReplacementNamed(context, '/login');
      }
    } catch (e) {
      await authService.clearToken();
      Navigator.pushReplacementNamed(context, '/login');
    }
  }

  Future<void> updateProfile() async {
    final token = await authService.getToken();
    if (token == null) return;

    // Validasi form
    if (nameController.text.trim().isEmpty) {
      setState(() {
        message = 'Nama lengkap tidak boleh kosong';
      });
      return;
    }

    if (emailController.text.trim().isEmpty) {
      setState(() {
        message = 'Email tidak boleh kosong';
      });
      return;
    }

    if (passwordController.text.isNotEmpty &&
        passwordController.text != confirmPasswordController.text) {
      setState(() {
        message = 'Konfirmasi password tidak cocok';
      });
      return;
    }

    setState(() {
      isLoading = true;
      message = null;
    });

    final body = {
      'name': nameController.text.trim(),
      'email': emailController.text.trim(),
    };

    if (passwordController.text.isNotEmpty) {
      body['password'] = passwordController.text;
      body['password_confirmation'] = confirmPasswordController.text;
    }

    try {
      final response = await http.put(
        Api.profile(),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: json.encode(body),
      );

      setState(() {
        isLoading = false;
      });

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        setState(() {
          message = data['message'] ?? 'Profil berhasil diperbarui.';
        });
        passwordController.clear();
        confirmPasswordController.clear();
      } else if (response.statusCode == 422) {
        final error = json.decode(response.body);
        final firstError = error['errors'].values.first[0];
        setState(() {
          message = firstError;
        });
      } else {
        final error = json.decode(response.body);
        setState(() {
          message = error['message'] ?? 'Gagal memperbarui profil';
        });
      }
    } catch (e) {
      setState(() {
        isLoading = false;
        message = 'Terjadi kesalahan saat menyimpan data.';
      });
    }
  }

  Widget _buildInputField(
    TextEditingController controller,
    String label,
    String hint,
    IconData icon, {
    bool isPassword = false,
    bool isVisible = false,
    VoidCallback? onToggleVisibility,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: const TextStyle(
            fontSize: 14,
            fontFamily: 'Poppins',
            fontWeight: FontWeight.w600,
            color: Color(0xFF091F5B),
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          obscureText: isPassword && !isVisible,
          decoration: InputDecoration(
            filled: true,
            fillColor: Colors.white,
            hintText: hint,
            prefixIcon: Icon(icon, color: const Color(0xFF6FA2BD)),
            suffixIcon: isPassword
                ? IconButton(
                    icon: Icon(
                      isVisible ? Icons.visibility : Icons.visibility_off,
                      color: const Color(0xFF6FA2BD),
                    ),
                    onPressed: onToggleVisibility,
                  )
                : null,
            contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
            border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(12),
              borderSide: BorderSide(color: Colors.grey[300]!),
            ),
            enabledBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(12),
              borderSide: BorderSide(color: Colors.grey[300]!),
            ),
            focusedBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(12),
              borderSide: const BorderSide(color: Color(0xFF6FA2BD), width: 2),
            ),
            hintStyle: TextStyle(
              color: Colors.grey[500],
              fontFamily: 'Poppins',
              fontWeight: FontWeight.w400,
            ),
          ),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F7FA),
      appBar: AppBar(
        title: const Text(
          'Profil Siswa',
          style: TextStyle(
            color: Colors.white,
            fontFamily: 'Poppins',
            fontWeight: FontWeight.w600,
          ),
        ),
        backgroundColor: const Color(0xFF091F5B),
        iconTheme: const IconThemeData(color: Colors.white),
        elevation: 0,
      ),
      body: isLoadingProfile
          ? const Center(
              child: CircularProgressIndicator(
                valueColor: AlwaysStoppedAnimation<Color>(Color(0xFF6FA2BD)),
              ),
            )
          : SingleChildScrollView(
              child: Column(
                children: [
                  // Header dengan avatar
                  Container(
                    width: double.infinity,
                    decoration: const BoxDecoration(
                      gradient: LinearGradient(
                        colors: [Color(0xFF6FA2BD), Color(0xFF5A8BA3)],
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                      ),
                      borderRadius: BorderRadius.only(
                        bottomLeft: Radius.circular(32),
                        bottomRight: Radius.circular(32),
                      ),
                    ),
                    child: Padding(
                      padding: const EdgeInsets.all(32),
                      child: Column(
                        children: [
                          Container(
                            width: 100,
                            height: 100,
                            decoration: BoxDecoration(
                              color: Colors.white.withOpacity(0.2),
                              shape: BoxShape.circle,
                              border: Border.all(color: Colors.white, width: 3),
                            ),
                            child: const Icon(
                              Icons.person,
                              size: 50,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(height: 16),
                          Text(
                            nameController.text.isNotEmpty 
                                ? nameController.text 
                                : 'Nama Siswa',
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 20,
                              fontFamily: 'Poppins',
                              fontWeight: FontWeight.w600,
                            ),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            emailController.text.isNotEmpty 
                                ? emailController.text 
                                : 'email@example.com',
                            style: TextStyle(
                              color: Colors.white.withOpacity(0.8),
                              fontSize: 14,
                              fontFamily: 'Poppins',
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),

                  // Form
                  Padding(
                    padding: const EdgeInsets.all(24),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        // Message
                        if (message != null)
                          Container(
                            width: double.infinity,
                            padding: const EdgeInsets.all(16),
                            margin: const EdgeInsets.only(bottom: 24),
                            decoration: BoxDecoration(
                              color: message!.contains('berhasil')
                                  ? Colors.green.withOpacity(0.1)
                                  : Colors.red.withOpacity(0.1),
                              borderRadius: BorderRadius.circular(12),
                              border: Border.all(
                                color: message!.contains('berhasil')
                                    ? Colors.green
                                    : Colors.red,
                                width: 1,
                              ),
                            ),
                            child: Row(
                              children: [
                                Icon(
                                  message!.contains('berhasil')
                                      ? Icons.check_circle
                                      : Icons.error,
                                  color: message!.contains('berhasil')
                                      ? Colors.green
                                      : Colors.red,
                                  size: 20,
                                ),
                                const SizedBox(width: 12),
                                Expanded(
                                  child: Text(
                                    message!,
                                    style: TextStyle(
                                      fontFamily: 'Poppins',
                                      color: message!.contains('berhasil')
                                          ? Colors.green[700]
                                          : Colors.red[700],
                                      fontWeight: FontWeight.w500,
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ),

                        // Form Fields
                        _buildInputField(
                          nameController,
                          'Nama Lengkap',
                          'Masukkan nama lengkap',
                          Icons.person_outline,
                        ),
                        const SizedBox(height: 20),

                        _buildInputField(
                          emailController,
                          'Email',
                          'Masukkan email',
                          Icons.email_outlined,
                        ),
                        const SizedBox(height: 20),

                        _buildInputField(
                          passwordController,
                          'Password Baru',
                          'Masukkan password baru (opsional)',
                          Icons.lock_outline,
                          isPassword: true,
                          isVisible: _isPasswordVisible,
                          onToggleVisibility: () {
                            setState(() {
                              _isPasswordVisible = !_isPasswordVisible;
                            });
                          },
                        ),
                        const SizedBox(height: 20),

                        _buildInputField(
                          confirmPasswordController,
                          'Konfirmasi Password Baru',
                          'Konfirmasi password baru',
                          Icons.lock_outline,
                          isPassword: true,
                          isVisible: _isConfirmPasswordVisible,
                          onToggleVisibility: () {
                            setState(() {
                              _isConfirmPasswordVisible = !_isConfirmPasswordVisible;
                            });
                          },
                        ),
                        const SizedBox(height: 32),

                        // Button Simpan
                        SizedBox(
                          width: double.infinity,
                          height: 50,
                          child: ElevatedButton(
                            onPressed: isLoading ? null : updateProfile,
                            style: ElevatedButton.styleFrom(
                              backgroundColor: const Color(0xFF091F5B),
                              disabledBackgroundColor: Colors.grey[400],
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(12),
                              ),
                              elevation: 0,
                            ),
                            child: isLoading
                                ? const SizedBox(
                                    width: 20,
                                    height: 20,
                                    child: CircularProgressIndicator(
                                      color: Colors.white,
                                      strokeWidth: 2,
                                    ),
                                  )
                                : const Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Icon(Icons.save, color: Colors.white),
                                      SizedBox(width: 8),
                                      Text(
                                        'Simpan Perubahan',
                                        style: TextStyle(
                                          color: Colors.white,
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 16,
                                        ),
                                      ),
                                    ],
                                  ),
                          ),
                        ),

                        const SizedBox(height: 24),

                        // Tombol Kembali
                        Center(
                          child: TextButton(
                            onPressed: () {
                              Navigator.pushReplacement(
                                context,
                                MaterialPageRoute(builder: (_) => const DashboardPage()),
                              );
                            },
                            style: TextButton.styleFrom(
                              padding: const EdgeInsets.symmetric(
                                horizontal: 24,
                                vertical: 12,
                              ),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(8),
                              ),
                            ),
                            child: const Row(
                              mainAxisSize: MainAxisSize.min,
                              children: [
                                Icon(
                                  Icons.arrow_back,
                                  color: Color(0xFF6FA2BD),
                                  size: 18,
                                ),
                                SizedBox(width: 8),
                                Text(
                                  'Kembali ke Dashboard',
                                  style: TextStyle(
                                    color: Color(0xFF6FA2BD),
                                    fontSize: 14,
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w600,
                                  ),
                                ),
                              ],
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