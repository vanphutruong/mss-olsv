<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<!-- Forms: Top Bar -->
		<div class="top-bar">
			<h4>Report</h4>
		</div>
		<!-- / Forms: Top Bar -->

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('report/search/company') ; ?>" method="post" class="form-horizontal">
				
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
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</div>
				<table class="data-table">
						<?php
							if (isset($result_search)) {
							 
								if (!empty($result_search)) 
								{?>
						<thead>
							<tr>
								<th style="text-decoration:underline;">S/No</th>
								<th style="text-decoration:underline;">Company ID</th>
								<th style="text-decoration:underline;">Survey Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
									foreach ($result_search as $key => $value){
							?>

										<tr class="gradeC">
											<td><?php echo $key+1;?></td>
											<td><?php echo $value['NM_COMPANY'];?></td>
											<td><?php echo $value['TX_STATUS'];?></td>
											<td>

												<a href="<?php  echo site_url('report/generate_report');echo '/';echo($value['ID_COMPANY']); ?>"><button type="button" name="id_company" id="report" value="" class="btn btn-primary">Generate Report</button></a>
												
											</td>
										</tr>
							<?php
										}
								}
								else
								{

							?>
							<div class="accordion-inner">
								<p>
									<?php echo "Company have not fond";?>
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