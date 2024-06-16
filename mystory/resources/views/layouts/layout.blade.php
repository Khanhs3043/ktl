<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Mystory</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
  <link rel="stylesheet" href="css/layout.css">
  <!-- <link rel="stylesheet" href="css/profile.css"> -->
</head>
<body>
<!-- partial:index.partial.html -->
<div id="nav-bar">
  <input id="nav-toggle" type="checkbox"/>
  <div id="nav-header"><a id="nav-title" href="#" target="_blank">MyStory</a>
    <!-- <label for="nav-toggle"><span id="nav-toggle-burger"></span></label> -->
    <form  action = "/logout" method="post">
      @csrf
      <button class="logout-button"><i class="fa-solid fa-right-from-bracket"></i></button>
    </form>
    <hr/>
  </div>
  <div id="nav-content">
 
    <a href = '/home' class="nav-button"><div class="nav-button"><i class="fas fa-home"></i><span>Home</span></div></a>
    <a href = '/groups' class="nav-button"><div class="nav-button"><i class="fas fa-solid fa-users-line"></i><span>Groups</span></div></a>
    <a href = '/friends' class="nav-button"><div class="nav-button"><i class="fas fa-solid fa-user-group"></i><span>Friends</span></div></a>
    <hr/>

    <a href = '/search' class="nav-button"><div class="nav-button"><i class="fas fa-search"></i><span>Sreach</span></div></a>
    <a href = '/tasks' class="nav-button"><div class="nav-button"><i class="fas fa-solid fa-list-check"></i><span>Tasks</span></div></a>
    <a href = '/appointments' class="nav-button"><div class="nav-button"><i class="fas fa-regular fa-calendar-check"></i><span>Appointments</span></div></a>
    
    <hr/>
    <a href = '/friend_requests' class="nav-button"><div class="nav-button"><i class="fas fa-solid fa-envelope"></i><span>Friend requests</span></div></a>
    <a href = '/settings' class="nav-button"><div class="nav-button"><i class="fas fa-solid fa-gear"></i><span>Setting</span></div></a>
    
    <!-- <form  action = "/logout" method="post"><button class="nav-button"><i class="fas fa-solid fa-comments"></i><span>Log out</span></button></form> -->
    <div id="nav-content-highlight"></div>
  </div>
  <input id="nav-footer-toggle" type="checkbox"/>
  <!-- <div id="nav-footer">
    <div id="nav-footer-heading">
      <div id="nav-footer-avatar"><img src="https://gravatar.com/avatar/4474ca42d303761c2901fa819c4f2547"/></div>
      <div id="nav-footer-titlebox"><a id="nav-footer-title" href="https://codepen.io/uahnbu/pens/public" target="_blank">{{Auth::user()->name}}</a></div>
      <label for="nav-footer-toggle"><i class="fas fa-caret-up"></i></label>
    </div>
    <div id="nav-footer-content">
      <Lorem>ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</Lorem>
    </div>
  </div> -->
</div>
<div class="container">
    @yield('content')
</div>
</body>
</html>
