<?php 

$db=new mysqli('localhost','root','','sadik_db');
$db->set_charset("utf8");

$db_rez=new mysqli('sauroneg.beget.tech','sauroneg_sadiks','{*Rt2ludMySQL','sauroneg_sadiks'); // rezerv_db
$db_rez->set_charset("utf8"); 

 if (isset($_POST['about_menu'])){ // 
   $res=$db->query('select *from about_menu where part ="'.$_POST['about_menu'].'" ');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
} 
 if (isset($_POST['about_menu_1'])){ // 
   $res=$db->query('select *from about_menu where router_name ="'.$_POST['about_menu_1'].'" ');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
} 
if (isset($_POST['news'])){ // 
   $res=$db->query('select *from news where sch_cod =170102 ORDER BY `news`.`date` DESC');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
} 
if (isset($_POST['trashnews_id'])){ // 
   $db->query('delete from news where id ='.$_POST['trashnews_id'].' ');  
   $res=$db->query('select *from news where sch_cod =170102 ORDER BY `news`.`date` DESC');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
}  
if (isset($_POST['save_news'])){
    $date=date('Y:m:d'); 
   $_POST['zag']=str_replace('"','\"',$_POST['zag']);
   $_POST['zag']=str_replace("'",'\"',$_POST['zag']);
   $_POST['cont_full']=str_replace('"','\"',$_POST['cont_full']);     
   $_POST['cont_full']=str_replace("'",'\"',$_POST['cont_full']);     
   $db->query('insert into news(zag,cont_full,sch_cod,date) values("'.$_POST['zag'].'","'.$_POST['cont_full'].'",170102,"'.$date.'") ');  
   $res=$db->query('select *from news where sch_cod =170102 ORDER BY `news`.`date` DESC');  
     $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
} 
if (isset($_POST['about_fields'])){ // 
   $res=$db->query('select *from about_fields ');
    $content=array(); $i=0;
    foreach($res as $row ){ 
        $content[]=$row; 
//        $res_v=$db->query('select *from '.$row['table_name'].' where sch_cod=170101 and  '); $row_v=$res_v->fetch_array();   
//        $content[$i] += ['value'=>$row_d[$row['name']]];
        $i++; }
    echo json_encode($content);
}
if (isset($_POST['about_value'])){ // 
    $res=$db->query('select *from about_value where sch_cod=170102 ');
    $content=array(); 
    foreach($res as $row ){
        $content[]=$row; 
    }
    echo json_encode($content);
}
 if (isset($_POST['doc_fields'])){ // sch list from d_name
   $res=$db->query('select *from docs ');  
     $content=array(); 
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
}

if (isset($_POST['remove_file_id'])){ // remove docs 
      $db->query('delete from docs where id='.$_POST['remove_file_id'].'');  
   $res=$db->query('select *from docs ');  
     $content=array(); 
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
}

if (isset($_FILES['my_file'])){ // sch list from d_name
    $tmp_name = $_FILES["my_file"]["tmp_name"];
    $res=$db->query('select count(1) from docs');$count=$res->fetch_array()[0];    
    move_uploaded_file($tmp_name, 'files/f'.$count.'.pdf');
    move_uploaded_file($tmp_name, 'http://sauroneg.beget.tech/schools/f'.$count.'.pdf');
       
    $db->query('insert into docs(caption,path,cat) values
    ("'.$_POST['caption'].'","files/f'.$count.'.pdf","'.$_POST['cat'].'") ');  // without sch_cod !!!  
     
   $res=$db->query('select *from docs ');  
     $content=array(); 
    foreach($res as $row ){ 
        $content[]=$row; 
          }
    echo json_encode($content);
}
if (isset($_POST['next_news_id'])){ // 
    $res=$db->query('SHOW TABLE STATUS FROM `sadik_db` LIKE "news" '); $id=$res->fetch_array()['Auto_increment'];  
    echo $id;
}

if (isset($_POST['update'])){ // update about_value
    $_POST['update']=str_replace('"','\"',$_POST['update']);$_POST['update']=str_replace("'",'\"',$_POST['update']);
    if ($db->query('update about_value set value="'.$_POST['update'].'" where id='.$_POST['id'].' ')){ echo "Обновлено !!!";  }
    
}




?>