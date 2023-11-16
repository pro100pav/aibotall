<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Чат бот на основе ChatGPT | AiBotAll</title>
    <link rel="stylesheet" href="{{asset('assets/css/foundation.min.css')}}" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{mix('assets/css/app.css')}}" crossorigin="anonymous">

</head>

<body>
    <div class="grid-container">
        @include('chunk.header',['page_name'=>$page_name])
		@yield('content')
	</div>
    <script src="{{asset('assets/js/vendor/jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/what-input.js')}}"></script>
    <script src="{{asset('assets/js/vendor/foundation.min.js')}}"></script>
    <script src="{{mix('assets/js/app.js')}}"></script>
</body>

</html>
