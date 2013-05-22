<h4>Subscribers</h4>
<table class="table table-striped">
	<thead>
		<tr><th>Name</th><th>Number</th><th>Joined</th>
		</tr>
	</thead>		
	<tbody>
		<tr>
		<?php
			foreach($subscribers as $subscriber){
				print "<tr><td>".$subscriber['name']."</td><td>".$subscriber['number']."</td><td>".$subscriber['joined']."</td></tr>";
			}
		?>
		</tr>
	</tbody>
</table>