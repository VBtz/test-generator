<!DOCTYPE html>
<html>
<head>
    <title>Test-generator</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('panel') }}" class="nav-link px-2 text-secondary">Созданные тесты</a></li>
                    <li><a href="{{ route('create') }}" class="nav-link px-2 text-white">Создать тестирование</a></li>
                </ul>

                <div class="text-end">
                    <a href="{{ route('logout') }}" class="btn btn-outline-light me-2">Выйти из системы</a>
                </div>
            </div>
        </div>
    </header>

    <div class="content m-auto my-4" style="width: 100%;max-width: 800px;">
        <form method="post" action="{{ $question != null ? "/question/update/" . $question->id : "save/" . $test }}" id="form">
            @csrf
            <label for="basic-url" class="form-label">URL изображения:</label>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">@</span>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="imageUrl" value="{{ isset($question) ? $question->image_url : "" }}">
            </div>

            <label for="basic-url" class="form-label">Текст вопроса:</label>
            <textarea class="form-control" aria-label="With textarea" id="text" name="question">{{ isset($question) ? $question->text : "" }}</textarea>

            <button type="button" class="btn btn-primary mt-3" id="addQuestionBtn">Добавить вариант ответа</button>
            <div id="answers">
                @isset($question)
                    @foreach(json_decode($question->answers) as $answer)
                    <div class="input-group mt-3">
                        <div class="input-group-text">
                            <input type="checkbox" style="cursor: pointer;" {{ $answer->checked ? "checked" : "" }}>
                        </div>
                        <textarea class="form-control" aria-label="With textarea">{{ $answer->text }}</textarea>
                        <a class="input-group-text text-danger" style="cursor: pointer;" onclick="removeItem(this)">Удалить</a>
                    </div>
                    @endforeach
                @endisset
            </div>
            <input type="hidden" name="jsonHidden" id="jsonHidden">
            <button type="button" class="btn btn-danger mt-3" id="saveButton" name="save">Сохранить</button>
        </form>
    </div>

    <div class="footer text-center">
        <div class="p-4 bg-dark text-white">
            ©2022
            <a class="text-white" href="https://www.libgonchar.org/" target="_blank">Библиотека</a>
        </div>
    </div>
</div>

<script>
    let addQuestionBtn = document.getElementById('addQuestionBtn');
    let answers = document.getElementById('answers');

    addQuestionBtn.addEventListener('click', () => {
        let group = document.createElement('DIV');
        group.className = 'input-group mt-3';

        let text = document.createElement('DIV');
        text.className = 'input-group-text';

        let checkbox = document.createElement('INPUT');
        checkbox.type = 'checkbox';
        checkbox.style.cursor = 'pointer';

        let area = document.createElement('TEXTAREA');
        area.className = 'form-control';
        area.setAttribute('aria-label', 'With textarea');

        let remove = document.createElement('A');
        remove.className = 'input-group-text text-danger';
        remove.textContent = 'Удалить';
        remove.style.cursor = 'pointer';
        remove.addEventListener('click', () => {
            answers.removeChild(group);
            checkButtonState();
        });

        text.appendChild(checkbox);
        group.append(text, area, remove);

        answers.appendChild(group);
        checkButtonState();
    });

    // ниже - полные костыли, но для скорости разработки сойдет
    function removeItem(elem) {
        answers.removeChild(elem.parentNode);
        checkButtonState();
    }

    let jsonHidden = document.getElementById('jsonHidden');
    let saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', () => {
        function prepareJSON() {
            let result = [];
            console.log(answers.childNodes);
            for (let answer of answers.childNodes) {
                if (answer.tagName !== "DIV")
                    continue;

                result.push({
                    checked: answer.querySelector('input').checked,
                    text: answer.querySelector('textarea').value
                })
            }
            return JSON.stringify(result);
        }

        jsonHidden.value = prepareJSON();

        let form = document.getElementById('form');
        form.submit();
    });

    let text = document.getElementById('text');
    text.addEventListener('input', () => checkButtonState());

    function checkButtonState() {
        saveButton.disabled = answers.childElementCount < 2 || text.value === '';
    }



    checkButtonState();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
