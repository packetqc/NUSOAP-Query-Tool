<?php

echo "<h3>Select the options for this protection to deploy</h3>";

print <<<END
<p>
    </br>Actions: Monitor, Redirect, Block, Quarantine</br>
    </br><select name="DeploymentActions">
            <option>Monitor only</option>
            <option>Monitor and reset</option>
            <option>Redirect</option>
            <option>Block</option>
            <option>Quarantine</option>
    </select>
</p>    
<p>
    </br>Online: Yes or No to provide this information on the soap service
    </br><div class="btn-group" data-toggle="buttons">
        <label class="btn btn-xs btn-default">
            <input type="checkbox" autocomplete="off">no
        </label>
    </div>
</p>
<p>
    </br>Push: Yes or No to push this protection to the asset
    </br><div class="btn-group" data-toggle="buttons">
        <label class="btn btn-xs btn-default">
            <input type="checkbox" autocomplete="off">no
        </label>
    </div>
</p>


END;
?>
