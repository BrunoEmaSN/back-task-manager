<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="ms-auto me-auto mt-5" style="width: 500px">
        <div class="mt-5">
            @if ($errors)
                <div class="col-12">
                    <div class="alert alert-danger">{{ $errors }}</div>
                </div>
            @endif
            @if (session()->has('error'))
                <div>{{ session('error') }}</div>
            @endif

            @if (session()->has('success'))
                <div>{{ session('success') }}</div>
            @endif
        </div>
        <form action="{{ route('reset_password_api') }}" method="post">
            @csrf
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <div class="mb-3">
                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input class="form-control" name="password" id="password" type="password">
                </div>
                <div class="form-group mt-3">
                    <label class="form-label" for="repeat_password">Repeat Password</label>
                    <input class="form-control" name="repeat_password" id="repeat_password" type="password">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
