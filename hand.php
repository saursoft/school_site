<?php 

$db=new mysqli('localhost','root','','sadik_db');
$db->set_charset("utf8");


 if (isset($_POST['about_menu'])){ // sch list from d_name
   $res=$db->query('select *from about_menu ');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
}
if (isset($_POST['text'])){ // sch list from d_name
   $res=$db->query('select *from test where id=1 ');  
     
    echo $res->fetch_array()['text'];
}

if (isset($_POST['save_text'])){ // sch list from d_name
   
    $text=($_POST['save_text']);
    $text=str_replace('"','\"',$text);
    //$text=str_replace("'",'\"',$text);
    
    $db->query('update test set text = "'.$text.'" where id=1 ');  
    
    $res=$db->query('select *from test where id=1');  
     
    echo $res->fetch_array()['text'];
}
?>