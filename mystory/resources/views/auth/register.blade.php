<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <link rel="stylesheet" href="css/log.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/register" method="post">
    
    @csrf
        <h3>Register</h3>
        <label for="username">Username</label>
        <input type="text" placeholder="Name" id="username" name="name">
        <label for="username">Email</label>
        <input type="text" placeholder="Email" id="username" name="email">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">
        <input type="password" placeholder="Confirm Password" id="password" name="password_confirmation">

        <button type="submit">Register</button>
        <div class="social">
          <p>Already have an account? </p>
          <a href="/login"><div class="fb">Log in</div></a>
        </div>
    </form>
</body>
</html>
