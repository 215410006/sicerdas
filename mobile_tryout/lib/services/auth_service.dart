import 'dart:convert';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:http/http.dart' as http;
import '../utils/api.dart';

class AuthService {
  final _storage = FlutterSecureStorage();

  // Login siswa
  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(
      Api.login(),
      body: {'email': email, 'password': password},
    );

    final data = json.decode(response.body);

    if (response.statusCode == 200) {
      await _storage.write(key: 'token', value: data['access_token']);
      return {'success': true, 'user': data['user']};
    } else {
      return {'success': false, 'message': data['message'] ?? 'Login gagal'};
    }
  }

  // Register siswa
  Future<Map<String, dynamic>> register({
    required String firstName,
    required String lastName,
    required String email,
    required String password,
    required String passwordConfirmation,
  }) async {
    final response = await http.post(
      Api.register(),
      body: {
        'first_name': firstName,
        'last_name': lastName,
        'email': email,
        'password': password,
        'password_confirmation': passwordConfirmation,
      },
    );

    final data = json.decode(response.body);

    if (response.statusCode == 201) {
      await _storage.write(key: 'token', value: data['access_token']);
      return {'success': true, 'user': data['user']};
    } else {
      return {
        'success': false,
        'errors': data['errors'] ?? {'message': 'Register gagal'}
      };
    }
  }

  // Logout
  Future<void> logout() async {
    final token = await _storage.read(key: 'token');

    if (token != null) {
      await http.post(
        Api.logout(),
        headers: {'Authorization': 'Bearer $token'},
      );
      await _storage.delete(key: 'token');
    }
  }

  // Get user login (me)
  Future<Map<String, dynamic>?> getMe() async {
    final token = await _storage.read(key: 'token');

    if (token != null) {
      final response = await http.get(
        Api.me(),
        headers: {'Authorization': 'Bearer $token'},
      );

      if (response.statusCode == 200) {
        return json.decode(response.body);
      }
    }

    return null;
  }

  Future<String?> getToken() async {
    return await _storage.read(key: 'token');
  }

  Future<void> clearToken() async {
    await _storage.delete(key: 'token');
  }
}
