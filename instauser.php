<?php


function getInstaID($username)
{

    $username = strtolower($username); // sanitization
    $token = "InsertThatHere";
    $url = "https://api.instagram.com/v1/users/search?q=".$username."&access_token=".$token;
    $get = file_get_contents($url);
    $json = json_decode($get);

    foreach($json->data as $user)
    {
        if($user->username == $username)
        {
            return $user->id;
        }
    }

    return '00000000'; // return this if nothing is found
}

echo getInstaID('aliciakeys'); // this should print 20979117

?>