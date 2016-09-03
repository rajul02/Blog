<?php 
    
    include 'dbFunction.php';
  include_once 'dbConnect.php';
    if(isset($_POST['delete'])){
       $id = $_POST['delete_rec_id']; 
       echo $id; 
       $query = "DELETE FROM `blog_master` WHERE blog_id= '$id'"; 
       $result = mysqli_query($conn,$query);
       if(!$result)
       {
        echo "failed";
       }
    }

    $query = "SELECT * FROM blog_detail";
    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_array($result)) { 
            $id = $row['blog_id'];
            $subject = $row['blog_detail_id'];
            

            print "<p><strong>$subject</strong> ($id) </p>"; 
            print "<p> $subject </p>";

        ?>
        //delete button starts here here
        <form id="delete" method="post" action="">
        <input type="hidden" name="delete_rec_id" value="<?php print $id; ?>"/> 
        <input type="submit" name="delete" value="Delete!"/>    

        </form>
        <?php
    }   
    ?>