<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$a = dirname( dirname( dirname(__FILE__) ) );
$arr = explode("/", $a);
$last = $arr[count($arr) - 1];

define('URL', 'http://localhost/' . $last . "/");