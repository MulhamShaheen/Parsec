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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <link href="{{ asset('css/app.css?'.filectime('css/app.css')) }}" rel="stylesheet">
    <link href="{{ asset('css/components.css?'.filectime('css/components.css')) }}" rel="stylesheet">


</head>
<body>
@include('header')

<div class="update-body">
    <div class="container d-flex flex-column align-items-center">
        <div class="prof-picture d-flex justify-content-center">
            <div style="display:block; max-height:100px; overflow:hidden;">
                <img src="/uploads/projects/{{ $project->icon}}" alt="" width="100px" height="100px">
            </div>
        </div>
        <h2>Основная информация проекта</h2>
        <div class="update-form-group">
            <form action="{{route('update.project',$project->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" placeholder="title" id="title" class="form-control" name="title"
                           value="{{$project->title}}"
                           required autofocus>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input type="text" placeholder="director" id="director" class="form-control" name="director"
                           value="{{$project->director}}"
                           autofocus>
                    @if ($errors->has('director'))
                        <span class="text-danger">{{ $errors->first('director') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input type="textarea" placeholder="description" id="description" class="description-control"
                           {{$project->description}}
                           name="description">
                </div>
                <div class="form-group mb-3">
                    <input type="file" name="icon" id="icon" class="form-control">
                </div>
{{--                <input type="hidden" name="id" id="id" value="{{$project->id}}">--}}
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--@include('footer')--}}
</body>
<script src="{{ mix('js/app.js')}}"></script>
</html>