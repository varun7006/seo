

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="bootstrap default admin template">
        <meta name="viewport" content="width=device-width">
        <title>Dashboard | Admin Template</title>
        <script src="wRMkwTFXgv2zoxOD9jejBCMelWw.js"></script>
        <link rel="shortcut icon" href="assets_backup/favicon/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="assets_backup/favicon/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets_backup/favicon/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets_backup/favicon/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets_backup/favicon/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets_backup/favicon/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets_backup/favicon/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets_backup/favicon/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets_backup/favicon/apple-touch-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="assets_backup/favicon/apple-touch-icon-180x180.png" />
        <link rel="stylesheet" href="assets_backup/global/plugins/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets_backup/icons_fonts/elegant_font/elegant.min.css" />
        <link id="site-color" rel="stylesheet" href="assets_backup/layouts/layout-left-icon-menu/css/color/light/color-default.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/switchery/dist/switchery.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/weather-icons/css/weather-icons.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/weather-icons/css/weather-icons-wind.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/rickshaw/rickshaw.min.css" />
        <link rel="stylesheet" href="assets_backup/global/css/components.min.css" />
        <link rel="stylesheet" href="assets_backup/layouts/layout-left-icon-menu/css/layout.min.css" />
        <link rel="stylesheet" href="assets_backup/global/plugins/FooTable/compiled/footable.bootstrap.min.css" />

        <link rel="stylesheet" href="assets/global/plugins/FooTable/compiled/footable.bootstrap.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/font-awesome/css/font-awesome.min.css" />

           <!--  <script src="scripts/angular.min.js"></script>
        <script src="scripts/angular-ui-router.min.js"></script> -->

        <script src="http://code.angularjs.org/1.2.13/angular.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script>


        <script src="scripts/app.js"></script>
        <script src="scripts/app.router.js"></script>

        <script src="scripts/app.main.js"></script>

        <script src="libs/angular/angular-resource/angular-resource.js"></script>
        <script src="libs/angular/ngstorage/ngStorage.js"></script>

        <script src="scripts/services/ngstore.js"></script>
        <script src="scripts/services/ui-load.js"></script>

        <style>
            #loading-block {
                position:fixed;
                top:0px;
                right:0px;
                bottom:0px;
                left:0px;
                background-color:#000000;
                background-image:url(images/loading.gif);
                background-position:center center;
                background-repeat:no-repeat;
                opacity:0.8;
                filter:alpha(opacity=80);
                z-index:50000;
            }
        </style>
    </head>
    <body  ng-app="app" ng-controller="AppCtrl">

        <div class="loader-overlay">
            <div class="loader-preview-area">
                <div class="spinners">
                    <div class="loader">
                        <div class="rotating-plane"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div ui-view></div>

        </div>

        <script src="scripts/controllers/login.js"></script>
        <script src="scripts/controllers/dashboard.js"></script>
        <script src="scripts/controllers/user.js"></script>
        <script src="scripts/controllers/sources.js"></script>
        <script src="scripts/controllers/linkreport.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/tether/dist/js/tether.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/screenfull.js/dist/screenfull.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/classie/classie.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/Flot/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot/jquery.flot.time.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot/jquery.flot.categories.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/arcseldon-jquery.sparkline/dist/jquery.sparkline.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/skycons/skycons.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/progressbar.js/dist/progressbar.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/gauge.js/dist/gauge.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/raphael/raphael.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/jquery-mapael/js/jquery.mapael.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/jquery-mapael/js/maps/france_departments.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/jquery-mapael/js/maps/world_countries.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/jquery-mapael/js/maps/usa_states.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/d3/d3.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/rickshaw/rickshaw.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/js/site.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/js/site-settings.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/js/global/dashboard_v4.min.js"></script>
        <script type="text/javascript" src="assets_backup/layouts/layout-left-icon-menu/js/layout.min.js"></script>

        <!--Js For Login Page-->

        <script type="text/javascript" src="assets_backup/global/plugins/moment/moment.js"></script>
        <script type="text/javascript" src="assets_backup/global/plugins/FooTable/compiled/footable.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-form-validator/form-validator/jquery.form-validator.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-mask-plugin/dist/jquery.mask.min.js"></script>


        <script type="text/javascript" src="assets_backup/global/js/site.min.js"></script>
        <script type="text/javascript" src="assets_backup/global/js/site-settings.min.js"></script>


        <script type="text/javascript" src="assets_backup/global/js/global/footable.min.js"></script>
        <script type="text/javascript" src="assets/global/js/global/form_validation.min.js"></script>

    </body>
</html>



