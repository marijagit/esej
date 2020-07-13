<?php
class Baza
{

    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new mysqli("localhost", "root", "", "esej");
        $this->konekcija->set_charset("utf8");
    }

    public function vratiPredmeteIProfesore()
    {
        $resultSet = $this->konekcija->query("SELECT * FROM predmet p join profesor pr on p.idProfesor = pr.idProfesor");

        $predmeti = [];
        while ($row = $resultSet->fetch_object()){
            $predmeti[] = $row;
        }

        return $predmeti;
    }

    public function vratiKolikoKojiProfesorPredmetaPredaje()
    {
        $resultSet = $this->konekcija->query("SELECT prof.ime,prof.prezime,count(p.idPredmet) as brojPredmeta FROM predmet p join profesor prof on p.idProfesor = prof.idProfesor  group by p.idProfesor");

        $predmeti = [];
        while ($row = $resultSet->fetch_object()){
            $predmeti[] = $row;
        }

        return $predmeti;
    }

    public function vratiSeminarske()
    {
        $resultSet = $this->konekcija->query("SELECT * FROM seminarski ");

        $sem = [];
        while ($row = $resultSet->fetch_object()){
            $sem[] = $row;
        }

        return $sem;
    }

    public function vratiKolikoStudenataImaSeminarskeZadatke()
    {
        $resultSet = $this->konekcija->query("SELECT s.ime,s.prezime,count(sem.idSeminarski) as brojseminarskih FROM student s join seminarski sem on s.idStudent = sem.idStudent  group by sem.idStudent");

        $predmeti = [];
        while ($row = $resultSet->fetch_object()){
            $predmeti[] = $row;
        }

        return $predmeti;
    }
}