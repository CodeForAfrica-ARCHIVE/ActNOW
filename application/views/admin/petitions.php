<a href="<?php echo base_url()?>index.php/admin/petitions/new">Add new petition</a>
<h4>Petitions</h4>
<table class="table table-striped">
	<thead>
		<tr><th>Petition</th><th>Description</th><th>Signatures</th>
		</tr>
	</thead>		
	<tbody>
		<tr>
		<?php
			if(count($petitions)>0){
			foreach($petitions as $petition){
				print "<tr><td>".$petition['name']."</td><td>".$petition['description']."</td><td>".$petition['signatures']."</td></tr>";
			}
			}
		?>
		</tr>
	</tbody>
</table>