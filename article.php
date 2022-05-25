<?php


require_once("vendor/init.php");

$database = new Database();
$article = new Article();

//expecting UserId and articleId from frontEnd


if (!empty($_POST['userid']) and !empty($_POST['article'])) {

    $article->userid = $database->escape_string($_POST['userid']);
    $article->article = $database->escape_string($_POST['article']);


    if ($article->CreateArticle($article->userid,  $article->article) == true) {

        $array = [
            'success' => true,
            'message' => "Article created successfully",
            'userid' => $article->userid,
            'article' => $article->article
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    } else {

        $array = [
            'success' => false,
            'message' => "Unable to create article",
           
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }
} else {

    $array = [
        'success' => false,
        'message' => "Fields cannot be empty..",
       
    ];
    $return = json_encode($array);
    echo "$return";
    exit();
}

