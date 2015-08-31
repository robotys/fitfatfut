<div class="col-sm-3 sidebar">
	<h1>Menu</h1>

	<?php 
		// show_sess();		
	?>

	<div class="list-group">
		<?php if(is_group('developer')){?>

			<a href="<?= site_url('customer')?>" class="list-group-item">Urus Pelanggan</a>
		
		<?php }elseif(is_group('user')){
				$user = $this->session->userdata('user');
			?>
			
			<a href="<?= site_url('dashboard/data')?>" class="list-group-item">Data</a>
			<a href="<?= site_url('dashboard/report')?>" class="list-group-item">Report</a>
			<a href="<?= site_url('dashboard/setting')?>" class="list-group-item">Settings</a>
		
		<?php } ?>
	</div>
</div>