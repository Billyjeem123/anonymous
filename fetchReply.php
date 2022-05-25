<?php


require_once("vendor/init.php");

$database = new Database();

$article =  new Article();

//CommentId CoMIN gROM fRONTEND
// https://sites.local/anonymous/fetchReply.php?comment_id={'incomg Parameter'}

if(isset($_POST['comment_id']) and !empty($_POST['comment_id'])){

$RelyData = $article->FetchReply($_POST['comment_id']);

foreach($RelyData as $DataFetched){

  $data['FetchedDetails'] = $DataFetched;
  $return = json_encode($data);
  echo "$return";

}

}else{

    $array = [
        'success' => false,
        'message' => 'commentId cannot be found '
      ];
      $return = json_encode($array);
      echo "$return";
      exit();
}
