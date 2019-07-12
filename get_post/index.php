<!DOCTYPE html>
<html>
<body>
<pre>
<?PHP
	$file_name = "log.txt";
	$separator = "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";	// separates between entries(requests at different times) in a file
	$url = isset($_SERVER['HTTPS'])?"https":"http" . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	// complete URL
	$initiate = 0;	// just to track if the get or post is available and is written to file
	// can append all the output to single string and then print and write in the file at the end. This way used to see output all along
	
	
	$write_to = fopen($file_name, "a");
	
	// write date and url
	fwrite($write_to, date("Y-m-d h:i:sa") . "    $url\n\n");
	print(date("Y-m-d h:i:sa") . "    $url\n\n");
	
	// write all the GET data
	foreach ($_GET as $key => $value){
		if ($initiate==0){	// means there is get request and this is the first one
			$initiate=1;
			fwrite($write_to, "\tGET   (key => value)\n\t--------------------\n");
			print("\tGET   (key => value)\n\t--------------------\n");
		}
		fwrite($write_to, print_r($key,true) . "   =>   " . print_r($value, true) . "\n");
		print(print_r($key,true) . "   =>   " . print_r($value, true) . "\n");
		// can use json too for more lovely way.
//		fwrite($write_to, json_encode($key) . "   =>   " . json_encode($value) . "\n");
//		print(json_encode($key) . "   =>   " . json_encode($value) . "\n");
	}
	
	if ($initiate == 1) {	// since there were some GET, lets skip a line and reset initiator
		$initiate=0;
		fwrite($write_to, "\n");
		print("\n");
	}
	
	// write all the POST data
	foreach ($_POST as $key => $value){
		if ($initiate==0){
			$initiate=1;
			fwrite($write_to, "\tPOST   (key => value)\n\t---------------------\n");
			print("\tPOST   (key => value)\n\t---------------------\n");
		}
		fwrite($write_to, print_r($key,true) . "   =>   " . print_r($value, true) . "\n");
		print(print_r($key,true) . "   =>   " . print_r($value, true) . "\n");
//		fwrite($write_to, json_encode($key) . "   =>   " . json_encode($value) . "\n");
//		print(json_encode($key) . "   =>   " . json_encode($value) . "\n");
	}
	if ($initiate == 1) {
		fwrite($write_to, "\n");
		print("\n");
	}
	
	fwrite($write_to, "$separator\n\n");
	print("$separator\n\n");

	fclose($write_to);
?>
</pre>
</body>
</html>