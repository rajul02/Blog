
<?php 


  
?>


<!DOCTYPE>
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
            <li>
            <form name=deleteblog action="" method="post">
            <input type="submit" name="delete_blog" value="Delete Blog"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            </li>
              <li>
            <form name=deleteblogger action="" method="post">
             <input type="submit" name="delete_blogger" value="Delete Blogger"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            
            </li>
            <li>
            <form name=blockblog action="" method="post">
             <input type="submit" name="block_blog" value="Block Blog"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            
            </li>

             <li>
            <form name=permission action="" method="post">
            <input type="submit" name="permission" value="Blog permission"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            </li>

            <li>
            <form name=permission action="" method="post">
            <input type="submit" name="permissionblogger" value="Blogger block"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            </li>

            <li>
            <form name=permission action="" method="post">
            <input type="submit" name="blockblogger" value="Blogger permission"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
            </li>

            <li><a href="extra.php" data-hover="GALLERY">GALLERY</a></li>
            <li><a href="extra.php" data-hover="CONTACT">CONTACT</a></li>
          </ul>
          <?php $id =  5; ?>
          
          <center><p style="color: white;">Input Id</p></center>
        <input type="hidden" name="delete_rec_id" value=<?php echo $id;?> required="" /> 
        <br>
        <p class="submit"></p>
            <input type="submit" name="delete" value="Delete"  style="background-color: #4a245e;color: white;width: 85%; height: 30px; border: solid;border-color: #4a245e"/> 
                 
                 </p>
                  </form>  
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
       <div class="col-md-9 main">
          <h2>Welcome Admin!</h2>

       </div>
 
      <?php 

      include 'dbFunction.php';
  include_once 'dbConnect.php';
  $funObj = new dbFunction($conn);
    
     if(isset($_POST['delet1'])){

       $id = $_POST['deleteblogger']; 
       //echo "deleted id:".$id; 
       $query = "DELETE FROM `blogger_info` WHERE blogger_id= '$id'"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->deleteBlogger();
    }
    
    
  if(isset($_POST['delete_blog']))
  $funObj->deleteBlog();
    if(isset($_POST['delete'])){
       $id = $_POST['delete_rec_id']; 
       echo 'hdhfuu'.$id; 
       $query = "DELETE FROM `blog_master` WHERE blog_id= '$id'"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->deleteBlog();
    }


    if(isset($_POST['delete_blogger']))
    {
      
      $funObj->deleteBlogger();
    }
//Blocking blog
    if(isset($_POST['block_blog']))
    {
      $funObj->blockBlog();
    }

    if(isset($_POST['block_blog1'])){
       $id = $_POST['block_blog_rec_id']; 
        
       $query = "UPDATE `blog_master` SET blog_is_active='0' WHERE blog_id= $id"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->blockBlog();
    }
//Giving permissions to blog
     if(isset($_POST['permission']))
    {
      $funObj->blogPermission();
    }

    if(isset($_POST['active_blog'])){
       $id = $_POST['active_blog_rec_id']; 
        
       $query = "UPDATE `blog_master` SET blog_is_active='1' WHERE blog_id= $id"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->blogPermission();
    }

    //blocking to blogger
    if(isset($_POST['permissionblogger']))
    {
      $funObj->bloggerPermission();
    }

    if(isset($_POST['blogger_permission'])){
       $id = $_POST['bloggerpermissionid']; 
        
       $query = "UPDATE `blogger_info` SET blogger_is_active='0' WHERE blogger_id= $id"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->bloggerPermission();
    }

    //permiting to blogger
    if(isset($_POST['blockblogger']))
    {
      $funObj->bloggerBlock();
    }

    if(isset($_POST['blogger_block'])){
       $id = $_POST['bloggerblockid']; 
        
       $query = "UPDATE `blogger_info` SET blogger_is_active='1' WHERE blogger_id= $id"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
       $funObj->bloggerBlock();
    }





   /* 
    $query1 = "SELECT * FROM blog_master";
    $result1 = mysqli_query($conn,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blog_id = $row1['blog_id'];
            $blog_desc = $row1['blog_desc'];
            $blog_title = $row1['blog_title'];
            $author = $row1['blog_author'];
            $last_update = $row1['creation_date'];

    $funObj = new dbFunction($conn);
  
   $image_seq= $funObj->getImageById($blog_id,'*');

    $row1=mysqli_fetch_assoc($image_seq);
    $image_name= $row1["blog_detail_image"];      $image_path="images";     

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; margin_bottom:10px; margin-right:30px">';
    
            echo '<div class=" log">';
    echo ' <h2 class="tittle">';
          echo $blog_title;
              echo ' </h2>';
          echo "<img src=".$image_path."/".$image_name." height=200 width=100%><br>";
     echo "</div>";
          
          echo '<div class="login-right"  style="float: right; height: 200px ; ">';
                  echo '   <br><br><br>';
                  echo ' <p>';
                  echo $blog_desc; 
                  echo '</p>';
                  echo ' <p style="float: bottom">';
                  echo "Author:-".$author;
                  echo '</p>';
         
         
                  echo '<p style="float: right">';
                  echo "Date:".$last_update;
                  echo '</p>';
          
   

  
            

        ?>
        //delete button starts here here
        <form id="delete" method="post" action="">
        <input type="hidden" name="delete_rec_id" value="<?php print $blog_id; ?>"/> 
        <input type="submit" name="delete" value="Delete!" style="background-color:blue"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
    } */  
    ?>
  
    </div>

    </body>
    </html>
