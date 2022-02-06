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
                    <li><a href="{{ route('panel') }}" class="nav-link px-2 text-white">Созданные тесты</a></li>
                    <li><a href="{{ route('create') }}" class="nav-link px-2 text-secondary">Создать тестирование</a></li>
                </ul>

                <div class="text-end">
                    <a href="{{ route('logout') }}" class="btn btn-outline-light me-2">Выйти из системы</a>
                </div>
            </div>
        </div>
    </header>

    <div class="content m-auto my-4" style="width: 100%;">
        @if(count($tests) == 0)
            <p class="text-center">Список тестирований пуст</p>
        @endif
        @foreach ($tests as $test)
        <div class="card mt-3" style="max-width: 600px;margin: auto;">
            <div class="card-body">
                <h5 class="card-title">{{ $test->name }}</h5>
                <p class="card-text">Дата создания: <small>{{ $test->created_at }}</small></p>
                <p><a href="{{ route('test', ['id' => $test]) }}" target="_blank" class="link-primary">Ссылка на тест</a></p>
                <a href="{{ route("settings", ['test' => $test]) }}" class="btn btn-primary">Редактировать</a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
                   data-test-id="{{ $test->id }}" onclick="onDeleteClick(this)">Удалить</a>
            </div>
        </div>
        @endforeach{{ $tests->links() }}
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
                Подтвердите действие удаления тестирования.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <form method="post" action="panel/delete">
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
    let attribute = elem.getAttribute("data-test-id");

    let element = document.getElementById("hiddenId");
    element.value = attribute;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
