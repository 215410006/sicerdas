@extends('layouts.app')

@section('title', 'Kerjakan Tryout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Kerjakan Tryout: {{ $tryout->nama_tryout }}</h1>
    </div>

    <div class="row">
        <!-- Panel Navigasi Soal -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Soal & Keterangan:</h4>
                </div>
                <div class="card-body">
                    <div class="question-navigation">
                        @foreach($questions as $index => $question)
                            <div class="question-number 
                                {{ isset($savedAnswers[$question->id]) ? 'answered' : 'unanswered' }}
                                {{ $index === 0 ? 'current' : '' }}"
                                data-question="{{ $index }}">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="divider divider-dashed"></div>
                    <div class="navigation-info">
                        <p class="text-small"><strong>Pastikan No. soal ini HIJAU ya!</strong></p>
                        <p class="text-small"><strong>Hijau artinya terjawab.</strong></p>
                        <p class="text-small"><strong>Setelah semua soal terjawab, tekan "Cek Nilaimu Sekarang".</strong></p>
                    </div>
                    <div class="divider divider-dashed"></div>

                    <div class="status-summary">
                        <p><strong>Terjawab:</strong> <span class="badge badge-success answered-count">{{ count($savedAnswers ?? []) }}</span></p>
                        <p><strong>Belum Terjawab:</strong> <span class="badge badge-danger unanswered-count">{{ count($questions) - count($savedAnswers ?? []) }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Soal -->
        <div class="col-md-8">
            <div class="alert alert-info text-center">
                Sisa Waktu: <span id="timer"></span>
            </div>

            <form action="{{ route('tryout.submit', $tryout->id) }}" method="POST" id="tryout-form">
                @csrf
                <div class="question-container">
                    @foreach($questions as $index => $question)
                        <div class="card question-card {{ $index === 0 ? 'active' : 'd-none' }}" data-question="{{ $index }}">
                            <div class="card-body">
                                <p><strong>Soal {{ $index + 1 }}:</strong> {{ $question->question_text }}</p>
                                @foreach($question->options as $option)
                                    @php
                                        $savedAnswer = $savedAnswers[$question->id] ?? null;
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="answers[{{ $question->id }}]"
                                            value="{{ $option }}"
                                            id="q{{ $question->id }}-{{ md5($option) }}"
                                            {{ $savedAnswer === $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="q{{ $question->id }}-{{ md5($option) }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="navigation-buttons mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-question" disabled>
                        <i class="fas fa-chevron-left"></i> Sebelumnya
                    </button>
                    <button type="button" class="btn btn-primary next-question">
                        Selanjutnya <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="submit" class="btn btn-success submit-all d-none">
                        <i class="fas fa-check-circle"></i> Cek Nilaimu Sekarang!
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
    .question-navigation {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 8px;
        margin-bottom: 16px;
    }
    .question-number {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
        border: 1px solid #e4e6fc;
        transition: all 0.3s;
    }
    .question-number.answered {
        background-color: #47c363;
        color: white;
        border-color: #47c363;
    }
    .question-number.unanswered {
        background-color: white;
        color: #6c757d;
        border-color: #e4e6fc;
    }
    .question-number.current {
        border-color: #6777ef;
        box-shadow: 0 0 0 2px rgba(103, 119, 239, 0.2);
        color: #6777ef;
        font-weight: bold;
    }
    .question-number:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .navigation-info, .status-summary {
        font-size: 13px;
    }
    .divider-dashed {
        border-top: 1px dashed #e4e6fc;
        margin: 15px 0;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const questions = document.querySelectorAll('.question-card');
    const questionNumbers = document.querySelectorAll('.question-number');
    const prevBtn = document.querySelector('.prev-question');
    const nextBtn = document.querySelector('.next-question');
    const submitBtn = document.querySelector('.submit-all');
    let currentQuestion = 0;

    // Init
    updateNavigation();

    questionNumbers.forEach(number => {
        number.addEventListener('click', () => showQuestion(parseInt(number.dataset.question)));
    });

    prevBtn.addEventListener('click', () => showQuestion(currentQuestion - 1));
    nextBtn.addEventListener('click', () => showQuestion(currentQuestion + 1));

    document.querySelectorAll('.form-check-input').forEach(radio => {
        radio.addEventListener('change', () => {
            updateAnswerStatus();
            saveAnswer(radio);
        });
    });

    function showQuestion(index) {
        if (index < 0 || index >= questions.length) return;
        questions[currentQuestion].classList.add('d-none');
        questionNumbers[currentQuestion].classList.remove('current');

        currentQuestion = index;
        questions[currentQuestion].classList.remove('d-none');
        questionNumbers[currentQuestion].classList.add('current');

        updateNavigation();
    }

    function updateNavigation() {
        prevBtn.disabled = currentQuestion === 0;
        if (currentQuestion === questions.length - 1) {
            nextBtn.classList.add('d-none');
            submitBtn.classList.remove('d-none');
        } else {
            nextBtn.classList.remove('d-none');
            submitBtn.classList.add('d-none');
        }
    }

    function updateAnswerStatus() {
        const answeredCount = document.querySelectorAll('.form-check-input:checked').length;
        const unansweredCount = questions.length - answeredCount;
        document.querySelector('.answered-count').textContent = answeredCount;
        document.querySelector('.unanswered-count').textContent = unansweredCount;

        questions.forEach((question, index) => {
            const questionId = question.querySelector('.form-check-input').name.match(/\[(.*?)\]/)[1];
            const isAnswered = document.querySelector(`input[name="answers[${questionId}]"]:checked`) !== null;
            questionNumbers[index].classList.toggle('answered', isAnswered);
            questionNumbers[index].classList.toggle('unanswered', !isAnswered);
        });
    }

    function saveAnswer(radio) {
        fetch("{{ route('tryout.saveAnswer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                tryout_id: '{{ $tryout->id }}',
                question_id: radio.name.match(/\d+/)[0],
                answer: radio.value
            })
        })
        .then(response => response.json())
        .then(data => console.log("Jawaban disimpan:", data.message))
        .catch(err => console.error("Error:", err));
    }

    // Timer
    let timeLeft = {{ $remainingTime }};
    const timerDisplay = document.getElementById('timer');
    const timerInterval = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerDisplay.textContent = `${minutes}m ${seconds}s`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            alert('Waktu habis! Jawabanmu akan dikirim.');
            document.getElementById('tryout-form').submit();
        }

        timeLeft--;
    }, 1000);
});

</script>
@endsection
