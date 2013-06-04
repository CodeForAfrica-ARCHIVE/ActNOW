<h4>Signatures</h4>
<table class="table table-striped">
	<thead>
		<tr><th>Number</th><th>Email</th><th>Name</th><th>Signatures</th>
		</tr>
	</thead>		
	<tbody>
		<tr>
		<?php
			//if(count($petitions)>0){
			foreach($signatures as $signature){
				print "<tr><td>".$signature['number']."</td><td>".$signature['email']."</td><td>".$signature['name']."</td><td>".$signature['message']."</td></tr>";
			}
			//}
		?>
		</tr>
	</tbody>
</table>