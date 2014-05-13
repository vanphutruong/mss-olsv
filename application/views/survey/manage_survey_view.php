<div class="row-fluid">
	<!-- Information Boxes: Create Company Profile -->
	<a href="<?php echo site_url('survey/search/take'); ?>" title="Manage Company Profile">
		<div class="span3 well infobox">
			<div class="pull-right text-right">
				<p>Take Survey</p>
			</div>
		</div>
	</a>
	<!-- / Information Boxes: Create Company Profile -->

	<?php 
	if(isset($this->session->userdata['ROLE'])) {

		if ($this->session->userdata['ROLE'] ==  $this->admin_role) {
		?>

			<!-- Information Boxes: Create Company Profile -->

			<a href="<?php echo site_url('survey/search/update'); ?>" title="Manage Company Profile">

				<div class="span3 well infobox">

					<div class="pull-right text-right">

						<p>Update Survey Responses</p>

					</div>

				</div>

			</a>

			<!-- / Information Boxes: Create Company Profile -->

		<?php
		}
	}
	?>	

	
</div>