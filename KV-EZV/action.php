<?php
include 'connection.php';

session_start();

$sPostData = file_get_contents("php://input");
$oPostData = json_decode($sPostData);

$sAction = $oPostData->action_id;

switch($sAction)
{
	case 'login':
		$sUserName = $oPostData->user_name;
		$sPassword = $oPostData->password;

		$query="SELECT * FROM korisnici WHERE username= '".$sUserName."' AND password= '".$sPassword."' ";
		$oRecord=$oConnection->query($query);
		$oExportData = array();

		
		$count = $oRecord->rowCount();
		$row = $oRecord->fetch();

		$oExportData = array();
		if($count>0)
		{
			$oExportData['login_flag'] = 1;
			$oExportData['name'] = $row['username'];
			$oExportData['pass'] = $row['password'];
			$oExportData['uloga'] = $row['uloga'];
			$oExportData['id_korisnika'] = $row['id_korisnika'];
			$oExportData['ime'] = $row['ime'];
			$oExportData['prezime'] = $row['prezime'];
			$_SESSION['uloga']=$oExportData['uloga'];
			$_SESSION['id_korisnika']=$oExportData['id_korisnika'];
			$_SESSION['ime']=$oExportData['ime'];
			$_SESSION['prezime']=$oExportData['prezime'];

		}
		else
		{
			$oExportData['login_flag'] = 0;
		}
		
		echo json_encode($oExportData);

	break;

	case 'logout':
		session_destroy();
	break;


	case 'add_new_thesis': 
		$nIdStudenta = $oPostData->id_studenta;
		$nIdPredmeta = $oPostData->predmet;
		$nIdMentora = $oPostData->id_mentora;
		$dDatumObrane = $oPostData->datum_obrane;

		$sQuery = "INSERT INTO prijave (datum_prijave, id_studenta) VALUES (:datum_prijave, :id_studenta)";
		$oStatement = $oConnection->prepare($sQuery);

		$oData = array(
			'datum_prijave'=> date("Y-m-d"),
			'id_studenta'=> $nIdStudenta
		);
		try
		{
			$oStatement=$oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			$nLastIdPrijave = $oConnection->lastInsertId();

			$sNewQuery = "INSERT INTO zavrsniradovi (student, id_predmeta, id_mentora, datum_obrane, id_prijave, status) VALUES (:student, :id_predmeta, :id_mentora, :datum_obrane, :id_prijave, :status)"; 
			$oNewStatement = $oConnection->prepare($sNewQuery);
			$oNewData = array( 
				'student' => $nIdStudenta, 
				'id_predmeta' => $nIdPredmeta,
				'id_mentora' => $nIdMentora, 
				'datum_obrane' => $dDatumObrane,
				'id_prijave' => $nLastIdPrijave,
				'status' => 1
			);
			try
			{
				$oNewStatement = $oConnection->prepare($sNewQuery);
				$oNewStatement->execute($oNewData);
			}
			catch(PDOException $error)
			{
				echo $error;
			}
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'add_new_student':
		$sIme = $oPostData->ime;
		$sPrezime = $oPostData->prezime;
		$nJmbag = $oPostData->jmbag;
		$sSmjer = $oPostData->smjer;

		$sQuery = "INSERT INTO korisnici (ime, prezime, uloga, username, password) VALUES (:ime, :prezime, :uloga, :username, :password)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'ime' => $sIme,
			'prezime' => $sPrezime,
			'uloga' => 3,
			'username' => $sIme,
			'password' => $sIme
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			$nNewKorisnikID = $oConnection->lastInsertId();

			$sNewQuery = "INSERT INTO studenti (student_id, jmbag, smjer) VALUES (:student_id, :jmbag, :smjer)";
			$oNewStatement = $oConnection->prepare($sNewQuery);
			$oNewData = array( 
				'student_id' => $nNewKorisnikID,
				'jmbag' => $nJmbag,
				'smjer' => $sSmjer
			);
			try
			{
				$oNewStatement = $oConnection->prepare($sNewQuery);
				$oNewStatement->execute($oNewData);
			}
			catch(PDOException $error)
			{
				echo $error;
			}
		}
		catch(PDOException $error)
		{
			echo $error;
		}	
	break;
	case 'add_new_teacher':
		$sIme = $oPostData->ime;
		$sPrezime = $oPostData->prezime;

		$sQuery = "INSERT INTO korisnici (ime, prezime, uloga, username, password) VALUES (:ime, :prezime, :uloga, :username, :password)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'ime' => $sIme,
			'prezime' => $sPrezime,
			'uloga' => 2,
			'username' => $sIme,
			'password' => $sIme
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'delete_thesis':
		$nIdRada = $oPostData->id_rada;

		$sQuery = "DELETE FROM zavrsniradovi WHERE id_rada=:id_rada";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'id_rada' => $nIdRada
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'delete_student':
		$nIdKorisnika = $oPostData->id_korisnika;
		$sQuery = "DELETE FROM korisnici WHERE id_korisnika=:id_korisnika";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'id_korisnika' => $nIdKorisnika,
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
		case 'delete_teacher':
		$nIdKorisnika = $oPostData->id_korisnika;
		$sQuery = "DELETE FROM korisnici WHERE id_korisnika=:id_korisnika";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array(
			'id_korisnika' => $nIdKorisnika,
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'uredi_zadatak':
		echo $sNaslov = $oPostData->naslov;
		echo $sZadatak = $oPostData->tekst;
		echo $nIdRada = $oPostData->id_rada;

		$sQuery = "UPDATE zavrsniradovi set naslov_rada=:naslov_rada, tekst_zadatka=:tekst_zadatka, dat_urucenja_zad=:dat_urucenja_zad, status=:status WHERE id_rada=".$nIdRada."";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'naslov_rada' => $sNaslov,
			'tekst_zadatka' => $sZadatak,
			'dat_urucenja_zad' => date("Y-m-d"),
			'status' => 2
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'prihvati_rad':
		$nIdRada = $oPostData->id_rada;
		$nOcjenaRada= $oPostData->ocjena;

		$sQuery = "UPDATE zavrsniradovi set status=:status, ocjena_rada=:ocjena_rada WHERE id_rada=".$nIdRada."";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'status' => 3,
			'ocjena_rada' => $nOcjenaRada
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}

	break;
	case 'odbij_rad':
		$nIdRada = $oPostData->id_rada;
		$sRazlog = $oPostData->razlog;

		$sQuery = "UPDATE zavrsniradovi set status=:status, razlog_odbijanja=:razlog_odbijanja WHERE id_rada=".$nIdRada."";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'status' => 4,
			'razlog_odbijanja' => $sRazlog
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'dodijeli_povjerenstvo':
		$nIdRada = $oPostData->id_rada;
		$sPredsjednik = $oPostData->predsjednik;
		$sPrviClan = $oPostData->prvi_clan;
		$sDrugiClan = $oPostData->drugi_clan;

		$sQuery = "INSERT INTO povjerenstva (predsjednik, prvi_clan, drugi_clan) VALUES (:predsjednik, :prvi_clan, :drugi_clan)";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'predsjednik' => $sPredsjednik,
			'prvi_clan' => $sPrviClan,
			'drugi_clan' => $sDrugiClan
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
			$nLastIdPovjerenstva = $oConnection->lastInsertId();

			$sNewQuery = "UPDATE zavrsniradovi set id_povjerenstva=:id_povjerenstva, status=:status WHERE id_rada=".$nIdRada."";
			$oNewStatement = $oConnection->prepare($sNewQuery);
			$oNewData = array( 
				'id_povjerenstva' => $nLastIdPovjerenstva,
				'status' => 5
			);
			try
			{
				$oNewStatement = $oConnection->prepare($sNewQuery);
				$oNewStatement->execute($oNewData);
			}
			catch(PDOException $error)
			{
				echo $error;
			}
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	case 'obrana_zavrsena':
		$ocjenaObrane = $oPostData->ocjenaobrane;
		$konacnaOcjena = $oPostData->konacna;
		$nIdRada = $oPostData->id_rada;

		$sQuery = "UPDATE zavrsniradovi set ocjena_obrane=:ocjena_obrane, konacna_ocjena=:konacna_ocjena, status=:status WHERE id_rada=".$nIdRada."";
		$oStatement = $oConnection->prepare($sQuery);
		$oData = array( 
			'ocjena_obrane' => $ocjenaObrane,
			'konacna_ocjena' => $konacnaOcjena,
			'status' => 6
		);
		try
		{
			$oStatement = $oConnection->prepare($sQuery);
			$oStatement->execute($oData);
		}
		catch(PDOException $error)
		{
			echo $error;
		}
	break;
	
}


?>