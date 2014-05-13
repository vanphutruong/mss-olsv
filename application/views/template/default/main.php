<?php

if (file_exists(APPPATH."views/template/$template_name/footer".'.php')) {

	$this->load->view("template/$template_name/header");

}

?>

<div class="main-wrapper">

	<div class="content">

		<div class="container">
			<!--[if lte IE 8 ]>

                <div class="ie_container">

			<![endif]-->

			<?php 
				if ($this->session->userdata(USER_SESSION_KEY)) {
				?>

				<menu id="parent-menu">
					<ul id="menu">

						<li><a href="<?php echo site_url('home/index') ?>">Main menu</a></li>

						<?php 
							if(isset($this->session->userdata['ROLE'])) {
								
								if (in_array($this->session->userdata['ROLE'], $this->manager_role)) {
								?>
								
								<li><a href="<?php echo site_url('company/index') ?>">Manage Company Profile</a></li>

								<li><a href="<?php echo site_url('survey/index') ?>">Survey</a></li>

								<?php
								}
							}
						?>
						

						<?php 
						if(isset($this->session->userdata['ROLE'])) {

							if ($this->session->userdata['ROLE'] ==  $this->admin_role) {
							?>

							<li><a href="javascript:void(0);">Report</a></li>

							<?php
							}
						}
						?>

						<li><a href="<?php echo site_url('users/logout') ?>">Logout</a></li>
					</ul>
				</menu>
			
				<?php
				}
				
			?>
			<?php echo $content?>

			<!--[if lte IE 8 ]>

                </div>

			<![endif]-->

		</div>

	</div>

</div>

<style>
	.main-wrapper{
		width: 1024px;
		height: 631px;
	}
	.control-group{
		margin-left: auto;
		margin-right: auto;
	}
	.wrapper_form{
		margin-top: 5% !important;
	}
</style>
<?php

if (file_exists(APPPATH."views/template/$template_name/footer".'.php')) {

	$this->load->view("template/$template_name/footer");
	
}

?>