<?php
header("Content-type: application/xml");
include("../model/konekcija.php");
$sql="SELECT * FROM predmet ORDER BY idPredmet ASC";
$dom = new DomDocument('1.0','utf-8');

 $predmet = $dom->appendChild($dom->createElement('predmet'));

if (!$q=$mysqli->query($sql)){
 $greska = $predmet->appendChild($dom->createElement('greska'));
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita"));
} else {
  if ($q->num_rows>0){
    $niz = array();
    while ($red=$q->fetch_object()){
      $tip = $predmet->appendChild($dom->createElement('tip'));
      $idPredmet = $tip->appendChild($dom->createElement('idPredmet'));
      $idPredmet->appendChild($dom->createTextNode($red->idPredmet));
      $nazivPredmeta = $tip->appendChild($dom->createElement('nazivPredmeta'));
      $nazivPredmeta->appendChild($dom->createTextNode($red->nazivPredmeta));
}
} else {
  $greska = $predmet->appendChild($dom->createElement('greska'));
 $greska->appendChild($dom->createTextNode("Nema unetih predmeta"));
}
}
$xml_string = $dom->saveXML(); 
echo $xml_string;
$mysqli->close()
?>
