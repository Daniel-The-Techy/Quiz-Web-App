<?php


include 'db.php';
include 'Get.php';

if($_POST['Wid']  && $_POST['ans']){
    $id=htmlspecialchars(strip_tags($_POST['Wid']));
    $Answer=htmlspecialchars(strip_tags($_POST['ans']));
    $Question=new GetQuestion();
    $arr=$Question->Insert($id, $Answer);
}


?>