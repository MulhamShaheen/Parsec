<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Blog') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link href="{{ URL::asset('css/app.css?'.filectime('css/app.css')) }}" rel="stylesheet">
    <link href="{{ URL::asset('css/vue-styles.css?'.filectime('css/vue-styles.css')) }}" rel="stylesheet">
</head>

<body >
<div class="container" id="body">
    <div class="row">
        <div class="col profile-content">
            <form action="{{route('new.resume')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="resume-create-input" placeholder="Title" id="title" class="form-control "
                           name="title"
                           required autofocus>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <h2>Расскажите про себя</h2>
                <div>
                    <div class="reg-form d-flex flex-column justify-content-center">
                        <div class="form-group mb-3">
                                <textarea placeholder="Description" id="description" class="form-control"
                                          name="description" autofocus style="height: 200px">
                                </textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <h2>Основная информация</h2>
                <div class="row">
                    <div class="col">
                        <h5>Дата рождения</h5>
                    </div>
                    <div class="col">
                        <input type="date">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Пол</h5>
                    </div>
                    <div class="col">
                        <input type="radio" value="asd">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Гражданство</h5>
                    </div>
                    <div class="col">
                        <input type="text">
                    </div>
                </div>
                <h2>Навыки</h2>
                <div class="tags-select d-flex flex-column align-items-center">
{{--                    <tags-table></tags-table>--}}
                </div>
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block">Create Resume</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
<script src="{{ mix('js/app.js')}}" ></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js">

</script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>

</html>