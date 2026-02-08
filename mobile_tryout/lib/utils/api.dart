class Api {
  static const String baseUrl = 'https://sicerdas.sectortwoo.com/api';

  // ========== AUTH ==========
  static Uri register() => Uri.parse('$baseUrl/register');
  static Uri login() => Uri.parse('$baseUrl/login');
  static Uri logout() => Uri.parse('$baseUrl/logout');
  static Uri me() => Uri.parse('$baseUrl/me');

  // ========== DASHBOARD ==========
  static Uri dashboard() => Uri.parse('$baseUrl/dashboard');

  // ========== PROFILE ==========
  static Uri profile() => Uri.parse('$baseUrl/profile');
  static Uri updateProfile() => Uri.parse('$baseUrl/profile/update');

  // ========== MATERI ==========
  static Uri materi() => Uri.parse('$baseUrl/materi');
  static Uri detailMateri(int id) => Uri.parse('$baseUrl/materi/$id');

  // ========== TRYOUT ==========
  static Uri tryout() => Uri.parse('$baseUrl/tryout');
  static Uri tryoutSchedule() => Uri.parse('$baseUrl/tryout/jadwal');
  static Uri tryoutResult() => Uri.parse('$baseUrl/tryout/result');
  static Uri leaderboard() => Uri.parse('$baseUrl/leaderboard');
  static Uri tryoutHistory() => Uri.parse('$baseUrl/tryout/history');


  // ========== TRYOUT PENGERJAAN ==========
  static Uri kerjakanTryout(int id) => Uri.parse('$baseUrl/tryout/$id/kerjakan');
  static Uri submitTryout(int id) => Uri.parse('$baseUrl/tryout/$id/submit');

   // === ENDPOINT LATIHAN SOAL ===
  static Uri latihanCategories() => Uri.parse('$baseUrl/latihan/categories');
  static Uri latihanSoal(int id) => Uri.parse('$baseUrl/latihan/soal/$id');
  static Uri latihanSubmit() => Uri.parse('$baseUrl/latihan/submit');
}
