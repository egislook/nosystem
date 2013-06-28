<?php
    class db extends main{
        
        public $connected = 0;
        public $format = 0;         //json or 0:array
        public $display = 0;
    
        function __construct(){
            $this->mongo = new Mongo($GLOBALS['DB']['DEF']['uri']);
            if($this->mongo->connected){
                $this->connected = 1;
                $this->db = $this->mongo->$GLOBALS['DB']['DEF']['db'];
                $this->msg(1, 'db sucessfully connected', __METHOD__);
            }
            else
                $this->msg(0, 'db connection failed', __METHOD__);
        }
        
//get collection data and find what data do u need from collection        
        public function get($collection, $find=array(), $collect = array(), $sort = array("date" => -1)){
            
            //$find = array('set' => 'projects');
            if($this->connected){
                $collection = $this->db->$collection->find($find, $collect)->sort($sort);
                $data = $this->fetch($collection, $collect, $this->format);
                if(!$this->display)
                    return $data;
                else{
                    if(isset($_GET['jsoncallback']))
                        print $_GET['jsoncallback']. '('.$data.')';
                    else
                        print $data;
                }
                    
            }
            else
                return false;
                
        }
        
//convert only for necessary data and reformat if needed
        public function fetch($obj, $collect=false, $format){
            $array = iterator_to_array($obj);
            
            if(count($array)>0){
                $i=0;
                foreach($array as $key => $val){
                    if($collect){
                        foreach($collect as $attr){
                            $data[$i][$attr] = $val[$attr];
                        }
                    }
                    else
                        $data[$i]=$val;
                    $i++;
                }
                if($format==='json')
                    $data = json_encode($data);
                    
                return ($data);
            }
            else
                return false;
        }
    }