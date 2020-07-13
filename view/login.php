<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
include("../model/config.php");
 
$username = $password = "";
$username_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Molimo Vas unesite Koriničko ime.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Molimo Vas unesite lozinku.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT idStudent, username, password FROM student WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $idStudent, $username, $password); 
                    if(mysqli_stmt_fetch($stmt)){
                        if($password == $_POST['password']){ 
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idStudent"] = $idStudent;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: welcome.php");
                        } else{
                            $password_err = "Lozinka nije tačna.";
                        }
                    }
                } else{
                    $username_err = "Ne postoji korisnik sa ovim korisničkim imenom.";
                }
            } else{
                echo "Greška! Molimo Vas pokušajte ponovo.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>

                
 <?php

 include("php/heading.php");
?>

                    
                    <div class="login">
                        <div class="log">
                                        <h2>Ulogujte se</h2>
                                        <p>Molimo Vas popunite sva polja.</p>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                                <label>Koriničko ime</label>
                                                <br>
                                                <input type="text" type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                                <span class="help-block"><?php echo $username_err; ?></span>
                                            </div>    
                                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                <label>Lozinka</label>
                                                <br>
                                                <input type="password" name="password" class="form-control">
                                                <span class="help-block"><?php echo $password_err; ?></span>
                                            </div>
                                            <div class="form-group1">
                                                <input type="submit" class="btn btn-primary" value="Ulogujte se">
                                                <br>
                                                
                                            </div>
                                            <hr>
                                            <h2>Trenutni podaci o virusu</h2>
                                            <div>
                                                <ul>
                                                    <li>Novih slucajeva <span style="color: darkviolet;" id="novi"></span></li>
                                                    <li>Aktivnih slucajeva <span style="color: blueviolet;" id="aktivno"></span></li>
                                                    <li>Kriticnih slucajeva <span style="color: darkred;" id="kriticno"></span></li>
                                                    <li>Oporavljenih slucajeva <span style="color: brown;" id="opor"></span></li>
                                                    <li>Ukupno slucajeva <span style="color: black;" id="total"></span></li>
                                                </ul>
                                            </div>
                                        </form>
                        </div>
                        
                </div>    
        </div>
        
    
                
 <?php

 include("php/footing.php");
?>