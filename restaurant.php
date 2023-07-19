<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="webSiteStyle.css">
</head>
<body>
	<h1> Anthony's Restaurant Chain</h1>
	<br>
	<img src="images/restaurantImage.jpg" alt="restaurant inside" width="300" height="400"> 
	
	
	<h2>Orders on a Particular Date</h2>
	<form action="getOrderInfo.php" method="post"> 
   

		<?php  
	  include 'connecteddb.php';
	  $query = "SELECT DatePlaced FROM foodOrder group by DatePlaced";
	  $result = $connection->query($query);
	  echo "Choose a date </br>";
	  while ($row = $result->fetch()) {
		   echo '<input type="radio" name="orderDated" value = "';
		   echo $row["DatePlaced"];
		   echo '">'. $row["DatePlaced"]."<br>";
	  }
	  $connection = NULL;
   		?>


	  <input type="submit" value = "Choose Date">
	  </form> 




    <h2>Add New Customer</h2>
    <form action = "insertCustomer.php" method = "post">    
	<form>
	<p>Email:</p>
    <input type="text" name="CEmail">  <br>
     <p>First name:</p>
     <input type="text" name="FName">  <br>
     <p>Last name: </p>
     <input type="text" name="LName">
     <p>Phone Number:</p>
     <input type = "text" name = "Phone">
	 <p>Street:</p>
     <input type = "text" name = "CStreet">
	 <p>City:</p>
     <input type = "text" name = "CCity">
	 <p>Zip:</p>
     <input type = "text" name = "CZip">
     <input type="submit">
	 <br>
   </form> 



   <h2>Orders Placed</h2>
	
	<table>
	<tr><th>Dates of orders</th><th>Number of orders on date</th></tr>

	<?php
	include 'connecteddb.php';

	$result = $connection->query("select PaymentDate as Date, count(PaymentDate) as NumOrders from Payment group by PaymentDate");

	while ($row = $result->fetch()) {
		echo "<tr><td><center>".$row["Date"]."</center></td><td><center>".$row["NumOrders"]."</center></td></tr>";
		
		
	}

	$connection = NULL;
	?>
	</table>


	<h2>Schedule</h2>

	<form action="showSchedule.php" method="post"> 
   
	<?php
   include 'connecteddb.php';
   $query = "SELECT FName, LName FROM Employee";
   $result = $connection->query($query);
   echo "Which Employee schedule would you like to see? </br>";
   while ($row = $result->fetch()) {
        echo '<input type="radio" name="employeeNamed" value="';
        echo $row["FName"];
        echo '">'. $row["FName"]." ".$row["LName"]."<br>";
   }
   $connection = NULL;
	?>
   <input type="submit" value = "Choose Employee">
   </form> 

	
   <h2>Thank you for visiting!</h2>
</body>
</html> 