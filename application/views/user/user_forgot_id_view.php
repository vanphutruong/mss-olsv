<form class="" id="osa_forgot_id" action="<?php echo site_url('users/send_mail_contain_id') ; ?>" method="post">
	
	<div class="wrapper_form">

		<div class="control-group">

		    <div class="controls">

		    	<input type="email" placeholder="Email" id="TX_USEREMAIL" name="TX_USEREMAIL" value="<?php
		    		if(isset($this->session->userdata['TX_USEREMAIL']) && !empty($this->session->userdata['TX_USEREMAIL'])) {

		    			echo $this->session->userdata['TX_USEREMAIL'];
		    			
		    		}
		    	?>" autocomplete="off">

		    </div>

		</div>

		<div class="control-group">

			<div class="controls">

			    <button id="osa_forgot_id_submit" type="submit" class="btn_login">Confirm</button>	

			</div>

			<ul class="controls_forgot">

			    <li>

			    	<a href="<?php echo site_url('users/login'); ?>" title="ack To Login Page">Back To Login Page</a><br>

			    </li>

			</ul>

		</div>

	</div>

</form>