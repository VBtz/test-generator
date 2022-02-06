<!DOCTYPE html>
<html>
<head>
    <title>Test-generator</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        textarea[autoresize] {
            display: block;
            overflow: hidden;
            resize: none;
        }
        </style>
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

    <div class="content m-auto my-4">
        <form class="mx-4 container" style="max-width: 1000px;" method="post" action="">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название</label>
                <input type="text" class="form-control" name="name" value="{{ $test->name }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Сообщение после прохождения</label>
                <input type="text" class="form-control" name="successMessage" value="{{ $test->successMessage }}">
            </div>
            <button type="submit" class="btn btn-danger">Изменить данные</button>
        </form>
        <hr>

        <div>
            <a href="{{ route("question", ['test' => $test]) }}" class="btn btn-primary d-flex justify-content-center">Добавить вопрос</a>
        @foreach($test->questions() as $question)
            <div class="mt-3">
                <div class="card mx-3" style="max-width: 25rem;">
                    @if ($question->image_url != null)
                        <img src="{{ $question->image_url }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <p class="card-text">{{ $question->text }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @foreach(json_decode($question->answers) as $answer)
                                <div class="input-group mt-2 mb-2">
                                    <div class="input-group-text">
                                        <input class="form-check-input" type="checkbox" {{ $answer->checked ? "checked" : "" }} disabled>
                                    </div>
                                    <span class="form-control" aria-label="With textarea">{{ $answer->text }}</span>
                                </div>
                            @endforeach
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('question', ['test' => $question->test_id, 'question' => $question->id])}}" class="card-link">Редактировать</a>
                        <a href="" class="card-link" data-bs-toggle="modal" data-bs-target="#exampleModal"
                           style="color: red;" data-qId="{{ $question->id }}" onclick="onDeleteClick(this);">Удалить</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>

    <div class="footer text-center">
        <div class="p-4 bg-dark text-white">
            ©2022
            <a class="text-white" href="https://www.libgonchar.org/" target="_blank">Библиотека</a>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Внимание!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Подтвердите действие удаления вопроса.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <form method="post" action="/question/delete">
                    @csrf
                    <input type="hidden" id="hiddenId" name="hiddenId" value="">
                    <button type="submit" class="btn btn-danger">Подтвердить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function onDeleteClick(elem) {
    let attribute = elem.getAttribute("data-qId");

    let element = document.getElementById("hiddenId");
    element.value = attribute;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
