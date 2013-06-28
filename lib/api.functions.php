<?php

//store msg to $GLOBALS['MSG'] and return data
    function msg($done, $msg='no message', $part='main', $in='unknown', $enabled=1){
        if($enabled){
            $data = array('done' => $done, 'msg' => $msg, 'in' => $in);
            $GLOBALS['MSG'][$part] = $data;
            return $data;
        }
    }
    
    function dump($data, $deep=0){
        $tab = '   ';
        $space = '';
        $strCol = '#cc0000';
        $keyCol = '#13489E';
        $arowCol = '#888a85';
        
        for($i=0; $i<$deep; $i++){
            $space = $space.$tab;
        }
        
        if($deep==0)
            echo('<pre>-------------------------------------------------------------</br>');
        else
            echo('<pre>');
        if(isset($data)){
            if(is_array($data)){
                $keys = array_keys($data);
                foreach($keys as $k){
                    if(is_array($data[$k])){
                        echo($space.'<b>(array)</b> <font color="'.$keyCol.'">'.$k.'</font> => <b>{</b>');
                        dump($data[$k], $deep+1);
                        echo($space.'<b>}</b></br>');
                    }
                    else
                        echo($space.'<small>(string)</small> <font color="'.$keyCol.'">['.$k.']</font> => <font color="'.$strCol.'">'.$data[$k].'</font></br>');
                    
                }
                
            }   
            else
                echo('(string) => <font color="'.$strCol.'">'.$data.'</font></br>');
        }
        
        if($deep==0)
            echo('-------------------------------------------------------------</pre>');
        else
            echo('</pre>');
    }