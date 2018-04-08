<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $page_title or 'Тестирование' }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/shop-homepage.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Главная</a>
						<a class="navbar-brand" href="/register">Регистрация</a>
                    </div>
                </div>
                <div class="col-lg-6 text-right" style="padding-top: 10px">
                    @if (Auth::check())
                        <div style="color:white">
                            
                            <form action="{{ route('auth.logout') }}" method="post">
                                {{ csrf_field() }}
								 {{ Auth::user()->name }}
                                <input type="submit" value="Выйти" class="btn btn-info">
                            </form>
                        </div>
                    @else
                        <form action="{{ route('auth.login') }}" method="post">
                            {{ csrf_field() }}
                            <input type="email" name="email" placeholder="Email" />
                            <input type="password" name="password" placeholder="Password" />
                            <input type="submit" value="Войти" class="btn btn-info">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @yield('sidebar')
            </div>
            <div class="col-md-9">
                <div class="row">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <footer class="container-fluid text-center bg-lightgray">

        <div class="copyrights" >
            <p>Kramatorsk © 2018, All Rights Reserved<br>
            <span>Web Design By: Yurchenko Alexey</span></p>
        </div>
		</footer>
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
