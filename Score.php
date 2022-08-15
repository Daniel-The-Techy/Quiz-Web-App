<?php
include "Get.php";
include "db.php";

$question=new GetQuestion();
$number=$question->get();
$score=$question->CalculateScore();
$TotalScore=$score["TotalScore"] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" a href="main.css">
</head>

<body>
    <div class="container">
        <div class="d-flex bg-white justify-content-center align-items-center  mt-5">
            <h1>You Score <?php  echo htmlspecialchars($TotalScore .'/'. $number * 2)?>
        </div>

      
    </div>
     
    <div class="text-center">
        
        <button class="btn btn-success text-center"><a href="index.php" class="link-light text-decoration-none">Go
                Back</a></button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
