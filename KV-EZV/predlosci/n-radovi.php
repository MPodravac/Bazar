<div class="container-fluid">
  <header>
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target= #main-navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="logo pull-left">
            <img onclick="alert('Author: Mateja Podravac, VŠMTI, 2018.')" src="img/bazar.png">
          </div>
          <div class="collapse navbar-collapse" id="main-navbar">
            <button class="btn btn-alert pull-right" ng-click="Odjava()"><i class="glyphicon glyphicon-log-out"></i> Odjava</button>
          </div>
        </div>
      </nav>
    </header>
  </div>


<div class="main">
	<div class="container">
		<table ng-hide="{{radovi.length==0}}" id="nastavniciTablica" class="table table-hover table-bordered table-striped">
			<thead>
        <th> Rbr </th>
				<th> Student </th>
				<th> Predmet </th>
				<th> Datum obrane </th>
				<th> Datum prijave </th>
				<th> Status </th>
				<th> Naslov </th>
				<th> Tekst zadatka </th>
				<th> Ocjena rada </th>
				<th>  </th>
			</thead>
			<tbody>
				<tr ng-repeat="rad in radovi" value="{{rad.id_rada}}">
          			<td>{{$index+1}}.</td>
					<td>{{rad.student.ime}} {{rad.student.prezime}}</td>
					<td>{{rad.id_predmeta.naziv}}</td>
					<td>{{rad.datum_obrane}}</td>
					<td>{{rad.id_prijave.datum_prijave}}</td>
					<td>{{rad.status.status_naziv}}</td>
					<td>{{rad.naslov_rada}}</td>
					<td>{{rad.tekst_zadatka}}</td>
					<td>{{rad.ocjena_rada}}</td>
					<td><span ng-repeat="action in rad.actions" class="glyphicon glyphicon-{{action.img}}" ng-click="ZavrsniRadActionModal(action.action_id, rad)"></span></td>
				</tr>
			</tbody>
		</table>
		<nema-radova></nema-radova>

	</div>
</div>

<?php
include '../modals.php';
?>
