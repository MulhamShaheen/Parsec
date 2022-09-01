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
<body>
@include('header')

<div class="container-sm">
    <div class="create-body">
        @can('create',\App\Models\Project::class)
            <form action="{{route('create.project')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" placeholder="title" id="title" class="form-control" name="title"
                           required autofocus>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input type="text" placeholder="director" id="director" class="form-control" name="director"
                           autofocus>
                    @if ($errors->has('director'))
                        <span class="text-danger">{{ $errors->first('director') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <input type="textarea" placeholder="description" id="description" class="description-control"
                           name="description">
                </div>
                <div class="form-group mb-3">
                    <input type="file" name="cover_picture" id="cover_picture" class="form-control">
                </div>
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                </div>
            </form>
            <h1>aaaaa</h1>
        @endcan
    </div>
</div>



@include('footer')
</body>
<script src="{{ mix('js/app.js')}}"></script>
</html>