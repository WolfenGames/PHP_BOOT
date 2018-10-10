<?php
	session_start();

	include("../inc/config.php");
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if ($_POST['register'] == "ok" && !empty($_POST['Passwd']))
		{
			$uname = $_POST['Uname'];
			$passwd = hash("whirlpool", $_POST['Passwd']);
			$fname = $_POST['Fname'];
			$lname = $_POST['Lname'];
			$email = $_POST['Email'];
			if (!empty($uname)&& !empty($email))  {
                $conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASS, "rush00");
                $query = "INSERT INTO persons(
                            FirstName,
                            LastName,
                            Username,
                            HashedPassword,
                            Email,
                            MemberType
                        )
                        VALUES(
                            '".$fname."',
                            '".$lname."',
                            '".$uname."',
                            '".$passwd."',
                            '".$email."',
                            '1'
                        );";
                if (!mysqli_query($conn, $query))
                {
                    mysqli_close($conn);
                    Header("Location: ../index.php?ERROR=Fail " . mysqli_error($conn));
                }
                else {
                    mysqli_close($conn);
                    header("Location: ../index.php?Success");
                }
            }else
                header("Location: ../index.php?ERROR='Incorrect information given'");
		}else
            header("Location: ../index.php?ERROR='No Password given'");
	}
?>