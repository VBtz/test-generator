<!DOCTYPE html>
<html>
<head>
    <title>{{ $test->name }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <div class="content m-auto my-4" style="width: 100%;">
        <div class="alert alert-danger mb-3" role="alert" style="max-width: 650px;margin: auto;display: none;" id="failAlert">
            Ответ на вопрос неверный.
        </div>
        <div class="alert alert-success mb-3" role="alert" style="max-width: 650px;margin: auto;display: none;" id="successAlert">
            {{ $test->successMessage }}
        </div>
        @if(count($test->questions()) > 0)
            <div style="margin: auto;">
                <h4 class="text-center" id="counter">Вопрос <b id="questionNumber" class="text-center">1</b> из <b>{{ count($test->questions()) }}</b></h4>
                <div id="questions">
                    @foreach($test->questions() as $question)
                    <div class="card mb-3 mt-3 question" style="max-width: 650px;margin: auto;display:none;">
                        @if ($question->image_url != null)
                            <img src="{{ $question->image_url }}" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <p class="card-text">{{ $question->text }}</p>
                            @foreach(json_decode($question->answers) as $answer)
                                <div class="input-group mt-2 mb-2">
                                    <div class="input-group-text">
                                        <input class="form-check-input" type="checkbox" data-checked="{{ $answer->checked }}" style="cursor: pointer;">
                                    </div>
                                    <span class="form-control" aria-label="With textarea">{{ $answer->text }}</span>
                                </div>
                            @endforeach
                            <a class="btn btn-primary mt-3" style="float: right;" onclick="onCheckAnswer(this);">Проверить ответ</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="footer"></div>
</div>
<script>
    let failAlert = document.getElementById('failAlert');
    let questions = document.getElementsByClassName('question');
    let questionNumber = document.getElementById('questionNumber');

    let size = questions.length;
    let index = 0;

    let currentQuestion = null;
    if (size > 0) {
        toNextQuestion();
    }

    function toNextQuestion() {
        currentQuestion = questions.item(index++);
        unFade(currentQuestion);
        questionNumber.textContent = index;
    }

    function onCheckAnswer(elem) {
        let validAnswer = true;
        elem.parentNode.querySelectorAll('input').forEach(input => {
            if (input.type === 'checkbox') {
                let checked = input.dataset.checked == 1;
                let userChecked = input.checked;
                if (checked !== userChecked) {
                    validAnswer = false;
                }
            }
        });

        if (validAnswer) {
            failAlert.style.display = 'none';
            fade(currentQuestion, () => {
                if (index < size) {
                    toNextQuestion();
                } else {
                    let successAlert = document.getElementById('successAlert');
                    successAlert.style.display = '';

                    let counter = document.getElementById('counter');
                    counter.style.display = 'none';
                    fade(counter);
                }
            });
        } else {
            failAlert.style.display = '';
        }
    }

    function fade(element, handler = null) {
        let op = 1;
        let timer = setInterval(function () {
            if (op <= 0.1) {
                clearInterval(timer);
                element.style.display = 'none';

                if (handler != null) {
                    handler();
                }
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op -= op * 0.1;
        }, 20);
    }

    function unFade(element, handler = null) {
        let op = 0.1;
        element.style.display = '';
        let timer = setInterval(function () {
            if (op >= 1) {
                clearInterval(timer)

                if (handler != null) {
                    handler();
                }
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op += op * 0.1;
        }, 10);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
