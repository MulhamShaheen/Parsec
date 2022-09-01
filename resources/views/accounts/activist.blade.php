<?php
$user = Auth::user();
$resume = $user->resumes()->orderBy('created_at', 'DESC')->get()[0];
$info = $user->info()->get()[0];
?>
<div class="account-body">
    <div id="profile" class="container-fluid account-main">
        <div class="row g-5">
            <div class="col-3">
                <profile-card></profile-card>
                <div class="p-3 mt-4 profile-content">
                    Возраст: {{$info->getUserAge()}} <br>
                    Регистрация: {{$user->created_at->toDateString()}}<br>
                    Телефон: {{$info->phone}} <b>make double</b><br>
                </div>
            </div>
            <div class="col-9">
                <div class="p-3 profile-content">
                    <div>
                        <div class="m-2 ">
                            <h3>Обо мне</h3>
                            <div class="profile-about">
                                {!! $resume->description !!}
                            </div>
                        </div>
                        {{--            @if(Auth::user()->resumes()->exists())--}}

                        {{--                <div class="ms-2 pt-2 border-0 border-bottom border-info">--}}
                        {{--                    <a href="/resume/{{$resume->id}}" style="text-decoration: none"><h4>{{$resume->title}}</h4></a>--}}

                        {{--                    <div style="color: #cbd5e0">--}}
                        {{--                        {!! $resume->description !!}--}}
                        {{--                    </div>--}}
                        {{--                </div>--}}
                        {{--            @else--}}
                        {{--                <div>--}}
                        {{--                    <h3>--}}
                        {{--                        add new resume <a href="{{route('create.resume')}}">here</a>--}}
                        {{--                    </h3>--}}
                        {{--                </div>--}}
                        {{--            @endif--}}
                        {{--            <div>--}}
                        {{--                <a href="{{route("create.resume")}}">--}}
                        {{--                            <span style="border-radius: 7px; background-color: #718096; color: #cbd5e0; margin: 20px">--}}
                        {{--                                Add Resume--}}
                        {{--                            </span></a>--}}

                        {{--            </div>--}}
                    </div>
                </div>
                <div class="p-3 mt-4 profile-content">
                    <div class="m-2 ">
                        <h3>Участие в проектах</h3>
                        <div class="profile-about mt-4">
                            <div class="row g-4">
                                <div class="col-1">
                                    <img src="img/unlock.jpg" alt="" width="100%">
                                </div>
                                <div class="col-11">
                                    <h5><a href="">Unlock</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto
                                        consectetur cum
                                        doloremque ea exercitationem inventore ipsa ipsam iusto, libero nam natus nisi
                                        odit, perferendis
                                        perspiciatis quibusdam temporibus! Ea, ipsa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 mt-4 profile-content">
                    <div class="m-2 ">
                        <h3>Образование</h3>
                        <div class="profile-about mt-4">
                            <div class="row g-4">
                                <div class="col-1">
                                    <img src="/uploads/faculties/{{$info->faculty()->get()[0]->icon}}" alt="" width="100%">
                                </div>
                                <div class="col-11">
                                    <h5>{{$info->faculty()->get()[0]->name}}</h5>
                                    <h6>{{$info->major()->get()[0]->title}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
