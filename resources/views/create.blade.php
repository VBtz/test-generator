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

    <div class="content m-auto my-4">
        <form class="mx-4 container" style="max-width: 1000px;" method="post" action="">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название</label>
                <input type="text" class="form-control" name="name">
            </div>

            <button type="submit" class="btn btn-danger">Создать</button>
        </form>
    </div>
    <div class="footer text-center">
        <div class="p-4 bg-dark text-white">
            ©2022
            <a class="text-white" href="https://www.libgonchar.org/" target="_blank">Библиотека</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
