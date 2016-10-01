<?php
session_start();
	class dbFunction

	{
		var
			$image,
			$image_id,
			$image_name;
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$FOR CONNECTION
		public function __construct($conn)
		{
			//conecting to database
			$this->db = $conn;
		}
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$FOR LOGIN
		public function Login($username,$password)
		{
			$res = mysqli_query($this->db, "SELECT * FROM blogger_info WHERE blogger_username='$username' and blogger_password='$password'");
			if (!$res) {
    		echo 'Could not run query: ' . mysqli_error();
    		exit;
		  }
			

			$no_rows = mysqli_num_rows($res);
			$user_data=mysqli_fetch_assoc($res);

			if($user_data["blogger_id"])

			{	
				$_SESSION['blogger_id'] = $user_data["blogger_id"];
        $_SESSION['blooger_username'] = $user_data['blogger_username'];
				header("Location: blogger.php");
				
				

				return $user_data["blogger_id"];
			}
			else
			{

				return false;
			}
		}

		public function Register($username,$password)
		{
			//$d=date("Y-m-d");
			//echo "asdgfhgjhkjlklvf";
			$d = date_create()->format('Y-m-d');
			mysqli_query($this->db, "INSERT INTO `blogger_info` (`blogger_id`, `blogger_username`, `blogger_password`, `blogger_creation_date`, `blogger_is_active`, `blogger_updated_date`, `blogger_end_date`) VALUES ('', '$username', '$password', '$d', '1', '', '')");

			return true;
			
		}
		public function isUserActive($id)
		{
			
			$qr = mysqli_query($this->db, "SELECT * FROM blogger_info WHERE blogger_id='".$id."' ");

			$row=mysqli_fetch_assoc($qr);
			$status = $row['blogger_is_active'];
			 //echo $status;
			return $status;
			
		}

		public function getBlogsById($id)
		{
			if($id=='*')
			{
				$qr = mysqli_query($this->db,"SELECT * FROM blog_master WHERE blog_is_active=1");
				$qr1= mysqli_query($this->db,"SELECT * FROM blog_detail");
			}
			else
			{
				$qr = mysqli_query($this->db,"SELECT * FROM blog_master WHERE blogger_id='".$id."'");
				$qr1= mysqli_query($this->db,"SELECT * FROM blog_detail");
			}
			if (!$qr) {
   			 echo 'Could not run query: ' . mysqli_error();
   			 exit;
				}
			

				$no_rows = mysqli_num_rows($qr);
				if($no_rows>0)
				
				return $qr;
			
		}

		public function blogAdd($id,$title,$category,$desc)
		{
			$qr= mysqli_query($this->db,"SELECT * FROM blogger_info WHERE blogger_id='".$id."'");
			if (!$qr) {
   			 echo 'Could not run query: ' . mysqli_error();
   			 exit;
				}
				$d = date_create()->format('Y-m-d');
				$row=mysqli_fetch_assoc($qr);
				$username= $row["blogger_username"];
				$ins=mysqli_query($this->db,"INSERT INTO `blog_master`(`blog_id`, `blogger_id`, `blog_title`, `blog_desc`, `blog_category`, `blog_author`, `blog_is_active`, `creation_date`, `updated_date`) VALUES ('','$id','$title','$desc','$category','$username','','$d','')");

				$qr=mysqli_query($this->db,"SELECT * FROM blog_master WHERE blog_title='".$title."'");
				$row=mysqli_fetch_assoc($qr);
				$blog_id= $row["blog_id"];

				//for image upload
				if($_FILES["txt_image"])
			{
				$tempnamme= $_FILES["txt_image"]["tmp_name"];
				$originalname= $_FILES["txt_image"]["name"];
				$size=($_FILES["txt_image"]["size"]/5242880)."MB<br>";
				$type=$_FILES["txt_image"]["type"];
				$image=$_FILES["txt_image"]["name"];
				move_uploaded_file($_FILES["txt_image"]["tmp_name"], "images/".$_FILES["txt_image"]["name"]);

				
			}
			$qr=mysqli_query($this->db,"INSERT INTO `blog_detail`(`blog_detail_id`, `blog_id`, `blog_detail_image`) VALUES ('','$blog_id','$image')");
			if($qr)
			{
				echo "sucess";
			}
			else
			{
				echo "failed";
			}

		}
		function getImageById($blog_id,$blogger_id)
		{
		
			if($blogger_id=='*')
			{

				$qr= mysqli_query($this->db,"SELECT * FROM blog_detail WHERE blog_id='$blog_id'");
			}
			else
			{
				$qr= mysqli_query($this->db,"SELECT * FROM blog_detail WHERE blog_id='$blog_id'");
			}
			if (!$qr) {
   			 echo 'Could not run query: ' . mysqli_error();
   			 exit;
				}
			

				$no_rows = mysqli_num_rows($qr);
				if($no_rows>0)
				
				return $qr;
		}
		


		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

		function deleteBlog()
		{
	
    
    $query1 = "SELECT * FROM blog_master";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blog_id = $row1['blog_id'];
            $blog_desc = $row1['blog_desc'];
            $blog_title = $row1['blog_title'];
            $author = $row1['blog_author'];
            $last_update = $row1['creation_date'];

   // $funObj = new dbFunction($conn);
  
   $image_seq= $this->getImageById($blog_id,'*');

    $row1=mysqli_fetch_assoc($image_seq);
    $image_name= $row1["blog_detail_image"];      $image_path="images";     

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:20px">';
    
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
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="delete_rec_id" value="<?php print $blog_id; ?>"/> 
        <input type="submit" name="delete" value="Delete!" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
    }   
		}

		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$


		function deleteBlogger()
		{

    	
    $query1 = "SELECT * FROM blogger_info";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blogger_id = $row1['blogger_id'];
            $username = $row1['blogger_username'];
            $blogger_is_active = $row1['blogger_is_active'];
            if($blogger_is_active==1)
            	$status='yes';
            else
            	$status='no';

             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:10px">';
    
            echo '<div class=" log">';
    echo ' <h2 class="tittle">';
          echo $username;
              echo ' </h2>';
              echo '<div>';
              echo 'Blogger ID:'.$blogger_id;
              echo '</div>';
               echo '<div>';
               echo 'Blogger Active:'.$status;
               echo '</div>'; 
         
     echo "</div>";
          echo '<div style="float: left">';
          echo '<br><br><br>';
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="deleteblogger" value="<?php print $blogger_id; ?>"/> 
        <input type="submit" name="delet1" value="Delete!" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white; float:right"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>";
    }   
		}
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

		function blockBlog()
		{
			$query1 = "SELECT * FROM blog_master";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blog_id = $row1['blog_id'];
            $blog_desc = $row1['blog_desc'];
            $blog_title = $row1['blog_title'];
            $author = $row1['blog_author'];
            $last_update = $row1['creation_date'];

            if($row1['blog_is_active']) 
    	$status='Yes';
    else
    	$status='Not';

   // $funObj = new dbFunction($conn);
  
   $image_seq= $this->getImageById($blog_id,'*');

    $row1=mysqli_fetch_assoc($image_seq);
    $image_name= $row1["blog_detail_image"];      $image_path="images";
        

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:20px">';
    
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

                  echo '<p>';
                  echo "Blog Active:".$status;
                  echo '</p>';
         
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="block_blog_rec_id" value="<?php print $blog_id; ?>"/> 
        <input type="submit" name="block_blog1" value="Block" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
    }   
		}
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

		function blogPermission()
		{
			$query1 = "SELECT * FROM blog_master WHERE blog_is_active= 0";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blog_id = $row1['blog_id'];
            $blog_desc = $row1['blog_desc'];
            $blog_title = $row1['blog_title'];
            $author = $row1['blog_author'];
            $last_update = $row1['creation_date'];

          
   // $funObj = new dbFunction($conn);
  
   $image_seq= $this->getImageById($blog_id,'*');

    $row1=mysqli_fetch_assoc($image_seq);
    $image_name= $row1["blog_detail_image"];      $image_path="images";
        

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:20px">';
    
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
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="active_blog_rec_id" value="<?php print $blog_id; ?>"/> 
        <input type="submit" name="active_blog" value="Make Active" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
    }   
		}

		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$(blocking blogger)
		function bloggerPermission()
		{


    	
    $query1 = "SELECT * FROM blogger_info WHERE blogger_is_active=1";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blogger_id = $row1['blogger_id'];
            $username = $row1['blogger_username'];
           

             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:10px">';
    
            echo '<div class=" log">';
    echo ' <h2 class="tittle">';
          echo $username;
              echo ' </h2>';
              echo '<div>';
              echo 'Blogger ID:'.$blogger_id;
              echo '</div>';
               
         
     echo "</div>";
          echo '<div style="float: left">';
          echo '<br><br><br>';
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="bloggerpermissionid" value="<?php print $blogger_id; ?>"/> 
        <input type="submit" name="blogger_permission" value="Block Blogger" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white; float:right"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>";
    }   
		}
		
		//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$permiting blogger
		function bloggerBlock()
		{


    	
    $query1 = "SELECT * FROM blogger_info WHERE blogger_is_active=0";
    $result1 = mysqli_query($this->db,$query1);
    while ($row1 = mysqli_fetch_array($result1)) { 
            $blogger_id = $row1['blogger_id'];
            $username = $row1['blogger_username'];
           

             echo '<div class="col-md-9 main" style="border: ridge; border-radius:25px; padding:10px">';
    
            echo '<div class=" log">';
    echo ' <h2 class="tittle">';
          echo $username;
              echo ' </h2>';
              echo '<div>';
              echo 'Blogger ID:'.$blogger_id;
              echo '</div>';
               
         
     echo "</div>";
          echo '<div style="float: left">';
          echo '<br><br><br>';
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="bloggerblockid" value="<?php print $blogger_id; ?>"/> 
        <input type="submit" name="blogger_block" value="Allow Blogger" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white; float:right"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>";
    }   
		}
		
		

		
	}
?>
