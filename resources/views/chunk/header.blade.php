<div class="responsive-nav-social-mobile" data-responsive-toggle="responsive-nav-social" data-hide-for="medium">
    <div class="responsive-nav-social-mobile-left">
        <ul class="menu">
            <li>Меню</li>
        </ul>
    </div>
    <div class="responsive-nav-social-mobile-right">
        <button class="menu-icon" type="button" data-toggle="responsive-nav-social"></button>
    </div>
</div>
<div data-sticky-container>
    <div class="responsive-nav-social" id="responsive-nav-social" data-sticky data-options="marginTop:0;">
        <div class="row align-justify align-middle" id="responsive-menu">
            <div class="responsive-nav-social-left">
                <ul class="menu vertical medium-horizontal">
                    <li><a href="{{route('profile.index')}}">Профиль</a></li>
                    <li><a href="{{route('profile.message')}}">Сообщения чат бота</a></li>
                    <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выйти</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>
