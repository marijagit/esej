<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("../model/config.php");

    $sql = "SELECT * FROM student WHERE username='".$_SESSION['username']."'";
	$sth = $link->query($sql);
	$result=mysqli_fetch_array($sth);
    $getit = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($getit);

	$sql2 = "SELECT p.ime,p.prezime, p.slikaProf FROM profesor p JOIN student s ON p.idProfesor=s.idProfesor
					    		WHERE s.username= '".$_SESSION['username']."'";
	$sth2 = $link->query($sql2);
    $result2=mysqli_fetch_array($sth2);
    
    $getit2 = mysqli_query($link,$sql2);
    $row2 = mysqli_fetch_array($getit2);

	$sql3= "SELECT s.idSeminarski, p.ime, p.prezime, s.datumOdbrane,t.username, pr.nazivPredmeta, s.vremeOdbrane FROM seminarski s JOIN student t ON s.idStudent=t.idStudent 
                                                                                         JOIN profesor p ON s.idProfesor= p.idProfesor
                                                                                         JOIN predmet pr ON s.idPredmet= pr.idPredmet
                                                                                        WHERE t.username= '".$_SESSION['username']."'  AND s.azuriran='ne'";
$result3 = $link->query($sql3);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/mojeSkripte.js"></script>
    <title></title>
</head>
<body>
    <div id="wrapper">
        <div id="header" class="uliniji">
            <img src="css/images/logo.png"> 
            
        </div>
             <div id="content">
                        <div class="topnav" id="myTopnav">
                                <a href="logout.php">Izloguj se</a>
                                <a href="password-reset.php">Promeni lozinku</a> <!--responzivnost -->
                                
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                            
                            
                        </div>
						
						
							
			<div id="title"><h2><h2>Predstojeći seminarski</h2></h2></div>
            <div id="contentdash" class="uliniji">
          <table id="myTable" width="100%" border="1" style="border-collapse:collapse;">
              <thead>
              <tr>
              <th><strong>Br.</strong></th> 
              <th><strong>Ime profesora</strong></th>
              <th><strong>Prezime profesora</strong></th>
              <th><strong>Predmet</strong></th>
              <th><strong>Datum odbrane</strong></th>
              <th><strong>Vreme odbrane</strong></th>
              </tr>
              </thead>
              <tbody>
              <?php
              $count=1;
              
              while($row3 = mysqli_fetch_assoc($result3)) { ?>
              <tr><td><?php echo $count; ?></td>
              <td ><?php echo $row3["ime"]; ?></td>
              <td ><?php echo $row3["prezime"]; ?></td>
              <td ><?php echo $row3["nazivPredmeta"]; ?></td>
              <td ><?php echo $row3["datumOdbrane"]; ?>
              <td ><?php echo $row3["vremeOdbrane"]; ?>
              </td>
              </td>
              </td>
              </tr>
              <?php $count++; } ?>
              </tbody>
              </table>


        </div>
</div>
 
		<?php

 include("php/footing.php");
?>