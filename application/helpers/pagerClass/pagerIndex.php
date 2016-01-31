<?php
require_once 'class.pagerFromFile.php';
$obj = new pager_file('words.gmc',2,10,2);
$arr=$obj->get_page();
$n=count($arr);
for($i=0;$i<$n;$i++)
{
  echo $arr[$i].'<BR>';
}
echo $obj;