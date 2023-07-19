<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="webSiteStyle.css">
<style>
 table, th, tr {
  border: 1px solid black;
}
</style>
</head>
<body>
<h1>Order Info</h1>
	
<?php
include "connecteddb.php";
$orderDate = $_POST["orderDated"];

$query = "select Cost, Customer.FName as CFName, Customer.LName as CLName, NameOfFood, Tip, Employee.FName as EFName, 
Employee.LName as ELName from Customer join 
Payment join foodOrder join Includes join Food join Delivery join Employee
on Payment.CusEmail = Customer.CEmail and 
foodOrder.CusEmail = Customer.CEmail and Includes.NameOfFood = Food.FoodName 
and Includes.OrderID = foodOrder.ID and
Delivery.Identification = foodOrder.EID
and Employee.ID = foodOrder.EID where DatePlaced = :orderDate";
$stmt = $connection->prepare($query);
$stmt->bindParam(':orderDate', $orderDate);
$result = $stmt->execute();

echo "The orders made on $orderDate are </br>";


echo "<table><th>Cost $</th><th>Customer first name</th><th>Customer last name</th>
<th>Food ordered</th><th>Tip $</th><th>Deliverer first name</th><th>Deliverer last name</th>";

while ($row = $stmt->fetch()) {
	echo "<tr><td><center>".$row["Cost"]."</center></td><td><center>".$row["CFName"]."</center></td><td><center>
    ".$row["CLName"]."</center></td><td><center>".$row["NameOfFood"]."</center></td><td><center>
    ".$row["Tip"]."</center></td><td><center>".$row["EFName"]."</center></td><td><center>".$row["ELName"]."</center></td></tr>";
}

echo "</table>";



$connection = NULL;

?>
</body>
</html>