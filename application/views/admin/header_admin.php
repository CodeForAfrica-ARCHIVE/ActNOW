<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?></title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/admin.css"/>
</head>
<body>

<div id="container">
<div id="admin_menu">
<ul>
	<li><a href="<?php echo base_url()?>index.php/admin/">Dashboard</a></li>
	<li><a href="<?php echo base_url()?>index.php/admin/send_update">Send Update</a></li>
	<li><?php echo anchor('user/logout', 'Logout'); ?></li>
</ul>
</div>
<div class="content">
  <b>Welcome <?php echo $this->session->userdata('user_name'); ?>!</b><br />
  <h3>Administration Dashboard</h3>