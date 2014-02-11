<?php
	if( isset($_POST['email']) ) {
	
		clearstatcache(); 
		$logname = $_ENV["OPENSHIFT_DATA_DIR"].'/cameleon/emails.txt';
		if(!file_exists($logname)) 
		{ 
		   $fp = fopen($logname,"w");  
		   fwrite($fp,"0");  
		   fclose($fp); 
		}
		
		$email = htmlentities(strip_tags($_POST['email']));
	 
		$logcontents = file_get_contents($logname);
	 
		if(strpos($logcontents,$email)) {
			die('You are already subscribed.');
		} else {
			$filecontents = $email.',';
			$fileopen = fopen($logname,'a+');
			$filewrite = fwrite($fileopen,$filecontents);
			$fileclose = fclose($fileopen);
			if(!$fileopen or !$filewrite or !$fileclose) {
				die('Error occured');
			} else {
				echo 'Your email has been added.';
			}
		}	
	}
	else {
		die('No email set.');
	}
?>




