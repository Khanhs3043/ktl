<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <link rel="stylesheet" href="css/log.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="/login" method="post">
    @csrf
      <h3>Login Here</h3>
        <label for="username">Email</label>
        <input type="text" placeholder="Email" id="username" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button>Log In</button>
        <a href="/login/google"><button type="button" class="logwithgg"><i class="fa-brands fa-google"></i><span> Log In with Google</span></button></a>
        <div class="social">
        <p>Don't have account? </p>
          <a href="/register"><div class="fb">Register</div></a>
        </div>
    </form>
</body>
</html>
