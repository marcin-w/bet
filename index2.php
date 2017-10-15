<!doctype html>
<html ng-app="authApp">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title></title>
    <link href="css/toaster.css" rel="stylesheet"/>
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.css" rel="stylesheet"/>
    <script src="app/lib/angular/angular.js"></script>
    <script src="app/lib/toaster/toaster.js"></script>
    <script src="app/services/betService.js"></script>
    <script src="app/app.js"></script>
    <script src="app/controllers/bet.js"></script>
    <script src="app/filters/bet.js"></script>
    <script src="app/lib/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="app/lib/node_modules/satellizer/satellizer.js"></script>
    <script src="laravel/public/scripts/app.js"></script>
    <script src="laravel/public/scripts/authController.js"></script>
    <script src="laravel/public/scripts/betController.js"></script>
</head>
<body ng-app="authApp">

<div class="container">
    <div ui-view>


    </div>
</div>

</body>

</html>