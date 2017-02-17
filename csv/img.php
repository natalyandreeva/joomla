<?php
 include("../configuration.php");
 $config=new JConfig(); 
 $host=$config->host;  
 $base=$config->db;        
 $login=$config->user;     
 $password=$config->password;
 
 $result=mysql_connect($host,$login,$password);
 if(!$result)
  {
   echo "<p>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.</p>";
   exit();
  }

 $result=mysql_select_db($base);
 if(!$result)
  {
   echo "<p>В настоящий момент база данных не доступна, поэтому корректное отображение страницы невозможно.</p>";
   exit();
  }
 
 define( '_JEXEC', 1 );
 define( 'JPATH_BASE', realpath(dirname(__FILE__).'/..' ));
 define( 'DS', DIRECTORY_SEPARATOR );
 
 require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
 require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
 $mainframe =& JFactory::getApplication('site');
 $mainframe->initialise(); 
  
  $datetime=date('Y-m-d H:i:s',time());
  //$handle=fopen("all-cat.csv","r");
  $csv=file('all-cat.csv');
  //while(($csv=fgetcsv($handle,2500000,";"))!==FALSE) {
  $i=1;
  while($i<=count($csv)) {
   $data=explode(';',$csv[$i]);
   $name=explode('~',str_replace('`','',$data[1]));
   $cat_name=trim($name[2]);
   //echo JApplication::stringURLSafe($cat_name)."<br>";
   $file_url='images/stories/virtuemart/category/'.str_replace('`','',$data[3]);
   $file_url_thumb='images/stories/virtuemart/category/'.str_replace('`','',$data[4]);
   if($file_url_thumb!='images/stories/virtuemart/category/' and $file_url=='images/stories/virtuemart/category/') $file_url=$file_url_thumb;
   if($file_url_thumb=='images/stories/virtuemart/category/') { $file_url=''; $file_url_thumb=''; }
   $desc=str_replace('`','',$data[2]).'<br /><br />'.str_replace('`','',$data[5]).str_replace('`','',$data[6]);
   if($file_url_thumb!='') {
     $query="UPDATE kisya_virtuemart_categories_ru_ru SET category_description='".$desc."' WHERE slug='".JApplication::stringURLSafe($cat_name)."'";
	 $result=mysql_query($query);
    //echo $query." - ".$result.'<br>';      
	
    //Создание медиа контента
	   
	   $query="select virtuemart_category_id from kisya_virtuemart_categories_ru_ru where slug='".JApplication::stringURLSafe($cat_name)."'";
	   $result=mysql_query($query);
	   $n=mysql_num_rows($result);
	   if($n!=0) list($id_category)=mysql_fetch_array($result); else $id_category='';
	   
	   //echo $id_category.'<br>';  
	
	   if($id_category!='') {
	   $query="insert into kisya_virtuemart_medias values('','1','','','','image/jpeg','category','$file_url','$file_url_thumb','0','0','0','','0','1','$datetime','413','$datetime','413','0000-00-00 00:00:00','0')";
	   $result=mysql_query($query);
	   $last_id=mysql_insert_id();
	   
	   //echo $result.'<br>'; 
	   
	   $query="insert ignore into kisya_virtuemart_category_medias values('','$id_category','$last_id','')";
	   $result=mysql_query($query);
	   }
  } $i++; }
 echo "OK";
?>