<div class="top-header">
    <div class="container">
        <div class="col-sm-8 nopad">
            <nav class="top_menu">
                <li class="main-li"><a href="/">Главная</a></li>
                <li class="#"><a href="{{ url('/news') }}">Новости</a></li>
                <li class="#"><a href="#">Все о нас</a></li>
                <li class="#"><a href="{{ url('/for-partner') }}">Партнерам</a></li>
                <li class="#"><a href="{{ url('/suggest') }}">+ Предложить свой товар</a></li>
            </nav>
        </div>
        <div class="col-sm-4 text-right nopad">
                <span class="kabinet">
                    @if(Auth::check())
                        <a style="color: #fff; cursor: pointer; float: left;" href="{{ url('user/account') }}">
                            @if (!empty(Auth::user()->avatar))
                                <img class="my_avatar_small" src="{{ asset('uploads/users/small/'.Auth::user()->avatar) }}" alt="user-photo">
                            @else
                                <img class="my_avatar_small" src="{{ asset('img/blank_avatar_220.png') }}" alt="user-photo">
                            @endif
                            &nbsp;
                            {{ Auth::user()->firstname }}
                            &nbsp;
                            <font color="#619F05">{{ __decode(Auth::user()->fm, env('KEY')) }} тг</font>
                        </a>
                    @else
                        <i class="user icon"></i>
                        <a style="color: #ffffff; text-decoration: none;" href="{{ url('user/login') }}">Личный кабинет</a>
                    @endif
                </span>
        </div>
    </div>
</div>