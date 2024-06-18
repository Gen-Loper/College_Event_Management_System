<?php
include "database/connect.php";
$query = "SELECT u.UserID, u.UserFullName, e.EventName, e.EventID, b.BookingID FROM user_details u INNER JOIN booking_details b ON u.UserID = b.UserID INNER JOIN event_details e ON b.EventID = e.EventID";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " WHERE e.EventName LIKE '%$search%'";
}
$run = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
     <style>
          form{
               margin-left:150px;
               margin-bottom:50px;
               margin-top:25px;
          }
     </style>
    <meta charset="utf-8">
    <title>Delete Data From Database in PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>Admin Mangement</header>

<form action="" method="GET">
    <input type="text" name="search" placeholder="Search by Event Name...">
    <input type="submit" value="Search">
</form>

<table border="1" cellspacing="0" cellpadding="0">
    <tr class="heading">
        <th>SLNO</th>
        <th>Event ID</th>
        <th>Event Name</th>
        <th>User ID</th>
        <th>User Name</th>
        <th>Booking Id</th>
    </tr>
    <?php
    $i=1;
    if ($run && mysqli_num_rows($run) > 0) {
        while ($result = mysqli_fetch_assoc($run)) {
            echo "
                <tr class='data'>
                    <td>".$i++."</td>
                    <td>".$result['EventID']."</td>
                    <td>".$result['EventName']."</td>
                    <td>".$result['UserID']."</td>
                    <td>".$result['UserFullName']."</td>
                    <td>".$result['BookingID']."</td>
                    <td><a href='delete.php?id=".$result['BookingID']."' id='btn'>Delete</a></td>
                </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='6'>No results found.</td></tr>";
    }
    ?>
</table>
</body>
</html>
