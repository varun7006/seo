

<!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="AppCtrl">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="bootstrap default admin template">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <title>Dashboard | Admin Template</title>
        <script src="wRMkwTFXgv2zoxOD9jejBCMelWw.js"></script>
        <link rel="shortcut icon" href="assets/favicon/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="assets/favicon/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-touch-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon-180x180.png" />
        <link rel="stylesheet" href="assets/global/plugins/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/icons_fonts/elegant_font/elegant.min.css" />
        <link id="site-color" rel="stylesheet" href="assets/layouts/layout-left-icon-menu/css/color/light/color-default.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/switchery/dist/switchery.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/weather-icons/css/weather-icons.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/weather-icons/css/weather-icons-wind.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/rickshaw/rickshaw.min.css" />
        <link rel="stylesheet" href="assets/global/css/components.min.css" />
        <link rel="stylesheet" href="assets/layouts/layout-left-icon-menu/css/layout.min.css" />


        <link rel="stylesheet" href="assets/global/plugins/FooTable/compiled/footable.bootstrap.min.css" />
        <link rel="stylesheet" href="assets/global/plugins/font-awesome/css/font-awesome.min.css" />


        <link rel="stylesheet" href="assets/global/css/components.min.css" />

        <link rel="stylesheet" href="assets/global/plugins/simplemde/dist/simplemde.min.css"/>
        <!--    <link rel="stylesheet" href="assets/global/plugins/jquery-nice-select/css/style.min.css">-->


        <link rel="stylesheet" href="assets/layouts/layout-left-icon-menu/css/layout.min.css" />
        <link rel="stylesheet" type="text/css" href="css/angular-datepicker.css"/>


        <link rel="stylesheet" href="assets/global/plugins/bootstrap-select/dist/css/bootstrap-select.min.css"/>
        <link rel="stylesheet" href="assets/global/plugins/select2/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="assets/global/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css"/>
        <link rel="stylesheet" href="assets/global/plugins/jt.timepicker/jquery.timepicker.css"/>
        <link rel="stylesheet" href="assets/global/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"/>
        <link rel="stylesheet" href="assets/global/plugins/flatpickr/dist/flatpickr.min.css"/>

        <link rel="stylesheet" href="css/select.css">
                  <!--  <script src="scripts/angular.min.js"></script>
                  <script src="scripts/angular-ui-router.min.js"></script> -->



        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.1/angular.min.js">
//        <script src="http://code.angularjs.org/1.2.13/angular.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="scripts/angular-datepicker.js"></script>
        <script src="scripts/app.js"></script>
        <script src="scripts/app.config.js"></script>
        <script src="scripts/app.router.js"></script>


        <script src="scripts/app.main.js"></script>

        <script src="libs/angular/angular-resource/angular-resource.js"></script>
        <script src="libs/angular/ngstorage/ngStorage.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
        <script src="scripts/services/ngstore.js"></script>
        <script src="scripts/services/ui-load.js"></script>
        <script src="scripts/select.js"></script>

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
    <body class="{{ menu_class}}"  id="body-main">

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
            <!--<div ui-view></div>-->
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


        </div>

        <script type="text/javascript" src="assets/global/plugins/filesaver/filesaver.js"></script>
        <script>
            function exportData(id, filename) {

                var blob = new Blob([document.getElementById(id).innerHTML], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
                });
                saveAs(blob, filename);
            }
        </script>

        <script src="scripts/controllers/login.js"></script>
        <script src="scripts/controllers/dashboard.js"></script>
        <script src="scripts/controllers/clientdashboard.js"></script>
        <script src="scripts/controllers/user.js"></script>
        <script src="scripts/controllers/project.js"></script>
        <script src="scripts/controllers/sources.js"></script>
        <script src="scripts/controllers/sourcereport.js"></script>
        <script src="scripts/controllers/bucket.js"></script>
        <script src="scripts/controllers/header.js"></script>
        <script src="scripts/controllers/broken_sources.js"></script>
        <script src="scripts/controllers/mailsystem.js"></script>
        <script src="scripts/controllers/view_mail.js"></script>
        <script src="scripts/controllers/link_status_report.js"></script>
        <script src="scripts/controllers/settings.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/tether/dist/js/tether.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/screenfull.js/dist/screenfull.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/classie/classie.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/Flot/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot/jquery.flot.time.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot/jquery.flot.categories.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/arcseldon-jquery.sparkline/dist/jquery.sparkline.js"></script>
        <script type="text/javascript" src="assets/global/plugins/skycons/skycons.js"></script>
        <script type="text/javascript" src="assets/global/plugins/progressbar.js/dist/progressbar.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/gauge.js/dist/gauge.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/raphael/raphael.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-mapael/js/jquery.mapael.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-mapael/js/maps/france_departments.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-mapael/js/maps/world_countries.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jquery-mapael/js/maps/usa_states.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/d3/d3.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/rickshaw/rickshaw.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/CodeMirror-v1/js/codemirror.js"></script>
        <script type="text/javascript" src="assets/global/js/global/mail.js"></script>
        <script type="text/javascript" src="assets/global/js/site.min.js"></script>
        <script type="text/javascript" src="assets/global/js/site-settings.min.js"></script>
        <script type="text/javascript" src="assets/global/js/global/dashboard_v4.min.js"></script>
        <script type="text/javascript" src="assets/layouts/layout-left-icon-menu/js/layout.min.js"></script>

        <script type="text/javascript" src="assets/global/plugins/moment/moment.js"></script>
      
        <script type="text/javascript" src="assets/global/js/site.min.js"></script>
        <script type="text/javascript" src="assets/global/js/site-settings.min.js"></script>


        <script type="text/javascript" src="assets/global/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/select2/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/typeahead.js/dist/typeahead.jquery.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/typeahead.js/dist/bloodhound.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/jt.timepicker/jquery.timepicker.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script type="text/javascript" src="assets/global/plugins/flatpickr/dist/flatpickr.min.js"></script>
        <script type="text/javascript" src="assets/global/js/global/advanced_elements.js"></script>
        <!--Js For Login Page-->


    </body>
</html>



