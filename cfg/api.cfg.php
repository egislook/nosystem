<?php

//default db settings
    $afDB = array(
		'host' => '10.0.5.138:25689',
		'user' => '6deb07d4-8962-4b75-a97c-59f992a9c33d',
		'pass' => 'ca7fed63-c7bc-464d-a2b1-1ceccd60735e',
		'db' => 'db'
	);
    
    $mongolabDB = array(
    	'host' => 'ds029798.mongolab.com:29798',
		'user' => 'common',
		'pass' => 'common1001',
		'db' => 'common'
	);
    
    $db = $mongolabDB;

	//$pass = (base64_decode($db['pass']));
	
	$db['uri'] = 'mongodb://'.$db['user'].':'.$db['pass'].'@'.$db['host'].'/'.$db['db'];
	$GLOBALS['DB']['DEF'] = $db;
	
//constants
	define('HOST', '//'.$_SERVER['SERVER_NAME']);
    define('DS', '/');                                  //directory separator
    define('VM', '...');                                //value mark in url
    define('VS', ',');                                  //value separator
    define('AM', '~');                                  //action marker in url
    //object markers eg. [data:1,g:azas];[j:3]
    define('OS', ';');                                  //object separator
    define('SOM', '[');                                 //starting object marker
    define('EOM', ']');                                 //ending object marker
    define('EQ', ':');                                  //object value equivalent

    define('ROOT', dirname(dirname(__FILE__)));

//pub link
    define('URL', HOST.substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], '/pub/')+5)); 

    //pub directories
    define('DIR_PUB', ROOT.DS.'pub'.DS);
    define('DIR_UPLOAD', DIR_PUB.'upload'.DS);

    //fw directories
    define('DIR_APP', ROOT.DS.'app'.DS);
    define('DIR_COMMON', DIR_APP.'~common'.DS);
    define('DIR_DB', ROOT.DS.'db'.DS);
    define('DIR_LOGS', ROOT.DS.'logs'.DS);
    define('DIR_CFG', ROOT.DS.'cfg'.DS);
    define('DIR_TEMP', ROOT.DS.'temp'.DS);

    //lib
    define('DIR_LIB', ROOT.DS.'lib'.DS);