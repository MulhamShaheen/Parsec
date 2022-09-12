@extends('projects.layouts.reply')

@section('content')
    <h2>Оставить отклык организаторам проекта</h2>
    <div class="update-form-group">
{{--        <form action="" method="POST" enctype="multipart/form-data">--}}
        <form action="{{route('register.to.project',$project->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input type="textarea" placeholder="message" id="message"
                       name="message">
            </div>
            {{--                <input type="hidden" name="id" id="id" value="{{$project->id}}">--}}
            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Отправить</button>
            </div>
        </form>
    </div>

@stop