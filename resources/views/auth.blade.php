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
        <div class="content m-auto my-4">
            <form class="mx-4 container" style="max-width: 600px;" method="post" action="">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Логин</label>
                    <input type="text" class="form-control" name="login">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('auth_fail'))
                        <div class="alert alert-danger mt-3" role="alert">
                            {{ $errors->first('auth_fail') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="check" name="remember">
                    <label class="form-check-label" for="check">Запомнить</label>
                </div>
                <button type="submit" class="btn btn-danger">Войти в систему</button>
            </form>
        </div>
        <div class="footer"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
