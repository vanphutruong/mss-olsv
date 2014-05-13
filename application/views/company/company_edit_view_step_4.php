<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<h3>Update Company Profile</h3>
		<p class="title_header">Company's current Growth Stage</p>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('company/processing_edit'); ?>" method="post" class="form-horizontal">
				
				<div class="control-group">
					<p class="title_content">Q2: Management Style</p>
					<div class="controls">
						<?php 

							if(isset($edit_step_2) && !is_null($edit_step_2)){
								echo form_hidden($edit_step_2);
							}

							if(isset($question) && !is_null($question)){
								foreach ($question as $key => $value) {
						?>

									<label class="radio_info"><span><input required type="radio" name="ID_GS2" value="<?php echo $question[$key]['ID_GS']; ?>" <?php  if( isset($ID_GS2) && $ID_GS2 == $question[$key]['ID_GS']) echo 'checked=""' ; ?> ></span><?php echo $question[$key]['VALUE'] ?></label>

						<?php
								}
							}
						?>
					</div>
				</div>

				<div class="form-actions">
					
					<button type="submit" name="submit" value="BACK" class="btn_submit pull-left">Back</button>

					<input type="hidden" name="step" value="3">

					<button type="submit" name="submit" value="SAVE" class="btn_submit pull-right">Update Profile</button>

				</div>

			</form>
			<!-- / Forms: Form -->           

		</div>
		<!-- / Forms: Content -->

	</div>
	<!-- / Forms: Box -->

</div>
<!-- / Forms -->