<div id="login-str">
	<h3>Prijavite se kako bi pristupili sadržaju</h3><br>
	<form>
		<div class="form-group">
			<label>Korisničko ime </label><br>
			<input type="text" ng-model="user">
		</div>
		<div class="form-group">
			<label>Lozinka</label><br>
			<input type="password" ng-model="pass">
		</div>
		<div class="login-buttons">
			<button type="submit" class="btn btn-info" ng-click="Prijava()"><i class="glyphicon glyphicon-log-in"></i> Prijava</button>
		</div>
	</form>
</div>