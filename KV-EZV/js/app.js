var oModul=angular.module('oModul', ['ngRoute', 'ngCookies']);

oModul.config(function($routeProvider){
	$routeProvider.when('/', {
		templateUrl: 'predlosci/login.php',
		controller: 'glavniKontroler'
	});
	$routeProvider.when('/radovi', {
		templateUrl: 'predlosci/zavrsniradovi.php',
		controller: 'thesisKontroler'
	});
	$routeProvider.when('/studenti', {
		templateUrl: 'predlosci/studenti.php',
		controller: 'thesisKontroler'
	});
	$routeProvider.when('/nastavnici', {
		templateUrl: 'predlosci/nastavnici.php',
		controller: 'thesisKontroler'
	});
	$routeProvider.when('/n-radovi', {
		templateUrl: 'predlosci/n-radovi.php',
		controller: 'thesisKontroler'
	});
	$routeProvider.when('/s-radovi', {
		templateUrl: 'predlosci/s-radovi.php',
		controller: 'thesisKontroler'
	});
	$routeProvider.otherwise({
		template:'Pogreška'
	});
});

oModul.directive('nemaRadova', function()
{
	return{
		template: '<h1 ng-show="{{radovi.length==0}}">Nema radova</h1>'
	};
});


oModul.controller('glavniKontroler', function($scope, $http, $location/*, Authentication*/){
	$scope.ulogiran = false;


	$scope.Prijava=function()
	{
		var oData = {
			'action_id': 'login',
			'user_name': $scope.user,
			'password': $scope.pass
		};

	    $http.post('action.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	if( response.data.login_flag == 1 )
		    	{
		    		$scope.ulogiran = true;
		    		if( response.data.uloga == 1 )
		    		{
		    			$location.path('/radovi');
		    		}
		    		else if( response.data.uloga == 2 )
		    		{
		    			$location.path('/n-radovi');
		    		}
		    		else if( response.data.uloga == 3 )
		    		{
		    			$location.path('/s-radovi');
		    		}
		    	}
		    	else
		    	{
		    		alert('Netočni podaci. Pokušajte ponovno');
		    	}
		        console.log(response);
		    },
		    function (e) 
		    {
		    	console.log('error');
		 	}
		);
	};	
});

oModul.controller('thesisKontroler', function($scope, $http, $location){
	$scope.radovi=[];
	$scope.studenti=[];
	$scope.nastavnici=[];
	$scope.predmeti=[];

	$scope.DohvatiZavrsneRadove=function()
	{
		$http({
			method : "GET",
 			url: "json.php?json_id=dohvati_zavrsne_radove"
 			}).then(function(response) {
 				console.log(response);
 				$scope.radovi = response.data;
 			},function (response) {
 				console.log('Došlo je do pogreške');
 		});
 	}
 	$scope.DohvatiStudente=function()
 	{
	 	$http({
			method : "GET",
	 		url: "json.php?json_id=dohvati_studente"
	 		}).then(function(response) {
	 			console.log(response);
	 			$scope.studenti = response.data;
	 		},function (response) {
	 			console.log('Došlo je do pogreške');
	 	});
 	}
 	$scope.DohvatiNastavnike=function()
 	{
	 	$http({
			method : "GET",
	 		url: "json.php?json_id=dohvati_nastavnike"
	 		}).then(function(response) {
	 			console.log(response);
	 			$scope.nastavnici = response.data;
	 		},function (response) {
	 			console.log('Došlo je do pogreške');
	 	});
 	}
 	$scope.DohvatiPredmete=function()
 	{
	 	$http({
			method : "GET",
	 		url: "json.php?json_id=dohvati_predmete"
	 		}).then(function(response) {
	 			console.log(response);
	 			$scope.predmeti = response.data;
	 		},function (response) {
	 			console.log('Došlo je do pogreške');
	 	});	
 	}
 	$scope.PokreniAplikaciju=function()
	{
		$scope.DohvatiZavrsneRadove();
		$scope.DohvatiStudente();
		$scope.DohvatiNastavnike();
		$scope.DohvatiPredmete();
	}
	$scope.PokreniAplikaciju();

 	$scope.Odjava=function()
	{
		var oData = {
			'action_id': 'logout'
		};
		$http.post('action.php', oData)
		    .then
		    (
		    	function (response) 
		    	{
		    		$scope.ulogiran = false;
		    		//Authentication.Logout();
		    		$location.path('/');
			    },
			    function (e) 
			    {
			    	console.log('error');
			 	}
		);
	}

 	$scope.SaveNewThesis=function()
	{
		console.log($scope.dodaj_rad);
		$scope.dodaj_rad.action_id="add_new_thesis";

			$http.post('action.php', $scope.dodaj_rad)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		alert('Uspješno ste dodali rad');
				    	$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.SaveNewStudent=function()
	{
		var oData = {
				'action_id': 'add_new_student',
				'ime': $scope.studentIme,
				'prezime': $scope.studentPrezime,
				'jmbag' : $scope.studentJmbag,
				'smjer' : $scope.studentSmjer
			};
			$http.post('action.php', oData)
			    .then
			    (
			    	function (response) 
			    	{
			    		alert('Uspješno ste dodali studenta');
			    		$scope.DohvatiStudente();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.SaveNewTeacher=function()
	{
		var oData = {
				'action_id': 'add_new_teacher',
				'ime': $scope.nastavnikIme,
				'prezime': $scope.nastavnikPrezime
			};
			$http.post('action.php', oData)
			    .then
			    (
			    	function (response) 
			    	{
			    		alert('Uspješno ste dodali nastavnika');
			    		$scope.DohvatiNastavnike();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.obrisiRad={};
	$scope.DeleteThesis=function(oRad)
	{
		$scope.obrisiRad.action_id="delete_thesis";
		$scope.obrisiRad.id_rada=oRad.id_rada;
		$http.post('action.php', $scope.obrisiRad)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.obrisiNastavnika={};
	$scope.DeleteTeacher=function(oNastavnik)
	{
		$scope.obrisiNastavnika.action_id="delete_teacher";
		$scope.obrisiNastavnika.id_korisnika=oNastavnik.korisnik_id;
		$http.post('action.php', $scope.obrisiNastavnika)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiNastavnike();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.obrisiStudenta={};
	$scope.DeleteStudent=function(oStudent)
	{
		$scope.obrisiStudenta.action_id="delete_student";
		$scope.obrisiStudenta.id_korisnika=oStudent.korisnik_id;
		$http.post('action.php', $scope.obrisiStudenta)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiStudente();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}

	$scope.urediRad={};
	$scope.prihvatiRad={};
	$scope.odbijRad={};
	$scope.radZavrsen={};
	$scope.radOdbijen={};
	$scope.povjerenstvo={}; 

	$scope.ZavrsniRadActionModal=function(action_id, oRad, oStudent, oPovjerenstvo)
	{
		console.log(oRad);
		switch(action_id)
		{
			case '1':
				$sActionId='uredi_zadatak';		           
				$scope.urediRad.naslov=oRad.naslov_rada;
				$scope.urediRad.tekst=oRad.tekst_zadatka;
				$scope.urediRad.id_rada=oRad.id_rada;
				$('#uredi-naslov-i-tekst').modal('show');
			break;
			case '2':
				$sActionId='prihvati_rad';
				$scope.prihvatiRad.ocjena=oRad.ocjena_rada;
				$scope.prihvatiRad.id_rada=oRad.id_rada;
				$('#prihvati_rad').modal('show');
			break;
			case '3':
				$sActionId='odbij_rad';
				$scope.odbijRad.razlog=oRad.razlog_odbijanja;
				$scope.odbijRad.id_rada=oRad.id_rada;
				$('#odbij_rad').modal('show');
			break;
			case '4':
				$sActionId='dodijeli_povjerenstvo';
				$scope.povjerenstvo.predsjednik=oPovjerenstvo.predsjednik;
				$scope.povjerenstvo.prvi_clan=oPovjerenstvo.prvi_clan;
				$scope.povjerenstvo.drugi_clan=oPovjerenstvo.drugi_clan;
				$scope.povjerenstvo.id_rada=oRad.id_rada;
				$('#dodijeli_povjerenstvo').modal('show');
			break;
			case '6':
				$sActionId = 'obrana_zavrsena';
				$scope.radZavrsen.ocjenaobrane=oRad.ocjena_obrane;
				$scope.radZavrsen.konacna=oRad.konacna_ocjena;
				$scope.radZavrsen.id_rada=oRad.id_rada;
				$('#obrana_zavrsena').modal('show')
			break;
			case '5':
			case '7':
			case '8':
				$sActionId = 'rad_odbijen';
				$scope.radOdbijen.razlog=oRad.razlog_odbijanja;
				$scope.radOdbijen.id_rada=oRad.id_rada;
				$('#rad_odbijen').modal('show')
			break;
		}
	}
	$scope.UrediNasloviTekst=function()
	{
		$scope.urediRad.action_id="uredi_zadatak";
		$http.post('action.php', $scope.urediRad)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.PrihvatiRad=function()
	{
		$scope.prihvatiRad.action_id="prihvati_rad";
		$http.post('action.php', $scope.prihvatiRad)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.OdbijRad=function()
	{
		$scope.odbijRad.action_id="odbij_rad";
		$http.post('action.php', $scope.odbijRad)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.DodijeliPovjerenstvo=function()
	{
		$scope.povjerenstvo.action_id="dodijeli_povjerenstvo";
		$http.post('action.php', $scope.povjerenstvo)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
	$scope.RadObranjen=function()
	{
		console.log($scope.radZavrsen);
		$scope.radZavrsen.action_id="obrana_zavrsena";
		$http.post('action.php', $scope.radZavrsen)
			    .then
			    (
			    	function (response) 
			    	{
			    		console.log(response);
			    		$scope.DohvatiZavrsneRadove();
				    },
				    function (e) 
				    {
				    	console.log('error');
				 	}
				);
	}
});
