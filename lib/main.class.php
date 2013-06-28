<?php

    class main{
        
        private $name;
    
        function __construct(){
            
            $this->name = get_called_class();
        }
        
        function msg($done, $msg, $method='unknown'){
            msg($done, $msg, $this->name, $method);
        }
        
    }