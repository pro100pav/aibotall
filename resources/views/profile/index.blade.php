@extends('layouts.app', ['page_name' => 'Ваш профиль'])
@section('content')
    <div class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3">
        <div class="cell">
            <div class="callout">
                <p>{{Auth::user()->username}}</p>
                <p class="lead">Ваш статус: {{Auth::user()->status()}}</p>
            </div>
        </div>
        <div class="cell">
            <div class="callout">
                <p>{{Auth::user()->req()->requests}}</p>
                <p class="lead">Ваш статус: {{Auth::user()->status()}}</p>
                <p class="subheader">Тут вы можете докупить или заработать запросы для чат бота</p>
            </div>
        </div>
    </div>
@endsection
