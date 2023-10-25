<!DOCTYPE html>
<html lang="ru">
@include('chunk.head')
<body>
    <div id="main-wrapper">
        @include('chunk.header',['page_name'=>$page_name])

        @include('chunk.sidebar')

        <div class="content-body">
			<div class="container-fluid">
				@yield('content')
            </div>
        </div>
	</div>
    @include('chunk.script')
    </body>
</html>