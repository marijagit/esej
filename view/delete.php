
<?php
include("../model/config.php");
$id=$_REQUEST['idStudent'];
$query = "DELETE FROM student WHERE idStudent=$id"; 
$result = mysqli_query($link,$query) or die ( mysqli_error());
header("Location: welcomeProfesor.php"); 
?>