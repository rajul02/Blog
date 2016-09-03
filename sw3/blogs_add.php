<?php
  include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);
  if(isset($_POST['submit']))
  {
    $title = $_POST['title'];

    $category =$_POST['category'];
    $desc=$_POST['description'];
    
    $id = $_SESSION['blogger_id'];
    
    $funObj->image=str_replace("'","''",isset($_POST['txt_image']));
    $funObj->image=isset($_POST['txt_image']);

    $user = $funObj->blogAdd($id,$title,$category,$desc);
    header('Location: blogger.php');
    //$funObj->insert_into_image();
    //if($user)
    //{
      //registration sucess
      //$row=mysqli_fetch_assoc($user);
      //echo $row["blogger_id"];
      //header("Location: index.php");
   // }
   // else {  
            // Registration Failed  
          //  echo "<script>alert('username / Password Not Match')</script>"; 
          //}

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
  <!-- login-page -->
  <div class="login">
    <div class="login-grids">
      <div class=" log" >
           <h2 class="tittle">Blog </h2>
           <p>Enter you blog details here. "A pen is mighter than the sword."</p>
           <?php

           		$status=$funObj->isUserActive($_SESSION['blogger_id']);
           	

           
           if($status)
           {
           		echo '<form name="login" method="post" action="" enctype="multipart/form-data">';
              echo '<p>';   
                echo '<label for="username" class="text" data-icon="e" > <h5>Blog-title<h5></label>';  
                echo '<input id="title" name="title" required="required" type="text" placeholder="Title"/>';   
                 echo '</p>'; 
                  echo '<p>';   
               echo '<label for="username" class="text" data-icon="e" > <h5>Category<h5></label>';  
               echo '<input id="category" name="category" required="required" type="text" placeholder="Category"/>';   
                  echo '</p>'; 
                   echo '<p>';   
               echo '<label for="username" class="text" data-icon="e" > <h5>Description<h5></label>';  
                echo '<input id="description" name="description" required="required" type="text" placeholder="Discription..." style="height: 100px; width: 100%"/>';   
                  echo '</p>';
                 echo '<p>';
                 echo ' <label for="username" class="text" data-icon="e" > <h5>Upload Image<h5></label>'; 
                echo '<input type="file" name="txt_image" id="fileToUpload">';
                 echo '</p>';
                 echo '<p class="Submit"> ';  
                  echo '<input type="submit" name="submit" value="Submit"  />';   
                   echo '</p> '; 
            echo '</form>';

           }
           else 
          echo  '<h2>You are Blocked by Admin</h2>';
           
             ?>
             </div>
      
      
      </div>
    </div>
    
  </div>
  
    </body>
    </html>
