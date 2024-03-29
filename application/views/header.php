<!DOCTYPE html>
<html>
<head>
	<title>Login &bull; Template</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css')?>" />
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>" />

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?= base_url();?>">FitLog</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<!-- <li class="<?php active('/')?>"><a href="<?= site_url('/')?>">Sistem Metadata Buku <span class="sr-only">Metadata</span> </a></li> -->
					<!-- <li><a href="<?= site_url('umum/daftar_affiliate')?>">Daftar Sebagai Affiliate</a></li> -->
					<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
					<li class="divider"></li>
					<li><a href="#">One more separated link</a></li>
					</ul>
					</li> -->
				</ul>
				<!-- 
				<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				</form> -->
				<ul class="nav navbar-nav navbar-right">
					<?php if(is_logged_in() == false){?>
					<li class="<?php active('umum/login')?>"><a href="<?= site_url('login')?>">Login</a></li>
					<li class="<?php active('umum/register')?>"><a href="<?= site_url('umum/register')?>">Register</a></li>
					<?php }else{ 
					$user = $this->session->userdata('user');
					?>
					<li><a href="#">Welcome <b><?= ucwords($user['username'])?></b>!</a></li>
					<li class="<?php active('dashboard/index')?>"><a href="<?= site_url('dashboard/index')?>">Dashboard</a></li>
					<li><a href="<?= site_url('umum/logout')?>">Logout</a></li>
					<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Shortcut <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Senarai Buku</a></li>
							<li><a href="#">Buku Baru</a></li>
							<li><a href="#">Maklumat Akaun</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							</ul>
						</li> -->
					<?php } ?>

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
