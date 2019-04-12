SmbGREP
--

*Smbgrep* is a simple smb file monitor.

PreRequisites:
- PHP >= 5.3
- smblib (The magic)

Features:
- Check for I/O modifications (Notify)

#### Example - Monitore new files
```php
<?php

include __DIR__ . '/vendor/autoload.php';

use SmbGrep\SmbGrep;

try {
	$smb = new SmbGrep('SERVER', 'DOMAIN/user', 'password');
	$smb->auth();
	echo $smb->smbMon('PATH', function($code, $path) {
		// Work with result
	});
} catch (Exception $e) {
	exit($e->getMessage());
}

```

Todo:
- UnitTests
- Improve path manipulation
- New Features: Upload/download via smb (This list will grow soon)

Contribute:
```
Feel free to contribute, open a pull request with the request, keeping the branch name as the feature name or open a issue to suggest.

Contact:
- proclnas@gmail.com
```