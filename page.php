<?php

if(uac == true)
{
	$page = '
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4>'.$page_title.'</h4>
						</div>
						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="index.php?page=home" class="btn btn-link btn-float has-text"><i class="fa fa-home text-primary" style="font-size:18px"></i> <span>Home</span></a>
								<a href="index.php?page=help" class="btn btn-link btn-float has-text"><i class="fa fa-book text-primary" style="font-size:18px"></i> <span>Help</span></a>
								<a href="index.php?page=archive" class="btn btn-link btn-float has-text"><i class="fa fa-archive text-primary" style="font-size:18px"></i> <span>Archive</span></a>
							</div>
						</div>
					</div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">';
							if(sizeof($page_crumbs) > 0)
								$page .= '<li><a href="'.$page_crumbs[0][0].'"><i class="icon-home2 position-left"></i> '.$page_crumbs[0][1].'</a></li>';
							for($x = 1; $x < sizeof($page_crumbs); $x++)
								$page .= '<li class="active">'.$page_crumbs[$x].'</li>';
						$page .= '
						</ul>
						<ul class="breadcrumb-elements">
							<li><a href="index.php"><i class="fa fa-comments-o position-left"></i> Support</a></li>
							<li><a href="index.php"><i class="fa fa-magic position-left"></i> Bulk action</a></li>
							<li class="dropdown">
								<a href="index.php" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-gear position-left"></i>
									Settings
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="index.php"><i class="icon-user-lock"></i> Account security</a></li>
									<li><a href="index.php"><i class="icon-statistics"></i> Analytics</a></li>
									<li><a href="index.php"><i class="icon-accessibility"></i> Action log</a></li>
									<li class="divider"></li>
									<li><a href="logout.php"><i class="icon-lock"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div class="content">
					<div class="row">
					'.$content.'
					</div>
				</div>
			</div>
		</div>
	</div>
	';
}
else
	$page = $content;

$page = '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>'.company_name.' | '.$title.'</title>

	<meta name="description" content="Here on this login page you can login or register a new account or recover forgot password just click below.">
	<meta name="keywords" content="account, enter, below, credentials, click, login, password, new, register, forgot">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 Week">
	<meta name="author" content="'.company_name.'">
	<meta name="copyright" content="ARR - '.company_name.'">
	<meta name="distribution" content="global">
	<meta name="language" content="EN">
	<meta name="rating" content="general">
	<meta name="generator" content="'.company_name.'">
	
	<meta name="pingerprint" content="'.generateHash(16).'">
	
	<!-- Global stylesheets -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/icons/icomoon/styles.css">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/icons/fontawesome/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/minified/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/minified/core.min.css">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/minified/components.min.css">
	<link rel="stylesheet" type="text/css" href="'.sys_path.'data/themes/backend/default/assets/css/minified/colors.min.css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/visualization/echarts/echarts.js"></script>

	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/core/app.js"></script>
	
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/forms/styling/switch.min.js"></script>
	
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/pages/radios.js"></script>
	<script type="text/javascript" src="'.sys_path.'data/themes/backend/default/assets/js/pages/multiselect.js"></script>
	<!-- /theme JS files -->
	
</head>
<body>
	'.$page.'
</body>
</html>
';

?>