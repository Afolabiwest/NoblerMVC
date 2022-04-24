<?php

class ObjectModel {

    private $_model_data;

    public function __call($name, $value = null) {
        if (strpos($name, 'get') === 0) {
            $attribute = substr($name, 3);			
            return $this->_model_data[$attribute];
        } else if (strpos($name, 'set') === 0) {
            $attribute = substr($name, 3);
            $this->_model_data[$attribute] = $value;
        }
    }
}

?>