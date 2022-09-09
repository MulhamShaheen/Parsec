@extends('projects.layouts.view')

@section('header')
    @include('header')
@stop


<?php
$project = \App\Models\Project::find($id);
$employer = $project->employer()->get()[0]
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
        <a href="/project/edit/{{$id}}"><button class="btn-redirect">Редактировать информацию проекта</button></a>
    </div>
@stop
@section('project-delete')
    <div class="p-3 mt-4 profile-content">
        <a href="/project/delete/{{$id}}"><button class="btn-redirect">Удалить проекта</button></a>
    </div>
@stop

{{--@section('footer')--}}
{{--    @include('footer')--}}
{{--@stop--}}


