<?php

    if ($_POST['login'] && $_POST['newpw'] && $_POST['oldpw'] $_POST['submit'])
    {
        if (!file_exists("../private"))
        {
            mkdir("../private");
        }
        if (!file_exists("../private/password"))
        {
            file_put_contents("../private/password", NULL);
        }
        $account = unserialize(file_get_contents("../private/password"));
        if ($account)
        {
            $match = hash("sha256", $_POST['oldpw']);
            foreach($account as $k => $v)
            {
                if ($v['login'] == $_POST['login'] && $v['passwd'] == $match)
                {
                    $v['passwd'] = hash("sha256", $_POST['newpw']);
                    file_put_contents("../private/password", serialize($account));
                    echo "OK!\n";
                    break ;
                }
            }
            echo "Error\n";
        } else
        {
            echo "Error\n";
        }
    }
    else
        echo "Error!\n";

?>