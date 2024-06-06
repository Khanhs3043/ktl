<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="calc.css">
    <title>Home</title>
</head>
<body>
    <div class="header">
        <div class="header-top">
            <a href=""><div class="logo">
                <i class="fa-solid fa-bolt"></i>
                <p>ELECTRICITY</p>
            </div>
            </a>
            <div class="wrap-user">
                <div class="avatar">
    
                </div>
                <div class="username">
                    User k
                </div>
                <a href="">
                <div class="logout"><i class="fa-solid fa-right-from-bracket"></i></div>
            </a>
            </div>
        </div>
        <div class="header-bottom">
            <div class="wrap-header-bottom">
                <a href="/calc" class="ecalc">Tính tiền điện</a>
                <a href="/cost" class="cost">Giá điện</a>
                <a href="" class="search">Tra cứu</a>
                <a href="" class="pay">Đóng tiền</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</body>
</html>