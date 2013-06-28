<?php
    class collect extends main{
        
        public $error = 0;
        public $collection = 'common';
        public $access = 'public';
        
        function __construct($request, $data){
            $this->db = new db();
            $this->db->display =0;
            $collection = $this->checkCollection($data);
            if($collection!=='common' && $collection){
                $done = $this->getCollectionData($request, $collection, $data);
                if($done)
                    $this->msg(1, 'data was displayed successfully', __METHOD__);
            }
            else
                $this->msg(0, 'invalid collection or access is private ', __METHOD__);
            
            
        }
//get collection data
        function getCollectionData($request, $collection, $data){
            $this->db->format = 'json';
            $this->db->display = 1;
            (isset($data[1]) && @$data[1][0]!='null') ? $find=$data[1] : $find=array();
            (isset($data[2])) ? $collect=$data[2] : $collect=array();
            $data = $this->db->$request($collection, $find, $collect);
            return true;
        }
//check collection name and permissions
        function checkCollection($data){
            if(isset($data[0]['key'])){
                $name = $this->db->get($this->collection, array('key'=>$data[0]['key'], 'access'=>$this->access), array('name'));
                return $name[0]['name'];
            }
            if(count($data[0])==1){
                $access = $this->db->get($this->collection, array('name'=>$data[0][0]), array('access'));
                if($access[0]['access']=='public')
                    return $data[0][0];
            }
                
        }
    }