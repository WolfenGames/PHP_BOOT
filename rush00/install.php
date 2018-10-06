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
		hashedPassword varchar(255),
		Age int,
		CellPhoneNumber int(10),
		HomeAddress varchar(255),
		DeliveryAdress varchar(255),
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
		hashedPassword,
		Age,
		CellPhoneNumber,
		HomeAddress,
		DeliveryAdress,
		MemberType
	)
	VALUES(
		'0',
		'Admin',
		'Admin',
		'Admin',
		'74dfc2b27acfa364da55f93a5caee29ccad3557247eda238831b3e9bd931b01d77fe994e4f12b9d4cfa92a124461d2065197d8cf7f33fc88566da2db2a4d6eae',
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

	?>