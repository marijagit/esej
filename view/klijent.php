<!DOCTYPE html>
<html>
<head>
	<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>


<meta http-equiv='Content-Type' content='Type=text/html; charset=utf-8'>
<title>Predmeti</title>
<style>
#predmeti {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#predmeti td, #predmeti th {
  border: 1px solid #ddd;
  padding: 8px;
}

#predmeti tr:nth-child(even){background-color: #800000; color: white}

#predmeti tr:hover {background-color: black; color: white;}

#predmeti th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: black;
  color: white;
}
</style>
</head>
<body>
<?php
$url = 'http://localhost/esej/controller/server.php';   
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
curl_close($curl);

$predmet = new SimpleXMLElement($curl_odgovor,null,false);
if (property_exists($predmet,"greska")){
echo ($predmet->greska);
} else {
?>
<h2>Predmeti</h2>
<table id="predmeti">
<tr>
<td>Id</td>
<td>Naziv</td>
</tr>
<?php
foreach ($predmet as $p){
?>
<tr>
<td><?php echo $p->idPredmet;?></td>
<td><?php echo $p->nazivPredmeta;?></td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
</body>
</html>


