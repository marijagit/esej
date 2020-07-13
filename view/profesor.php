
<?php

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcomeProfesor.php");
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
        $sql = "SELECT idProfesor, username, password FROM profesor WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $idProfesor, $username, $password) ;
                    if(mysqli_stmt_fetch($stmt)){
                        if($password == $_POST['password']){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["idProfesor"] = $idProfesor;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: welcomeProfesor.php");
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
                                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
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
                                                
                                            </div>
                                            
                                        </form>
                        </div>

                </div>    
        </div>
        
    
                
 <?php

 include("php/footing.php");
?>