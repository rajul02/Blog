<?php

  include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);
  if(isset($_POST['login']))
  {
    $username = $_POST['username'];

    $password =$_POST['password'];
    if($username=='admin' && $password=='system123')
    {
      
      header("Location: admin.php");

    }
    else
    {
      $user = $funObj->Login($username,$password);
    if(!$user)
      echo " Incorrect username or password";
    
    }
    
   

  }
?>
<!DOCTYPE >
<html>
<head>
<link href="style.css" rel='stylesheet' type='text/css' />  

</head>
<body style="margin: 0dp">
<body>
  <!-- header-section-starts -->
      <div class="h-top" id="home">
       <div class="top-header">
          <ul class="cl-effect-16 top-nag">
            <li><a href="registration.php" data-hover="REGISTRATION">REGISTRATION</a></li> 
            <li><a href="about.php" data-hover="ABOUT">ABOUT</a></li>
            <li><a href="extra.php" data-hover="CATEGORIES">CATEGORIES</a></li>
            <li><a class="active" href="login.php" data-hover="LOGIN">LOGIN</a></li>
            <li><a href="extra.php" data-hover="CONTACT">CONTACT</a></li>
          </ul>
        </div>
       </div>
  
      <div class="col-md-3 top-nav login">
             <div class="logo">
          <center><h1 style="color: white">Mostly Thoughtful!</h1></center>
          </div>
          <div class="top-menu">
           <span class="menu"> </span>

          <ul class="cl-effect-16">
            <li><a href="index.php" data-hover="HOME">HOME</a></li> 
            <li><a href="about.php" data-hover="ABOUT">ABOUT</a></li>
            <li><a href="extra.php" data-hover="CATEGORIES">CATEGORIES</a></li>
            <li><a href="extra.php" data-hover="GALLERY">GALLERY</a></li>
            <li><a href="extra.php" data-hover="CONTACT">CONTACT</a></li>
          </ul>
          <!-- script-for-nav -->
          <script>
            $( "span.menu" ).click(function() {
              $( ".top-menu ul" ).slideToggle(300, function() {
              // Animation complete.
              });
            });
          </script>
          </div>
      </div>
  <div class="col-md-9 main">
  <!-- login-page -->
  <div class="login">
    <div class="login-grids">
      <div class=" log" >
           <h2 class="tittle">Login </h2>
           <p>Welcome, please enter the following to continue.If you are previously registered blogger please sign in to see your blogs.</p>
           <form name="login" method="post" action="">
              <p>   
                <label for="username" class="text" data-icon="e" > <h5>Your User name<h5></label>  
                <input id="username" name="username" required="required" type="text" placeholder="Rajul Nahar"/>   
                  </p>  
                  <p>   
                 <label for="password" class="youpasswd" data-icon="p"> <h5>Your password<h5> </label>  
                <input id="password" name="password" required="required" type="password" placeholder="u14co001" />   
                  </p>   
                  <p class="login button">   
                  <input type="submit" name="login" value="Login" />   
                    </p>  
             </form>
             <a href="index.php"><h3>See the page as viewer?</h3></a>
             </div>
      <div class="login-right" >
           <h2 class="tittle">New Registration</h2>
          <p>By creating an account you will be able to write your own blogs which will be seen by our viwers.</p>
          <br>
          <a href="registration.php" class="hvr-bounce-to-bottom button">Create An Account</a>
          </div>
      
      </div>
    </div>
    
  </div>
  
    </body>
    </html>
