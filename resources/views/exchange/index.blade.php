<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchange Rates</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">Home</a>
        <div class="justify-content-between">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('exchange.index') }}">Exchange Rates</a>
                </li>
                @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="nav-link" href="{{ route('logout') }}">Logout</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-6 col-xl-5">
                <div class="card p-3">
                    <div class="card-body">
                        <h1>Exchange Rates</h1>
                        <span class="date">
                            Current date and time: {{ date('d.m.Y - H:i:s') }}
                        </span>
                        <p class="mt-1">Data from <a href="https://privatbank.ua/" target="_blank">PrivatBank</a></p>
                        <hr>
                        <h5>Cash Rates</h5>
                        <ul class="ccy-list">
                            @foreach($cashCurrencies as $cashCurrency)
                                <li class="ccy-list-item p-2 mt-2 mb-2">
                                    <span class="ccy-name">{{ $cashCurrency['ccy'] }}</span>
                                    <span class="ccy-item"><span>Buy:</span> {{ number_format($cashCurrency['buy'], 2) }} UAH</span>
                                    <span class="ccy-item"><span>Sale:</span> {{ number_format($cashCurrency['sale'], 2) }} UAH</span>
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <h5>Non-Cash Rates</h5>
                        <ul class="ccy-list">
                            @foreach($nonCashCurrencies as $nonCashCurrency)
                                <li class="ccy-list-item p-2 mt-2 mb-2">
                                    <span class="ccy-name">{{ $nonCashCurrency['ccy'] }}</span>
                                    <span class="ccy-item"><span>Buy:</span> {{ number_format($nonCashCurrency['buy'], 2) }} UAH</span>
                                    <span class="ccy-item"><span>Sale:</span> {{ number_format($nonCashCurrency['sale'], 2) }} UAH</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
