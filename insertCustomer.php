<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="webSiteStyle.css">
</head>
<body>
<h2>This inserts Customers:</h2>
<?php
$CEmail = $_POST["CEmail"];
$FName = $_POST["FName"];
$LName = $_POST["LName"];
$Phone = $_POST["Phone"];
$CStreet = $_POST["CStreet"];
$CCity = $_POST["CCity"];
$CZip = $_POST["CZip"];


include 'connecteddb.php';


$query0 = "select CEmail from Customer where CEmail = :CEmail";
$stmt = $connection->prepare($query0);
$stmt->bindParam(':CEmail', $CEmail);
$result = $stmt->execute();



if ($row = $stmt->fetch()) {
	echo "This customer email already exists";
}

else{


$query = "insert into Customer values (:CEmail, :FName, :LName, :Phone, :CStreet, :CCity, :CZip)";
$stmt = $connection->prepare($query);
$stmt->bindParam(':CEmail', $CEmail);
$stmt->bindParam(':FName', $FName);
$stmt->bindParam(':LName', $LName);
$stmt->bindParam(':Phone', $Phone);
$stmt->bindParam(':CStreet', $CStreet);
$stmt->bindParam(':CCity', $CCity);
$stmt->bindParam(':CZip', $CZip);
$result = $stmt->execute();

if ($result == true) {
	echo "Customer successfully inserted<br>";
}
else {
	echo "Failed insertion<br>";
}


$Credit = 5.00;
$query2 = "insert into Account values (:Credit, :CEmail)";
$stmt = $connection->prepare($query2);
$stmt->bindParam(':Credit', $Credit);
$stmt->bindParam(':CEmail', $CEmail);
$result = $stmt->execute();

if ($result == true) {
	echo "Customer given $5 in credit";
}
else {
	echo "No credit given";
}

}


$connection = NULL;
?>

</body>
</html>