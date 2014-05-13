<h3>HUMAN RESOURCE MATURITY MODEL (HRMM) V3.1</h3>

<p class="company_detail">A Seft-Diagnostics Survey for Singapore SMEs</p>

<form class="" id="osa_login" action="<?php echo site_url('users/check_login') ; ?>" method="post">
	
	<div class="wrapper_form">

		<div class="control-group">
			
		    <div class="controls">

		    	<input type="text" placeholder="Username" id="ID_LOGIN" name="ID_LOGIN" value="<?php
		    		if(isset($this->session->userdata['ID_LOGIN']) && !empty($this->session->userdata['ID_LOGIN'])) {

		    			echo $this->session->userdata['ID_LOGIN'];
		    			
		    		}
		    	?>" autocomplete="off" required>

		    </div>

		</div>

		<div class="control-group">

		    <div class="controls">

		    	<input type="password" placeholder="Password" id="EN_PASSWORD" name="EN_PASSWORD" value="<?php
		    		if(isset($this->session->userdata['EN_PASSWORD']) && !empty($this->session->userdata['EN_PASSWORD'])) {

		    			echo $this->session->userdata['EN_PASSWORD'];

		    		}
		    	?>" autocomplete="off" required>

		    </div>

		</div>

		<div class="control-group">

			<div class="controls">

		    	<button id="osa_login_submit" type="submit" class="btn_login">Login</button>
		    	
			</div>

			<ul class="controls_forgot">

			    <li>

			    	<a href="<?php echo site_url('users/forgot_password'); ?>" title="Forget password">Forget Password</a><br>

			    </li>

			    <li>

			    	<a href="<?php echo site_url('users/forgot_id') ; ?>" title="Forget Login ID">Forget Username</a>

			    </li>

			</ul>

		</div>

	</div>

</form>