<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<h3><?php if( isset($question['nm_category']) && isset($step) ) echo $step . '. '. $question['nm_category']; ?></h3>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php echo site_url("survey/processing_take_survey"); ?>" method="post" class="form-horizontal">
									
				<div class="control-group">
					<p class="title_content"><?php if( isset($question['nm_question']) ) echo $question['nm_question']; ?></p>

					<div class="controls">

						<?php

							if( isset( $question['id_question'] ) ){
								echo form_hidden('id_question', $question['id_question']);
							}

							if( isset( $question['nm_category'] ) ){
								echo form_hidden('nm_category', $question['nm_category']);
							}

							if(isset($option) && !is_null($option)){

								foreach ($option as $key => $value) {

						?>
								<label class="radio">
								<span>
								<input  type="radio" name="id_answer" value="

								<?php 
									if(isset($value))
										echo $value['ID_ANSWER']; 

								?>" 

								<?php  

									if(isset($id_answer))
									{

										if($id_answer == $value['ID_ANSWER'])
										{

										 	echo  " checked " ; 

										}

									}		
										

								?>>

								</span>
								<?php 
									echo $value['NM_ANSWER'] 
								?>
								</label></br>

						<?php
								}
							}
						?>
					</div>
				</div>

				<div class="form-actions">
					
					<?php 
						if(isset($step) && is_numeric($step)) { 
							if($step != 1)
							{
								?>

									<button type="submit" name="submit" value="Previous" class="btn_submit pull-left">Previous</button>

									
								<?php
							}

							?>

							<input type="hidden" name="nm_company" value="<?php if(isset($nm_company) && !empty($nm_company) ){echo $nm_company;} ?>">
							
							<input type="hidden" name="submit_step" value="<?php if(isset($step) && !empty($step) ){echo $step;} ?>">
							
							<input type="hidden" name="submit_id_survey" value="<?php if(isset($id_survey) && !empty($id_survey) ){echo $id_survey;} ?>">



							<?php

							if($step != 34)
							{
								?>

									<button type="submit" name="submit" value="Next" class="btn_submit pull-right">Next</button>

								<?php
							}
							if($step == 34)
							{
								?>
									<button type="submit" name="submit" value="Save" class="btn_submit">Save Survey Responses</button>
								<?php
							}


						}
					?>

					
					
				</div>

			</form>
			<!-- / Forms: Form -->

		</div>
		<!-- / Forms: Content -->

	</div>
	<!-- / Forms: Box -->

</div>
<!-- / Forms -->