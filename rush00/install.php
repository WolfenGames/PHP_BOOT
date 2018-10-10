#!/usr/bin/php
<?php
	include_once("inc/config.php");
	$sql = "CREATE DATABASE rush00";
	if (mysqli_query($conn, $sql))
	{
		echo "Database created successfully\n";
	}
	else
	{
		echo "Error creating Database " . mysqli_error($conn) . "\n";
	}

	$conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");

	$user_tab = "CREATE TABLE Persons (
		ID int NOT NULL AUTO_INCREMENT,
		LastName varchar(255),
		FirstName varchar(255),
		Username varchar(255) UNIQUE,
		HashedPassword varchar(255),
		Email varchar(255) UNIQUE ,
		Age int,
		CellPhoneNumber int(10),
		HomeAddress varchar(255),
		DeliveryAddress varchar(255),
		MemberType	int(1),
		PRIMARY KEY (ID)
	);";

	if (mysqli_query($conn, $user_tab))
	{
		echo "User Table created successfully\n";
	}
	else
	{
		echo "Error creating User Table " . mysqli_error($conn) . "\n";
	}

	$item_tab = "CREATE TABLE Items (
		ID int NOT NULL,
		Name varchar(255),
		Description varchar(255),
		Category varchar(255),
		Price int(255),
		Stock int(255),
		PRIMARY KEY (ID)
	);";

	if (mysqli_query($conn, $item_tab))
	{
		echo "Item Table created successfully\n";
	}
	else
	{
		echo "Error creating Item Table " . mysqli_error($conn) . "\n";
	}

	$def_user = "INSERT INTO persons(
		ID,
		LastName,
		FirstName,
		Username,
		HashedPassword,
		Email,
		Age,
		CellPhoneNumber,
		HomeAddress,
		DeliveryAddress,
		MemberType
	)
	VALUES(
		'0',
		'Admin',
		'Admin',
		'Admin',
		'74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae',
		' ',
		'0',
		'0',
		' ',
		' ',
		'3'
	);";

	if (mysqli_query($conn, $def_user))
	{
		echo "Def_user created successfully\n";
	}
	else
	{
		echo "Error creating Def user " . mysqli_error($conn) . "\n";
	}

	$populate_cart = "INSERT INTO `items` (`ID`, `Name`, `Description`, `Category`, `Price`, `Stock`) VALUES 
                        ('1', 'Libft', 'I will do your libft for a minor fee', 'pre_sem', '350', '20'), 
                        ('2', 'Get Next Line', 'I will do your Get Next Line for a higher fee', 'pre_sem', '700', '15'), 
                        ('3', 'Filler', 'I will attempt your filler for a fee', 'Algos_one', '1000', '5'),
                        ('4', 'FdF', 'I will copy someones github for you', 'Gfx_one', '100', '3'), 
                        ('5', 'ft_printf', 'I will make your ft_printf, print \'f\'', 'Unix_one', '2000', '1000'), 
                        ('6', 'Lem-in', 'I will play with your ants', 'Algos_one', '2500', '5'), 
                        ('7', 'Wolf3D', 'I will play wolf3D for you', 'Gfx_one', '0', '0'), 
                        ('8', 'ft_ls', 'I will make sure it does what it says.', 'Unix_one', '10000000', '0'), 
                        ('9', 'C Exam', 'I will pretend to be you.', 'C_alone_in_the_dark', '250000', '1'),
                        ('10', 'C Bootcmap', 'I will attempt to help you', 'C_bootcamp', '9999999', '42'),
                        ('11', 'Php Bootcmap', 'I will make this site for you', 'PHP_bootcamp', '0', '0');";
    if (mysqli_query($conn, $populate_cart))
    {
        echo "Items created successfully\n";
    }
    else
    {
        echo "Error creating Items" . mysqli_error($conn) . "\n";
    }

    ?>