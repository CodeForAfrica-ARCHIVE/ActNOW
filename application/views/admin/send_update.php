<?php
	if(isset($_POST)){
		print "<h3>updates sent!<h3>";
	}
?>
<form action="<?php echo base_url()?>index.php/admin/send_update" method="post">
<select name="petition">
	<?php
	foreach($petitions as $item){
		print "<option value='".$item['id']."'>".$item['name']."</option>";
	}
	?>
</select>
<br />
<textarea name="message" placeholder="description">
</textarea>
<br />
<input type="submit">
</form>