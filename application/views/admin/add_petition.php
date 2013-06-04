<form action="<?php echo base_url()?>index.php/admin/add_petition" method="post"  enctype="multipart/form-data">
<input name="name" type="text" placeholder="name">
<br />
<textarea name="description" placeholder="description">
</textarea>
<br />
<input name="image" type="file">
<br />
<input type="submit">
</form>