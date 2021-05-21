<?php

function get_safe_data($con,$str){
    if($str!=''){
    $str=trim($str);
    return strip_tags(mysqli_real_escape_string($con,$str));
}
}
?>