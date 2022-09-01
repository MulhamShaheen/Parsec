<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Blog') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <link href="{{ asset('css/app.css?'.filectime('css/app.css')) }}" rel="stylesheet">
    <link href="{{ asset('css/components.css?'.filectime('css/components.css')) }}" rel="stylesheet">

</head>

@can('isAdmin',\App\Models\Project::class)
    @yield('admin-panel')
@endcan


<body>

@yield('header')
<div>
    @yield('add')
        <div class="landing-container">
            <div class="landing-text">
                <div class="landing-text-main">
                    PW Parsec
                </div>
                <div class="landing-text-secondary">
                    Project Work Parsec — это платформа для проектов, идей и стартапов,
                    на которой вы можете найти единомышленников и инициативных ребят в свою команду.
                </div>
            </div>
            <div class="landing-form">
                <a href="/registration">Я - Активист</a>
                <a href="/registration_as_employer">Я - Руководитель</a>
            </div>
        </div>
        
</div>
<div style="
      border-top: 300px solid transparent;
      border-left: 97vw solid #1a202c;
">

</div>
<div style="background: #1a202c;min-height: 60vh;text-align: center">
    <div>
        <img src="/img/1.jpg" width="500px" alt="">
        <img src="/img/3.jpg" width="500px" alt=""><br>
        <img src="/img/23.jpg" width="500px" alt="">
    </div>
    <div style="background: #2D384D">
        <div style="text-align: left; color: #e2e8f0; width: 70vw; margin-left: 10vw">
            <h1>Отзывы</h1>
        </div>
        <div style="display: flex; flex-direction: row; justify-content: space-around">
            <div style="background: #1a202c; padding: 10px"><h1 >Отзыв 1 </h1></div>
            <div style="background: #1a202c; padding: 10px"><h1 >Отзыв 2 </h1></div>
            <div style="background: #1a202c; padding: 10px"><h1 >Отзыв 3 </h1></div>
        </div>
        <br>
    </div>
</div>

@yield('footer')
</body>

<script src="{{ mix('js/app.js')}}" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>