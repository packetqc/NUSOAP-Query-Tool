<?php
    require_once 'ui/view.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CTD Project - Interoperability</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="theme.css" rel="stylesheet">

    <!--link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"-->
    <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <!--link rel="stylesheet" type="text/css" href="css/editor.bootstrap.css"-->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css" class="init">

    body { font-size: 140%; }

    </style>

    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.editor.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="js/editor.bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="js/demo.js"></script>
    <script type="text/javascript" language="javascript" src="js/editor-demo.js"></script>

    <script src="js/eModal.min.js"></script>
    <script src="js/docs.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script type="text/javascript" class="init">
            jQuery(document).ready(function ($) {
                    $('#tabs').tab();
            } );
    </script>   
  </head>

  <body role="document">
   
    
        <div class="container">

            

            <div class="jumbotron">
                <h1>CTD Project - Interoperability</h1>
                <p>This is a CTD project that uses nusoap, bootstrap javascript and apache to provide a light and an interoperable central managmenent service</p>
            </div>

            <div id="content">
		<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
                    <li><a href="#submit" data-toggle="tab">SUBMIT</a></li>
                    <li><a href="#custom" data-toggle="tab">CUSTOM</a></li>
                    <li><a href="#updates" data-toggle="tab">UPDATES</a></li>
                    <li><a href="#deployed" data-toggle="tab">DEPLOYED</a></li>
		</ul>

		<div id="mp-tab-content" class="tab-content">

                    <div class="tab-pane active" id="settings">       
                        <?php viewSettings();?>
                        
                        
                    </div>

                    <div class="tab-pane" id="submit">
                        <?php viewSubmit();?>
                    </div>

                    <div class="tab-pane" id="custom">
                        <?php viewCustom();?>
                    </div>

                    <div class="tab-pane" id="deployed">
                        <?php viewDeployed();?>
                    </div>

                    <div class="tab-pane" id="updates">
                        <?php viewUpdates();?>
                    </div>
		</div>
	</div>

    </div> <!-- /container -->

  </body>
</html>


