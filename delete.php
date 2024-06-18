<?php   
 include "database/connect.php"; 
 if (isset($_GET['id'])) {  
     $BookingID = $_GET['id'];  
     $query="DELETE FROM booking_details WHERE BookingID='$BookingID'";
     $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:admin_delete.php');  
      }else{  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 ?>