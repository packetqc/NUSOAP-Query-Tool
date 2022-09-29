<?php
function viewIntegration() {        
        print <<<END
    <div>
        <h3>Integration, Certification and Testing Assets to be connected</h3>
    </div>
    <div id="accordion" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseConnection">Connection with the asset for certification or for integration</a>
                </h4>
            </div>
            <div id="collapseConnection" class="panel-collapse collapse">
                <div class="panel-body">
                    
                        <table id="connectionTable" class="display dataTable table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Connection type</th>
                                    <th>Connection string</th>
                                    <th>Authentication (optional)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ddi.epaquet.net</td>
                                    <td>WSDL</td>
                                    <td>http://ddi.epaquet.net/api?WSDL</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSamples">Configuration of the tests samples for validations</a>
                </h4>
            </div>
            <div id="collapseSamples" class="panel-collapse collapse">
                <div class="panel-body">
                    <table id="samplesTable" class="display dataTable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Types</th>
                                <th>Values</th>
                                <th>Actions</th>
                                <th>Comments</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>IP Address</td>
                                <td title="Click to edit...">123.123.123.123</td>
                                <td></td>
                                <td>Certification test</td>
                            </tr>
                            <tr>
                                <td>Url</td>
                                <td title="Click to edit...">http://ss.epaquet.net/demos/basic.html</td>
                                <td></td>
                                <td>Certification test</td>
                            </tr>
                            <tr>
                                <td>File</td>
                                <td title="Click to edit...">cf8bd9dfddff007f75adf4c2be48005cea317c62</td>
                                <td></td>
                                <td>Certification test</td>
                            </tr>
                            <tr>
                                <td>Domain</td>
                                <td title="Click to edit...">epaquet.net</td>
                                <td></td>
                                <td>Certification test</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseIntegration">Configuration of the certification or the integration</a>
                </h4>
            </div>
            <div id="collapseIntegration" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div>
                        <table cellpadding="0">
                            <tr>
                                <th><h4>Methods available</h4></th>
                                <th><table border=0 width="100%"><tr><td align="left"><h4>Configuration for interoperability</h4></td><td align="right"><div id="tagTableTools"></div></td></tr></table></th>
                            <tr>
                                <td width="50%" valign="top">
                                    <table id="interoperateTable" class="display" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Methods available for this asset</th>
                                                <th width="5%" class="text-center">Add</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </td>
                                <td valign="top">
                                    <table id="configurationTable" class="display" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Configured methods</th>
                                                <th>Configured modes</th>
                                                <th>Configured types</th>
                                                <th width="5%" class="text-center">Test</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <p></p>
    <!--
                                    <div id="consoles" class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="" href="#collapseCertif">Validations and troubleshooting consoles</a>
                                                </h4>
                                            </div>
                                            <div id="collapseCertif" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <ul id="tabsConsole" class="nav nav-tabs" data-tabs="tabsConsole">
                                                        <li class="active"><a href="#text" data-toggle="tab">TEXT</a></li>
                                                        <li><a href="#web" data-toggle="tab">WEB</a></li>
                                                        <li><a href="#request" data-toggle="tab">REQUEST</a></li>
                                                        <li><a href="#response" data-toggle="tab">RESPONSE</a></li>
                                                        <li><a href="#debug" data-toggle="tab">DEBUG</a></li>
                                                    </ul>

                                                    <div id="mp-tab-content" class="tab-content">
                                                        <div class="tab-pane active" id="text">       
                                                            <textarea id="textConsole" name="textConsole" rows="10" cols="40"></textarea>
                                                        </div>

                                                        <div class="tab-pane" id="web">       
                                                            <div id="webConsole"></div>
                                                        </div>

                                                        <div class="tab-pane" id="request">
                                                            <textarea id="requestConsole" name="textConsole" rows="10" cols="40"></textarea>
                                                        </div>

                                                        <div class="tab-pane" id="response">
                                                            <textarea id="responseConsole" name="textConsole" rows="10" cols="40"></textarea>
                                                        </div>

                                                        <div class="tab-pane" id="debug">
                                                            <textarea id="debugConsole" name="textConsole" rows="10" cols="40"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-footer">
                                                </div>
                                            </div>
                                    </div>
-->    
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>

        

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapsePersist">Additional certification and integration options</a>
                </h4>
            </div>
            <div id="collapsePersist" class="panel-collapse collapse">
                <div class="panel-body">
                    <div><p>Persist as certified asset, as preset configuration and integrate to the connected environment to manage threats.</p></div>
              
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>        
END;

}

function viewSettings() {
        print <<<END
    
    <div>
        <h3>Status and configurations for a Connected Threats Custom Defenses interoperable local intelligence</h3>
    </div>    
    
    <table id="settingsTable" class="display dataTable table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Status</th>
                <th>Assets</th>
                <th>Asset Types</th>
                <th>Check Status</th>
                <th>Remove</th
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Status</th>
                <th>Assets</th>
                <th>Asset Types</th>
                <th>Check Status</th>
                <th>Remove</th
            </tr>
        </tfoot>
    </table>      
END;
    }
    
function viewSubmit() {
        print <<<END

    <div>
        <h3>Submissions to Local or to Global services to update the Local or the Global Intelligence</h3>
    </div>    
    
    <table id="submitTable" class="display dataTable table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>last_name</th>
                <th>first_name</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>last_name</th>
                <th>first_name</th>
            </tr>
        </tfoot>
    </table>
END;
    }
    
function viewCustom() {
        print <<<END

    
    <div>
        <h3>Custom defenses configurations to be deployed to the connected Local Intelligence</h3>
    </div>    
    
    <table id="customTable" class="display dataTable table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status Sources</th>
                    <th>Source Types</th>
                    <th>Source Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status Sources</th>
                    <th>Source Types</th>
                    <th>Source Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Status</th>
                </tr>
            </tfoot>
    </table>
END;
}
   
function viewUpdates() {
        print <<<END
        
    <div>
        <h3>Threats updates from the connected sources: to be deployed and managed in the Local Intelligence</h3>
    </div>    
    
        <table id="updatesTable" class="display dataTable table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status</th>
                    <th>Types</th>
                    <th>Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Deployed</th>
                    <th>Deploy</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status</th>
                    <th>Types</th>
                    <th>Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Deployed</th>
                    <th>Deploy</th>
                </tr>
            </tfoot>
        </table>
END;
}    
    
function viewDeployed() {
        print <<<END

    <div>
        <h3>Defenses available on-line WSDL or PUSHED to connected and to interoperable assets</h3>
    </div>    
    
    <table id="deployedTable" class="display dataTable table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status</th>
                    <th>Types</th>
                    <th>Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Deployments</th>
                    <th>Disable</th>
                    <th>Expires</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Sources</th>
                    <th>Status</th>
                    <th>Types</th>
                    <th>Actions</th>
                    <th>Types</th>
                    <th>Values</th>
                    <th>Comments</th>
                    <th>Deployments</th>
                    <th>Disable</th>
                    <th>Expires</th>
                </tr>
            </tfoot>
    </table>   
  
END;
    }    
?>