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

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    
    <link href="css/styles.css" rel="stylesheet">    
    
    <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css"/>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css"/>
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/editor.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <style type="text/css" class="init">
        body { font-size: 100%; }
    </style>
    
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.min.js"></script>    
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/eModal.min.js"></script>
    <script src="js/dataTables.select.min.js" type="text/javascript"></script>
    <script src="js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="js/dataTables.editor.min.js" type="text/javascript"></script>
            
    <script type="text/javascript" class="init">
        var editor;
        
        jQuery(document).ready(function ($) {                                                                
            getTab("settings");
            getTab("updates");
            //getTab("submit");                
            getTab("custom");
            getTab("deployed");
        });
        
        function getTab(thetab) {
            if(thetab === "deployed"){          
                //alert("updates !");                        

                $('#deployedTable').dataTable({
                    processing: true,
                    ajax: "ui/get-deployed.php",
                    columns: [ 
                        { 
                            data: "#" 
                        },
                        { 
                            data: "Sources" 
                        },
                        { 
                            data: "Status Sources" 
                        },
                        { 
                            data: "Source Types" 
                        },
                        { 
                            data: "Source Actions" 
                        },
                        { 
                            data: "Types" 
                        },
                        { 
                            data: "Values" 
                        },
                        { 
                            data: "Comments" 
                        },
                        { 
                            data: "Deployments",
                            render: function() {
                                    return "<button id=\"registerModal_deployment\" type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"modal\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Configure deployment options...\" onclick=\"deployment()\"><span class=\"glyphicon glyphicon-cog\" style=\"color:gray\"></span></button>";
                            }
                        },
                        { 
                            data: "Disable",
                            render: function() {
                                return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><input type=\"checkbox\" autocomplete=\"off\">no</label></div>";
                            }
                        },
                        { 
                            data: "Expires",
                            render: function() {
                                return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><input type=\"checkbox\" autocomplete=\"off\">no</label></div>";
                            }
                        }
                    ]
                });
            }
            
            if(thetab === "updates"){          
                //alert("updates !");                        

                $('#updatesTable').dataTable({
                    processing: true,
                    ajax: "ui/get-updates.php",
                    columns: [ 
                        { 
                            data: "#" 
                        },
                        { 
                            data: "Sources" 
                        },
                        { 
                            data: "Status Sources" 
                        },
                        { 
                            data: "Source Types" 
                        },
                        { 
                            data: "Source Actions" 
                        },
                        { 
                            data: "Types" 
                        },
                        { 
                            data: "Values" 
                        },
                        { 
                            data: "Comments" 
                        },
                        { 
                            data: "Deployed",
                            render: function() {
                                    return "<span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span>";
                            }
                        },
                        { 
                            data: "Deploy",
                            render: function() {
                                return "<button id=\"deployU1\" type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"modal\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Deploy Now\" onclick=\"deployNow()\"><span class=\"glyphicon glyphicon-time\" style=\"color:orange\"></span></button>";
                            }
                        }
                    ]
                });
            }
            
            if(thetab === "settings"){          
                //alert("updates !");                        

                $('#settingsTable').dataTable({
                    processing: true,
                    ajax: "ui/get-settings.php",
                    columns: [ 
                        { 
                            data: "Status", 
                            render: function() {
                                return "<span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span>";
                            }
                        },
                        { 
                            data: "Assets" 
                        },
                        { 
                            data: "Asset Types" 
                        },
                        { 
                            data: "Registrations",
                            render: function() {
                                return "<button id=\"registerModal_d1\" type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"modal\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"https://ddi.epaquet.net/api?WSDL\" onclick=\"wsdlRegister()\"><span class=\"glyphicon glyphicon-cog\" style=\"color:gray\"></span></button>";
                            }
                        },
                        { 
                            data: "Interoperabilities",
                            render: function() {
                                return "<button id=\"interoperModal_d2\" type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"modal\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Configure Interoperability Settings...\" onclick=\"wsdlInterOper()\"><span class=\"glyphicon glyphicon-cog\" style=\"color:gray\"></span></button>";
                            }
                        },
                        {
                            data: "Remove",
                            render: function() {
                                return "<span class=\"glyphicon glyphicon-remove\" style=\"color:red\"></span>";
                            }
                        }

                    ]
                });
            }
            
            if(thetab === "submit"){          
                //alert("updates !");                        

                $('#submitTable').dataTable({
                    processing: true,
                    ajax: "ui/get-updates.php",
                    columns: [ 
                        {
                            data: "last_name"
                        },
                        {
                            data: "first_name"                                        
                        }
                    ]
                });
            }
            
            if(thetab === "custom"){          
                var todo = {};

                // Create or update the todo localStorage entry
                if ( localStorage.getItem('todo') ) {
                    todo = JSON.parse( localStorage.getItem('todo') );
                }

                // Set up the editor
                editor = new $.fn.dataTable.Editor( 
                {
                    table: "#customTable",
                    fields: [
                        {
                            label: "# (Number)",
                            name: "#"
                        },
                        {
                            label: "Sources:",
                            name: "sources"
                        },
                        {
                            label: "Status Sources:",
                            name: "statussources",
                            type: "select",
                            def: "Enabled",
                            options: [ 'Enabled', 'Disabled', 'Expired' ]
                        },
                        {
                            label: "Source Types:",
                            name: "sourcetypes",
                            type: "select",
                            def: "User-Defined",
                            options: [ 'User-Defined', 'Virtual Analyzer', 'C&C Callback' ]
                        },
                        {
                            label: "Source Actions:",
                            name: "sourceactions",
                            type: "select",
                            def: "Monitor only",
                            options: [ 'Monitor only', 'Monitor and reset', 'Redirect', 'Block', 'Quarantine', 'Expired' ]
                        },
                        {
                            label: "Types:",
                            name: "types",
                            type: "select",
                            def: "IP Address",
                            options: [ 'IP Address', 'Url', 'File', 'Domain' ]
                        },
                        {
                            label: "Values:",
                            name: "values"
                        },
                        {
                            label: "Comments:",
                            name: "comments"
                        },
                        {
                            label: "Status:",
                            name: "status",
                            type: "radio",
                            def: "To deploy",
                            options: [ 'To deploy', 'Deployed' ]
                        }
                    ],               
                    ajax: function ( method, url, d, successCallback, errorCallback ) {
                        var output = { data: [] };

                        if ( d.action === 'create' ) {
                            // Create new row(s), using the current time and loop index as
                            // the row id
                            var dateKey = +new Date();

                            $.each( d.data, function (key, value) {
                                var id = dateKey+''+key;

                                value.DT_RowId = id;
                                todo[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'edit' ) {
                            // Update each edited item with the data submitted
                            $.each( d.data, function (id, value) {
                                value.DT_RowId = id;
                                todo[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'remove' ) {
                            // Remove items from the object
                            $.each( d.data, function (id) {
                                delete todo[ id ];
                            } );
                        }
                        else if ( d.action === 'deploy' ) {
                            alert("deploy");
                        }

                        // Store the latest `todo` object for next reload
                        localStorage.setItem( 'todo', JSON.stringify(todo) );

                        // Show Editor what has changed
                        successCallback( output );
                    }    

                } 
            
                );
                
                // Initialise the DataTable
                $('#customTable').DataTable( {
                    dom: "Bfrtip",
                    data: $.map( todo, function (value, key) {
                        return value;
                    } ),
                    columns: [
                        { data: "#" },
                        { data: "sources" },
                        { data: "statussources" },
                        { data: "sourcetypes" },
                        { data: "sourceactions" },
                        { data: "types" },
                        { data: "values" },
                        { data: "comments" },
                        { data: "status" }
                    ],
                    select: true,
                    buttons: [
                        { extend: "create", editor: editor },
                        { extend: "edit",   editor: editor },
                        { extend: "remove", editor: editor }
                    ]
                } );
            }           //,
                        //{ extend: "deploy", editor: editor }
        }
 </script>
 
 <script>
        function deployNow() {  
            var options = {
                url: "ui/deploy.php",
                title:'Deploy: ',
                subtitle: 'options',          
                buttons: [
                    {text: 'Cancel', style: 'info',   close: true, click: cancelDeploy },
                    {text: 'Deploy', style: 'danger', close: true, click: saveDeploy }
                ]
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            //eModal.ajax(options).then(saveDeployment, cancelDeployment);
            eModal.ajax(options);
            //eModal.confirm(options).then(saveDeployment, cancelDeployment);
        }
        

        function saveDeployNow() {
            alert("Time to migrate to SQL or sqlite ?");
        }
        
        function cancelDeployNow() {
            alert("Cancel called on Deploy");
        }

        function deployment() {  
            var options = {
                url: "ui/deployment.php",
                title:'Deployment: ',
                subtitle: 'options',          
                buttons: [
                    {text: 'Cancel', style: 'info',   close: true, click: cancelDeployment },
                    {text: 'Save', style: 'danger', close: true, click: saveDeployment }
                ]
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            //eModal.ajax(options).then(saveDeployment, cancelDeployment);
            eModal.ajax(options);
            //eModal.confirm(options).then(saveDeployment, cancelDeployment);
        }

        function saveDeployment() {
            alert("Time to migrate to SQL or sqlite ?");
        }
        
        function cancelDeployment() {
            alert("Cancel called on Deployment");
        }
        
        function ajaxOnLoadCallback() {
            $('#example').DataTable( {
                        lengthChange: false,
                        ajax: "ui/wsdl-interoper.php",
                        columns: [ 
                            {
                                data: "method"
                            },
                            {
                                data: "interoper", 
                                render: function() {
                                    return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><input type=\"radio\" name=\"options\" id=\"get\" autocomplete=\"off\"> Read </label><label class=\"btn btn-xs btn-default\"><input type=\"radio\" name=\"options\" id=\"set\" autocomplete=\"off\"> Write </label></div>";
                                }
                            }
                        ]
                    } );
        }
              
        function wsdlInterOper() {
            var options = {
                url: "ui/wsdl-interoper.html",
                title:'Interoperability settings: ',
                subtitle: 'ddi.epaquet.net',
                size: 'lg'
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            eModal.ajax(options).then(ajaxOnLoadCallback);
        }

        function wsdlRegister() {  
            var options = {
                url: "ui/wsdl-register.php",
                title:'Registration: ',
                subtitle: 'ddi.epaquet.net'
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            eModal.ajax(options);
            //eModal.ajax(url);
        }
    </script> 
</head>

  <body role="document editor wide comments example">
       
        <div class="container">            

            <div class="jumbotron">
                <h1>CTCD Project - Interoperability</h1>
                <h2>Interoperable Mitigation Operation Process</h2>
                <p>This is a CTCD project that uses nusoap, bootstrap javascript and apache to provide a light and an interoperable central managmenent service</p>
            </div>

            <div id="content">
                
		<ul id="tabs22222222222" class="nav nav-tabs" data-tabs="tabs22222222222">
                    <li class="active"><a href="#settings" data-toggle="tab">CONNECTED</a></li>
                    <li><a href="#updates" data-toggle="tab">THREATS</a></li>
                    <li><a href="#custom" data-toggle="tab">CUSTOM</a></li>
                    <li><a href="#deployed" data-toggle="tab">DEFENSES</a></li>
                    <li><a href="#submit" data-toggle="tab">GLOBAL SUBMIT</a></li>
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
        </div> 

  </body>
</html>


