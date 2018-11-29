<?php

class Configuration
{
	public $host='localhost:3306';
	public $dbName='zavrsniradovi';
	public $username='root';
	public $password='';
}

class ZavrsniRad
{
	public $id_rada="";
	public $student=null;	
	public $id_predmeta=null;
	public $id_mentora=null;
	public $datum_obrane="";
	public $id_prijave=null;
	public $status=null;
	public $naslov_rada="";
	public $tekst_zadatka="";
	public $datum_urucenja_zad="";
	public $ocjena_rada="";
	public $id_povjerenstva=null;
	public $ocjena_obrane="";
	public $konacna_ocjena="";
	public $razlog_odbijanja="";
	public $actions=null;

	public function __construct($id_rada=null, $student=null, $id_predmeta=null, $id_mentora=null, $datum_obrane=null, $id_prijave=null, $status=null, $naslov_rada=null, $tekst_zadatka=null, $datum_urucenja_zad=null, $ocjena_rada=null, $id_povjerenstva=null, $ocjena_obrane=null, $konacna_ocjena=null, $razlog_odbijanja=null, $actions=null) 
	{
		if ($id_rada != null) $this->id_rada = $id_rada;
		if ($student != null) $this->student = $student;
		if ($id_predmeta != null) $this->id_predmeta = $id_predmeta;
		if ($id_mentora != null) $this->id_mentora = $id_mentora;
		if ($datum_obrane != null) $this->datum_obrane = $datum_obrane;
		if ($id_prijave != null) $this->id_prijave = $id_prijave;
		if ($status != null) $this->status = $status;
		if ($naslov_rada != null) $this->naslov_rada = $naslov_rada;
		if ($tekst_zadatka != null) $this->tekst_zadatka = $tekst_zadatka;
		if ($datum_urucenja_zad != null) $this->datum_urucenja_zad = $datum_urucenja_zad;
		if ($ocjena_rada != null) $this->ocjena_rada = $ocjena_rada;
		if ($id_povjerenstva != null) $this->id_povjerenstva = $id_povjerenstva;
		if ($ocjena_obrane != null) $this->ocjena_obrane = $ocjena_obrane;
		if ($konacna_ocjena != null) $this->konacna_ocjena = $konacna_ocjena;
		if ($razlog_odbijanja != null) $this->razlog_odbijanja = $razlog_odbijanja;
		if ($actions != null) $this->actions = $actions;
	}
}

class Prijava
{
	public $id_prijave="";
	public $datum_prijave="";
	public $id_studenta="";

	public function __construct($id_prijave=null, $datum_prijave=null, $id_studenta=null)
	{
		if ($id_prijave != null) $this->id_prijave = $id_prijave;
		if ($datum_prijave != null) $this->datum_prijave = $datum_prijave;
		if ($id_studenta != null) $this->id_studenta = $id_studenta;
	}
}

class Povjerenstvo
{
	public $id_povjerenstva="";
	public $predsjednik="";	//id_korisnika
	public $prvi_clan=""; 	//id_korisnika
	public $drugi_clan="";	//id_korisnika

	public function __construct($id_povjerenstva=null, $predsjednik=null, $prvi_clan=null, $drugi_clan=null)
	{
		if ($id_povjerenstva != null) $this->id_povjerenstva = $id_povjerenstva;
		if ($predsjednik != null) $this->predsjednik = $predsjednik;
		if ($prvi_clan != null) $this->prvi_clan = $prvi_clan;
		if ($drugi_clan != null) $this->drugi_clan = $drugi_clan;
	}
}

class Korisnik
{
	public $korisnik_id="";
	public $ime="";
	public $prezime="";
	public $uloga="";	//referada, nastavnik, student

	public function __construct($korisnik_id=null, $ime=null, $prezime=null, $uloga=null)
	{
		if ($korisnik_id != null) $this->korisnik_id = $korisnik_id;
		if ($ime != null) $this->ime = $ime;
		if ($prezime != null) $this->prezime = $prezime;
		if ($uloga != null) $this->uloga = $uloga;
	}
}


class Student extends Korisnik
{
	public $jmbag="";
	public $smjer="";
	public $status="";	//status studentskih obveza
	public $obrana="";	//ocjena obrane
	public $prosjek="";	//prosjek ocjena

	public function __construct($korisnik_id=null, $ime=null, $prezime=null, $jmbag=null, $smjer=null, $status=null, $obrana=null, $prosjek=null)
	{
		if ($korisnik_id != null) $this->korisnik_id = $korisnik_id;
		if ($ime != null) $this->ime = $ime;
		if ($prezime != null) $this->prezime = $prezime;
		if ($jmbag != null) $this->jmbag = $jmbag;
		if ($smjer != null) $this->smjer = $smjer;
		if ($status != null) $this->status = $status;
		if ($obrana != null) $this->obrana = $obrana;
		if ($prosjek != null) $this->prosjek = $prosjek;
	}
}

class Predmet
{
	public $id_predmeta="";
	public $naziv="";
	public $nastavnik="";	//id korisnika

	public function __construct($id_predmeta=null, $naziv=null, $nastavnik=null)
	{
		if ($id_predmeta != null) $this->id_predmeta = $id_predmeta;
		if ($naziv != null) $this->naziv = $naziv;
		if ($nastavnik != null) $this->nastavnik = $nastavnik;
	}
}

class Status
{
	public $status_id="";
	public $status_naziv="";

	public function __construct($status_id=null, $status_naziv=null)
	{
		if ($status_id != null) $this->status_id = $status_id;
		if ($status_naziv != null) $this->status_naziv = $status_naziv;
	}
}


?>