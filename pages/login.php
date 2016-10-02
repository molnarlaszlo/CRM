<?php
$title = 'Login';
$footer = company_disclaimer;
$content = '
<div class="page-container login-container">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content">
				<form id="loginform" name="loginform" action="login.php" method="POST">
					<input type="hidden" name="type" id="type" value="login">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Username" name="i1" id="i1">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control" placeholder="Password" name="i2" id="i2" autocomplete="off">
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
						</div>
						<div class="text-center">
							<a href="index.php?page=recovery">Forgot password?</a>
						</div>
						<div class="text-center">
							<a href="index.php?page=registration">New here? Click here to register.</a>
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