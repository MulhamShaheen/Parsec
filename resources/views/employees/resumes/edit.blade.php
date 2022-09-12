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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link href="{{ URL::asset('css/app.css?'.filectime('css/app.css')) }}" rel="stylesheet">
</head>

<body>
<?php
$user = Auth::user();
if ($user->resumes()->exists()) {
    $resume = $user->resumes()->get()[0];
} else {
    $resume = null;
}
?>
<div class="position-absolute top-50 start-50 translate-middle">
    <div class="align-items-center reg-form d-flex flex-column justify-content-center">
        <h2>New Resume</h2>
        <form action="{{route("save.account.resume")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input type="text" placeholder="Title" id="title" class="form-control" name="title"
                       required autofocus value="{!! !is_null($resume)? $resume->title : "" !!}">
                @if ($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group mb-3" style="color: #1a202c">
                        <textarea placeholder="Description" id="description" class="form-control"
                                  name="description" autofocus style="height: 200px; "
                                  text=" {!! !is_null($resume)? $resume->description : ""!!}">

                        </textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Save changes</button>
            </div>
        </form>
    </div>
</div>

</body>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js">

</script>
<script>

    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            editor.setData('{!! !is_null($resume) ? $resume->description : "" !!}')
        })
        .catch(error => {
            console.error(error);
        });

    {{--editorInstance.setData('{!! \App\Models\Resume::find($id)->description !!}')--}}
    // console.log(editorInstance)

</script>

</html>