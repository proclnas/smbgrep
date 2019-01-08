<?php

namespace SmbGrep;

use Icewind\SMB\Server;

class SmbGrep {
    /**
     * Host (Local ip)
     * @var string
     */
    protected $host;

    /**
     * Smb user
     * @var string
     */
    protected $user;

    /**
     * User password
     * @var string
     */
    protected $password;

    /**
     * Connected server
     * @var Icewind\SMB\Server
     */
    protected $server;

    /**
     * @param string $host     Smb host
     * @param string $user     Smb user
     * @param string $password Smb password
     */
    public function __construct($host, $user, $password) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Monitore smb I/O
     * @return void
     */
    public function smbMon($folder, \Closure $notifyCallback = null) {
        $share = $this->server->getShare($folder);
        $share->notify('')->listen(function (\Icewind\SMB\Change $change) use ($notifyCallback) {

            if (is_null($notifyCallback)) {
                echo $change->getCode() . ': ' . $change->getPath() . "\n";
                return;
            }

            call_user_func_array($notifyCallback, [$change->getCode(), $change->getPath()]);
        });
    }

    /**
     * Auth
     * @return void
     */
    public function auth() {
        try {
            if(!$this->server = new Server($this->host, $this->user, $this->password)) {
                Throw new \Exception('Error on auth: Unable to create Server instance' . PHP_EOL);
            }
        } catch (\Exception $e) {
            fwrite(STDOUT, sprintf('[-] %s' . PHP_EOL, $e->getMessage()));
        }
    }
}