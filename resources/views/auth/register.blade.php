<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Blog') }}</title>

{{--    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>--}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="{{ URL::asset('css/app.css?'.filectime('css/app.css')) }}" rel="stylesheet">
</head>

<body>

        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="align-items-center reg-form d-flex flex-column justify-content-center">
                <h2>Welcome!</h2>
                <form action="{{route('register.custom')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                               required autofocus>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email_address" class="form-control"
                               name="email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Password" id="password" class="form-control"
                               name="password" required>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" name="prof_picture" id="prof_picture" class="form-control">
                    </div>
                    <h2>Личные данные</h2>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Фамилия" id="surname" class="form-control" name="surname"
                               required autofocus>
                        @if ($errors->has('surname'))
                            <span class="text-danger">{{ $errors->first('surname') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="Имя" id="firstname" class="form-control" name="firstname"
                               required autofocus>
                        @if ($errors->has('firstname'))
                            <span class="text-danger">{{ $errors->first('firstname') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="Отчество" id="middlename" class="form-control" name="middlename"
                               autofocus>
                        @if ($errors->has('middlename'))
                            <span class="text-danger">{{ $errors->first('middlename') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input type="date" placeholder="Дата рождения" id="birthdate" class="form-control" name="birthdate"
                               required autofocus>
                        @if ($errors->has('birthdate'))
                            <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="Номер телефона" id="phone" class="form-control" name="phone"
                               autofocus>
                        @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="faculty">
                            @foreach($faculities as $faculty)
                                <option value="{{$faculty->name}}">{{$faculty->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember"> Remember Me</label>
                        </div>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                    </div>
                </form>
                <div>
                    Or click <a href="login">here</a> if you already have an account
                </div>
            </div>
        </div>

</body>

</html>