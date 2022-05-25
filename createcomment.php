<?php


require_once("vendor/init.php");

$database = new Database();

//  CreateComment

// Expecting ArticleId, comment  and UserId From FronTEnd

$article = new Article();

// https://sites.local/anonymous/createcomment.php?article_id={'incoming Parameter'}&comment={'incoming Parameter'}&userid={'incoming Parameter'}

if (!empty($_POST['article_id']) and !empty($_POST['comment']) and !empty($_POST['userid'])) {


    $PostId = $database->escape_string($_POST['article_id']);
    $CmtDetails = $database->escape_string($_POST['comment']);
    $PostUserName = $database->escape_string($_POST['userid']);


    if ($article->CreateComment($PostId, $CmtDetails, $PostUserName ) == true) {

        $array = [
            'success' => true,
            'message' => "Comment added successfully",
            'userid' => $PostUserName,
            'comment' => $CmtDetails
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }
} else {

    $array = [
        'success' => false,
        'message' => "Fields cannot be empty..",
        // 'username' => $article->username,
        // 'article' => $article->article
    ];
    $return = json_encode($array);
    echo "$return";
    exit();
}