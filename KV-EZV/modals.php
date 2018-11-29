<div id="dodaj-zavrsni-rad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodaj završni rad</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Student</label>
            <div class="col-md-8 dropdown">
              <select ng-model="dodaj_rad.id_studenta">
                <option style="display:none" value="">--Odaberite studenta--</option>
                <option id="id_studenta" ng-repeat="student in studenti" value="{{student.korisnik_id}}">{{student.ime}} {{student.prezime}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Predmet</label>
            <div class="col-md-8 dropdown">
             <select ng-model="dodaj_rad.predmet">
                <option style="display:none" value="">--Odaberite predmet--</option>
                <option id="predmet" ng-repeat="predmet in predmeti" value="{{predmet.id_predmeta}}">{{predmet.naziv}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Mentor</label>
            <div class="col-md-8 dropdown">
              <select ng-model="dodaj_rad.id_mentora">
                <option style="display:none" value="">--Odaberite mentora--</option>
                <option id="id_mentora" ng-repeat="nastavnik in nastavnici" value="{{nastavnik.korisnik_id}}">{{nastavnik.ime}} {{nastavnik.prezime}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Datum obrane</label>
            <div class="col-md-8">
              <input id="datum_obrane" ng-model="dodaj_rad.datum_obrane" data-parsley-required="true" type="text" placeholder="Upisite datum obrane" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="SaveNewThesis()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="dodaj-studenta" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodaj studenta</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Ime</label>
            <div class="col-md-8">
              <input ng-model="studentIme" id="ime" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Prezime</label>
            <div class="col-md-8">
              <input ng-model="studentPrezime" id="prezime" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Jmbag</label>
            <div class="col-md-8">
              <input ng-model="studentJmbag" id="jmbag" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Smjer</label>
            <div class="col-md-8">
              <input ng-model="studentSmjer" id="smjer" data-parsley-required="true" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="SaveNewStudent()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="uredi-naslov-i-tekst" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Uredi naslov rada i tekst zadatka</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Naslov rada</label>
            <div class="col-md-8">
              <input id="inptNaslovRada" data-parsley-required="true" ng-model="urediRad.naslov" type="text" placeholder="" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Tekst zadatka</label>
            <div class="col-md-8">
              <textarea class="form-control" style="min-width: 100%" id="inptTekstZadatka" ng-model="urediRad.tekst" data-parsley-required="true" type="text"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="UrediNasloviTekst()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="prihvati_rad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prihvati rad</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Ocjena rada</label>
            <div class="col-md-8 dropdown">
              <select ng-model="prihvatiRad.ocjena">
                <option style="display:none" value="">--Odaberite ocjenu--</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="PrihvatiRad()" type="button" class="btn btn-primary" data-dismiss="modal">Prihvati</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="odbij_rad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Odbij rad</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Razlog (opcionalno)</label>
            <div class="col-md-8">
              <input id="inptRazlog" data-parsley-required="true" ng-model="odbijRad.razlog" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="OdbijRad()" type="button" class="btn btn-primary" data-dismiss="modal">Odbij</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="obrana_zavrsena" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rad je obranjen</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Ocjena obrane</label>
            <div class="col-md-8 dropdown">
              <select ng-model="radZavrsen.ocjenaobrane">
                <option style="display:none" value="">--Odaberite ocjenu--</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Konačna ocjena</label>
            <div class="col-md-8">
              <input id="inptKonacnaOcjena" data-parsley-required="true" ng-model="radZavrsen.konacna" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="RadObranjen()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>

<div id="rad_odbijen" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rad je odbijen</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Razlog </label>
            <div class="col-md-8">
              <input id="textRazlog" data-parsley-required="true" ng-model="radOdbijen.razlog" type="text" placeholder="" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
      </div>
    </div>
  </div>
</div>


<div id="dodijeli_povjerenstvo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Povjerenstvo</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Predsjednik</label>
            <div class="col-md-8 dropdown">
              <select ng-model="povjerenstvo.predsjednik">
                <option style="display:none" value="">--Odaberite predsjednika--</option>
                <option ng-repeat="nastavnik in nastavnici" value="{{nastavnik.korisnik_id}}">{{nastavnik.ime}} {{nastavnik.prezime}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Prvi član</label>
            <div class="col-md-8 dropdown">
              <select ng-model="povjerenstvo.prvi_clan">
                <option style="display:none" value="">--Odaberite prvog člana--</option>
                <option ng-repeat="nastavnik in nastavnici" value="{{nastavnik.korisnik_id}}">{{nastavnik.ime}} {{nastavnik.prezime}}</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3">Drugi član</label>
            <div class="col-md-8 dropdown">
              <select ng-model="povjerenstvo.drugi_clan">
                <option style="display:none" value="">--Odaberite drugog člana--</option>
                <option ng-repeat="nastavnik in nastavnici" value="{{nastavnik.korisnik_id}}">{{nastavnik.ime}} {{nastavnik.prezime}}</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button ng-click="DodijeliPovjerenstvo()" type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
      </div>
    </div>
  </div>
</div>
