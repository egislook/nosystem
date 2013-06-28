<?php
    
    
    class string{
        
    
        public static function strExplode($separator, $string, $req=0){
            
            $length = strlen($string);
            if($length>2){
                $array = explode($separator, $string);
                
                foreach($array as $val){
                    if(strlen($val)<1)
                        return 0;
                }
            
                return $array;
            }
            else if($length>0 && $length<3){
                $valid = (preg_match("/^[0-9a-zA-Z]+$/", $string)==1)?true:false;
                if($valid){
                    $array[0] = $string;
                    return $array;
                }
                else{
                    return 0;
                }
            }
            else
                return 0;
                
            
            
        }
    }