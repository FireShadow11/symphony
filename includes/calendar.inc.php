<?php
    require 'dbh.inc.php';
    session_start();
    $uid = $_SESSION['userUid'];

    /*
    $doc = new DomDocument;
    
    $internalErrors = libxml_use_internal_errors(true);

    // We need to validate our document before referring to the id
    $doc->validateOnParse = true;
    $doc->loadHTMLFile('../calendar.php');
    libxml_use_internal_errors($internalErrors);
    */

    //DATES
    $sun = $_POST['sun'];
    $mon = $_POST['mon'];
    $tues = $_POST['tues'];
    $wed = $_POST['wed'];
    $thur = $_POST['thur'];
    $fri = $_POST['fri'];
    $sat = $_POST['sat'];

    //DATES AND CONTENT
    $sunday = $sun . "~ " . $_POST['sunday'];
    $monday = $mon . "~ " . $_POST['monday'];
    $tuesday = $tues . "~ " . $_POST['tuesday'];
    $wednesday = $wed . "~ " . $_POST['wednesday'];
    $thursday = $thur . "~ " . $_POST['thursday'];
    $friday = $fri . "~ " . $_POST['friday'];
    $saturday = $sat . "~ " . $_POST['saturday'];

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
            
            if(str_contains($row['sunday'], $sun)){ //if the inputted date is already in the database, then replace it
                $list = explode("~ ", $row['sunday']);
                $index = array_search($sun, $list);
                $list[$index+1] = $_POST['sunday'];
                $sunday = implode("~ ", $list);

            }
            else{
                $sunday = $row['sunday'] . $sunday . "~ ";
            }

            if(str_contains($row['monday'], $mon)){ //if the inputted date is already in the database~ then replace it
                $list = explode("~ ", $row['monday']);
                $index = array_search($mon, $list);
                $list[$index+1] = $_POST['monday'];
                $monday = implode("~ ", $list);

            }
            else{
                $monday = $row['monday'] . $monday . "~ ";
            }

            if(str_contains($row['tuesday'], $tues)){ //if the inputted date is already in the database~ then replace it
                $list = explode("~ ", $row['tuesday']);
                $index = array_search($tues, $list);
                $list[$index+1] = $_POST['tuesday'];
                $tuesday = implode("~ ", $list);

            }
            else{
                $tuesday = $row['tuesday'] . $tuesday . "~ ";
            }

            if(str_contains($row['wednesday'], $wed)){ //if the inputted date is already in the database, then replace it
                $list = explode("~ ", $row['wednesday']);
                $index = array_search($wed, $list);
                $list[$index+1] = $_POST['wednesday'];
                $wednesday = implode("~ ", $list);

            }
            else{
                $wednesday = $row['wednesday'] . $wednesday . "~ ";
            }

            if(str_contains($row['thursday'], $thur)){ //if the inputted date is already in the database, then replace it
                $list = explode("~ ", $row['thursday']);
                $index = array_search($thur, $list);
                $list[$index+1] = $_POST['thursday'];
                $thursday = implode("~ ", $list);

            }
            else{
                $thursday = $row['thursday'] . $thursday . "~ ";
            }

            if(str_contains($row['friday'], $fri)){ //if the inputted date is already in the database, then replace it
                $list = explode("~ ", $row['friday']);
                $index = array_search($fri, $list);
                $list[$index+1] = $_POST['friday'];
                $friday = implode("~ ", $list);

            }
            else{
                $friday = $row['friday'] . $friday . "~ ";
            }

            if(str_contains($row['saturday'], $sat)){ //if the inputted date is already in the database, then replace it
                $list = explode("~ ", $row['saturday']);
                $index = array_search($sat, $list);
                $list[$index+1] = $_POST['saturday'];
                $saturday = implode("~ ", $list);

            }
            else{
                $saturday = $row['saturday'] . $saturday . "~ ";
            }
        }
            

        $sql = "UPDATE week SET sunday = ?, monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ? WHERE uid = ?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssssssss", $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $uid);
            mysqli_stmt_execute($stmt);
            exit();
        }
    }    
?>

