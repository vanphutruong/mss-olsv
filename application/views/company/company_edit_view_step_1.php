<!-- Forms -->
<div class="row-fluid form-create">

	<!-- Forms: Box -->
	<div class="span12">

		<h3>Edit Company Profile</h3>

		<!-- Forms: Content -->
		<div class="well no-padding">

			<!-- Forms: Form -->
			<form action="<?php  echo site_url('company/search/edit') ; ?>" method="post" class="form-horizontal">
				
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
						<button type="submit" name="SEARCH" value="SEARCH" class="btn_submit">Search</button>
					</div>
				</div>
				<table class="data-table">
						<?php
							if (isset($result_search)) {
							 
								if (!empty($result_search)) 
								{?>
						<thead>
							<tr>
								<th>S/No</th>
								<th>Company ID</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// if (isset($result_search)) {
							 
							// 	if (!empty($result_search)) 
							// 	{
									foreach ($result_search as $key => $value){
							?>

										<tr class="gradeC">
											<td><?php echo $key+1;?></td>
											<td><a href="<?php  echo site_url('company/edit/'.$value['ID_COMPANY'].'') ; ?>" title=""><?php echo $value['NM_COMPANY'];?></a></td>
										</tr>
							<?php
										}
								}
								else
								{

							?>
							<div class="accordion-inner">
								<p>
									<?php echo "The company had not found";?>
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