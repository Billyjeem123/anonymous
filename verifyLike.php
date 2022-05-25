<?php

require_once("vendor/init.php");

$database = new Database();

$article =  new Article();

if (isset($_POST['article_id']) and !empty($_POST['article_id']) and !empty($_POST['userid'])) {

    $userid =  $database->escape_string($_POST['userid']);
   $articleId =  $database->escape_string($_POST['article_id']);

    $verifyId =  $article->verifyLikes($userid,  $articleId);
    $rows = $database->rows($verifyId);

    if ($rows == 1) {

        $array = [
            'success' => true,
            'message' => 'Liked',
        ];
        $return = json_encode($array);
        echo "$return";
    } else {
        $array = [
            'success' => false,
            'message' => 'Never been Liked',
          
        ];
        $return = json_encode($array);
        echo "$return";
    }
}else{

    $array = [
        'success' => false,
        'message' => 'articleid or userid not provided'
    ];
    $return = json_encode($array);
    echo "$return";



}
