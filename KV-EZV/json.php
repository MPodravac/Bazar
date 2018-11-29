<?php

ini_set('memory_limit', '2048M');
header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');
include 'connection.php';

session_start();

$sJsonID="";
if(isset($_GET['json_id']))
{
	$sJsonID=$_GET['json_id'];
}

$oJson=array();

switch($sJsonID)
{
	case 'dohvati_zavrsne_radove':

		$sWhere="";
		$sUloga=$_SESSION['uloga'];

		if($sUloga==3)
		{
			$sWhere="WHERE student=".$_SESSION['id_korisnika'];
		}
		else if($sUloga==2)
		{
			$sWhere="WHERE id_mentora=".$_SESSION['id_korisnika'];
		}

		$sQuery = "SELECT 
						t1.id_rada,
						t1.student,
    					t2.ime as 'ime_studenta',
    					t2.prezime as 'prezime_studenta',
    					t1.id_predmeta,
    					t3.naziv,
    					t1.id_mentora,
    					t4.ime,
    					t4.prezime,
    					t1.datum_obrane,
    					t1.id_prijave,
    					t5.datum_prijave,
    					t1.status,
    					t6.status_naziv,
    					t1.naslov_rada,
    					t1.tekst_zadatka,
    					t1.dat_urucenja_zad,
    					t1.ocjena_rada,
    					t1.id_povjerenstva,
    					t7.predsjednik,
                        t7.prvi_clan,
                        t7.drugi_clan,
    					t1.ocjena_obrane,
    					t1.konacna_ocjena,
    					t1.razlog_odbijanja
					FROM zavrsniradovi t1
					LEFT JOIN korisnici t2
					ON t1.student=t2.id_korisnika
					LEFT JOIN korisnici t4
					ON t1.id_mentora=t4.id_korisnika
					LEFT JOIN predmeti t3
					ON t1.id_predmeta=t3.id_predmeta
					LEFT JOIN prijave t5
					ON t1.id_prijave=t5.id_prijave 
					LEFT JOIN statusi t6
					ON t1.status=t6.status_id 
					LEFT JOIN povjerenstva t7
                    ON t1.id_povjerenstva=t7.id_povjerenstva ".$sWhere." ORDER BY t1.id_rada ASC"; 
		$oRecord = $oConnection->query($sQuery); 

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
		{
			$sActionQuery = "SELECT * FROM actions WHERE status=".$oRow['status']." AND uloga=".$sUloga."";
			$oActionRecord = $oConnection->query($sActionQuery); 
			$oActionArray = array();
			while($oActionRow = $oActionRecord->fetch(PDO::FETCH_BOTH)) 
			{
				$oAction['action_id'] = $oActionRow['action_id'];
				$oAction['status'] = $oActionRow['status'];
				$oAction['uloga'] = $oActionRow['uloga'];
				$oAction['img'] = $oActionRow['img'];
				array_push($oActionArray, $oAction);
			}
			$oStudent = new Korisnik(
				$oRow['student'],
				$oRow['ime_studenta'],
				$oRow['prezime_studenta']
			);
			$oSubject = new Predmet(
				$oRow['id_predmeta'],
				$oRow['naziv']
			);
			$oTeacher = new Korisnik(
				$oRow['id_mentora'],
				$oRow['ime'],
				$oRow['prezime']
			);
			$oApplication = new Prijava(
				$oRow['id_prijave'],
				$oRow['datum_prijave']
			);
			$oStatus = new Status(
				$oRow['status'],
				$oRow['status_naziv']
			);
			$oPovjerenstvo = new Povjerenstvo(
				$oRow['id_povjerenstva'],
				$oRow['predsjednik'],
				$oRow['prvi_clan'],
				$oRow['drugi_clan']
			);
			$oZavrsniRadovi = new ZavrsniRad(
				$oRow['id_rada'],
				$oStudent,
				$oSubject,
				$oTeacher,
				$oRow['datum_obrane'],
				$oApplication,
				$oStatus,
				$oRow['naslov_rada'],
				$oRow['tekst_zadatka'],
				$oRow['dat_urucenja_zad'],
				$oRow['ocjena_rada'],
				$oPovjerenstvo,
				$oRow['ocjena_obrane'],
				$oRow['konacna_ocjena'],
				$oRow['razlog_odbijanja'],
				$oActionArray
			);
			array_push($oJson, $oZavrsniRadovi);
		}
	break;
	case 'dohvati_sve_korisnike':
		$sQuery = "SELECT * FROM korisnici"; 
		$oRecord = $oConnection->query($sQuery); 

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
			{
				$oKorisnici=new Korisnik(
					$oRow['id_korisnika'],
					$oRow['ime'],
					$oRow['prezime'],
					$oRow['uloga']
				);
				array_push($oJson, $oKorisnici);
			}
	break;
	case 'dohvati_studente':
		$sQuery = "	SELECT 
						s.student_id,
						s.jmbag,
						k.ime,
						k.prezime,
						s.smjer,
						s.status,
						s.obrana,
						s.prosjek
					FROM studenti s 
					LEFT JOIN korisnici k ON k.id_korisnika = s.student_id
					WHERE k.uloga=3
					"; 
		$oRecord = $oConnection->query($sQuery); 

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
			{
				$oStudenti=new Student(
					$oRow['student_id'],
					$oRow['ime'],
					$oRow['prezime'],
					$oRow['jmbag'],
					$oRow['smjer'],
					$oRow['status'],
					$oRow['obrana'],
					$oRow['prosjek']
				);
				array_push($oJson, $oStudenti);
			}
	break;
	case 'dohvati_predmete':
		$sQuery = "SELECT * FROM predmeti"; 
		$oRecord = $oConnection->query($sQuery); 

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
			{
				$oPredmeti=new Predmet(
					$oRow['id_predmeta'],
					$oRow['naziv'],
					$oRow['id_nastavnika']
				);
				array_push($oJson, $oPredmeti);
			}
	break;
	case 'dohvati_nastavnike': 
		$sQuery = "SELECT * FROM korisnici WHERE uloga=2"; 
		$oRecord = $oConnection->query($sQuery); 

		while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
			{
				$oNastavnici=new Korisnik(
					$oRow['id_korisnika'],
					$oRow['ime'],
					$oRow['prezime'],
					$oRow['uloga']
				);
				array_push($oJson, $oNastavnici);
			}
	break;
	case 'dohvati_prijave': 
	$sQuery = "SELECT * FROM prijave"; 
	$oRecord = $oConnection->query($sQuery); 
	while($oRow = $oRecord->fetch(PDO::FETCH_BOTH)) 
		{
			$oPrijave=new Prijava(
				$oRow['id_prijave'],
				$oRow['datum'],
				$oRow['id_studenta']
			);
			array_push($oJson, $oPrijave);
		}
	break;
}
echo json_encode($oJson);




?>