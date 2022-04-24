<?php

class Context implements ArrayAccess{

	/* 
	$user =  Context::getInstance()->user;
	echo $user->email;
	*/
	
	public $user 		= [];
	
	public function __construct($arrayReturn = false) {
        $this->user = json_decode(json_encode(getSession('user')), $arrayReturn);
    }
	
	public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
	
	public static function getInstance(){
		return new Context();
	}

}

?>