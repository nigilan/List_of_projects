<?php
header('Content-type: application/json');

$con=mysqli_connect("localhost","root","root");
// Check connection
if (mysqli_connect_errno()) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create database
$sql="CREATE DATABASE IF NOT EXISTS my_db";
if (mysqli_query($con,$sql)) {
  //echo "Database my_db created successfully";
} else {
  //echo "Error creating database: " . mysqli_error($con);
}

mysqli_select_db($con, "my_db");


$query = "SELECT ID FROM USERS";
$result = mysqli_query($con, $query);

if(empty($result)) {
                $query = "CREATE TABLE USERS (
                          ID int(11) NOT NULL,
                          NAME varchar(255) NOT NULL,
                          AGE int,
                          DEPT varchar(255), 
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($con, $query);
                echo $result;
}











  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "add": 
      //test_function();
      //echo $action;
      //echo $_POST["id"];
     // echo $_POST["name"];
     // echo $_POST["age"];
      //To print the json or take data from nested JSON
      //echo json_encode($_POST["try"]["age"]);
      
      $id = mysqli_real_escape_string($con, $_POST['id']);
      $name = mysqli_real_escape_string($con, $_POST['name']);
      $age =mysqli_real_escape_string($con, $_POST['age']);
      $dept =mysqli_real_escape_string($con, $_POST['dept']);
      $sql="INSERT INTO USERS (ID, NAME, AGE,DEPT) VALUES ('$id', '$name', '$age','$dept')";

        if (!mysqli_query($con,$sql)) {
                    die('Error: ' . mysqli_error($con));
                    $result = array('status' => "fail");
         
        echo json_encode($result);
        }else{
        
        $result = array('status' => "success");
         
        echo json_encode($result);
        }
      break;
      
      case "select":
      $result = mysqli_query($con,"SELECT * FROM USERS");
      $rowvalueFinal = ""; 
      while($row = mysqli_fetch_array($result)) {
         //echo $row['ID'] . " " . $row['NAME'];
         $rowvalue = "<tr><td>". $row['ID'] . "</td><td>". $row['NAME']."</td><td>". $row['AGE']."</td><td>".$row['DEPT']."</td><td><input type=\"button\" value=\"Update\" class=\"update_row\" data-id=". $row['ID'] ." data-name=" .$row['NAME']. " data-age=".$row['AGE']." data-dept=". $row['DEPT']."></td><td><input type=\"button\" value=\"Delete\" class=\"delete_row\" data-id=". $row['ID'] ."></td></tr>";
         $rowvalueFinal = $rowvalueFinal . $rowvalue; 
      }
      $result1 = array('status' => $rowvalueFinal);
      echo json_encode($result1);
      break;
      
      case "delete":
      $id = mysqli_real_escape_string($con, $_POST['id']);
      mysqli_query($con,"DELETE FROM USERS WHERE ID=".$id."");
      $result1 = array('status' => "success");
      echo json_encode($result1);
      
      break;
      
      case "update":
      $id = mysqli_real_escape_string($con, $_POST['id']);
      $name = mysqli_real_escape_string($con, $_POST['name']);
      $age =mysqli_real_escape_string($con, $_POST['age']);
      $dept =mysqli_real_escape_string($con, $_POST['dept']);
      
      
      $sql="UPDATE USERS SET NAME=\"".$name."\",AGE=".$age.",DEPT=\"".$dept."\" WHERE ID=".$id."";
//echo("UPDATE USERS SET NAME=".$name.",AGE=".$age.",DEPT=".$dept." WHERE ID=".$id."");
        if (!mysqli_query($con,$sql)) {
                    die('Error: ' . mysqli_error($con));
                  //  echo("UPDATE USERS SET NAME='".$name."',AGE=".$age.",DEPT='".$dept."' WHERE ID=".$id."");
                    $result = array('status' => "fail");
         
        echo json_encode($result);
        }else{
        
        $result = array('status' => "success");
         
        echo json_encode($result);
        }
      
      
      //mysqli_query($con,"");
      //echo("UPDATE USERS SET NAME=".$name.",AGE=".$age.",DEPT=".$dept." WHERE ID=".$id.""); 
      //$result1 = array('status' => "success");
      //echo json_encode($result1);
      
      
      
      break;
      
    }
  }

 
mysqli_close($con);


?>
