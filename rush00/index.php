<?php
session_start();
include_once ("inc/config.php");

if (isset($_POST['clear']))
{
    unset($_SESSION['cart']);
}

if (isset($_POST['delete']))
{
    unset($_SESSION['cart'][$_POST['delete']]);
    if (count($_SESSION['cart']) == 0)
        unset($_SESSION['cart']);
}

if (isset($_POST['buy']))
{
    $ID = $_POST['buy'];
    $Stock = $_POST['quantity'];
    $item['id'] = $ID;
    $item['count'] = $Stock;
    $_SESSION['cart'][$ID] = $item;
}


function login_stuff()
{
    if (!$_SESSION['Logged in']) {
        ?>
        <form method="POST" action="src/login.php">
            <table>
            <tr>
                <td>
                    Username :
                </td>
                <td>
                    <input name="Uname" value="">
                </td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input name="Passwd" type="password" value=""></td>
            </tr>
            <tr>
                <td>
                    <button class="mainbut" type="submit" name="login" value="ok">Login</button>
                </td>
            </tr>
            </table>
        </form>
        <form method="POST" action="src/register.php">
            <table>
                <tr>
                    <td>
                        Username :
                    </td>
                    <td>
                        <input name="Uname" value="" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Password :
                    </td>
                    <td>
                        <input name="Passwd" type="password" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        First Name :
                    </td>
                    <td>
                        <input name="Fname" value="" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Last Name :
                    </td>
                    <td>
                        <input name="Lname" value="" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Email :
                    </td>
                    <td>
                        <input name="Email" type="email" value="" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="mainbut" type="submit" name="register" value="ok">Register</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    } else if ($_SESSION['Logged in']) {
        ?>
        <form method="POST" action="src/update.php">
            <table>
                <tr>
                    <td>
                        Username :
                    </td>
                    <td>
                        <input name="Uname" value="<?php echo $_SESSION['UI']['Username']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        First Name :
                    </td>
                    <td>
                        <input name="Fname" value="<?php echo $_SESSION['UI']['FirstName']; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Last Name :
                    </td>
                    <td>
                        <input name="Lname" value="<?php echo $_SESSION['UI']['LastName']; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Email :
                    </td>
                    <td>
                        <input name="Email" type="email" value="<?php echo $_SESSION['UI']['Email']; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Address :
                    </td>
                    <td>
                        <textarea name="HAddress" value="<?php echo $_SESSION['UI']['HomeAddress']; ?>" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Delivery Adress :
                    </td>
                    <td>
                        <textarea name="DAddress" type="email" value="<?php echo $_SESSION['UI']['DeliveryAddress']; ?>" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="mainbut" type="submit" name="Update" value="ok">Update Info</button>
                    </td>
                </tr>
            </table>
        </form>
        <form method="POST" action="src/login.php">
            <button class="mainbut" type="submit" name="logout" value="ok">logout</button>
        </form>
        <?php
    }
}

function display_contents()
{
    $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
    if (mysqli_connect_error())
        echo "Failed to connect to mysqli database: " . mysqli_connect_error();

    if (isset($_POST['Category']))
    {
        switch ($_POST['Category'])
        {
            case  "pre_sem":
                $search = "%pre_sem%";
                break;
            case "Algos":
                $search = "%Algos%";
                break;
            case "Unix":
                $search = "Uni%";
                break;
            case "GFX":
                $search = "GFX%";
                break;
            case "BOOTCAMP":
                $search = "%bootcamp%";
                break;
        }
        if (isset($search))
            $query = "SELECT * FROM `items` WHERE `Category` LIKE '".$search."'";
        else
            $query = "SELECT * FROM `items` ORDER BY `ID` ";
    }else
        $query = "SELECT * FROM `items` ORDER BY `ID` ";
    $result = $conn->query($query);
    mysqli_close($conn);
    $val = $result->num_rows;
    if ($val > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <form action="index.php" method="post">
                <div class="item">
                    <div class="img">
                        <img src="img/42.png" alt="Imagine a logo is here">
                    </div>
                    <div class="name">
                        <?php echo $row['Name']; ?>
                    </div>
                    <div class="description box">
                        <?php echo $row['Description']; ?>
                    </div>
                    <?php if ($row['Stock'] >= 1) { ?>
                        <div class="price rainbow">
                            Monies: <?php echo $row['Price']; ?>
                        </div>
                        <div class="amount">
                            <input type="number" name="quantity" min="1" value="1" max="<?php
                                if (isset($_SESSION['cart']))
                                    $val = $row['Stock'] - $_SESSION['cart'][$row['ID']]['count'];
                                else
                                    $val = $row['Stock'];
                                echo $val;
                                ?>">
                        </div>
                        <div class="stock">
                            left :: <?php
                                if (isset($_SESSION['cart']))
                                    $val = $row['Stock'] - $_SESSION['cart'][$row['ID']]['count'];
                                else
                                    $val = $row['Stock'];
                                echo $val;
                            ?>
                        </div>
                        <button class="buy" type="submit" name="buy" value="<?php echo $row['ID']; ?>">Add to cart</button>
                        <?php
                    } else {
                        ?>
                        <div class="soldout">
                            <h2>SOLD OUT!</h2>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
            <?php
        }
    }
}

function get_item_by_id($id)
{
    $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
    if (mysqli_connect_error())
        echo "Failed to connect to mysqli database: " . mysqli_connect_error();

    $query = "SELECT * FROM `items`";
    $result = $conn->query($query);
    $val = $result->num_rows;
    if ($val > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['ID'] == $id) {
                mysqli_close($conn);
                return ($row['Name']);
            }
        }
    }
    mysqli_close($conn);
    return "";
}

function get_item_price($id)
{
    $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
    if (mysqli_connect_error())
        echo "Failed to connect to mysqli database: " . mysqli_connect_error();

    $query = "SELECT * FROM `items`";
    $result = $conn->query($query);
    $val = $result->num_rows;
    if ($val > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['ID'] == $id) {
                mysqli_close($conn);
                return ($row['Price']);
            }
        }
    }
    mysqli_close($conn);
    return ;
}

function get_cart()
{
    if (!isset($_SESSION['cart'])) {
        echo "No Items in cart<br/>";
        return;
    }
    $tot = 0;
    $str = "";
    foreach ($_SESSION['cart'] as $item)
    {
        $str .= '<form class="Itemform" action="index.php" method="post">';
        $str .= '<div class="itemname">';
        $str .= "<p>" . get_item_by_id($item['id']) . "</p>";
        $str .= "</div>";
        $str .= '<div class="cartamount">';
        $str .= "<p>Amount :: " .$item['count'] . "</p>";
        $str .= '<button class="BuyButs" name="delete" type="submit" value="' . $item['id'] . '">del</button>';
        $str .= "</div>";
        $str .= '</form>';
        $tot += 1 * $item['count'] * get_item_price($item['id']);
    }
    //print_r($str);
    echo "<p class='total rainbow'>Total => " . $tot . "<br/></p>";
    echo $str;
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>WTC_ Black Market Sales</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
	<div class="header">
        <h1>WTC_ Black Market Sales</h1>
	</div>
	<div class="container">
		<div class="left">
			<?php login_stuff(); ?>
            <div class="search">
                <form action="index.php" method="post">
                    <div>
                        <p>SEARCH BY CATEGORY</p>
                        <input list="Category" name="Category">
                        <datalist id="Category">
                            <option value="pre_sem">
                            <option value="Algos">
                            <option value="Unix">
                            <option value="GFX">
                            <option value="BOOTCAMP">
                            <option value="ALL">
                        </datalist>
                    </div>
                    <div class="SearchBut">
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>
		</div>
		<div class="mid">
			<?php display_contents(); ?>
		</div>
		<div class="right">
            <form method="post" action="src/checkout.php">
                <button class="BuyButs" type="submit" href="index.php" name="clear">Buy Now</button>
            </form>
            <a href="src/checkout.php"><img title="Click here to buy" src="img/cart.png" class="cart"></a>
                <form method="post" action="index.php">
                    <button class="BuyButs" type="submit" href="index.php" name="clear">Clear</button>
                </form>
            <div class="space"><br /></div>
            <div class="cart_content">
                <?php get_cart() ?>
            </div>
		</div>
	</div>

</body>
</html>