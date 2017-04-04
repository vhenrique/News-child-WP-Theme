<?php 
	require_once("../../../../wp-load.php");
	header ( "Content-type: application/vnd.ms-excel" );
	header ( "Content-Disposition: attachment; filename=Assinantes-".date('d-m-Y').".xls" );
	global $themePrefix; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Export</title>
</head>
<body>
	<?php 
		$users = get_users( array(
			'meta_key'		=> $themePrefix . 'newsletter',
			'meta_value'	=> 'on'
			)
		);
		echo '<table><tr><th>Nome</th><th>Email</th></tr>';
		foreach ($users as $user) {
			echo '<tr><td>'.$user->display_name.'</td><td>'.$user->user_email.'</td></tr>';
		}
		echo '</table>';
	?>
</body>
</html>