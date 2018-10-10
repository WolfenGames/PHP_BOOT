<?php
    session_start();
    include_once("../inc/config.php");
    if (isset($_SESSION['cart']))
    {
        if (isset($_SESSION['Logged in']))
        {
            $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
            $cart = $_SESSION['cart'];
            $valid = true;
            //ID and a COUNT -- Validate
            foreach ($cart as $item)
            {
                $query = "SELECT * FROM `items` WHERE `ID`=".$item['id'];
                $result = $conn->query($query);
                while ($tmp = $result->fetch_assoc()) {
                    $new_stock = $tmp['Stock'] - $item['count'];
                    if ($new_stock < 0) {
                        $item['count'] = "Out of Stock";
                        $valid = false;
                    }
                }

            }
            if ($valid == false)
                header("Location: ../index.php?OOS");
            //DO->

            foreach ($cart as $item)
            {
                $query = "SELECT * FROM `items` WHERE `ID`=".$item['id'];
                $result = $conn->query($query);
                while ($tmp = $result->fetch_assoc()) {
                    $new_stock = $tmp['Stock'] - $item['count'];
                    $update = "UPDATE `items` SET `STOCK`='".$new_stock."' WHERE `ID`=".$item['id'];
                    if (!mysqli_query($conn, $update))
                        header("Location: ../index.php?'Please notify the admin'");
                }

            }
            unset($_SESSION['cart']);
            header("Location: ../index.php?Success");
        }
        else
            header("Location: ../index.php?error='Login in'");
    }
    else
        header("Location: ../index.php?error='Empty cart'");
?>