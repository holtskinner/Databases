<html>
	<body>
		<?php
			if(mail('jdhcp3@mail.missouri.edu', 'Test Email', 'Test')){
				echo "mailed";
			}
			else {
				echo "not mailed";
			}
			echo phpinfo();
		?>
	</body>
</html>
