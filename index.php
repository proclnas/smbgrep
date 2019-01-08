<?php

require_once __DIR__ . '/vendor/autoload.php';

use SmbGrep\SmbGrep;

try {

	$smb = new SmbGrep($server, $domainAndUser, $password);
	$smb->auth();

	echo $smb->smbMon($folder, function($code, $path) {
		echo $path . PHP_EOL;
	});

	ob_end_flush();
} catch (Exception $e) {
	echo sprintf('[-] %s:%s' . PHP_EOL, $mail, $password);
}
