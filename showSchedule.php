<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="webSiteStyle.css">
</head>
<body>
<h1>Displaying Schedule</h1>
	
<?php
include "connecteddb.php";
$employeeName = $_POST["employeeNamed"];


$query = "select Identification, WorkDay, FName from Employee join workSchedule where (FName = :employeeName and
Employee.ID = workSchedule.Identification) and WorkDay != 'Saturday' and WorkDay != 'Sunday'";
$stmt = $connection->prepare($query);
$stmt->bindParam(':employeeName', $employeeName);
$result = $stmt->execute();


echo "$employeeName works the following days:  ";

if (empty($stmt)) {
	echo "<br>No shifts<br>";
  }

while ($row = $stmt->fetch()) {
	
	echo "<table><tr><td>".$row["WorkDay"]."</td></tr></table>";
}




$connection = NULL;

?>
</body>
</html>