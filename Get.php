<?php




class GetQuestion{

public $conn;
public $limit=1;

    public function __construct(){
        $Database=new Database();
       $this->conn=$Database->Connect();
    }


     public function show($offset){
      $query="SELECT * 
      FROM 
      question 
      LIMIT $offset, $this->limit";
      //$stmt=$this->conn->prepare($query);
      $stmt=$this->conn->query($query);
      $stmt->execute();
      return $stmt;
     }

     public function get(){
         $query="SELECT * FROM question";
        // $stmt=$this->conn->prepare($query);
        $stmt=$this->conn->query($query);
         $stmt->execute();
         $Total=$stmt->rowCount();
        $Total_all=ceil($Total/$this->limit);
         return $Total_all;
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
     }

     public function set(){
        if(!isset($_GET['page'])){
            $page_no=1;
       }else{
        $page_no=$_GET['page'];
      }
      $page=($page_no-1)*$this->limit;
       return $page;
     }

     public function Getall(){
   
       $page=$this->set();
         $result=$this->show($page);
         return $result;
     }
     
    

    public function showData($offset){
      $data=$this->show($offset);
      while($row=$data->fetch(PDO::FETCH_ASSOC)){
        $id=htmlspecialchars($row['id']);
        $question=$row['question'];
        $option_A=htmlspecialchars($row['option-A']);
        $option_B=htmlspecialchars($row['option-B']);
        $option_C=htmlspecialchars($row['option-C']);
        $option_D=htmlspecialchars($row['option-D']);
        $result=["id"=>$id, "question"=>$question, "option_A"=> $option_A, "option_B"=>$option_B, "option_C"=>$option_C, "option_D"=>$option_D];
        return $result;
  }
}

 public function Insert($id, $Answer){
      try{
        $this->conn->beginTransaction();
            $query="SELECT 
                Correct_Option 
         FROM question 
                    WHERE id=?";
         $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1, $id);
           $stmt->execute();
         $result=$stmt->fetch(PDO::FETCH_ASSOC);
      
         if($Answer == $result['Correct_Option']){
              $score=2;
          }else{
              $score=0;
           }
           $query="INSERT INTO score(id, Correct_score, Ans)
            VALUES(?, ?, ?) 
           ON DUPLICATE KEY UPDATE Correct_score=?";
            $stmt=$this->conn->prepare($query);
           $stmt->bindParam(1, $id);
          $stmt->bindParam(2, $score);
            $stmt->bindParam(3, $Answer);
           $stmt->bindParam(4, $score);
          $stmt->execute();
          $this->conn->commit();
    }catch(PDOException $e){
              $this->conn->rollback;
              throw $e;
      }
    }

    

    public function CalculateScore(){
      $query="SELECT  SUM(Correct_score) As TotalScore from score";
      $stmt=$this->conn->query($query);
      $stmt->execute();
     $result=$stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function DeleteQuizData(){
      $sql="DELETE  FROM score";
      $stmt=$this->conn->query($sql);
      $stmt->Execute();
    }

}