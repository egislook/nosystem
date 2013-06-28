<?php

    class rout extends main{
        
        public $VMcount = 1;
        public $MAXobjects = 3;                                                 //min 1 object needed for collections
        public $MAXcollections = 1;
        public $requests = array('get');                                        //available requests
        
        public $request = 0;                                                    //request in url
        public $data = 0;                                                       //object data in url
        
        public $collection = 0;
        public $find = array();
        public $collect = array();
    
        function __construct(){
            parent::__construct();
                
            $url = $this->filterGet();
            
            if($url){
                $this->sortUrlToData($url);
                
                if(isset($this->request) && is_array($this->data)){
                    $collect = new collect($this->request, $this->data);
                }
            }
        }
        
//validate get and return it
        function filterGet(){
            
            if(isset($_GET['url'])){
                $url = $_GET['url'];
                $valid = (preg_match("/^[0-9a-zA-Z\/\,\.\:\;]+$/", $url)==1)?true:false;
                if($valid){
                    $this->msg(1, 'valid url', __METHOD__);
                    return $_GET['url'];
                }
                else{
                    $this->msg(0, 'invalid url', __METHOD__);
                    return false;
                }
            }
            else{
                $this->msg(0, 'invalid url', __METHOD__);
                return false;
            }
        }
        
//sort url to array
        function sortUrlToData($url){
            
            
            $url = explode(VM, $url);
            $count = count($url);
            if($count==($this->VMcount+1)){
                foreach($this->requests as $val){
                    if($val==$url[0]){
                        //set to class public request
                        $this->request = $url[0];
                        $this->msg(1, 'valid url {request} structure' , __METHOD__);
                        $objects = string::strExplode(';', $url[1], 3);
                        if(is_array($objects) && count($objects)<=$this->MAXobjects){
                            $data = $this->objToArray($objects);
                            
                            if(is_array($data)){
                                if(count($data[0])<=$this->MAXcollections){
                                    $this->data = $data;
                                    $this->msg(1, 'valid url {data} object structure' , __METHOD__);
                                }
                                else
                                    $this->msg(0, 'invalid url {data} selected collections number : '.$url[1], __METHOD__);
                                //set to class public data
                                
                            }
                            else
                                $this->msg(0, 'invalid url {data} object structure : '.$url[1], __METHOD__);
                        }
                        else
                            $this->msg(0, 'invalid url {data} object structure : '.$url[1].' or to much objects', __METHOD__);
                        
                    }
                    else
                        $this->msg(0, 'invalid url {request} : '.$url[0], __METHOD__);
                }
            }
            else
                $this->msg(0, 'cannot detect {value marker}', __METHOD__);
            
        }
        
//convert url object to array and return it        
        function objToArray($obj){
            foreach($obj as $key=> $val){
                $data = string::strExplode(',', $val);
                if(is_array($data)){
                    foreach($data as $k => $v){
                        $new = string::strExplode(':', $v);
                        if(count($new)>1){
                            $a = $new[0];
                            unset($data[$k]);
                            $data[$a] = $new[1];
                        }
                    }
                    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!ISIEXTRACTINK SMULKIAU KAP REIKIES
                    $objects[$key] = $data;
                }
                else
                    return 0;
            }
            return $objects;
            
        }
    }