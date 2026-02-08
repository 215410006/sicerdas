import 'package:flutter/material.dart';
import '../services/auth_service.dart';
import 'dashboard_page.dart';
import 'login_page.dart';

class RegisterPage extends StatefulWidget {
  const RegisterPage({super.key});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final firstNameController = TextEditingController();
  final lastNameController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final confirmController = TextEditingController();

  final authService = AuthService();
  bool isLoading = false;
  Map<String, dynamic>? errors;

  void register() async {
    setState(() {
      isLoading = true;
      errors = null;
    });

    final result = await authService.register(
      firstName: firstNameController.text.trim(),
      lastName: lastNameController.text.trim(),
      email: emailController.text.trim(),
      password: passwordController.text.trim(),
      passwordConfirmation: confirmController.text.trim(),
    );

    setState(() {
      isLoading = false;
    });

    if (result['success']) {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (_) => DashboardPage()),
      );
    } else {
      setState(() {
        errors = result['errors'];
      });
    }
  }

  Widget showError(String field) {
    if (errors != null && errors![field] != null) {
      return Padding(
        padding: const EdgeInsets.only(left: 24, top: 4),
        child: Text(
          errors![field][0],
          style: const TextStyle(
            color: Colors.red,
            fontSize: 12,
            fontFamily: 'Poppins',
          ),
        ),
      );
    }
    return const SizedBox();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFDFCEA),
      body: SingleChildScrollView(
        child: Column(
          children: [
            // Header Image
            Container(
              height: 232,
              decoration: const BoxDecoration(
                image: DecorationImage(
                  image: NetworkImage("https://placehold.co/365x232"),
                  fit: BoxFit.cover,
                ),
              ),
            ),

            // Registration Form Container
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 46, vertical: 32),
              decoration: const BoxDecoration(
                color: Color(0xFF6FA2BD),
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(48),
                  topRight: Radius.circular(48),
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const Text(
                    'Register',
                    style: TextStyle(
                      color: Color(0xFF091F5B),
                      fontSize: 32,
                      fontFamily: 'Poppins',
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                  const SizedBox(height: 24),

                  _buildInputField(
                    controller: firstNameController,
                    hintText: 'Nama Depan',
                    icon: Icons.person,
                  ),
                  showError('first_name'),
                  const SizedBox(height: 16),

                  _buildInputField(
                    controller: lastNameController,
                    hintText: 'Nama Belakang',
                    icon: Icons.person_outline,
                  ),
                  showError('last_name'),
                  const SizedBox(height: 16),

                  _buildInputField(
                    controller: emailController,
                    hintText: 'Email',
                    icon: Icons.email,
                  ),
                  showError('email'),
                  const SizedBox(height: 16),

                  _buildInputField(
                    controller: passwordController,
                    hintText: 'Password',
                    icon: Icons.lock,
                    isPassword: true,
                  ),
                  showError('password'),
                  const SizedBox(height: 16),

                  _buildInputField(
                    controller: confirmController,
                    hintText: 'Konfirmasi Password',
                    icon: Icons.lock_outline,
                    isPassword: true,
                  ),
                  const SizedBox(height: 32),

                  // Register Button
                  SizedBox(
                    width: double.infinity,
                    height: 50,
                    child: ElevatedButton(
                      onPressed: isLoading ? null : register,
                      style: ElevatedButton.styleFrom(
                        backgroundColor: const Color(0xFF091F5B),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(28),
                        ),
                      ),
                      child: isLoading
                          ? const CircularProgressIndicator(color: Color(0xFFD6ECFF))
                          : const Text(
                              'DAFTAR',
                              style: TextStyle(
                                color: Color(0xFFD6ECFF),
                                fontSize: 16,
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                    ),
                  ),
                  const SizedBox(height: 24),

                  // Login Prompt
                  Center(
                    child: GestureDetector(
                      onTap: () {
                        Navigator.pushReplacement(
                          context,
                          MaterialPageRoute(builder: (_) => LoginPage()),
                        );
                      },
                      child: RichText(
                        text: TextSpan(
                          text: 'Sudah punya akun? ',
                          style: TextStyle(
                            color: Colors.black.withOpacity(0.67),
                            fontSize: 14,
                            fontFamily: 'Poppins',
                            fontWeight: FontWeight.w600,
                          ),
                          children: const [
                            TextSpan(
                              text: 'Login disini',
                              style: TextStyle(
                                color: Color(0xFF245883),
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
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

  Widget _buildInputField({
    required TextEditingController controller,
    required String hintText,
    required IconData icon,
    bool isPassword = false,
  }) {
    return TextField(
      controller: controller,
      obscureText: isPassword,
      decoration: InputDecoration(
        filled: true,
        fillColor: Colors.white,
        contentPadding: const EdgeInsets.symmetric(horizontal: 24, vertical: 16),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(28),
          borderSide: BorderSide.none,
        ),
        hintText: hintText,
        hintStyle: const TextStyle(
          color: Color(0xFFBCBCBC),
          fontSize: 14,
          fontFamily: 'Poppins',
          fontWeight: FontWeight.w600,
        ),
        prefixIcon: Icon(icon, color: const Color(0xFFBCBCBC)),
      ),
    );
  }
}
