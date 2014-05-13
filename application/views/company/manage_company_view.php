<h3>Manage Company Profile</h3>

<div class="row-fluid">

	<?php 
		if (in_array($this->session->userdata['ROLE'], $this->manager_role)) {
	?>
		<!-- Information Boxes: Create Company Profile -->
		<a href="<?php echo site_url('company/create'); ?>" title="Manage Company Profile">

			<div class="span3 well infobox">

				<div class="pull-right text-right">

					<p>Create Company Profile</p>

				</div>

			</div>

		</a>

		<!-- / Information Boxes: Create Company Profile -->

		<!-- Information Boxes: Create Company Profile -->
		
		<a href="<?php echo site_url('company/search'); ?>" title="Manage Company Profile">

			<div class="span3 well infobox">

				<div class="pull-right text-right">

					<p>Edit Company Profile</p>

				</div>

			</div>

		</a>
		<!-- / Information Boxes: Create Company Profile -->
	<?php
	}
	?>


	
</div>