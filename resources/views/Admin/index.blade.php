@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Подключение API sber</h5>
                        <form method="POST" action="{{route('admin.authSber')}}">
                            <div class="mb-3">
                                <label for="inp1" class="form-label">Токен</label>
                                <input type="text" name="token" class="form-control" id="inp1">
                            </div>
                            <div class="mb-3">
                                <label for="inp2" class="form-label">Клиент ID</label>
                                <input type="text" name="client" class="form-control" id="inp2">
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
