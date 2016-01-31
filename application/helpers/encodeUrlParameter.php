<?
function encodeUrlParameter($p){
    return substr(trim(urldecode(@$p)), 0, 60 );
}