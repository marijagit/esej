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

    $sql2 = "SELECT t.idStudent,t.ime, t.prezime, t.email, t.brojIndexa, t.slikaStudenta FROM student t JOIN profesor p ON t.idProfesor=p.idProfesor
                  WHERE p.username= '".$_SESSION['username']."' ORDER BY t.idStudent desc";
  $result2 = $link->query($sql2);

$curl = curl_init("http://localhost/esej/api/grupno");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
$podaci = json_decode($curl_odgovor);
curl_close($curl);


$curl = curl_init("http://localhost/esej/api/obaveze");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
$podaci2 = json_decode($curl_odgovor);
curl_close($curl);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                            
                        </div>
						
						
							
			<div id="contentdash">

          <div class="table">
            <h2>Studenti</h2>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraga po prezimenu">
            <table id="myTable">
              <thead>
              <tr>
              <th><strong>Br.</strong></th>
              <th><strong>Slika</strong></th> 
              <th><strong>Ime</strong></th>
              <th><strong>Prezime</strong></th>
              <th><strong>Email</strong></th>
              <th><strong>Broj indexa</strong></th>
              <th><strong>Izmeni</strong></th>
              <th><strong>Obriši</strong></th>
              <th><strong>Zakaži odbranu</strong></th>
              </tr>
              </thead>
              <tbody>
              <?php
              $count=1;
              
              while($row2 = mysqli_fetch_assoc($result2)) { ?>
              <tr><td><?php echo $count; ?></td>
              <td ><?php echo '<img src="data:css/images/png;base64,'.base64_encode( $row2['slikaStudenta'] ).'"style="width: 100px;"/>'; ?></td>
              <td ><?php echo $row2["ime"]; ?></td>
              <td ><?php echo $row2["prezime"]; ?></td>
              <td ><?php echo $row2["email"]; ?></td>
             
              <td ><?php echo $row2["brojIndexa"]; ?></td>
              <td>
              <a href="update.php?idStudent=<?php echo $row2["idStudent"]; ?>">Izmeni</a>
              </td>
              <td>
              <a href="delete.php?idStudent=<?php echo $row2["idStudent"]; ?>">Obriši</a>
              <td>
              <a href="newexf.php?idStudent=<?php echo $row2["idStudent"]; ?>">Zakaži</a>
              </td>
              </td>
              </tr>
              <?php $count++; } ?>
              </tbody>
              </table>

            </div>
                <hr>
                <h2>Koliko koji profesor predaje predmeta</h2>
                <div class="table">
                    <table id="myTable" >
                        <thead>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>Broj predmeta</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($podaci as $podatak){
                            ?>
                            <tr>
                                <td><?php echo $podatak->ime . " " . $podatak->prezime ?> </td>
                                <td><?php echo $podatak->brojPredmeta ?> </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
                <hr>
                <h2>Koliko je studentima ostalo seminarskih radova</h2>
                <div class="table">
                    <table id="myTable" >
                        <thead>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>Broj seminarskih</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($podaci2 as $podatak){
                            ?>
                            <tr>
                                <td><?php echo $podatak->ime . " " . $podatak->prezime ?> </td>
                                <td><?php echo $podatak->brojseminarskih ?> </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

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