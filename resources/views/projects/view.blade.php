@extends('projects.layouts.view')

@section('header')
    @include('header')
@stop


<?php
$project = \App\Models\Project::find($id);
$employer = $project->employer()->get()[0];

?>

@section('project-card')
    <div id="profile-card" class="profile-card">
        <div class="p-3 d-flex flex-column justify-content-center">
            <div class="prof-picture d-flex justify-content-center">
                <div style="display:block; max-height:100px; overflow:hidden;">
                    <img src="/uploads/projects/{{ $project->icon}}" alt="" width="100px" height="100px">
                </div>
            </div>

            <div class="prof-title d-flex justify-content-center">
                <div style=" min-width: 100%;text-align: center;">
                    <h3>{{ $project->title }}</h3>
                </div>
            </div>
            <div class="prof-info d-flex align-items-center flex-column">
                <div class="row">
                    <div class="col">
                        <b>Оргинизатор:</b>
                    </div>
                    <div class="col">
                        {{$employer->title}}
                    </div>
                </div>
                @if($employer->director)
                    <div class="row">
                        <div class="col">
                            <b>Руководитель:</b>
                        </div>
                        <div class="col">
                            {{$employer->director}}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@stop
@section('about')
    <div class="p-3 profile-content">
        <div>
            <div class="m-2 ">
                <h3>О проекте</h3>
                <div class="profile-about">
                    {!! $project->description !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('project-edit')
    <div class="p-3 mt-4 profile-content">
        <a href="/project/edit/{{$id}}">
            <button class="btn-redirect">Редактировать информацию проекта</button>
        </a>
    </div>
@stop
@section('project-delete')
    <div class="p-3 mt-4 profile-content">
        <a href="/project/delete/{{$id}}">
            <button class="btn-redirect">Удалить проекта</button>
        </a>
    </div>
@stop
@section('project-reply')
    <div class="p-3 mt-4 profile-content">
        <a href="/project/reply/{{$id}}">
            <button class="btn-redirect">Откликнуть</button>
        </a>
    </div>
    {{--    @dd(Auth::user()->can('reply', $project))--}}
@stop
@section('project-view-replies')
    <div class="p-3 mt-4 profile-content">
        <div>
            <div class="m-2">
                <h3>Отклыки</h3>
                <div class="profile-about">
                    <div class="row g-4">
                        @if(isset($data['replies']))
                            @foreach($data['replies'] as $reply)
                                <?php
                                $tmp_user = $reply->user()->get()[0];
                                ?>
                                {{--                            @dd($reply)--}}
                                <div class="col-1">
                                    <img src="/uploads/profiles/{{ $tmp_user->prof_picture}}" alt="" width="75px"
                                         height="75px">
                                </div>
                                <div class="col-7">
                                    <h4>{{$reply->user()->get()[0]->name}}</h4>
                                    <p>{{$reply->message}}</p>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/reply/{{$reply->id}}/accept">
                                                <button class="btn-redirect">
                                                    Приминить
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <form action="/reply/decline">
                                                <input type="hidden" class="form-control" name="project" value="{{$id}}">
                                                <input type="hidden" class="form-control" name="reply" value="{{$reply->id}}">
                                                <button type="submit" class="btn-redirect">
                                                    Отказать
                                                </button>
                                            </form>
{{--                                            <a href="/reply/{{$reply->id}}/decline">--}}
{{--                                                <button class="btn-redirect">--}}
{{--                                                    Отказать--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
{{--@section('footer')--}}
{{--    @include('footer')--}}
{{--@stop--}}


