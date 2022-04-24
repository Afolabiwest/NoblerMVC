<?php

class DefaultSessionHandler implements SessionHandlerInterface
{
    private $savePath;
	
	public function __construct( $savePath = '' ){
		/* 
		$this->savePath = ini_get( 'session.save.path' );
		if( $savePath = '' ){
			$this->savePath = $savePath;
		} 
		*/
		
		$this->savePath = $savePath;
	}

    public function open($savePath, $sessionName): bool
    {
        $this->savePath = $savePath;
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }

        return true;
    }

    public function close(): bool
    {
        return true;
    }

    #[ReturnTypeWillChange]
    public function read($id)
    {
        return (string)AESDecrypt( @file_get_contents( "{$this->savePath}/sess_{$id}" ), config('sitekey') );
    }

    public function write($id, $data): bool
    {
        return file_put_contents("{$this->savePath}sess_{$id}", AESEncrypt( $data, config('sitekey') ) ) === false ? false : true;
    }

    public function destroy($id): bool
    {
        $file = "{$this->savePath}/sess_{$id}";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    #[ReturnTypeWillChange]
    public function gc($maxlifetime)
    {
        foreach (glob("{$this->savePath}/sess_*") as $file) {
            if (filemtime($file) + $maxlifetime < time() && file_exists($file)) {
                unlink($file);
            }
        }

        return true;
    }
}

?>