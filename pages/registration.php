<?php
$title = 'Registration';
$footer = company_disclaimer;
$content = '
<div class="page-container login-container">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content">
				<form id="registrationform" name="registrationform" action="login.php" method="POST">
					<input type="hidden" name="type" id="type" value="registration">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
							<h5 class="content-group">Create account <small class="display-block">All fields are required</small></h5>
						</div>
						<div class="content-divider text-muted form-group"><span>Your credentials</span></div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Eugene">
							<div class="form-control-feedback">
								<i class="icon-user-check text-muted"></i>
							</div>
							<span class="help-block text-danger"><i class="icon-cancel-circle2 position-left"></i> This username is already taken</span>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Create password">
							<div class="form-control-feedback">
								<i class="icon-user-lock text-muted"></i>
							</div>
						</div>
						<div class="content-divider text-muted form-group"><span>Your privacy</span></div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Your email">
							<div class="form-control-feedback">
								<i class="icon-mention text-muted"></i>
							</div>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Repeat email">
							<div class="form-control-feedback">
								<i class="icon-mention text-muted"></i>
							</div>
						</div>
						<div class="content-divider text-muted form-group"><span>Additions</span></div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled" checked="checked">
									Send me <a href="#">test account settings</a>
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled" checked="checked">
									Subscribe to monthly newsletter
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" class="styled">
									Accept <a href="#">terms of service</a>
								</label>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn bg-teal btn-block btn-lg">Register <i class="icon-circle-right2 position-right"></i></button>
						</div>
						<div class="text-center">
							<a href="index.php?page=login">Back to login</a>
						</div>
					</div>
				</form>
				<div class="footer text-muted">
				'.$footer.'
				</div>
			</div>
		</div>
	</div>
</div>
';
?>