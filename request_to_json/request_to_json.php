<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
	if (isset($_REQUEST)){
		print_r($_REQUEST);
		print("<br><br>");
		foreach ($_REQUEST as $key => $value){
			echo $key."============".$value."<br>";
		}
		$json="{";
		foreach ($_REQUEST as $key => $value){
			$json.= '"'.$key.'": '.'"'.$value.'", ';
		}
		$json=substr($json, 0, strlen($json)-2) ."}";
		echo $json."<br><br>";
		
		
		$form='"';
		foreach ($_REQUEST as $key => $value){
			$form.= urlencode($key).'='.urlencode($value)."&";
		}
		$form=substr($form, 0, strlen($form)-1).'"';
		echo $form."<br><br>";
	}
?>
</body>
</html>