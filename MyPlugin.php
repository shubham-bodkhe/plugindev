<?php

/**
 * Plugin Name: MyPlugin
 * Description: This is my first Custom plugin
 * Version:1.0
 * Author: Shubham
 * Author URI: www.shubham-bodkhe.com
 */



// Basics

class MyClass{
public $msg = "hello";
 function __construct(){

    echo"Class Constructor";
 }

public function showArray(){
     $array = array('one'=>1,'two'=>2,'three'=>3);

foreach($array as $key=> $a){
    echo $a.'<br>';
}
}
}



$obj = new MyClass();
$obj->showArray();



// filter
function myFilter($value){

    $value['four']= 4;
    return $value;
    
}
add_filter('$obj->myFilter','myFilter');

 $myarray= apply_filters('my_filter',array('one'=>1,'two'=>2,'three'=>3));
var_dump($myarray);
 
 
 //  action
 function myActionFunction(){
     echo "<BR>Hello Action<br>";
    }
    add_action('my_action','myActionFunction');
    do_action('my_action');



 // global variable
$GLOBALS['obj']= new MyClass();
$GLOBALS['obj']->showArray();


// // String 
$str = "Hello";
$str2 = $str." World";
$array = array('one'=>1,'two'=>2,'three'=>3);

echo $str2;





















?>