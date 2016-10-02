<?php
$title = 'Recovery';
$footer = company_disclaimer;
$content = '
<div class="page-container login-container">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content">
				<form id="recoveryform" name="recoveryform" action="login.php" method="POST">
					<input type="hidden" name="type" id="type" value="recovery">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
							<h5 class="content-group">Password recovery <small class="display-block">We will send you instructions in email</small></h5>
						</div>
						<div class="form-group has-feedback">
							<input type="email" class="form-control" placeholder="Your email">
							<div class="form-control-feedback">
								<i class="icon-mail5 text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn bg-blue btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
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