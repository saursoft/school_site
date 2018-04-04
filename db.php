<meta charset="utf-8">
<?php

$db=new mysqli('localhost','root','','sadik_db');
$db->set_charset("utf8");




$res=$db->query('select *from about_menu where part ="about" ');  
     $content=array();
    foreach($res as $row ){ 
        echo $row['caption']."<br>"; 
        $res1=$db->query('select *from '.$row['table_name'].' where sch_cod =170102 ');  
        foreach($res1 as $row1 ){
        echo '   '.;     
        }
        
          }






