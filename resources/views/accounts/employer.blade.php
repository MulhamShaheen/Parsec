@extends('accounts.layouts.view')

@section('profile-card')
    <profile-card></profile-card>
@stop
@section('about')
    <div class="p-3 profile-content">
        <div>
            <div class="m-2 ">
                <h3>О нас</h3>
                <div class="profile-about">
                    {!! $employer->description !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('projects')
    <div class="p-3 mt-4 profile-content position-relative">
        <div class="m-2 ">
            <div class="profile-content position-absolute top-0 end-0 mt-4 m-4">
                <a href="{{route('create.project.view')}}">Добавить проект </a>
            </div>
            <h3>Наши проекты</h3>
            <div class="profile-about mt-4">
                <div class="row g-4">
                    @if(!empty($projects))
                        @foreach($projects as $project)
                            <div class="col-1">
                                <img src="uploads/projects/{{$project->icon}}" alt="" width="100%">
                            </div>
                            <div class="col-11">
                                <h5><a href="/project/view/{{$project->id}}">{{$project->title}}</a></h5>
                                <p>{{$project->description}}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h4>Здесь ничего нет</h4>
                            </div>
                            <button class="btn-redirect">
                                <a href="/project/create">Добавьте проекты</a>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
