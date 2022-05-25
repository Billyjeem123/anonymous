<?php


require_once("vendor/init.php");

$database = new Database();
$article = new Article();


//Expecting ArticlId Parameter 
// https://sites.local/anonymous/fetchComment.php?article_id={'incoming Parameter'}

if(!empty($_POST['article_id'])){

$articleId = $database->escape_string($_POST['article_id']);

$FetchedComment = $article->FetchComment($articleId);
$rows = $database->rows($FetchedComment);

    while($FetchedDetails = $database->fetch($FetchedComment)){
        //FetchedDetails

        $array = [
            'success' => true,
            'FetchedDetails' => $FetchedDetails,
            'total_count' => $rows
        ];
        $return = json_encode($array);
        echo "$return";

}

}else{

    $data['error'] = 'commentid not found';
    $return = json_encode($data);
    echo "$return";


}








?>