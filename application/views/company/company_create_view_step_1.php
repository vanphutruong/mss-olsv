<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<!-- Forms: Top Bar -->
		
			<h3>Create Company Profile</h3>
		
		<!-- / Forms: Top Bar -->

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('company/processing_create') ; ?>" method="post" class="form-horizontal">
				
				<input type="hidden" name="step" value="1">

				<div class="control-group">

					<label for="nm_company"  class="control-label">Company ID</label>

					<div class="controls">

						<input type="text" class="span6 m-wrap" name="nm_company" required 
						value="<?php if(isset($nm_company) && !empty($nm_company))  echo $nm_company; ?>" id="nm_company">

					</div>

				</div>
				
				<div class="control-group">

					<label class="control-label" for="nm_respondent">Respondent Name</label>

					<div class="controls">

						<input type="text" class="span6 m-wrap" name="nm_respondent" required  value="<?php if(isset($nm_respondent) && !empty($nm_respondent))  echo $nm_respondent ; ?>" id="nm_respondent">

					</div>

				</div>

				<div class="control-group">

					<label class="control-label" for="nm_designation">Designation</label>

					<div class="controls">

						<input type="text" pattern=".{1,255}" class="span6 m-wrap" name="nm_designation" required value="<?php if
						(isset($nm_designation) && !empty($nm_designation))  echo $nm_designation ; ?>" id="nm_designation">

					</div>

				</div>
				
				<div class="control-group">

					<label class="control-label">Family Owned</label>

					<div class="controls" >

						<ul style="list-style:none;">
							<li>
								<label for="id_family_owned_yes">

									<span>

										<input required type="radio" id="id_family_owned_yes" name="id_family_owned" value="1" <?php

											if(isset($id_family_owned) && intval($id_family_owned) == 1) {

												echo 'checked=""';

											}

										?> >
									</span> Yes

								</label>

							</li>	

							<li>

								<label for="id_family_owned_no">

									<span>

										<input type="radio" id="id_family_owned_no" name="id_family_owned" value="0" <?php

											if(isset($id_family_owned) && intval($id_family_owned) != 1) {

												echo 'checked=""'; 

											}

											if(!isset($id_family_owned))
											{
												echo 'checked=""';
											}

											 
											?> >
											
									</span> No

								</label>

							</li>

						</ul>	

					</div>

				</div>

				<div class="control-group">

					<label for="inputRevenue Size"  class="control-label">Revenue size (in SGD)</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_revenue" >

							<?php

								if(isset($revenue_list) && !empty($revenue_list)){

									$flag = true;

									$flag_2 = false;

									if( isset($n_revenue) && !empty($n_revenue)){

										$flag_2 = true;

									}
									
									$first = count($revenue_list) ;

									foreach ($revenue_list as $key => $value) {

										$first -= 1;

										if(!empty($revenue_list[$key]['VALUE'])){

							?>

								<option value="<?php echo $revenue_list[$key]['ID_DROPDOWN'] ?>" <?php 

									if( $flag_2 && $n_revenue == $revenue_list[$key]['ID_DROPDOWN']) { 

										echo "selected";
									}
									else{
										if($flag) {
											echo "selected"; 
											$flag = false;}
									}

									if(!isset($n_revenue) && !empty($n_revenue))
									{
										echo "selected";
									}

								?> >

									<?php echo $revenue_list[$key]['VALUE']; ?>

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

					<label for="inputTotal staff size" class="control-label" for="inputTotal Staff Size">Total staff size (contributing CPF)</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_staff_size" >

							<?php

								if(isset($total_staff_list) && !empty($total_staff_list)){

									$flag = true;

									$flag_2 = false;

									if( isset($n_staff_size) && !empty($n_staff_size)){

										$flag_2 = true;

									}

									foreach ($total_staff_list as $key => $value) {

										if(!empty($total_staff_list[$key]['VALUE'])){

							?>

								<option value="<?php echo $total_staff_list[$key]['ID_DROPDOWN'] ?>" <?php 
									


									if( $flag_2 && $n_staff_size == $total_staff_list[$key]['ID_DROPDOWN']) {

										echo "selected";
									}
									else{ 

									if($flag) { 
											echo "selected"; $flag = false;}
									} 



									?> > 
									<?php echo $total_staff_list[$key]['VALUE']; ?>

								</option>

							<?php

										}
									}
							} ?>

						</select>

					</div>

				</div>

				<div class="control-group">

					<label for="inputHR staff size" class="control-label">HR staff size</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="n_hr_size" >

							<?php

								if(isset($hr_staff_list) && !empty($hr_staff_list)){

									$flag = true;

									$flag_2 = false;

									if( isset($n_hr_size) && !empty($n_hr_size)){

										$flag_2 = true;

									}

									foreach ($hr_staff_list as $key => $value) {

										if(!empty($hr_staff_list[$key]['VALUE'])){

							?>
								<option

									<?php 
										if($flag) {

											echo "selected"; $flag = false;

										}

										if( $flag_2 && $n_hr_size == $hr_staff_list[$key]['ID_DROPDOWN']){ 

											echo "selected"; $flag = false; 
										}
									?>

										value="<?php 

											echo $hr_staff_list[$key]['ID_DROPDOWN'] 

										?>" >

										<?php echo $hr_staff_list[$key]['VALUE']; ?>

								</option>

							<?php

										}
									}
							} ?>

						</select>

					</div>

				</div>

				<div class="control-group">

					<label for="inputCompany industry" class="control-label">Company industry</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="nm_industry" >

							<?php

								if(isset($company_industry_list) && !empty($company_industry_list)){

									$flag = true;

									$flag_2 = false;

									if( isset($nm_industry) && !empty($nm_industry)){

										$flag_2 = true;

									}

									foreach ($company_industry_list as $key => $value) {

										if(!empty($company_industry_list[$key]['VALUE'])){

							?>

								<option 
									<?php if($flag) {

										echo "selected"; $flag = false;
									} 

									if($flag_2 && $nm_industry == $company_industry_list[$key]['ID_DROPDOWN'])
									{ 
										echo "selected"; $flag = false; 
									} 

									?>

									value="<?php 

										echo $company_industry_list[$key]['ID_DROPDOWN'] 

										?>" >

										<?php 
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

					<label for="inputCompany type" class="control-label">Company type</label>

					<div class="controls">

						<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="nm_type" >

						<?php

								if(isset($company_type_list) && !empty($company_type_list)){

									$flag = true;

									$flag_2 = false;

									if( isset($nm_type) && !empty($nm_type)){

										$flag_2 = true;

									}

									foreach ($company_type_list as $key => $value) {

										if(!empty($company_type_list[$key]['VALUE'])){

							?>
								<option 
									<?php 
										if($flag) { 
											echo "selected"; $flag = false;
										}

										if($flag_2 && $nm_type == $company_type_list[$key]['ID_DROPDOWN']) {
											echo "selected"; $flag = false;
										}

										?>
										value="<?php

											echo $company_type_list[$key]['ID_DROPDOWN'];

										?>" >
										<?php

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

				<div class="form-actions">

					<button type="submit" name="submit" value="NEXT" class="btn_submit">Next</button>
					
				</div>

			</form>
			<!-- / Forms: Form -->           

		</div>
		<!-- / Forms: Content -->

	</div>
	<!-- / Forms: Box -->

</div>
<!-- / Forms -->