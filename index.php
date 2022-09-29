<?php
    require_once 'ui/view.php';
    
    //http://www.bootstrapzero.com/bootstrap-template/the-firm
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
    <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css"/>
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css"/>
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
    <link href="css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/editor.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/ctcd.css" rel="stylesheet" type="text/css"/>
    
    <style type="text/css" class="init">
        body { font-size: 120%; }
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
    
    <script src="js/ctcd.js" type="text/javascript"></script>
    
    <script type="text/javascript" class="init">
        var editor;
        var editorExample;
        var editorSamplesTypes;
        var editorCustom;
        var editorConfiguration;
        var editorConnection;
        
        
        //var $configurationTable = $('#configurationTable').DataTable();
        var configurationTable;
        var connectionTable;
        var samplesTable;
        
        $(document).ready(function(){
               
           });
           
        jQuery(document).ready(function ($) {                                                                
            getTab("settings");
            getTab("updates");
            //getTab("submit");                
            getTab("custom");
            getTab("deployed");
            
            getTab("connection");
            getTab("interoperate");
            getTab("samples");
            getTab("integration");
        });
        
        function getTab(thetab) {
            
            if(thetab === "samples"){
                var todoSamples = {};
                var dateKey = +new Date();
                var key = 0;
                var id = dateKey+''+key;

                // Create or update the todo localStorage entry
                if ( localStorage.getItem('todoSamples') ) {
                    todoSamples = JSON.parse( localStorage.getItem('todoSamples') );
                }
                else {
                    localStorage.setItem('todoSamples', '[]');
                    todoSamples = JSON.parse( localStorage.getItem('todoSamples') );
                    /*
                    todoSamples[id] = {
                        "DT_RowId": id,
                        "types": 'IP Address',
                        "values": '123.123.123.123',
                        "actions": 'Block',
                        "comments": 'Certification test'
                    };
                    */
                    localStorage.setItem( 'todoSamples', JSON.stringify(todoSamples) ); 
                                 
                }
                
                editorSamplesTypes = new $.fn.dataTable.Editor( {
                    table: "#samplesTable",
                    ajax: function ( method, url, d, successCallback, errorCallback ) {
                        var output = { data: [] };

                        if ( d.action === 'create' ) {
                            // Create new row(s), using the current time and loop index as
                            // the row id
                            var dateKey = +new Date();

                            $.each( d.data, function (key, value) {
                                var id = dateKey+''+key;

                                value.DT_RowId = id;
                                todoSamples[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'edit' ) {
                            // Update each edited item with the data submitted
                            $.each( d.data, function (id, value) {
                                value.DT_RowId = id;
                                todoSamples[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'remove' ) {
                            // Remove items from the object
                            $.each( d.data, function (id) {
                                delete todoSamples[ id ];
                            } );
                        }

                        // Store the latest `todo` object for next reload
                        localStorage.setItem( 'todoSamples', JSON.stringify(todoSamples) );

                        // Show Editor what has changed
                        successCallback( output );
                    },
                    fields: [ 
                        {
                            label: "Types:",
                            name: "types",
                            type: "select",
                            def: 'IP Address',
                            options: [ 'IP Address', 'Url', 'File', 'Domain' ]
                        }, 
                        {
                            label: "Values:",
                            name: "values"
                        },
                        {
                            label: "Actions:",
                            name: "actions",
                            type: "select",
                            def: 'Monitor',
                            options: [ 'Monitor', 'Redirect', 'Block', 'Quarantine', 'Expired' ]
                        },
                        {
                            label: "Comments:",
                            name: "comments"
                        }
                    ]
                } );                
                
                // Activate the bubble editorSamplesTypes on click of a table cell
                $('#samplesTable').on( 'click', 'tbody td:not(:first-child)', function (e) {
                    //editorSamplesTypes.inline( this );
                } );                
               
                samplesTable = $('#samplesTable').DataTable( {
                    dom: "Bfrtip",
                    lengthChange: false,
                    data: $.map( todoSamples, function (value, key) {
                        return value;
                    } ),
                    columns: [                        
                        {
                            data: "types"
                        },
                        {
                            data: "values"
                        },
                        {
                            data: "actions"
                        },
                        {
                            data: "comments"
                        }
                    ],                    
                    select: true,
                    buttons: [
                        //{ extend: "create", editor: editorSamplesTypes },
                        { extend: "edit",   editor: editorSamplesTypes }
                        //{ extend: "remove", editor: editorSamplesTypes }
                    ]                    
                } );
                
                key++;
                id = dateKey+''+key;
                samplesTable.row.add({
                    "DT_RowId": id,
                    "types": 'IP Address',
                    "values": '123.123.123.123',
                    "actions": 'Block',
                    "comments": 'Certification test'
                });
                
                key++;
                id = dateKey+''+key;
                samplesTable.row.add({
                    "DT_RowId": id,
                    "types": 'Domain',
                    "values": 'epaquet.net',
                    "actions": 'Monitor',
                    "comments": 'Certification test'
                });
                
                key++;
                id = dateKey+''+key;
                samplesTable.row.add({
                    "DT_RowId": id,
                    "types": 'File',
                    "values": 'cf8bd9dfddff007f75adf4c2be48005cea317c62',
                    "actions": 'Quarantine',
                    "comments": 'Certification test'
                });
                
                key++;
                id = dateKey+''+key;
                samplesTable.row.add({
                    "DT_RowId": id,
                    "types": 'Url',
                    "values": 'http://ss.epaquet.net/demos/basic.html',
                    "actions": 'Block',
                    "comments": 'Certification test'
                }).draw();
            }
  
            if(thetab === "connection"){
                var todoConnection = {};
                var dateKey = +new Date();
                var key = '0';
                var id = dateKey+''+key;

                // Create or update the todo localStorage entry
                if ( localStorage.getItem('todoConnection') ) {
                    todoConnection = JSON.parse( localStorage.getItem('todoConnection') );
                }
                else {
                    localStorage.setItem('todoConnection', '[]');
                    todoConnection = JSON.parse( localStorage.getItem('todoConnection') );
                    
                    todoConnection[id] = {
                        "DT_RowId": id,
                        "asset": 'ddi.epaquet.net',
                        "type": 'WSDL',
                        "connection": 'https://ddi.epaquet.net/api?WSDL',
                        "authentication": ''
                    };
                    
                    localStorage.setItem( 'todoConnection', JSON.stringify(todoConnection) ); 
                                 
                }
              
                editorConnection = new $.fn.dataTable.Editor( {
                    table: "#connectionTable",
                    fields: [ 
                        {
                            label: "Asset:",
                            name: "asset"
                        },                        
                        {
                            label: "Connection type:",
                            name: "type",
                            type: "select",
                            def: 'WSDL',
                            options: [ 'WSDL', 'REST', 'SAML', 'SSH' ]
                        },
                        {
                            label: "Connection string:",
                            name: "connection"
                        },
                        {
                            label: "Authentication:",
                            name: "authentication"
                        }
                    ],
                    ajax: function ( method, url, d, successCallback, errorCallback ) {
                        var output = { data: [] };

                        if ( d.action === 'edit' ) {
                            // Update each edited item with the data submitted
                            $.each( d.data, function (id, value) {
                                value.DT_RowId = id;
                                todoConnection[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        // Store the latest `todo` object for next reload
                        localStorage.setItem( 'todoConnection', JSON.stringify(todoConnection) );

                        // Show Editor what has changed
                        successCallback( output );
                    } 
                } );
                
                $('#connectionTable').on( 'click', 'tbody td', function (e) {
                    //editorConnection.inline( this );
                } );
                
                connectionTable = $('#connectionTable').DataTable( {
                    dom: "Bfrtip",
                    lengthChange: false, 
                    data: $.map( todoConnection, function (value, key) {
                        return value;
                    } ),
                    columns: [
                        {
                            data: "asset"
                        },
                        {
                            data: "type"
                        },
                        {
                            data: "connection"
                        },                        
                        {
                            data: "authentication"
                        }
                    ],                    
                    select: true,
                    buttons: [
                        { extend: "edit",   editor: editorConnection }
                    ]     
                } );
                
                connectionTable.row.add({
                    "DT_RowId": id,
                    "asset": 'ddi.epaquet.net',
                    "type": 'WSDL',
                    "connection": 'https://ddi.epaquet.net/api?WSDL',
                    "authentication": ''
                }).draw();               
            }
            
            if(thetab === "interoperate"){ 
                
                $('#interoperateTable').on('click', 'td:last-child', function (event) {                    
                    assetConfigure(this.parentNode.cells[0].textContent);
                } );
                
                //var typeConnection = connectionTable.cell(0,1).data();
                var connection = connectionTable.cell(0,2).data();
                //alert(typeConnection);

                /*switch(typeConnection) {
                    case 'WSDL':
                        //CallWSDL(connection, method, mode, type);
                        break;
                    case 'REST':
                        break;
                    default:
                        break;
                }*/
                $('#interoperateTable').DataTable( {
                    lengthChange: false,
                    ajax: "ui/wsdl-interoper.php?connect="+connection,                   
                    columns: [
                        {
                            data: "method",
                            searchable: true
                        },
                        {
                            data: "configure",
                            defaultContent: '',
                            className: 'dt-body-center',
                            searchable: false,
                            render: function (data, type, full, meta){
                                return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-plus\" style=\"color:orange\"></span></label></div>";
                            }
                        }
                    ],                    
                    select: true
                } );
            }
            
            if(thetab === "integration") {
                 
                // Object that will contain the local state
                var todoIntegration = {};

                // Create or update the todo localStorage entry
                if ( localStorage.getItem('todoIntegration') ) {
                    todoIntegration = JSON.parse( localStorage.getItem('todoIntegration') );
                }

                // Set up the editor
                editorConfiguration = new $.fn.dataTable.Editor( {
                    table: "#configurationTable",
                    fields: [
                        {
                            label: "Methods:",
                            name: "method"
                        },
                        {
                            label: "Modes:",
                            name: "modes",
                            type: "select",
                            def: "",
                            options: [ '','Get', 'Set', 'Reset', 'Trig' ]
                        },
                        {
                            label: "Types:",
                            name: "types",
                            type: "select",
                            def: "",
                            options: [ '','IP Address', 'Url', 'File', 'Domain' ]
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
                                todoIntegration[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'edit' ) {
                            // Update each edited item with the data submitted
                            $.each( d.data, function (id, value) {
                                value.DT_RowId = id;
                                todoIntegration[ id ] = value;
                                output.data.push( value );
                            } );
                        }
                        else if ( d.action === 'remove' ) {
                            // Remove items from the object
                            $.each( d.data, function (id) {
                                delete todoIntegration[ id ];
                            } );
                        }

                        // Store the latest `todo` object for next reload
                        localStorage.setItem( 'todoIntegration', JSON.stringify(todoIntegration) );

                        // Show Editor what has changed
                        successCallback( output );
                    }
                } );

                // Initialise the DataTable
                configurationTable = $('#configurationTable').DataTable( {
                    dom: 'Blfrtip',
                    data: $.map( todoIntegration, function (value, key) {
                        return value;
                    } ),
                    columns: [
                        {
                            data: "method"
                        },
                        {
                            data: "modes"
                        },
                        {
                            data: "types"
                        },
                        {
                            data: "null",
                            "orderable":      false,
                            defaultContent: '',
                            className: 'dt-body-center',
                            render: function (data, type, full, meta){
                                return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-play\" style=\"color:orange\"></span></label></div>";
                            }
                        }
                    ],                    
                    select: true,
                    buttons: [
                        { extend: "create", editor: editorConfiguration },
                        { extend: "edit",   editor: editorConfiguration },
                        { extend: "remove", editor: editorConfiguration }
                    ] 
                } );
/*
                            render: function (data, type, full, meta){
                                return "<div class=\"btn-group\" data-toggle=\"buttons\"><label class=\"btn btn-xs btn-default\"><span class=\"glyphicon glyphicon-play\" style=\"color:orange\"></span></label></div>";
                            }
*/
                var configurationTableTools = new $.fn.dataTable.TableTools( configurationTable, {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",                        
                    aButtons: [ "copy","csv","xls","pdf","print"]
                } );
                
                $( configurationTableTools.fnContainer() ).insertAfter('#tagTableTools');
                                
                $('#configurationTable tbody').on('click', 'td.details-control', function () {                                       
                    //alert('on click to in row !');
                    
                    var tr = $(this).closest('tr');
                    var row = configurationTable.row( tr );

                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child( getInRowConsoles() ).show();
                        tr.addClass('shown');
                    }
                    
                    assetTest(this.parentNode.cells[0].textContent, this.parentNode.cells[1].textContent, this.parentNode.cells[2].textContent);
                } );

            }
            
            if(thetab === "deployed"){          

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
                                return "<button id=\"registerModal_d1\" type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"modal\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"https://ddi.epaquet.net/api?WSDL\" onclick=\"wsdlStatus()\"><span class=\"glyphicon glyphicon-log-in\" style=\"color:gray\"></span></button>";
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
                editorCustom = new $.fn.dataTable.Editor( 
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
                            def: "Monitor",
                            options: [ 'Monitor', 'Redirect', 'Block', 'Quarantine', 'Expired' ]
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
                        { extend: "create", editor: editorCustom },
                        { extend: "edit",   editor: editorCustom },
                        { extend: "remove", editor: editorCustom }
                    ]
                } );
            }    
           
        }
            
        function getInRowConsoles() {
            //alert('got in row ?');
            
            return ''+
            '<div id="consoles">'+
                '<h4">'+
                    'Results from the test:'+
                '</h4>'+

                '<ul id="tabsConsole" class="nav nav-tabs" data-tabs="tabsConsole">'+
                    '<li class="active"><a href="#text" data-toggle="tab">TEXT</a></li>'+
                    '<li><a href="#web" data-toggle="tab">WEB</a></li>'+
                    '<li><a href="#request" data-toggle="tab">REQUEST</a></li>'+
                    '<li><a href="#response" data-toggle="tab">RESPONSE</a></li>'+
                    '<li><a href="#debug" data-toggle="tab">DEBUG</a></li>'+
                '</ul>'+

                '<div id="mp-tab-content" class="tab-content">'+
                    '<div class="tab-pane active" id="text">'+
                        '<textarea id="textConsole" name="textConsole" rows="10" cols="40"></textarea>'+
                    '</div>'+

                    '<div class="tab-pane" id="web">'+
                        '<div id="webConsole"></div>'+
                    '</div>'+

                    '<div class="tab-pane" id="request">'+
                        '<textarea id="requestConsole" name="textConsole" rows="10" cols="40"></textarea>'+
                    '</div>'+

                    '<div class="tab-pane" id="response">'+
                        '<textarea id="responseConsole" name="textConsole" rows="10" cols="40"></textarea>'+
                    '</div>'+

                    '<div class="tab-pane" id="debug">'+
                        '<textarea id="debugConsole" name="textConsole" rows="10" cols="40"></textarea>'+
                    '</div>'+
                '</div>'+
            '</div>';
        }
        
        function saveAssetInteroper() {
            //var message = 'Do you really <b>want</b> to pass?';
            //eModal.confirm(message, 'Please confirm to save this configuration as preset.').then(saveAssetPresetConfirmed, saveAssetPresetCancelled);
            alert('about to save?!');
        /*
            var options = {
                url: "ui/saveAssetPreset.php",
                title:'Save this configuration as preset: ',
                subtitle: 'Interoperability settings',          
                buttons: [
                    {text: 'Cancel', style: 'info',   close: true, click: saveAssetPresetCancelled},
                    {text: 'Save', style: 'danger', close: true, click: saveAssetPresetConfirmed}
                ]
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            //eModal.ajax(options).then(saveDeployment, cancelDeployment);
            eModal.ajax(options);
            //eModal.confirm(options).then(saveDeployment, cancelDeployment);
            */
        }

        function saveAssetPresetCancelled() {
            alert("Cancel called on Deploy");
        }
        
        function saveAssetPresetConfirmed() {
            alert("Time to migrate to SQL or sqlite ?");
        }
        
        function assetConfigure(amethod) {
      
            var todoIntegration = {};
            
            if ( localStorage.getItem('todoIntegration') ) {
                // Object that will contain the local state
                todoIntegration = JSON.parse( localStorage.getItem('todoIntegration') );
            }

            var dateKey = +new Date();
            var key = '0';
            var id = dateKey+''+key;
            var types = '';

            todoIntegration[id] = {
                "DT_RowId": id,
                "method": amethod,
                "modes": '',
                "types": ''
            };

            localStorage.setItem('todoIntegration', JSON.stringify(todoIntegration));

            configurationTable.row.add({
                "DT_RowId": id,
                "method": amethod,
                "modes": '',
                "types": ''
            }).draw();
        }
        
        function assetTest(method, mode, type) {
            var typeConnection = connectionTable.cell(0,1).data();
            var connection = connectionTable.cell(0,2).data();
            //alert(typeConnection);
            
            switch(typeConnection) {
                case 'WSDL':
                    CallWSDL(connection, method, mode, type);
                    break;
                case 'REST':
                    break;
                default:
                    break;
            }
            
        }
        
        function CallWSDL(connection, method, mode, type){
            //POST with the arguments ...for set...
            //url: 'ui/wsdl.php?method='+method,
            //url: 'ui/wsdl.php?',
            //url: 'ui/wsdl-dev.php?method='+method,
                                    
            var arguments = {};
            
            if(mode !== 'Get') {
                var index = 0;
                
                switch( type ) {
                    case 'IP Address':
                        index = 0;
                        break;
                    case 'Domain':
                        index = 1;
                        break;
                    case 'File':
                        index = 2;
                        break;
                    case 'Url':
                        index = 3;
                        break
                    default:
                        break;
                }
                
                var avalue = samplesTable.cell( index,1 ).data();
                var aaction = samplesTable.cell( index,2 ).data();
                var acomment = samplesTable.cell( index,3 ).data();  
                
                arguments = {
                    value: avalue,
                    action: aaction,
                    comment: acomment
                };
                
                //alert("AJAX MODE:"+mode);
                
                $.ajax({
                    url: 'ui/wsdl.php?method='+method+'&mode='+mode+'&connect='+connection,
                    type: 'post',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    traditional: true,
                    data: JSON.stringify(arguments),
                    async:false,
                    success: function (data) {
                         assetTestCallback(data);
                    },
                    error: function () {
                        textConsoleError('System error: ajax call not established');
                    }
                });
            }
            else {
                alert("AJAX MODE:"+mode);
                $.ajax({
                    url: 'ui/wsdl.php?method='+method+'&mode='+mode+'&connect='+connection,
                    type: 'get',
                    dataType: "json",
                    async:false,
                    contentType: "application/json; charset=utf-8",
                    traditional: true,                    
                    success: function (data) {
                         assetTestCallback(data);
                    },
                    error: function () {
                        textConsoleError('System error: ajax call not established');
                    }
                });
            }
        }
/*
                var anargument = {
                    value: avalue,
                    action: aaction,
                    comment: acomment
                };

                arguments.push(anargument);
*/
/*           
            $.ajax({
                url: 'ui/wsdl.php?method='+method+'&mode='+mode+'&connect='+connection,
                type: 'Get',
                dataType: "json",
                async:false,
                success: function (data) {
                     assetTestCallback(data);
                },
                error: function () {
                    textConsoleError('System error.');
                }
            });
*/        

        function assetTestCallback(data) {
            $('#textConsole').val("");
            
            $('#textConsole').val($('#textConsole').val()+"RESULTS: \n\n"+JSON.stringify(data.result)+"\n\n");
            $('#textConsole').val($('#textConsole').val()+"STATUS: \n\n"+JSON.stringify(data.status)+"\n\n");
            $('#textConsole').val($('#textConsole').val()+"ERROR: \n\n"+JSON.stringify(data.error)+"\n\n");
            //$('#textConsole').val($('#textConsole').val()+"ARGUMENTS: \n\n"+JSON.stringify(data.arguments)+"\n\n");
            $('#textConsole').val($('#textConsole').val()+"REQUEST: \n\n"+data.request+"\n\n");
            $('#textConsole').val($('#textConsole').val()+"RESPONSE: \n\n"+data.response+"\n\n");
            $('#textConsole').val($('#textConsole').val()+"DEBUG: \n\n"+data.debug+"\n\n");
            
            $('#requestConsole').val("REQUEST: \n\n"+data.request+"\n\n");
            $('#responseConsole').val("RESPONSE: \n\n"+data.response+"\n\n");
            $('#debugConsole').val("DEBUG: \n\n"+data.debug+"\n\n");            
        }
 
        function textConsoleError(results) {
            //var results = "System error.";
            
            $('#textConsole').val(function(i, text) { return text + results + "\n\n"; });
            //alert('push configuration to asset now!');
        }
        
        function assetConfigure_old() {
            alert('push configuration to asset now!');
        }
        
        function assetConfigureCallback() {
            alert('asset configuration callback!');
        }
 
</script>

<script>
        
        function deployNow() {  
            var options = {
                url: "ui/deploy.php",
                title:'Deploy: ',
                subtitle: 'options',          
                buttons: [
                    {text: 'Cancel', style: 'info',   close: true, click: cancelDeployNow },
                    {text: 'Deploy', style: 'danger', close: true, click: saveDeployNow }
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
            /*
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
            */
        }
              
        function wsdlInterOper() {
            var options = {
                url: "ui/wsdl-pop-interoper.php",
                title:'Interoperability settings: ',
                subtitle: 'ddi.epaquet.net',
                size: 'lg'
            };       

            eModal.setEModalOptions({ 
                loadingHtml: '<span class="fa fa-circle-o-notch fa-spin fa-3x text-primary"></span><span class="h4">Connecting</span>'
            });

            //eModal.ajax(options).then(ajaxOnLoadCallback);
            eModal.ajax(options);
        }

        function wsdlStatus() {  
            var options = {
                url: "ui/wsdl-status.php",
                title:'Checking status: ',
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
        <div id="content">
               <div class="panel panel-default">                   
                    
                    <div class="panel-heading text-center">
                        <h3>CTCD Project - Interoperability</h3>
                        <ul id="tabs22222222222" class="nav nav-tabs nav-justified" data-tabs="tabs22222222222">
                            <li class="active text-center"><a href="#integration" data-toggle="tab">INTEGRATION</a></li>
                            <li class="text-center"><a href="#settings" data-toggle="tab">CONNECTED</a></li>
                            <li class="text-center"><a href="#updates" data-toggle="tab">THREATS</a></li>
                            <li class="text-center"><a href="#custom" data-toggle="tab">CUSTOM</a></li>
                            <li class="text-center"><a href="#deployed" data-toggle="tab">DEFENSES</a></li>
                            <li class="text-center"><a href="#submit" data-toggle="tab">GLOBAL SUBMIT</a></li>
                        </ul>
                    </div>
                    
                    <div class="panel-body" style="height:630px;overflow-y: scroll;overflow-style: auto;overflow: auto;">
                        
                        
                        <div id="mp-tab-content" class="tab-content">
                            <div class="tab-pane active" id="integration">       
                                <?php viewIntegration();?>
                            </div>

                            <div class="tab-pane" id="settings">       
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
                    
                    <div class="panel-footer panel-danger clearfix">
                        <div class="text-right">                            
                            <p>This is a CTCD project that uses nusoap, bootstrap javascript and apache to provide a light and an interoperable central managmenent service</p>
                            <p>CTCD - Interoperable Mitigation Operation Process: martin_paquet@trendmicro.com</p>
                            (Recommended screen resolution: hdmi)
                        </div>
                    </div>

                </div>
        </div>
</div>
</body>
</html>



