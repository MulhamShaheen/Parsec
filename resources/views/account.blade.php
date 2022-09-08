@extends('layouts.account')

@section('header')
    @include('header')
@stop


<?php
$user = Auth::user();
if (!Auth::user()->isEmployer()) {
    if ($user->resumes()->exists()) {
        $resume = $user->resumes()->orderBy('created_at', 'DESC')->get()[0];
    }
    if ($user->info()->exists()) {
        $info = $user->info()->get()[0];

        if ($info->major()->exists()) {
            $major = $info->major()->get()[0];
        }

        if ($info->faculty()->exists()) {
            $faculty = $info->faculty()->get()[0];

        }
    }
    if ($user->projects()->exists())
    $projects = $user->projects()->get()->all();
}
else {

    $organization = $user->aboutEmployer()->get()[0];
    $projects = $organization->projects()->get()->all();

}

?>

@if(Auth::user()->isEmployer())
@section('profile-card')
    <profile-card></profile-card>
@stop
@section('about')
    <div class="p-3 profile-content">
        <div>
            <div class="m-2 ">
                <h3>О нас</h3>
                <div class="profile-about">
                    {!! $organization->description !!}
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

@else
@section('profile-card')
    <profile-card></profile-card>
    <div class="p-3 mt-4 profile-content">
        Возраст: {{$info->getUserAge()}} <br>
        Регистрация: {{$user->created_at->toDateString()}}<br>
        Телефон: {{$info->phone}} <b>make double</b><br>
    </div>

@stop
@section('about')
    @if(!empty($resume))
        <div class="p-3 profile-content">
            <div>
                <div class="m-2 ">
                    <h3>Обо мне</h3>
                    <div class="profile-about">
                        {!! $resume->description !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="p-3 profile-content">
            <div>
                <div class="m-2 ">
                    <h3>Обо мне</h3>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div>
                            <h4>Здесь ничего нет</h4>
                        </div>
                        <div class="text-center">
                            Расскажите про себя чтобы люди <br>
                            могла познакомиться с вами
                        </div>
                        <button class="btn-redirect">
                            <a href="{{route('edit.account.resume')}}">Рассказать о себе</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
@section('projects')
    <div class="p-3 mt-4 profile-content">
        <div class="m-2 ">
            <h3>Участие в проектах</h3>
            <div class="profile-about mt-4">

                <div class="row g-4">
                    @if(!empty($projects))
                        @foreach($projects as $project)
                            <div class="col-1">
                                <img src="uploads/projects/{{$project->icon}}" alt="" width="100%">
                            </div>
                            <div class="col-11">
                                <h5><a href="">{{$project->title}}</a></h5>
                                <p>{{$project->description}}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h4>Здесь ничего нет</h4>
                            </div>
                            <button class="btn-redirect">
                                <a href="/main">Добавьте проекты</a>
                            </button>
                        </div>
                    @endif
{{--                    <div class="col-1">--}}
{{--                        <img src="img/unlock.jpg" alt="" width="100%">--}}
{{--                    </div>--}}
{{--                    <div class="col-11">--}}
{{--                        <h5><a href="">Unlock</a></h5>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto--}}
{{--                            consectetur cum--}}
{{--                            doloremque ea exercitationem inventore ipsa ipsam iusto, libero nam natus nisi--}}
{{--                            odit, perferendis--}}
{{--                            perspiciatis quibusdam temporibus! Ea, ipsa.</p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@stop
@section('more')
    <div class="p-3 mt-4 profile-content">
        <div class="m-2 ">
            <h3>Образование</h3>
            @if(!empty($faculty))
            @else
            @endif
            <div class="profile-about mt-4">
                <div class="row g-4">
                    @if(!empty($faculty))
                        <div class="col-1">
                            <img src="/uploads/faculties/{{$info->faculty()->get()[0]->icon}}" alt="" width="100%">
                        </div>
                        <div class="col-11">
                            <h5>{{$info->faculty()->get()[0]->name}}</h5>
                            @if(!empty($major))
                                <h6>{{$info->major()->get()[0]->title}}</h6>
                            @else
                                <p>Нет специалности</p>
                            @endif
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div>
                                <h4>Где учитесь?</h4>
                            </div>
                            <button class="btn-redirect">
                                <a href="">Добавить место оброзования</a>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
{{--    @include('accounts.activist')--}}
@endif


@section('footer')
    @include('footer')
@stop


