<?php
	session_start();
	include "application/language/all.php";
	$lng = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
	if (file_exists("../install/config-setup.php")) { unlink ("../install/config-setup.php"); }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="apple-mobile-web-app-title" content="Bugs">
		<link rel="icon" type="image/ico" href="<?php echo URL::to_asset('/favicon.ico');?>">
		<meta name="msapplication-TileColor" content="#39404f">
		<meta name="msapplication-TileImage" content="<?php echo URL::to_asset('/mstile-144x144.png');?>">
		<meta name="application-name" content="<?php Config::get('my_bugs_app.name'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title><?php echo Config::get('application.my_bugs_app.name'); ?></title>
		<?php echo Asset::styles(); ?>
	</head>
<body>
	<div id="container">
		<div id="login">

			<h1><span id="span_Welcome"><?php echo (isset($Welcome[$lng])) ? $Welcome[$lng] : $Welcome["en"]; ?></span><br><img src="<?php echo URL::to_asset('app/assets/images/layout/tinyissue.svg');?>" alt="<?php echo Config::get('application.my_bugs_app.name'); ?>" style="width:350px;;"></h1>
			<form method="post">


				<table class="form" >
					<tr>
						<td colspan="2" style="color: #a31500;">
							<?php 
								if (Session::get('error') !== NULL) { echo (isset($WrongPwd[$lng])) ? $WrongPwd[$lng] : $WrongPwd["en"]; }
							?>
						</td>
					</tr>
					<tr><th colspan="2" id="th_Title"><?php echo (isset($Title[$lng])) ? $Title[$lng] : $Title["en"]; ?></th></tr>
					<tr>
						<th><label for="email" id="label_Email"><?php echo (isset($Email[$lng])) ? $Email[$lng] : $Email["en"]; ?></label></th>
						<td><input type="text" id="input_Email" name="email" id="email" autofocus value="<?php echo @$_SESSION["usr"]; ?>" /></td>
					</tr>
					<tr>
						<th><label for="password" id="label_Password"><?php echo (isset($Password[$lng])) ? $Password[$lng] : $Password["en"]; ?></label></th>
						<td><input type="password" id="password" name="password" value="<?php echo @$_SESSION["psw"]; ?>" /></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<label><input type="checkbox" value="1" name="remember" /><span id="span_Remember"><?php echo (isset($Remember[$lng])) ? $Remember[$lng] : $Remember["en"]; ?>&nbsp;? &nbsp;&nbsp;</span></label>
							<input type="submit" id="input_submit" value="<?php echo (isset($Login[$lng])) ? $Login[$lng] : $Login["en"]; ?>" class="button primary"/>
						</td>
					</tr>
				</table>

				<?php echo Form::hidden('return', Session::get('return', '')); ?>
				<?php echo Form::token(); ?>
			</form>
		</div>
		<div style="text-align:center; padding-top: 50px;">
		<select name="ChxLng" id="select_ChxLng" onchange="ChgLng(this.value);">
			<?php
				foreach ($Language as $ind => $val) {
					echo '<option value="'.$ind.'" '.(($ind == $lng) ? 'selected="selected"' : '').'>'.$val.'</option>';
				}
			?>
		</select>
		</div>
	</div>
</body>

<?php unset ($_SESSION["Msg"],$_SESSION["psw"],$_SESSION["usr"]) ?>
<?php echo Asset::scripts(); ?>
<script type="text/javascript">
var values = new Array();
<?php
	foreach ($Language as $ind => $val) {
		echo 'values["'.$ind.'"] = new Array(); ';
		echo 'values["'.$ind.'"]["Email"] = "'.$Email[$ind].'";
		';
		echo 'values["'.$ind.'"]["Login"] = "'.$Login[$ind].'";
		';
		echo 'values["'.$ind.'"]["Password"] = "'.$Password[$ind].'";
		';
		echo 'values["'.$ind.'"]["Remember"] = "'.$Remember[$ind].'";
		';
		echo 'values["'.$ind.'"]["Title"] = "'.$Title[$ind].'";
		';
		echo 'values["'.$ind.'"]["Welcome"] = "'.$Welcome[$ind].'";
		';
	}
?>
function ChgLng(Lng) {
		document.getElementById('label_Email').innerHTML =  values[Lng]["Email"];
		document.getElementById('input_submit').value =  values[Lng]["Login"];
		document.getElementById('label_Password').innerHTML =  values[Lng]["Password"];
		document.getElementById('span_Remember').innerHTML =  values[Lng]["Remember"];
		document.getElementById('th_Title').innerHTML =  values[Lng]["Title"];
		document.getElementById('span_Welcome').innerHTML =  values[Lng]["Welcome"];
}
</script>
</html>
