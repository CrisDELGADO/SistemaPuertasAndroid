<?php
	system("gpio -g mode 16 out");
	system("gpio -g write 16 1");
	system("gpio -g write 16 0");
?>
