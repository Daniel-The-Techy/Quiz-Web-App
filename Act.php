<?php
include "db.php";
include "Get.php";

 $question=isset($_POST['questions']) ? $_POST['questions'] : null;
    $Quest=new GetQuestion();
    $set=$Quest->showData($question);
    echo json_encode($set);
    