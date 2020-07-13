<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include("../model/config.php");

  $sql = "SELECT * FROM profesor WHERE username='".$_SESSION['username']."'";
  $sth = $link->query($sql);
  $result=mysqli_fetch_array($sth);


    $getit = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($getit);

    $idStudent=$_REQUEST['idStudent'];     
  $query2 = "SELECT * from student where idStudent='".$idStudent."'"; 
  $result2 = mysqli_query($link, $query2) or die ( mysqli_error());
  $row2 = mysqli_fetch_assoc($result2);



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
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                        </div>
        <div id="contentdashboard" class="uliniji height100">
          <div id="register" class="height100">
            
            <h1>Izmenite podatke</h1>
            <?php
            $status = "";
            if(isset($_POST['new']) && $_POST['new']==1)
            {
            $id=$_REQUEST['idStudent'];  
            $ime =$_REQUEST['ime'];
            $prezime =$_REQUEST['prezime'];
            $email =$_REQUEST['email'];
            $brojIndexa =$_REQUEST['brojIndexa'];
            $update="update student set ime='".$ime."',               
            prezime='".$prezime."', email='".$email."',
            brojIndexa='".$brojIndexa."' where idStudent='".$idStudent."'";
            mysqli_query($link, $update) or die(mysqli_error($link));
            $status = "Uspešno ste izmenli podatke. </br></br>
            <a href='welcomeProfesor.php'>Pogledajte izmenu</a>";
            echo '<p>'.$status.'</p>';
            }else {
            ?>
            <div>
            <form name="form" method="post" action=""> 
            <input type="hidden" name="new" value="1" />
            <input name="id" type="hidden" value="<?php echo $row2['idStudent'];?>" />
            <label>Ime</label>
            <p><input type="text" name="ime" 
            required value="<?php echo $row2['ime'];?>" /></p>
            <label>Prezime</label>
            <p><input type="text" name="prezime"  
            required value="<?php echo $row2['prezime'];?>" /></p>
            <label>Email</label>
            <p><input type="text" name="email" 
            required value="<?php echo $row2['email'];?>" /></p>
            <label>Broj indexa</label>
            <p><input type="text" name="brojIndexa" 
            required value="<?php echo $row2['brojIndexa'];?>" /></p>
            <p><input name="submit" type="submit" value="Izmeni" /></p>
            
            </form>
            <?php } ?>
            </div>
            </div>  


        </div>
                        

      

    </div>
 
		<div id="footer">
      <p>Copyright &copy; FON <p>
    </div>

  </div>
  <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</body>
</html>