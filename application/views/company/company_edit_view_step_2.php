<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

			<h3>Update Company Profile</h3>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('company/processing_edit') ; ?>" method="post" class="form-horizontal">
				
				<div class="control-group">

					<label for="inputCompanyID"  class="control-label">Company ID</label>

					<div class="controls">

						<input type="text" pattern=".{6,50}" class="span6 m-wrap" name="nm_company" required disabled value="<?php 

							if(isset($nm_company) && !empty($nm_company))  

								echo $nm_company; 
							?>">
						<input type="hidden" name="nm_company" value="<?php 

							if(isset($nm_company) && !empty($nm_company))  

								echo $nm_company; 
							?>">
					</div>

				</div>
				
				<div class="control-group">

					<label class="control-label" for="inputRespondentName">Respondent Name</label>

					<div class="controls">

						<input type="text" class="span6 m-wrap" name="nm_respondent" required  value="<?php 

							if(isset($nm_respondent) && !empty($nm_respondent))  echo $nm_respondent ; 

							?>">
					</div>

				</div>

				<div class="control-group">

					<label class="control-label" for="inputDesignation">Designation</label>

					<div class="controls">

						<input type="text" class="span6 m-wrap" name="nm_designation" required value="<?php 

							if(isset($nm_designation) && !empty($nm_designation))  

								echo $nm_designation;

							?>">

					</div>

				</div>
				
				<div class="control-group">

					<label class="control-label">Family Owned</label>

					<div class="controls" >

						<label class="radio">

							<span>

								<input required type="radio" name="id_family_owned" value="1" <?php 

									if(isset($id_family_owned) && $id_family_owned == 1) 

										echo 'checked=""' ; ?> >
							</span> Yes

						</label>

						<label class="radio">

							<span>

								<input type="radio" name="id_family_owned" value="0" <?php 

									if(isset($id_family_owned) && $id_family_owned == 0) {

										echo 'checked=""'; } ?>>
							</span> No

						</label>

					</div>

				</div>

				<div class="control-group">

					<label class="control-label">Revenue size (in <br> SGD)</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_revenue">

							<?php

								if(isset($revenue_list) && !empty($revenue_list)){

									$flag = false;

									$flag_2 = false;

									if( isset($n_revenue) && !empty($n_revenue)){

										$flag_2 = true;

									}
									
									foreach ($revenue_list as $key => $value) {

										if(!empty($revenue_list[$key]['VALUE'])){

							?>
								<option value="<?php 

									echo $revenue_list[$key]['ID_DROPDOWN'] 

									?>" <?php 

										if( $flag_2 && $n_revenue == $revenue_list[$key]['ID_DROPDOWN']){

											echo "selected";}
										else{

											if($flag)
												{

													echo "selected"; $flag = false;}

												} ?> > 
											<?php 

												echo $revenue_list[$key]['VALUE']; 

											?>
								</option>

							<?php

										}
									}
							} ?>

						</select>

						</select>

					</div>

				</div>

				<div class="control-group">

					<label class="control-label">Total staff size <br>(contributing CPF)</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_staff_size">

							<?php

								if(isset($total_staff_list) && !empty($total_staff_list)){

									$flag = false;

									$flag_2 = false;

									if( isset($n_staff_size) && !empty($n_staff_size)){

										$flag_2 = true;

									}

									foreach ($total_staff_list as $key => $value) {

										if(!empty($total_staff_list[$key]['VALUE'])){

							?>
								<option value="<?php 

									echo $total_staff_list[$key]['ID_DROPDOWN'] 

									?>" <?php 

										if( $flag_2 && $n_staff_size == $total_staff_list[$key]['ID_DROPDOWN']){

											echo "selected";
										}
										else{

											if($flag){

												echo "selected"; $flag = false;
											}

										} ?> >

										<?php 

											echo $total_staff_list[$key]['VALUE'];
										?>

								</option>

							<?php

										}
									}

							} ?>

						</select>

					</div>

				</div>

				<div class="control-group">

					<label class="control-label">HR staff size</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_hr_size">

							<?php

								if(isset($hr_staff_list) && !empty($hr_staff_list)){

									$flag = false;

									$flag_2 = false;

									if( isset($n_hr_size) && !empty($n_hr_size)){

										$flag_2 = true;

									}

									foreach ($hr_staff_list as $key => $value) {

										if(!empty($hr_staff_list[$key]['VALUE'])){

							?>
								<option value="<?php

									echo $hr_staff_list[$key]['ID_DROPDOWN'] 

									?>" <?php 

										if( $flag_2 && $n_hr_size == $hr_staff_list[$key]['ID_DROPDOWN']) { 

											echo "selected";
										
										}else{

											if($flag){

												echo "selected"; $flag = false;
											
											}

										} ?> > 

										<?php 

											echo $hr_staff_list[$key]['VALUE']; 
										?>
								</option>

							<?php

										}

									}

							} ?>

						</select>

					</div>

				</div>

				<div class="control-group">

					<label class="control-label">Company industry</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="nm_industry">

							<?php

								if(isset($company_industry_list) && !empty($company_industry_list)){

									$flag = false;

									$flag_2 = false;

									if(isset($nm_industry) && !empty($nm_industry)){

										$flag_2 = true;

									}

									foreach ($company_industry_list as $key => $value) {

										if(!empty($company_industry_list[$key]['VALUE'])){

							?>
								<option value="<?php

									echo $company_industry_list[$key]['ID_DROPDOWN'] 

									?>" <?php 

									if($flag_2 && $nm_industry == $company_industry_list[$key]['ID_DROPDOWN']) {

										echo "selected";

									}else{

										if($flag){ 

											echo "selected"; $flag = false;

										}
									} 
									?> > <?php 

										echo $company_industry_list[$key]['VALUE']; 

										?>

								</option>

							<?php

										}
									}
							} ?>
						</select>

					</div>

				</div>

				<div class="control-group">

					<label class="control-label">Company type</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="nm_type">

						<?php

								if(isset($company_type_list) && !empty($company_type_list)){

									$flag = false;

									$flag_2 = false;

									if( isset($nm_type) && !empty($nm_type)){

										$flag_2 = true;

									}

									foreach ($company_type_list as $key => $value) {

										if(!empty($company_type_list[$key]['VALUE'])){

							?>

								<option value="<?php 

									echo $company_type_list[$key]['ID_DROPDOWN'] 

									?>" <?php 

										if( $flag_2 && $nm_type == $company_type_list[$key]['ID_DROPDOWN']) {

											echo "selected";

										}else{

											if($flag){

												echo "selected"; $flag = false;
											}

										}

										?> > <?php 

											echo $company_type_list[$key]['VALUE']; 

										?>
								</option>

							<?php

										}

									}

							} ?>

						</select>

					</div>

				</div>

				<?php if($this->session->userdata['ROLE'] ==  $this->admin_role) { ?>

				<div class="control-group">

					<label for="inputRemarks"  class="control-label">Remarks</label>

					<div class="controls">

						<input type="text" pattern=".{0,350}" class="span6 m-wrap" name="tx_remarks" value="<?php 

							if(isset($tx_remarks) && !empty($tx_remarks))

								echo $tx_remarks; ?>">

					</div>

				</div>
				
				<?php }
				else
				{
					?>

						<input type="hidden"  name="tx_remarks" value="<?php 

							if(isset($tx_remarks) && !empty($tx_remarks))

								echo $tx_remarks; ?>">
					<?php
				}
				 ?>
				

				<div class="form-actions">

					<button type="submit" name="submit" value="NEXT" class="btn_submit">Next</button>

					<input type="hidden" name="step" value="1">
					
				</div>

			</form>
			<!-- / Forms: Form -->           

		</div>
		<!-- / Forms: Content -->

	</div>
	<!-- / Forms: Box -->

</div>
<!-- / Forms -->