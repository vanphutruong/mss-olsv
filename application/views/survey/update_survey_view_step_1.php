<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">
		
		<h3>Update Survey Responses - Select Company</h3>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('survey/search/update/company') ; ?>" method="post" class="form-horizontal">
				
				<div class="control-group">
					<label class="control-label" for="NM_COMPANY">Company ID</label>
					<div class="controls">
						<input type="text" id="NM_COMPANY" required pattern=".{1,50}" class="span6 m-wrap" name="NM_COMPANY" value="<?php 
						if(!empty($data_search['NM_COMPANY'])) 
							echo $data_search['NM_COMPANY'];
						else 
						{
						 	
						 } ?>">
					</div>
				

					<div class="form-actions">
						<button type="submit" class="btn_submit">Search</button>
					</div>
				</div>
				<table class="data-table">
					<?php 
							if (isset($result_search)) {
								
								if (!empty($result_search)) 
								{
					?>				
						<thead>
							<tr>
								<th>S/No</th>
								<th>Company ID</th>
								<th>Designation</th>
								<th>Revenue size</th>
								<th>Total staff size</th>
								<th>Hr staff size</th>
								<th>Company industry</th>
								<th>Overall HRMM Maturity Level points</th>
								<th>Survey Completion date</th>
								<th>Consultant ID</th>
							</tr>
						</thead>
						<tbody>
								<?php 
								if(isset($result_search))
									foreach ($result_search as $key => $value) {
								?>
											<tr class="gradeC">
												<td><?php echo $key + 1; ?></td>
												<td><a href="<?php echo site_url('survey/update_survey/'. $value['NM_COMPANY'])  ?>" ><?php echo $value['NM_COMPANY'];?></a></td>
												<td><?php echo $value['NM_DESIGNATION'];?></td>
												<td><?php echo $value['REVENUE'];?></td>
												<td><?php echo $value['TOTAL_STAFF'];?></td>
												<td><?php echo $value['HR_STAFF'];?></td>
												<td><?php echo $value['INDUSTRY'];?></td>
												<td><?php echo $value['HRMM_LEVEL'];?></td>
												<td><?php if(isset($value['DT_SURVEY_COMPLETE'])) echo $value['DT_SURVEY_COMPLETE'];?></td>
												<td><?php echo $value['ID_CONSULTANT'];?></td>
											</tr>

								<?php
									}
								}
								else
								{

							?>
							<div class="accordion-inner">
								<p>
									<?php  echo "Company have not found";?>
								</p>
							</div>
							<?php
								}
							}
							else
							{
							?>
								<div class="accordion-inner">
									<p>
										<?php  echo "Company have not found";?>
									</p>
								</div>
							<?php
							}
							?>
						</tbody>
				</table>	
			</form>
			<!-- / Forms: Form -->           

		</div>
		<!-- / Forms: Content -->

	</div>
	<!-- / Forms: Box -->

</div>
<!-- / Forms -->