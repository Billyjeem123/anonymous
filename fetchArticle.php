<?php


require_once("vendor/init.php");

$database = new Database();
$article = new Article();

//SENDING  OBJECT..

// ArtucleId
//UserId
//artckeContent
//likes,
//comment_count



if($detail = $article->FetchArticle()){

    while($FetchedDetails = $database->fetch($detail)){
        //FetchedDetails
        $data['FetchedDetails'] = $FetchedDetails;
        $return = json_encode($data);
        echo "$return";


}

}else{

    $array = [
        'success' => false,
        'message' => "Error while fetching",
       
    ];
    $return = json_encode($array);
    echo "$return";


}







?>