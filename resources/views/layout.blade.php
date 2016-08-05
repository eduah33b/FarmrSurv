<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Quick Dirty Dynamic Forms">
        <meta name="keywords" content="HTML,CSS,Laravel,JavaScript,FarmrSurv">
        <meta name="author" content="Duah Kwaku Emmanuel JNR">
        <title>Farmr Survey</title>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="Content/bootstrap.min.css" rel="stylesheet" />
        <link href="Content/Site.css" rel="stylesheet" />
        <link href="Content/Home.css" rel="stylesheet" />
        @yield('header')
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a id="header">FarmrSurv</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a onclick="partialNav('#MainWindow','AddSheet','Add New Form Sheet')" id="header"><span class="glyphicon glyphicon-plus text-success"></span> Add New Survey</a></li>
                        <li><a onclick="partialNav('#MainWindow', 'home_', 'Home')" id="header"><span class="glyphicon glyphicon-home text-info"></span> Home</a></li>
                    </ul>          
                </div>
            </div>
        </div>
        <div class="body-content">
            <div id="MainWindow">
                    @yield('content')
            </div>
        </div>

        <div id="progress_report">
            <div class="loading-effect-2">
                <span></span>
                <p style="font-weight:lighter; margin: 23vh auto 0px; text-align: center; color: #a00;">Please Wait ...</p>
            </div>
        </div>

        @yield('footer')
        <script src="Scripts/jquery-1.10.2.min.js"></script>

        <script src="Scripts/bootstrap.min.js"></script>
        <script src="Scripts/Chart.min.js"></script>

        <script src="Scripts/jquery-ui-1.11.4.min.js"></script>

        <script src="Scripts/Home.js"></script>
    </body>
</html>