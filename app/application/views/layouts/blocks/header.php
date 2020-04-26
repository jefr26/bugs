<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-title" content="Bugs">
		<link rel="icon" type="image/ico" href="<?php echo URL::to_asset('/favicon.ico');?>">
		<meta name="msapplication-TileColor" content="#39404f">
		<meta name="msapplication-TileImage" content="<?php echo URL::to_asset('/mstile-144x144.png');?>">
		<meta name="application-name" content="<?php Config::get('my_bugs_app.name'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title><?php echo Config::get('application.my_bugs_app.name'); ?></title>
		<script>
			var siteurl = '<?php echo URL::to(); ?>';
			var current_url = '<?php echo URL::to(Request::uri()); ?>';
			var baseurl = '<?php echo URL::base(); ?>';
		</script>
		<?php echo Asset::styles(); ?>
		<?php echo Asset::scripts(); ?>
		<?php
//Patrick, il faudra retirer cette protection temporaire
//Il faut pourtant trouver un moyen de connaître l'état « En ligne » ou « Hors ligne » de l'utilisateur.
$EnLigne = false;
			if (date("Y-m-d", fileatime ("../install/get_updates_list")) != date("Y-m-d") && $EnLigne) {
				include "../app/application/libraries/checkVersion.php";
				$Etat =  ($verActu == $verNum) ? '' :  $styleAdmin = 'class=".blink_me" style="color: yellow; text-decoration: underline wavy red; " ';
				file_put_contents ("../install/get_updates_list", $Etat);
			}
			$styleAdmin = file_get_contents ("../install/get_updates_list");

			$wysiwyg = Config::get('application.editor');
			if (trim($wysiwyg['BasePage']) != '') {
				if (file_exists($wysiwyg['directory'].'/Bugs_code/header.php')) { include_once $wysiwyg['directory'].'/Bugs_code/header.php'; }
				if (substr($wysiwyg['BasePage'], -2) == 'js') { echo '<script src="'.URL::base().$wysiwyg['BasePage'].'"></script>'; }
				if (substr($wysiwyg['BasePage'], -3) == 'php') { include $wysiwyg['BasePage']; }
			}
			$RepInstalled = false;
		?>
	</head>
<body>

	<div id="container">
		<div id="header">
			<a href="<?php echo URL::to(); ?>" class="logo" title="<?php echo  Config::get('application.my_bugs_app.name') ?>" ></a>
			<div class="logoVersion" id="logo_version" >version: 
			<?php 
				if ($styleAdmin != '') { echo '<a href="administration" id="aLogoVersion"> '; } 
				echo  Config::get('tinyissue.version').Config::get('tinyissue.release'); 
				if ($styleAdmin != '') { echo '</a>'; } 
			?>
			</div>

			<nav class="nav">
				<li>
					<ul>
						<li class="dashboard <?php echo $active == 'dashboard' ? 'active' : ''; ?>"><a href="<?php echo URL::to(); ?>"><?php echo __('tinyissue.dashboard');?></a></li>
						<li class="issues <?php echo $active == 'issues' ? 'active' : ''; ?>"><a href="<?php echo URL::to('user/issues'); ?>"><?php echo __('tinyissue.your_issues');?></a></li>
						<li class="todo <?php echo $active == 'todo' ? 'active' : ''; ?>"><a href="<?php echo URL::to('todo'); ?>"><?php echo __('tinyissue.your_todos');?></a></li>
						<li class="projects <?php echo $active == 'projects' ? 'active' : ''; ?>"><a href="<?php echo URL::to('projects'); ?>"><?php echo __('tinyissue.projects');?></a></li>
					</ul>
				</li>
 			</nav>

			<nav class="nav-right">
				<ul>
					<li><?php echo __('tinyissue.welcome');?>, <a href="<?php echo URL::to('user/settings'); ?>" class="user"><?php echo Auth::user()->firstname; ?></a></li>
					<li class="reports <?php echo $active == 'repprts' ? 'active' : ''; ?>"><a href="<?php echo URL::to('projects/reports'); ?>" "><?php echo __('tinyissue.report');?></a></li>
					<?php if(Auth::user()->permission('administration')): ?>
					<li><a href="<?php echo URL::to('administration/users'); ?>"><?php echo __('tinyissue.users');?></a></li>
					<li><a href="<?php echo URL::to('administration'); ?>" <?php echo $styleAdmin; ?>><?php echo __('tinyissue.administration');?></a></li>
					<?php endif; ?>
					<li class="logout"><a href="<?php echo URL::to('user/logout'); ?>"><?php echo __('tinyissue.logout');?></a></li>
				</ul>
			</nav>

		</div>
<div style="clear:both;"></div>
		<div id="main">
			<div id="sidebar">
				<div class="inside">
					<?php echo $sidebar; ?>
				</div>
			</div> <!-- end sidebar -->
			<div id="content">
				<div class="inside">
