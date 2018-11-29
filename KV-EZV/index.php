<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" ng-app="oModul">
<head>
	<meta charset="UTF-8">
	<title>Evidencija zavrsnih radova</title>
	<script src="assets/plugins/angularjs/angular.min.js"></script>
    <script src="assets/plugins/angularjs/angular-route.min.js"></script>
    <script src="assets/plugins/AngularJS/angular-cookies.min.js"></script>
    <script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="assets/plugins/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container-fluid">
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=	#main-navbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>				  
					</div>
				</div>
			</nav>
		</header>
		<div ng-view>
		</div>
	</div>
	<script src="assets/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</body>
</html>