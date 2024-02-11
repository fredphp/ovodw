<?php

  
	$code = "1233ddd";
	
$str = $code;
//preg_replace('/([A-Z]+)/', ' \1 ', $input);
//if(preg_match('/[A-Za-z]/', $str)!=tanh){
	//var_dump(preg_match('/[A-Z]/', $code));
if(preg_match('/[A-Z]/', $code)!=1){
    echo 'meiy 有大写字母！';
	die;
}
echo "完全输出"

?>