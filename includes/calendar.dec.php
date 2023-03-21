<?php
require 'dbh.inc.php';
session_start();
$uid = $_SESSION['userUid'];  
if(isset($_POST['ajax'])){ 
  global $sunday;
  global $monday;
  global $tuesday;
  global $wednesday;
  global $thursday;
  global $friday;
  global $saturday;

  $sunday = $_POST['sunday'];
    
  $sql = "SELECT * FROM week WHERE uid = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../calendar.php?error=sqlerror"); //might need to change this to index
      exit();
  }
  else{
      mysqli_stmt_bind_param($stmt, "s", $uid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $index = null;

        $s = explode("~ ", $row['sunday']);
        $m = explode("~ ", $row['monday']);
        $t = explode("~ ", $row['tuesday']);
        $w = explode("~ ", $row['wednesday']);
        $th = explode("~ ", $row['thursday']);
        $f = explode("~ ", $row['friday']);
        $sa = explode("~ ", $row['saturday']);

        
        for($x = 0; $x < count($s)-1; $x+=2){
          if($s[$x] == $sunday){
            $index = $x;
          }
        }
        
        
        global $s_content;
        global $m_content;
        global $t_content;
        global $w_content;
        global $th_content;
        global $f_content;
        global $sa_content;

        if(isset($index)){
          $s_date = $s[$index];
          $s_content = $s[$index+1];

          $m_date = $m[$index];
          $m_content = $m[$index+1];

          $t_date = $t[$index];
          $t_content = $t[$index+1];

          $w_date = $w[$index];
          $w_content = $w[$index+1];

          $th_date = $th[$index];
          $th_content = $th[$index+1];

          $f_date = $f[$index];
          $f_content = $f[$index+1];

          $sa_date = $sa[$index];
          $sa_content = $sa[$index+1];

          $week = array($s_content, $m_content, $t_content, $w_content, $th_content, $f_content, $sa_content);
          print_r(json_encode($week));
        }
        else{
          $week = array("", "", "", "", "", "", "");
          print_r(json_encode($week));
        }       
      }
    }
  }
  else{
    $sunday = " ";
  }
?>