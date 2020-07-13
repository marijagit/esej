<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
include("../model/config.php");

 	$sql1 = "SELECT * FROM student WHERE username='".$_SESSION['username']."'";
	$sth = $link->query($sql1);
	$result=mysqli_fetch_array($sth);
	$getit = mysqli_query($link,$sql1);
    $row = mysqli_fetch_array($getit);


$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Molimo Vas unesite novu lozinku.";     
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Molimo Vas ponovite lozinku.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err .= "Lozinke se ne poklapaju.<br>";
        }
        if (strlen($new_password) < 8) {
               $confirm_password_err .= "Lozinka mora imati preko 8 karaktera.<br>";
        }
        if (!preg_match("#[0-9]+#", $new_password)) {
                $confirm_password_err .= "Lozinka mora imati jedan broj.<br>";
        }
        if (!preg_match("#[a-zA-Z]+#", $new_password)) {
                $confirm_password_err .= "Lozinka mora sadrzati barem jedno slovo!";
        }
        
    }
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE student SET password = ? WHERE idStudent = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){ 
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id); 
            $param_password = $new_password;            
            $param_id = $_SESSION["idStudent"];
            
            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Greška! Pokušajte ponovo.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);

	}
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
                                <a href="index.php">Početna</a>
                                <a href="login.php">Student</a>
                                <a href="profesor.php">Profesor</a>
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                            
                            
                        </div>				
                        <div class="log">
					         <h2>Promenite lozinku</h2>
					        <p>Molimo Vas unesite validne podatke.</p>
					        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
					            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
					                <label>Nova lozinka</label>
                                    <br>
					                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
					                <span class="help-block"><?php echo $new_password_err; ?></span>
					            </div>
					            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
					                <label>Potvrdite lozinku</label>
                                    <br>
					                <input type="password" name="confirm_password" class="form-control">
					                <span class="help-block"><?php echo "<br>".$confirm_password_err; ?></span>
					            </div>
					            <div class="form-group">
					                <input type="submit" class="btn btn-primary" value="Promeni">
					              
					            </div>
					        </form>
					    </div>
        </div>
		<?php

 include("php/footing.php");
?>