<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: profesor.php");
    exit;
}
include("../model/config.php");

    $idStudent=$_REQUEST['idStudent'];
    $sql1 = "SELECT * FROM profesor WHERE username='".$_SESSION['username']."'";
    $sth = $link->query($sql1);
    $result=mysqli_fetch_array($sth);

    $idProfesora = $result['idProfesor'];

    $sqlPredmeti = "SELECT * FROM predmet p  WHERE p.idProfesor=".$idProfesora;
    $resultSetPredmeti = $link->query($sqlPredmeti);

    
    $getit = mysqli_query($link,$sql1);
    $row = mysqli_fetch_array($getit);
    echo "<script>console.log('".$row['prezime']."');</script>";
    $idProfesor=$row['idProfesor'];
    $idStudent=$_REQUEST['idStudent'];   


    $datumOdbrane=$predmet= "";
    $datumOdbrane_err =$predmet_err= "";
    
 

if(isset($_POST['save']))
{    
     $datumOdbrane = $_POST['datumOdbrane'];
     $nazivPredmeta = $_POST['naziv'];
     $vremeOdbrane=$_POST['vremeOdbrane'];
     $sqlupit1="SELECT * FROM predmet WHERE nazivPredmeta='$nazivPredmeta'";
    $result1 = mysqli_query($link,$sqlupit1);
    $row1 = mysqli_fetch_array($result1);
    $idPredmet=$row1['idPredmet'];
     
     $sql = "INSERT INTO seminarski (idProfesor,idStudent,datumOdbrane,idPredmet, azuriran,vremeOdbrane) VALUES ('$idProfesor','$idStudent','$datumOdbrane','$idPredmet','ne','$vremeOdbrane')";
     if (mysqli_query($link, $sql)) {
        header("Location: welcomeProfesor.php"); 
     } else {
        echo "Greška!   
" . mysqli_error($link);
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
                                <a href="logout.php">Izloguj se</a>
                                <a href="password-reset.php">Promeni lozinku</a>
                                
                                
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                            
                            
                        </div>
						
						
							
			<div id="contentdash" class="uliniji">
                    <div id="register">
                         <h2>Odredite termin odbrane</h2>
                    <p>Molimo Vas popunite sva polja.</p>
                   <form method="post" >
                             <div>
                            <label>Predmet</label>
                            <br>
                            <select name="naziv">
                                <?php
                                while($red = $resultSetPredmeti->fetch_object()){
                                    ?>
                                    <option value="<?php echo $red->nazivPredmeta?>"><?php echo $red->nazivPredmeta?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" name="selected_text" id="selected_text" value="" />
    
                        </div>   
                        Datum odbrane:<br>
                        <input type="date" name="datumOdbrane">
                        <br>
                        
                        <label>Vreme odbrane</label>
                        <br>
                            <select name="vremeOdbrane">
                              <option value="8:30">8:30</option>
                              <option value="9:00">9:00</option>
                              <option value="9:30">9:30</option>

                              <option value="10:00">10:00</option>
                              <option value="11:30">11:30</option>
                              <option value="12:00">12:00</option>
                              <option value="12:30">12:30</option>
                              <option value="12:00">13:00</option>
                              <option value="12:30">13:30</option>
                              <option value="12:00">14:00</option>
                              <option value="12:30">14:30</option>
                              <option value="12:00">16:00</option>
                              <option value="12:30">16:30</option>
                              <option value="12:00">17:00</option>
                              <option value="12:30">17:30</option>

                             
                              

                            </select>
                            <input type="hidden" name="selected_text" id="selected_text" value="" />
                        <input type="submit" name="save" value="Zakaži odbranu">
                    </form>
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