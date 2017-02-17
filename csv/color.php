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
  $csv=file('color.csv');
  
  $i=0;
  while($i<count($csv)) {
   $data=explode(';',$csv[$i]);
   $file_url='images/stories/virtuemart/product/color/'.$data[0].'.png';
   $file_url_thumb='images/stories/virtuemart/product/color/'.$data[0].'.png';
   
    //Создание медиа контента
	   
	   $query="select virtuemart_product_id from kisya_virtuemart_products_ru_ru where slug like '%".JApplication::stringURLSafe(trim($data[1]))."'";
	   $result=mysql_query($query);
	   $n=mysql_num_rows($result);
		
	   if($n!=0)
	   while(list($id_product)=mysql_fetch_array($result)) {
	    
	   $query2="insert into kisya_virtuemart_medias values('','1','','','','image/png','product','$file_url','$file_url_thumb','1','0','0','','0','1','$datetime','413','$datetime','413','0000-00-00 00:00:00','0')";
	   $result2=mysql_query($query2);
	   $last_id=mysql_insert_id();	   
	   
	   echo $i.'<br>';
	   
	   $query3="insert ignore into kisya_virtuemart_product_medias values('','$id_product','$last_id','')";
	   $result3=mysql_query($query3);
	   } 
 $i++; }
 echo "OK";
?>