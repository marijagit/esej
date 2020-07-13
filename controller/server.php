<?php

header("Content-type: application/xml"); //definiše se mime type

include("../model/konekcija.php");//konekcija ka bazi
$sql="SELECT * FROM predmet ORDER BY idPredmet ASC"; //priprema upita
$dom = new DomDocument('1.0','utf-8'); //kreiranje XMLDOM dokumenta

 $predmet = $dom->appendChild($dom->createElement('predmet')); //dodaje se koreni element

if (!$q=$mysqli->query($sql)){ //izvršavanje upita
  //ako se upit ne izvrši
 $greska = $predmet->appendChild($dom->createElement('greska')); //dodaje se element <greska> u korenom elementu
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita")); //dodaje se elementu <greska> sadrzaj cvora
  } else { //ako je upit u redu
    if ($q->num_rows>0){  //ako ima rezultata u bazi
        $niz = array();
        while ($red=$q->fetch_object()){
            $tip = $predmet->appendChild($dom->createElement('tip')); //dodaje se element <tip> u korenom elementu <predmet>
            $idPredmet = $tip->appendChild($dom->createElement('idPredmet'));  //dodaje  se <idPredmeta> element u <tip>
            $idPredmet->appendChild($dom->createTextNode($red->idPredmet)); //dodaje se elementu <idTipPregleda> sadrzaj cvora
            $nazivPredmeta = $tip->appendChild($dom->createElement('nazivPredmeta'));  //dodaje  se <nazivPregleda> element u <tip>
            $nazivPredmeta->appendChild($dom->createTextNode($red->nazivPredmeta)); //dodaje se elementu <nazivPregleda> sadrzaj cvora
  }
    } else { //ako nema rezultata u bazi
        $greska = $predmet->appendChild($dom->createElement('greska')); //dodaje se element <greska> u korenom elementu <tipPregleda>
        $greska->appendChild($dom->createTextNode("Nema unetih tipa")); //dodaje se elementu <greska> sadrzaj cvora
  }
}
$xml_string = $dom->saveXML();   //cuvanje XML-a
echo $xml_string;

$mysqli->close() //zatvaranje konekcije
?>
