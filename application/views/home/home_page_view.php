
<h3>Main Menu</h3>

<div class="row-fluid">


	<?php 
	if(isset($this->session->userdata['ROLE'])) {
		if (in_array($this->session->userdata['ROLE'], $this->manager_role)) {
			?>
			<!-- Information Boxes: Manage Company Profile -->

			<a href="<?php echo site_url('company/index'); ?>" title="Manage Company Profile">

				<div class="span3 well infobox">

					<div class="pull-right text-right">

						<p>Manage Company Profile</p>

					</div>

				</div>

			</a>
			<!-- / Information Boxes: Manage Company Profile -->


			<!-- Information Boxes: Survey -->
			<a href="<?php echo site_url('survey/index'); ?>" title="Survey">

				<div class="span3 well infobox">

					<div class="pull-right text-right">

						<p>Survey</p>

					</div>

				</div>

			</a>
			<!-- / Information Boxes: Survey -->

		<?php
		}
	}
	?>




	
	<?php 
	if(isset($this->session->userdata['ROLE'])) {
		if ($this->session->userdata['ROLE'] ==  $this->admin_role) {
		?>
			<!-- Information Boxes: Report -->

			<a href="<?php echo site_url('report/index'); ?>" title="Report">

				<div class="span3 well infobox">

					<div class="pull-right text-right">

						<p>Report</p>

					</div>

				</div>

			</a>

			<!-- / Information Boxes: Report -->
			
		<?php
		}
	}
	?>

</div>



