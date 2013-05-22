<table class="table table-striped">
<thead>
<tr>
<th>Module</th><th>Active</th><th></th>
</tr>
</thead>
<tbody>
<tr><td>SMS</td><td><input id="sms" name="modules[]" value="sms" type="checkbox"<?php if(($installed['sms'])=='1')print" checked";?>></td><td></td></tr>
<tr><td>Voter Turnout</td><td><input id="voter_turnout" name="modules[]" value="voter_turnout" type="checkbox"<?php if(($installed['voter_turnout'])=='1')print" checked";?>></td><td><a name='install_voter_turnout' class="btn btn-info" onclick="sampleData('voter_turnout')">Install sample voter turnout data</a></td></tr>
<tr><td>Registration Centers</td><td><input id="reg_centers" name="modules[]" value="reg_centers" type="checkbox"<?php if(($installed['reg_centers'])=='1')print" checked";?>></td><td></td></tr>
<tr><td>Aspirants</td><td><input id="aspirants" name="modules[]" value="aspirants" type="checkbox"<?php if(($installed['aspirants'])=='1')print" checked";?>></td><td><a name='install_voter_turnout' class="btn btn-info" onclick="sampleData('aspirants')">Install sample aspirants data</a></td></tr>
<tr><td></td><td><input type="submit" value="Save" class="btn btn-primary"/></td><td></td></tr>
 <?php echo form_close(); ?>
</tbody>
</table>