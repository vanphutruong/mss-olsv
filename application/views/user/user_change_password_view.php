<form class="" id="osa_change_password" action="<?php echo site_url('users/change_password') ; ?>" method="post">
	
	<div class="wrapper_form">

		<div class="control-group">

		    <div class="controls">

		    	<input type="text" placeholder="Username" id="ID_LOGIN" name="ID_LOGIN" value="<?php
		    		if(isset($this->session->userdata['ID_LOGIN']) && !empty($this->session->userdata['ID_LOGIN'])) {
		    			echo $this->session->userdata['ID_LOGIN'];
		    		}
		    	?>" autocomplete="off" readonly>

		    </div>

		</div>

		<div class="control-group">

		    <div class="controls">

		    	<input type="password" placeholder="Password" id="TX_SECURITY_CODE" name="TX_SECURITY_CODE" value="<?php
		    		if(isset($this->session->userdata['TX_SECURITY_CODE']) && !empty($this->session->userdata['TX_SECURITY_CODE'])) {
		    			echo $this->session->userdata['TX_SECURITY_CODE'];
		    		}
		    	?>" autocomplete="off" readonly>

		    </div>

		</div>

		<div class="control-group">

		    <div class="controls">

		    	<input type="password" placeholder="New Password" id="NEW_PASSWORD" name="NEW_PASSWORD" value="<?php
		    		if(isset($this->session->userdata['NEW_PASSWORD']) && !empty($this->session->userdata['NEW_PASSWORD'])) {

		    			echo $this->session->userdata['NEW_PASSWORD'];

		    		}
		    	?>">

		    </div>

		</div>

		<div class="control-group">

		    <div class="controls">

		    	<input type="password" placeholder="Confirm Password" id="CONFIRM_NEW_PASSWORD" name="CONFIRM_NEW_PASSWORD" value="<?php
		    		if(isset($this->session->userdata['CONFIRM_NEW_PASSWORD']) && !empty($this->session->userdata['CONFIRM_NEW_PASSWORD'])) {

		    			echo $this->session->userdata['CONFIRM_NEW_PASSWORD'];
		    			
		    		}
		    	?>">

		    </div>

		</div>

		<div class="control-group">

			<div class="controls">

		    	<button id="osa_change_password_submit" type="submit" class="btn_login">Confrim</button>

			</div>

			<ul class="controls_forgot">

			    <li>

			    	<a href="<?php echo site_url('users/login'); ?>" title="Login">Back to login</a>

			    </li>

			</ul>

		</div>

	</div>

</form>