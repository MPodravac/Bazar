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
            <ul class="nav navbar-nav">
              <li><a href="#!/radovi">Administracija završnih radova</a></li>
              <li><a href="#!/studenti">Administracija studenata</a></li>
              <li><a href="#!/nastavnici">Administracija nastavnika</a></li>
            </ul>
            <button class="btn btn-alert pull-right" ng-click="Odjava()"><i class="glyphicon glyphicon-log-out"></i> Odjava</button>
          </div>
        </div>
      </nav>
    </header>
  </div>

<div class="main">
  <div class="container">
    <button type="button" class="btn btn-info btn-md akcija-btn" data-toggle="modal" data-target=" #dodaj-zavrsni-rad">
      <i class="glyphicon glyphicon-plus"></i>
    </button>
    <input style="float: right; margin-top: 7px" type="text" ng-model="inputTekst" /> <br/>
    <table class="table table-hover table-bordered table-striped">
      <thead>
        <th> Rbr </th>
        <th> Student </th>
        <th> Mentor </th>
        <th> Predmet </th>
        <th> Datum obrane </th>
        <th> Datum prijave </th>
        <th> Status </th>
        <th> Naslov rada </th>
        <th> Tekst zadataka </th>
        <th> Ocjena rada </th>
        <th> Povjerenstvo </th>
        <th> Ocjena obrane </th>
        <th> Konačna ocjena </th>
        <th> </th>
        <th> </th>
      </thead>
      <tbody>
        <tr ng-repeat="rad in radovi | filter:inputTekst">
          <td>{{$index+1}}.</td>
          <td>{{rad.student.ime}} {{rad.student.prezime}}</td>
          <td>{{rad.id_mentora.ime}} {{rad.id_mentora.prezime}}</td> 
          <td>{{rad.id_predmeta.naziv}}</td>
          <td>{{rad.datum_obrane}}</td>
          <td>{{rad.id_prijave.datum_prijave}}</td>
          <td>{{rad.status.status_naziv}}</td>
          <td>{{rad.naslov_rada}}</td>
          <td>{{rad.tekst_zadatka}}</td>
          <td>{{rad.ocjena_rada}}</td>
          <td>{{rad.id_povjerenstva.id_povjerenstva}}</td>
          <td>{{rad.ocjena_obrane}}</td>
          <td>{{rad.konacna_ocjena}}</td>
          <td><span ng-repeat="action in rad.actions" class="glyphicon glyphicon-{{action.img}}" ng-click="ZavrsniRadActionModal(action.action_id, rad, student, povjerenstvo)"></span></td>
          <td><span class="glyphicon glyphicon-trash" ng-click="DeleteThesis(rad)"></span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php 
  include '../modals.php';
?>

