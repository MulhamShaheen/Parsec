<header>
    <div class="header">
        <div class="header-brand">
            <div class="header-title">

            </div>
        </div>

        <div class="nav-menu">
            <div class="nav-menu-tabs">Резюме</div>
            <div class="nav-menu-tabs">Проекты</div>
{{--            <div class="nav-menu-tabs">Что-то ещё</div>--}}
        </div>
        @if(Auth::check())
        <div id="user" class="header-user">
            <user-icon></user-icon>
        </div>
        @else
            <div id="user" class="header-user">
                <a href="/login">Login</a>
                <a href="/registration">Register</a>
            </div>
        @endif
    </div>
</header>


