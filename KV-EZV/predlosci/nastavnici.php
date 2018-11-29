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
    <button type="button" class="btn btn-info btn-md akcija-btn" data-toggle="modal" data-target=" #dodaj-nastavnika">
      <i class="glyphicon glyphicon-user"></i>
    </button>
    <table class="table table-hover table-bordered table-striped">
      <thead>
        <th> Redni broj </th>
        <th> Ime </th>
        <th> Prezime </th>
        <th></th>
      </thead>
      <tbody>
        <tr ng-repeat="nastavnik in nastavnici">
          <td>{{$index+1}}.</td>
          <td>{{nastavnik.ime}}</td>
          <td>{{nastavnik.prezime}}</td>
          <td><span class="glyphicon glyphicon-trash" ng-click="DeleteTeacher(nastavnik)"></span></td></span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div id="dodaj-nastavnika" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodaj nastavnika</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Ime</label>
            <div class="col-md-8">
              <input ng-model="nastavnikIme" id="ime" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Prezime</label>
            <div class="col-md-8">
              <input ng-model="nastavnikPrezime" id="prezime" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="SaveNewTeacher()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>

  </div>
</div>

<?php
include '../modals.php';
?>

