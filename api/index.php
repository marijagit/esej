<?php
require 'flight/Flight.php';
include("Baza.php");

Flight::register('db', 'Baza', array(''));

Flight::route('/', function(){
});

Flight::route('GET /predmeti', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Baza $db */
	$db = Flight::db();
    $rezultati = $db->vratiPredmeteIProfesore();
    echo json_encode($rezultati);
});

Flight::route('GET /grupno', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Baza $db */
    $db = Flight::db();
    $rezultati = $db->vratiKolikoKojiProfesorPredmetaPredaje();
    echo json_encode($rezultati);
});

Flight::route('GET /obaveze', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Baza $db */
    $db = Flight::db();
    $rezultati = $db->vratiKolikoStudenataImaSeminarskeZadatke();
    echo json_encode($rezultati);
});

Flight::route('GET /seminarski', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Baza $db */
    $db = Flight::db();
    $rezultati = $db->vratiSeminarske();
    echo json_encode($rezultati);
});

Flight::start();
