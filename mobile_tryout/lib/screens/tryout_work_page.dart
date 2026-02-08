import 'dart:async';
import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../utils/api.dart';
import '../services/auth_service.dart';
import 'tryout_result_page.dart';

class TryoutWorkPage extends StatefulWidget {
  final int tryoutId;
  
  const TryoutWorkPage({super.key, required this.tryoutId});

  @override
  State<TryoutWorkPage> createState() => _TryoutWorkPageState();
}

class _TryoutWorkPageState extends State<TryoutWorkPage> {
  // Constants
  static const Color _primaryColor = Color(0xFF091F5B);
  static const Color _secondaryColor = Color(0xFF134765);
  static const Color _backgroundColor = Color(0xFFFDFCEA);
  
  // Services
  final AuthService _authService = AuthService();
  
  // State variables
  Map<int, String> _selectedAnswers = {};
  List<dynamic> _questions = [];
  int _currentIndex = 0;
  int _remainingTime = 0;
  bool _isLoading = true;
  Timer? _timer;

  @override
  void initState() {
    super.initState();
    _fetchTryout();
  }

  @override
  void dispose() {
    _timer?.cancel();
    super.dispose();
  }

  // API Methods
  Future<void> _fetchTryout() async {
    try {
      final token = await _authService.getToken();
      final response = await http.get(
        Api.kerjakanTryout(widget.tryoutId),
        headers: {
          'Authorization': 'Bearer $token',
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        final savedAnswers = _parseSavedAnswers(data['saved_answers']);
        
        List<dynamic> rawQuestions = data['tryout']['questions'] ?? [];
        rawQuestions.shuffle(); // Randomize question order

        setState(() {
          _questions = rawQuestions;
          _remainingTime = data['remaining_time'] ?? 0;
          _selectedAnswers = savedAnswers;
          _isLoading = false;
        });

        _startTimer();
      } else {
        await _handleApiError(response);
      }
    } catch (e) {
      await _showErrorMessage('Terjadi kesalahan: ${e.toString()}');
    }
  }

  Map<int, String> _parseSavedAnswers(dynamic savedRaw) {
    Map<int, String> parsedSaved = {};
    
    if (savedRaw is Map) {
      savedRaw.forEach((key, value) {
        parsedSaved[int.parse(key.toString())] = value.toString();
      });
    } else if (savedRaw is List) {
      for (final item in savedRaw) {
        if (item is Map && 
            item.containsKey('question_id') && 
            item.containsKey('answer')) {
          parsedSaved[int.parse(item['question_id'].toString())] = 
              item['answer'].toString();
        }
      }
    }
    
    return parsedSaved;
  }

  Future<void> _submitTryout() async {
    try {
      final token = await _authService.getToken();
      final bodyAnswers = _selectedAnswers.map(
        (key, value) => MapEntry(key.toString(), value),
      );
      
      final response = await http.post(
        Api.submitTryout(widget.tryoutId),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
        },
        body: json.encode({'answers': bodyAnswers}),
      );

      if (response.statusCode == 200) {
        final score = json.decode(response.body)['score'];
        if (!mounted) return;
        
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (_) => TryoutResultPage(score: score),
          ),
        );
      } else {
        await _handleApiError(response);
      }
    } catch (e) {
      await _showErrorMessage('Gagal submit: ${e.toString()}');
    }
  }

  // Timer Methods
  void _startTimer() {
    _timer = Timer.periodic(const Duration(seconds: 1), (timer) {
      if (_remainingTime <= 0) {
        timer.cancel();
        _submitTryout();
      } else {
        setState(() => _remainingTime--);
      }
    });
  }

  // Helper Methods
  void _selectAnswer(String value) {
    final questionId = _questions[_currentIndex]['id'];
    setState(() {
      _selectedAnswers[questionId] = value;
    });
  }

  void _navigateToQuestion(int index) {
    setState(() => _currentIndex = index);
  }

  String _formatTime(int seconds) {
    final minutes = (seconds ~/ 60).toString().padLeft(2, '0');
    final secs = (seconds % 60).toString().padLeft(2, '0');
    return '$minutes:$secs';
  }

  Future<void> _handleApiError(http.Response response) async {
    final message = json.decode(response.body)['message'] ?? 
        'Terjadi kesalahan pada server';
    await _showErrorMessage(message);
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
    
    Navigator.pop(context);
  }

  // UI Helper Methods
  Widget _buildQuestionHeader() {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.1),
            blurRadius: 8,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                'Soal ${_currentIndex + 1} dari ${_questions.length}',
                style: const TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.w700,
                  fontFamily: 'Poppins',
                  color: _primaryColor,
                ),
              ),
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                decoration: BoxDecoration(
                  color: _secondaryColor.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(20),
                ),
                child: Text(
                  _formatTime(_remainingTime),
                  style: const TextStyle(
                    fontSize: 12,
                    fontWeight: FontWeight.w600,
                    fontFamily: 'Poppins',
                    color: _secondaryColor,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 16),
          Text(
            _questions[_currentIndex]['question_text'] ?? '',
            style: const TextStyle(
              fontSize: 15,
              fontFamily: 'Poppins',
              color: Colors.black87,
              height: 1.5,
            ),
          ),
        ],
      ),
    );
  }
Widget _buildOptionsSection() {
  final question = _questions[_currentIndex];
  final questionId = question['id'];
  final selectedAnswer = _selectedAnswers[questionId];

  // Deteksi apakah options berupa Map atau List
  final optionsRaw = question['options'];
  List<String> optionsList = [];

  if (optionsRaw is Map) {
    optionsList = optionsRaw.values
        .map((value) => value?.toString() ?? '')
        .toList();
  } else if (optionsRaw is List) {
    optionsList = optionsRaw
        .map((item) => item?.toString() ?? '')
        .toList();
  }

  return Container(
    padding: const EdgeInsets.all(16),
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(12),
      boxShadow: [
        BoxShadow(
          color: Colors.grey.withOpacity(0.1),
          blurRadius: 8,
          offset: const Offset(0, 2),
        ),
      ],
    ),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'Pilihan Jawaban:',
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.w600,
            fontFamily: 'Poppins',
            color: _primaryColor,
          ),
        ),
        const SizedBox(height: 12),
        ...optionsList.map((optionText) {
          final isSelected = selectedAnswer == optionText;

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
              value: optionText,
              groupValue: selectedAnswer,
              onChanged: (newValue) => _selectAnswer(newValue!),
              title: Text(
                optionText,
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 13,
                  fontWeight:
                      isSelected ? FontWeight.w600 : FontWeight.normal,
                  color: isSelected ? _secondaryColor : Colors.black87,
                ),
              ),
              activeColor: _secondaryColor,
              contentPadding: const EdgeInsets.symmetric(horizontal: 8),
            ),
          );
        }),
      ],
    ),
  );
}

  Widget _buildQuestionNavigation() {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(0.1),
            blurRadius: 8,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Navigasi Soal:',
            style: TextStyle(
              fontSize: 14,
              fontWeight: FontWeight.w600,
              fontFamily: 'Poppins',
              color: _primaryColor,
            ),
          ),
          const SizedBox(height: 12),
          Wrap(
            spacing: 8,
            runSpacing: 8,
            children: List.generate(_questions.length, (index) {
              final questionId = _questions[index]['id'];
              final isAnswered = _selectedAnswers[questionId] != null;
              final isCurrent = index == _currentIndex;
              
              return GestureDetector(
                onTap: () => _navigateToQuestion(index),
                child: Container(
                  width: 40,
                  height: 40,
                  decoration: BoxDecoration(
                    color: isCurrent 
                        ? _primaryColor
                        : isAnswered 
                            ? const Color.fromARGB(255, 2, 77, 118) 
                            : Colors.grey.shade300,
                    borderRadius: BorderRadius.circular(8),
                    border: isCurrent 
                        ? Border.all(color: _primaryColor, width: 2)
                        : null,
                  ),
                  child: Center(
                    child: Text(
                      '${index + 1}',
                      style: TextStyle(
                        color: isCurrent || isAnswered 
                            ? Colors.white 
                            : Colors.black54,
                        fontWeight: FontWeight.w600,
                        fontSize: 12,
                      ),
                    ),
                  ),
                ),
              );
            }),
          ),
        ],
      ),
    );
  }

  Widget _buildSubmitButton() {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.symmetric(horizontal: 16),
      child: ElevatedButton(
        onPressed: _submitTryout,
        style: ElevatedButton.styleFrom(
          backgroundColor: _secondaryColor,
          padding: const EdgeInsets.symmetric(vertical: 16),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          elevation: 2,
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(
              Icons.send,
              color: Colors.white,
              size: 18,
            ),
            const SizedBox(width: 8),
            const Text(
              'Submit Tryout',
              style: TextStyle(
                fontFamily: 'Poppins',
                fontSize: 16,
                color: Colors.white,
                fontWeight: FontWeight.w600,
              ),
            ),
          ],
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) {
      return const Scaffold(
        backgroundColor: _backgroundColor,
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              CircularProgressIndicator(
                valueColor: AlwaysStoppedAnimation<Color>(_primaryColor),
              ),
              SizedBox(height: 16),
              Text(
                'Memuat tryout...',
                style: TextStyle(
                  fontFamily: 'Poppins',
                  fontSize: 14,
                  color: _primaryColor,
                ),
              ),
            ],
          ),
        ),
      );
    }

    return Scaffold(
      backgroundColor: _backgroundColor,
      appBar: AppBar(
        backgroundColor: _primaryColor,
        elevation: 0,
        title: Row(
          children: [
            const Icon(
              Icons.timer,
              color: Colors.white,
              size: 20,
            ),
            const SizedBox(width: 8),
            Text(
              'Sisa Waktu: ${_formatTime(_remainingTime)}',
              style: const TextStyle(
                fontFamily: 'Poppins',
                color: Colors.white,
                fontWeight: FontWeight.w600,
                fontSize: 16,
              ),
            ),
          ],
        ),
        centerTitle: true,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
      ),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            children: [
              Expanded(
                child: SingleChildScrollView(
                  child: Column(
                    children: [
                      _buildQuestionHeader(),
                      const SizedBox(height: 16),
                      _buildOptionsSection(),
                      const SizedBox(height: 16),
                      _buildQuestionNavigation(),
                      const SizedBox(height: 24),
                    ],
                  ),
                ),
              ),
              _buildSubmitButton(),
              const SizedBox(height: 16),
            ],
          ),
        ),
      ),
    );
  }
}