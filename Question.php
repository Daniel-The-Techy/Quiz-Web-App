
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" a href="../main.css">
</head>
<body>
      <div class="container mt-4 maz">
        <div class="row">
         <div class="col-12 col-sm-12">
         <button class="btn btn-success float-end" id="link">End Quiz</button>
 <h1 id="question"  class="count"></h1>
      <div class="mt-5">
   <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
      <div class="formi mt-3">
  <input class="form-check-input alpha"  type="radio" name="flexRadioDefault"  id="flexRadioDefault1">
  <label class="form-check-label" id="option_A" for="flexRadioDefault1"></label>
</div>
 
<div class="formi mt-3">
  <input class="form-check-input alpha"  type="radio"  name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" id="option_B" for="flexRadioDefault1" value="man" ></label>
</div>

<div class="formi mt-3">
  <input class="form-check-input alpha"  type="radio"  name="flexRadioDefault" value="man" id="flexRadioDefault3">
  <label class="form-check-label" id="option_C" for="flexRadioDefault1"   value="man"></label>
</div>

<div class="formi mt-3">
  <input class="form-check-input alpha"  type="radio" name="flexRadioDefault" id="flexRadioDefault4">
  <label class="form-check-label" id="option_D" for="flexRadioDefault1"   value="man"></label>
</div>

<button class="btn btn-primary mt-5 p-2" id="btn">Next</button>
<input type="hidden" id="id" name="radio">
</form>
</div>





    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  
      <script>
    
$(document).ready(function(){

 var question=0;
 get(question);




    function get(question){
      $.ajax({
         url:'Act.php',
        method:'post',
         data:{questions:question},
         success:function(data){
          var data=JSON.parse(data);
          var prepend = data.id;
          var pre = prepend.concat(')')
           $('#question').html(data.question);
           $('#id').val(prepend);
            $('#option_A').html(data.option_A);
            $('#option_B').html(data.option_B);
            $('#option_C').html(data.option_C);
            $('#option_D').html(data.option_D);

            $('#flexRadioDefault1').val(data.option_A);
            $('#flexRadioDefault2').val(data.option_B);
            $('#flexRadioDefault3').val(data.option_C);
            $('#flexRadioDefault4').val(data.option_D);

           $('#question').prepend(pre);

            
         }

       })
     
    }
    submitData();
    Redirect();
    function submitData(){
 $("#btn").click(function(e){
  //alert('ji');
    e.preventDefault();
    question=question + 1;
    var id = $('#id').val();
    var value = $('input[name=flexRadioDefault]:checked').val();
    $.ajax({
                    url: 'Insert.php',
                    method: 'post',
                    data: {
                        Wid: id,
                        ans: value
                    },
                    success: function(data) {
                       console.log("Quiz data inserted");
                    }
                })
                get(question);
   });
   
    }

    function Redirect() {
            $('#link').click(function() {
                location.replace("http://localhost:8000/score.php");
            })
        }

});
    


      </script>