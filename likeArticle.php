<?php


require_once("vendor/init.php");

$database = new Database();

$article =  new Article();

//LikEiD  and article  expecting Parameter

// https://sites.local/anonymous/likeArticle.php?article_id={'incomg Parameter'}&userid={'incomg Parameter'}

if (isset($_POST['article_id']) and !empty($_POST['userid'])  and !empty($_POST['article_id']) ) {   // LikeId Coming From FrontEnd.

    $ArticleId =   $database->escape_string($_POST['article_id']);
    $userId =   $database->escape_string($_POST['userid']);


    $likeArticle = $article->LikeArticleId($ArticleId,  $userId);
    if ($likeArticle == true) {
        $array = [
            'success' => true,
            // 'color' => 'i  dont know',
            'message' => 'Liked'
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    } else {

        $array = [
            'success' => false,
            // 'color' => 'i  dont know',
            'message' => 'error'
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }
}else{

    $array = [
    'success' => false,
    'message' => 'Userid or Post Not Provided'
];
$return = json_encode($array);
echo "$return";
exit();



}