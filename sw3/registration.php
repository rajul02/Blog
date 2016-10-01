<?php
  include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);

  if(isset($_POST['register']))
  {

    $username = $_POST['username'];

    $password = md5($_POST['password']);
    $user = $funObj->Register($username,$password);
    if($user)
    {
      echo 'registration sucess';
      header("Location: login.php");
    }
    else {  
            // Registration Failed  
            echo "<script>alert('username / Password Not Match')</script>"; 
          }

  }
  ?>

<html>
  <head>
    <link href="style.css" rel='stylesheet' type='text/css' />  
    <script type="text/javascript">
         <!--
          function validate()
           {
      
             if( document.register.username.value == "" )
             {
              alert( "Please provide your username!" );
              document.register.username.focus() ;
              return false;
             }

             if(document.register.username.value.length <=4)
             {
              alert("Username is too short. Enter at least 4 characters");
              document.register.username.focus() ;
              return false;
             }

             if(document.register.password.value.length <=4)
             {
              alert("Password is too short. Enter at least 4 characters");
              document.register.password.focus() ;
              return false;
             }



             if((document.register.password.value)!=(document.register.rpassword.value))
             {
              alert("Password does not match");
              document.register.password.focus();
              return false;
             }
           }
         //-->
    </script>
  </head>
<body style="margin: 0dp">

  <!-- header-section-starts -->
      <div class="h-top" id="home">
       <div class="top-header">
          <ul class="cl-effect-16 top-nag">
            <li><a class="active" href="registration.php" data-hover="REGISTRATION">REGISTRATION</a></li> 
            <li><a href="about.php" data-hover="ABOUT">ABOUT</a></li>
            <li><a href="extra.php" data-hover="CATEGORIES">CATEGORIES</a></li>
            <li><a href="login.php" data-hover="LOGIN">LOGIN</a></li>
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
  <!-- registration-page -->
  <div class="register">
    <div class="register-grids">
      <div class=" reg" >
           <h2 class="tittle">Registration </h2>
           <p>Welcome, please enter the following to register yourself as blogger.If you are previously registered blogger please sign in to see your blogs.</p>
           <form name="register" method="post"  onsubmit="return(validate())" action="">
              <p>   
                <label for="username" class="text" data-icon="e" > <h5 style="font-size: 20px; color: #F26649; font-family: 'Open Sans', sans-serif;">Your Username</h5></label>  
                <input id="username" name="username" required="required" type="text" placeholder="Mohit Sharma"  style="width: 50%;
  padding: 8px;
  font-size: 14px;
  font-weight: 400;
  border: 1px solid #e6e6e6;
  outline: none;
  color: #000;
  margin-bottom:32px;" />   
                  </p>  
                  <p>   
                 <label for="password" class="youpasswd" data-icon="p"> <h5 style="font-size: 20px; color: #F26649; font-family: 'Open Sans', sans-serif;">Your password</h5> </label>  
                <input id="password" name="password" required="required" type="password" placeholder="u14co093" style="width: 50%;
  padding: 8px;
  font-size: 14px;
  font-weight: 400;
  border: 1px solid #e6e6e6;
  outline: none;
  color: #000;
  margin-bottom:32px;" />   
                  </p>  
                  <p>   
                 <label for="rpassword" class="ryoupasswd" data-icon="p"> <h5 style="font-size: 20px; color: #F26649; font-family: 'Open Sans', sans-serif;">Re-enter Password</h5> </label>  
                <input id="rpassword" name="rpassword" required="required" type="password" placeholder="u14co093" />   
                  </p>  
                  <p class="register button" >   
                  <input type="submit" name="register" value="Register" style=" border: none; color: #ffffff;padding: 11px 53px;font-size: 17px;cursor: pointer;margin: 0 0 32px 0;background: #4A245E;border: none;outline: none;-webkit-appearance: none; />   
                    </p> 

             </form>
             <a href= "index.php"><h3>See the page as viewer?</h3></a>
             </div>
      </div>
    </div>

    </div>
  </body>
</html>