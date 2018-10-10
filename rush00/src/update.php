<?php
    session_start();
    include_once("../inc/config.php");
    if (isset($_SESSION['Logged in']) && isset($_POST['Update']))
    {
        $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
        $update = "UPDATE `persons` SET `Username`='".$_POST['Uname']."' `FirstName`='".$_POST['Fname']."' `LastName`='".$_POST['Lname']."' 
                        `Email`='".$_POST['Email']."' `HomeAddress`='".$_POST['HAddress']."' `DeliveryAddress`='".$_POST['DAddress']."' 
                        WHERE `ID`=".$_SESSION['UI']['ID'];
       if (!mysqli_query($conn, $update))
            header("Location: ../index.php?'Please notify the admin'&error=" . mysqli_error($conn));
        $sql = "SELECT * FROM `persons` WHERE `ID`=".$_SESSION['UI']['ID'];
        $result = mysqli_query($conn,$sql);
        if (!$result)
        {
            die(mysqli_error($db));
        }
        mysqli_close($conn);
        $row = mysqli_fetch_array($result);
            unset($row['HashedPassword']);
            $_SESSION['UI'] = $row;
        header("Location: ../index.php?Updated");
    }
    else
        header("Location: ../index.php?error='Login in'");

?>