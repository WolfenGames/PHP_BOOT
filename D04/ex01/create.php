<?php

    if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'])
    {
        if (!file_exists("../info"))
        {
            mkdir("../info");
        }
        if (!file_exists("../info/unsecure"))
        {
            file_put_contents("../info/unsecure", NULL);
        }
        $account = unserialize(file_get_contents("../info/unsecure"));
        $found = 0;
        if ($account)
        {
            foreach($account as $k => $v)
                if ($v['login'] == $_POST['login'])
                    $found = 1;
        }
        if ($found)
        {
            echo "ERROR\n";
        } else
        {
            $tmp['login'] = $_POST['login'];
            $tmp['passwd'] = $_POST['passwd'];
            $account[] = $tmp;
            file_put_contents("../info/unsecure", serialize($account));
            echo "OK!\n";
        }
    }
    else
        echo "Error!\n";

?>