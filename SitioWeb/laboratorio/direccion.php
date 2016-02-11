<?php
	system("gpio -g mode 12 out");
	system("gpio -g write 12 1");
	system("gpio -g write 12 0");
?>
