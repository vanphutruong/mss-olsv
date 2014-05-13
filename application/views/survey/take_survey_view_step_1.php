<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<h3>Take Survey - Select Company</h3>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('survey/search/take/company') ; ?>" method="post" class="form-horizontal">
				
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
								<th>Survey Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if(isset($result_search))
								foreach ($result_search as $key => $value) {

							?>
										<tr class="gradeC">
											<td><?php echo $key + 1; ?></td>
											<td><a href="<?php echo site_url('survey/take_survey/'. $value['nm_company']);  ?>" ><?php echo $value['nm_company'];?></a></td>
											<td><?php echo $value['tx_status'];?></td>
										</tr>

							<?php
										}
								}
								else
								{

							?>
							<div class="accordion-inner">
								<p>
									<?php echo "Company have not found";?>
								</p>
							</div>
							<?php
								}
							}
							else
							{

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