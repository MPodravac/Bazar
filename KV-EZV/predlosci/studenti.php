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
  	<button type="button" class="btn btn-info btn-md akcija-btn" data-toggle="modal" data-target=" #dodaj-studenta">
  		<i class="glyphicon glyphicon-user"></i>
  	</button>
  	<table class="table table-hover table-bordered table-striped">
  		<thead>
  			<th> Redni broj </th>
  			<th> Jmbag </th>
  			<th> Ime </th>
  			<th> Prezime </th>
  			<th> Smjer </th>
  			<th></th>
  		</thead>
  		<tbody>
  			<tr ng-repeat="student in studenti">
  				<td>{{$index+1}}.</td>
  				<td>{{student.jmbag}}</td>
  				<td>{{student.ime}}</td>
  				<td>{{student.prezime}}</td>
  				<td>{{student.smjer | uppercase}}</td>
  				<td><span class="glyphicon glyphicon-trash" ng-click="DeleteStudent(student)"></span></td>
  			</tr>
  		</tbody>
  	</table>
  </div>
</div>

<?php
include '../modals.php';
?>
