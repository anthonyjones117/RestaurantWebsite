<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=restaurantdb', "root", "");
} catch (PDOException $e) {
	echo "Error";
    echo "Error!: ". $e->getMessage(). "<br/>";
	die();
}
?>