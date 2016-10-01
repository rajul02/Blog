<?php
  $id='*';
  include 'dbFunction.php';
  include_once 'dbConnect.php';
  



?>



<!DOCTYPE >
<html >
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
      <br><br>
  
  <?php
  session_destroy();
  $id='*';
  $funObj = new dbFunction($conn);
  $user = $funObj->getBlogsById($id);
  if(!is_null($user)){

  while ($row=mysqli_fetch_assoc($user)) {
    echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; margin_bottom:10px">';
    

    $image_seq= $funObj->getImageById($row["blog_id"],$id);

    $row1=mysqli_fetch_assoc($image_seq);
    ///echo $row1["blog_detail_image"];
    $image_name= $row1["blog_detail_image"];      $image_path="images";      
    echo '<div class=" log">';
    echo ' <h2 class="tittle">';
          echo $row["blog_title"];
              echo ' </h2>';
          echo "<img src=".$image_path."/".$image_name." height=200 width=100%><br>";
     echo "</div>";
          
          echo '<div class="login-right"  style="float: right; height: 200px ; ">';
                  echo '   <br><br><br>';
                  echo ' <p>';
                  echo $row["blog_desc"]; 
                  echo '</p>';
                  echo ' <p style="float: bottom">';
                  echo "Author:-".$row["blog_author"];
                  echo '</p>';
         
         
                  echo '<p style="float: right">';
                  echo "Date:".$row["creation_date"];
                  echo '</p>';
         echo  '</div>';  
   echo ' </div>';

   echo '<br><br><br><br>';
  

  }
}
?>
    
    
    
  
  </div>

    </body>
    </html>
  