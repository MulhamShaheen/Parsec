@extends('accounts.layouts.view')

@section('profile-card')
    <profile-card></profile-card>
    <div class="p-3 mt-4 profile-content">
        Возраст: {{$data['info']->getUserAge()}} <br>
        Регистрация: {{$data['info']->created_at->toDateString()}}<br>
        Телефон: {{$data['info']->phone}} <b>make double</b><br>
    </div>

@stop
@section('about')
    @if(isset($data['resume']))
        <div class="p-3 profile-content">
            <div>
                <div class="m-2 ">
                    <h3>Обо мне</h3>
                    <div class="profile-about">
                        {!! $data['resume']->description !!}
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
                    @if(isset($data['projects']))
                        @foreach($data['projects'] as $project)
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
                </div>
            </div>
        </div>
    </div>
@stop
@section('more')
    <div class="p-3 mt-4 profile-content">
        <div class="m-2 ">
            <h3>Образование</h3>
            @if(isset($data['faculty']))
            @else
            @endif
            <div class="profile-about mt-4">
                <div class="row g-4">
                    @if(isset($data['faculty']))
                        <div class="col-1">
                            <img src="/uploads/faculties/{{$data['faculty']->icon}}" alt="" width="100%">
                        </div>
                        <div class="col-11">
                            <h5>{{$data['faculty']->name}}</h5>
                            @if(isset($data['major']))
                                <h6>{{$data['major']->title}}</h6>
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
@section('my-replies')
    @if(isset($data['replies']))
        <div class="p-3 mt-4 profile-content">
            @foreach($data['replies'] as $reply)
                <?php
                    $project = $reply->project()->get()[0];
                ?>
                <a href="/project/view/{{$project->id}}">
                    <h4>{{$project->title}}</h4>
                    <p>{{$reply->message}}</p>
                    <p>{{$reply->status}}</p>

                </a>
            @endforeach
        </div>

    @endif
@stop