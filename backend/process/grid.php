<?php
require_once "../config.php";

$db = new Database();

if(!empty($_POST['option']) && isset($_POST) && $_POST['option'] == 'user'){
   $data = $db->selectUsers();
   echo ($data);
   exit;
}


if((empty($_POST['id']) && isset($_POST) && $_POST['grid'] == 'fetch')){
   $data = $db->select();
   echo ($data);
   exit;
}
if((!empty($_POST['search_value'])  && isset($_POST))){
   $field= filter_var($_POST['search_field']);
   $value= filter_var($_POST['search_value']);

   $data = $db->select($value,$field);
   echo ($data);
   exit;
}
if(isset($_POST) && $_POST['grid'] == 'editsingle' && (!empty($_POST['id']))){
   $id= filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
   $field= 'id';
   $data = $db->select($id, $field);
   echo ($data);
   exit;
}
if(isset($_POST) && $_POST['grid'] == 'delete' && (!empty($_POST['id']))){
   $id= $_POST['id']??'';
   $data = $db->delete($id);
   echo ($data);
   
   exit;
}

