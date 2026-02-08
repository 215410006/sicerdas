import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../services/auth_service.dart';
import '../utils/api.dart';
import 'dashboard_page.dart';

class LatihanSoalPage extends StatefulWidget {
  const LatihanSoalPage({super.key});

  @override
  State<LatihanSoalPage> createState() => _LatihanSoalPageState();
}

class _LatihanSoalPageState extends State<LatihanSoalPage> {
  // Constants
  static const Color _primaryColor = Color(0xFF091F5B);
  static const Color _secondaryColor = Color(0xFF134765);
  static const Color _backgroundColor = Color(0xFFFDFCEA);
  static const Color _accentColor = Color(0xFF6FA2BD);
  
  // Services
  final AuthService _authService = AuthService();
  
  // State variables
  List<dynamic> _categories = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _fetchCategories();
  }

  // API Methods
  Future<void> _fetchCategories() async {
    try {
      final token = await _authService.getToken();
      final response = await http.get(
        Api.latihanCategories(),
        headers: {
          'Authorization': 'Bearer $token',
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        setState(() {
          _categories = json.decode(response.body);
          _isLoading = false;
        });
      } else {
        await _showErrorMessage('Gagal memuat kategori');
      }
    } catch (e) {
      await _showErrorMessage('Terjadi kesalahan: ${e.toString()}');
    }
  }

  // Helper Methods
  void _navigateToSoal(int categoryId, String categoryName) {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (_) => KerjakanLatihanPage(
          categoryId: categoryId,
          categoryName: categoryName,
        ),
      ),
    );
  }

  Future<void> _showErrorMessage(String message) async {
    if (!mounted) return;
    
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: Colors.red,
        behavior: SnackBarBehavior.floating,
      ),
    );
  }

  // UI Helper Methods
  Widget _buildCategoryCard(Map<String, dynamic> category, int index) {
    final categoryName = category['name'] ?? 'Kategori';
    final categoryId = category['id'];
    final questionCount = category['question_count'] ?? 0;
    
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      child: Card(
        elevation: 4,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        child: Container(
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(12),
            gradient: LinearGradient(
              colors: [
                _accentColor.withOpacity(0.1),
                _primaryColor.withOpacity(0.05),
              ],
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
            ),
          ),
          child: ListTile(
            contentPadding: const EdgeInsets.all(16),
            leading: Container(
              width: 50,
              height: 50,
              decoration: BoxDecoration(
                color: _primaryColor,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Center(
                child: Text(
                  '${index + 1}',
                  style: const TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                    fontSize: 18,
                    fontFamily: 'Poppins',
                  ),
                ),
              ),
            ),
            title: Text(
              categoryName,
              style: const TextStyle(
                fontFamily: 'Poppins',
                fontWeight: FontWeight.w600,
                fontSize: 16,
                color: _primaryColor,
              ),
            ),
            subtitle: Text(
              '$questionCount soal tersedia',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 12,
                color: Colors.grey[600],
              ),
            ),
            trailing: Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: _secondaryColor,
                borderRadius: BorderRadius.circular(8),
              ),
              child: const Icon(
                Icons.arrow_forward_ios,
                color: Colors.white,
                size: 16,
              ),
            ),
            onTap: () => _navigateToSoal(categoryId, categoryName),
          ),
        ),
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(
            Icons.quiz_outlined,
            size: 80,
            color: Colors.grey[400],
          ),
          const SizedBox(height: 16),
          Text(
            'Belum ada kategori latihan',
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 16,
              color: Colors.grey[600],
              fontWeight: FontWeight.w500,
            ),
          ),
          const SizedBox(height: 8),
          Text(
            'Kategori latihan akan muncul di sini',
            style: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 14,
              color: Colors.grey[500],
            ),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: _backgroundColor,
      appBar: AppBar(
        backgroundColor: _backgroundColor,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: _primaryColor),
          onPressed: () {
            Navigator.pushReplacement(
              context,
              MaterialPageRoute(builder: (_) => const DashboardPage()),
            );
          },
        ),
        title: const Text(
          'Latihan Soal',
          style: TextStyle(
            color: _primaryColor,
            fontFamily: 'Poppins',
            fontWeight: FontWeight.w600,
            fontSize: 18,
          ),
        ),
        centerTitle: true,
      ),
      body: _isLoading
          ? const Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  CircularProgressIndicator(
                    valueColor: AlwaysStoppedAnimation<Color>(_primaryColor),
                  ),
                  SizedBox(height: 16),
                  Text(
                    'Memuat kategori...',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 14,
                      color: _primaryColor,
                    ),
                  ),
                ],
              ),
            )
          : _categories.isEmpty
              ? _buildEmptyState()
              : ListView.builder(
                  padding: const EdgeInsets.all(16),
                  itemCount: _categories.length,
                  itemBuilder: (context, index) {
                    final category = _categories[index];
                    return _buildCategoryCard(category, index);
                  },
                ),
    );
  }
}

class KerjakanLatihanPage extends StatefulWidget {
  final int categoryId;
  final String categoryName;
  
  const KerjakanLatihanPage({
    super.key,
    required this.categoryId,
    required this.categoryName,
  });

  @override
  State<KerjakanLatihanPage> createState() => _KerjakanLatihanPageState();
}

class _KerjakanLatihanPageState extends State<KerjakanLatihanPage> {
  // Constants
  static const Color _primaryColor = Color(0xFF091F5B);
  static const Color _secondaryColor = Color(0xFF134765);
  static const Color _backgroundColor = Color(0xFFFDFCEA);
  static const Color _accentColor = Color(0xFF6FA2BD);
  
  // Services
  final AuthService _authService = AuthService();
  
  // State variables
  List<dynamic> _questions = [];
  final Map<int, String> _answers = {};
  bool _isLoading = true;
  bool _isSubmitting = false;

  @override
  void initState() {
    super.initState();
    _fetchQuestions();
  }

  // API Methods
  Future<void> _fetchQuestions() async {
    try {
      final token = await _authService.getToken();
      final response = await http.get(
        Api.latihanSoal(widget.categoryId),
        headers: {
          'Authorization': 'Bearer $token',
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final decoded = json.decode(response.body);
        setState(() {
          _questions = decoded;
          _isLoading = false;
        });
      } else {
        await _showErrorMessage('Gagal memuat soal');
      }
    } catch (e) {
      await _showErrorMessage('Terjadi kesalahan: ${e.toString()}');
    }
  }

  Future<void> _submitAnswers() async {
    if (_isSubmitting) return;
    
    setState(() => _isSubmitting = true);
    
    try {
      final token = await _authService.getToken();
      final response = await http.post(
        Api.latihanSubmit(),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
        },
        body: json.encode({
          'answers': _answers.map(
            (key, value) => MapEntry(key.toString(), value.toString()),
          ),
        }),
      );

      if (response.statusCode == 200) {
        final result = json.decode(response.body);
        final List corrections = result['corrections'];
        await _showResultDialog(corrections);
      } else {
        await _showErrorMessage('Gagal mengirim jawaban. Coba lagi nanti.');
      }
    } catch (e) {
      await _showErrorMessage('Terjadi kesalahan: ${e.toString()}');
    } finally {
      setState(() => _isSubmitting = false);
    }
  }

  // Helper Methods
  void _selectAnswer(int questionId, String answer) {
    setState(() {
      _answers[questionId] = answer;
    });
  }

  List<String> _parseOptions(dynamic rawOptions) {
    List<String> options = [];

    try {
      if (rawOptions is String) {
        final decoded = json.decode(rawOptions);
        return _parseOptions(decoded); // Rekursif
      } else if (rawOptions is Map) {
        // Ambil hanya isi value-nya
        options = rawOptions.values.map((e) => e.toString()).toList();
      } else if (rawOptions is List) {
        options = rawOptions.map((e) => e.toString()).toList();
      }
    } catch (e) {
      debugPrint('Gagal parsing options: $e');
    }

    return options;
  }



  Future<void> _showErrorMessage(String message) async {
    if (!mounted) return;
    
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: Colors.red,
        behavior: SnackBarBehavior.floating,
      ),
    );
  }

  Future<void> _showResultDialog(List corrections) async {
    final correctCount = corrections.where((c) => c['is_correct'] == true).length;
    final totalCount = corrections.length;
    final percentage = ((correctCount / totalCount) * 100).round();
    
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(16),
        ),
        title: Row(
          children: [
            Icon(
              percentage >= 70 ? Icons.check_circle : Icons.info_outline,
              color: percentage >= 70 ? Colors.green : Colors.orange,
            ),
            const SizedBox(width: 8),
            const Text(
              'Hasil Latihan',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontWeight: FontWeight.w600,
              ),
            ),
          ],
        ),
        content: SizedBox(
          width: double.maxFinite,
          height: 400,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: percentage >= 70 
                      ? Colors.green.withOpacity(0.1)
                      : Colors.orange.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      'Skor Anda:',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w500,
                        color: Colors.grey[700],
                      ),
                    ),
                    Text(
                      '$correctCount/$totalCount ($percentage%)',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: percentage >= 70 ? Colors.green : Colors.orange,
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),
              const Text(
                'Detail Jawaban:',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontWeight: FontWeight.w600,
                  fontSize: 14,
                ),
              ),
              const SizedBox(height: 8),
              Expanded(
                child: ListView.builder(
                  itemCount: corrections.length,
                  itemBuilder: (context, index) {
                    final correction = corrections[index];
                    final isCorrect = correction['is_correct'] == true;
                    
                    return Container(
                      margin: const EdgeInsets.only(bottom: 8),
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        color: isCorrect 
                            ? Colors.green.withOpacity(0.1)
                            : Colors.red.withOpacity(0.1),
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(
                          color: isCorrect ? Colors.green : Colors.red,
                          width: 1,
                        ),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(
                            children: [
                              Icon(
                                isCorrect ? Icons.check_circle : Icons.cancel,
                                color: isCorrect ? Colors.green : Colors.red,
                                size: 20,
                              ),
                              const SizedBox(width: 8),
                              Expanded(
                                child: Text(
                                  'Soal ${index + 1}',
                                  style: TextStyle(
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w600,
                                    fontSize: 12,
                                    color: isCorrect ? Colors.green : Colors.red,
                                  ),
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 4),
                          Text(
                            correction['question_text'] ?? 'Pertanyaan tidak ditemukan',
                            style: const TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 12,
                              fontWeight: FontWeight.w500,
                            ),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            "Jawaban Anda: ${correction['your_answer'] ?? '-'}",
                            style: TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 11,
                              color: Colors.grey[600],
                            ),
                          ),
                          Text(
                            "Jawaban Benar: ${correction['correct_answer']}",
                            style: const TextStyle(
                              fontFamily: 'Poppins',
                              fontSize: 11,
                              fontWeight: FontWeight.w500,
                              color: Colors.green,
                            ),
                          ),
                        ],
                      ),
                    );
                  },
                ),
              ),
            ],
          ),
        ),
        actions: [
          TextButton(
            onPressed: () {
              Navigator.pop(context);
              Navigator.pop(context);
            },
            child: const Text(
              'Tutup',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
        ],
      ),
    );
  }

  // UI Helper Methods
 Widget _buildQuestionCard(Map<String, dynamic> question, int index) {
    final questionId = question['id'];
    final questionText = question['question_text'] ?? '';
    final List<String> options = _parseOptions(question['options']);
    final selectedAnswer = _answers[questionId];

    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      child: Card(
        elevation: 4,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        child: Container(
          padding: const EdgeInsets.all(16),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(12),
            color: Colors.white,
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  Container(
                    width: 30,
                    height: 30,
                    decoration: BoxDecoration(
                      color: selectedAnswer != null
                          ? Colors.green
                          : _primaryColor.withOpacity(0.1),
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Center(
                      child: Text(
                        '${index + 1}',
                        style: TextStyle(
                          color: selectedAnswer != null
                              ? Colors.white
                              : _primaryColor,
                          fontWeight: FontWeight.bold,
                          fontSize: 12,
                          fontFamily: 'Poppins',
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Text(
                      questionText,
                      style: const TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w500,
                        fontSize: 14,
                        color: _primaryColor,
                      ),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 16),

              // Tampilkan opsi jawaban
              ...options.map((optionValue) {
                final isSelected = selectedAnswer == optionValue;

                return Container(
                  margin: const EdgeInsets.only(bottom: 8),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(
                      color: isSelected ? _secondaryColor : Colors.grey.shade300,
                      width: isSelected ? 2 : 1,
                    ),
                    color: isSelected
                        ? _secondaryColor.withOpacity(0.05)
                        : Colors.transparent,
                  ),
                  child: RadioListTile<String>(
                    title: Text(
                      optionValue,
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontSize: 13,
                        fontWeight:
                            isSelected ? FontWeight.w600 : FontWeight.normal,
                        color: isSelected ? _secondaryColor : Colors.black87,
                      ),
                    ),
                    value: optionValue,
                    groupValue: selectedAnswer,
                    onChanged: (value) => _selectAnswer(questionId, value!),
                    activeColor: _secondaryColor,
                    contentPadding:
                        const EdgeInsets.symmetric(horizontal: 8),
                  ),
                );
              }),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildProgressIndicator() {
    final answeredCount = _answers.length;
    final totalCount = _questions.length;
    final progress = totalCount > 0 ? answeredCount / totalCount : 0.0;

    return Container(
      margin: const EdgeInsets.all(16),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.1),
            blurRadius: 4,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              const Text(
                'Progress Latihan',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontWeight: FontWeight.w600,
                  fontSize: 14,
                  color: _primaryColor,
                ),
              ),
              Text(
                '$answeredCount/$totalCount',
                style: const TextStyle(
                  fontFamily: 'Poppins',
                  fontWeight: FontWeight.w600,
                  fontSize: 14,
                  color: _secondaryColor,
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          LinearProgressIndicator(
            value: progress,
            backgroundColor: Colors.grey.shade300,
            valueColor: AlwaysStoppedAnimation<Color>(
              progress == 1.0 ? Colors.green : _accentColor,
            ),
            minHeight: 6,
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: _backgroundColor,
      appBar: AppBar(
        title: Text(
          widget.categoryName,
          style: const TextStyle(
            fontFamily: 'Poppins',
            fontWeight: FontWeight.w600,
            color: Colors.white,
          ),
        ),
        backgroundColor: _primaryColor,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: _isLoading
          ? const Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  CircularProgressIndicator(
                    valueColor: AlwaysStoppedAnimation<Color>(_primaryColor),
                  ),
                  SizedBox(height: 16),
                  Text(
                    'Memuat soal...',
                    style: TextStyle(
                      fontFamily: 'Poppins',
                      fontSize: 14,
                      color: _primaryColor,
                    ),
                  ),
                ],
              ),
            )
          : _questions.isEmpty
              ? const Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(
                        Icons.quiz_outlined,
                        size: 80,
                        color: Colors.grey,
                      ),
                      SizedBox(height: 16),
                      Text(
                        'Belum ada soal tersedia',
                        style: TextStyle(
                          fontFamily: 'Poppins',
                          fontSize: 16,
                          color: Colors.grey,
                        ),
                      ),
                    ],
                  ),
                )
              : Column(
                  children: [
                    _buildProgressIndicator(),
                    Expanded(
                      child: ListView.builder(
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        itemCount: _questions.length,
                        itemBuilder: (context, index) {
                          final question = _questions[index];
                          return _buildQuestionCard(question, index);
                        },
                      ),
                    ),
                  ],
                ),
      floatingActionButton: _questions.isNotEmpty
          ? FloatingActionButton.extended(
              backgroundColor: _isSubmitting ? Colors.grey : _primaryColor,
              label: _isSubmitting
                  ? const SizedBox(
                      width: 20,
                      height: 20,
                      child: CircularProgressIndicator(
                        valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                        strokeWidth: 2,
                      ),
                    )
                  : const Text(
                      'Submit Jawaban',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        color: Colors.white,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
              icon: _isSubmitting
                  ? null
                  : const Icon(Icons.send, color: Colors.white),
              onPressed: _isSubmitting ? null : _submitAnswers,
            )
          : null,
    );
  }
}