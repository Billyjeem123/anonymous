<?php


require_once("vendor/init.php");

$database = new Database();

$article =  new Article();

// Expecting  , CommentId, UserId,  Reply

if (isset($_POST['comment_id']) and !empty($_POST['reply']) and !empty($_POST['userid'])) { // LikeId Coming From FrontEnd.

    $comment_id =   $database->escape_string($_POST['comment_id']);
    $reply =    $database->escape_string($_POST['reply']);
    $userid =   $database->escape_string($_POST['userid']);


    if($article->CreateReply($comment_id, $reply, $userid) == true){
        $array = [
            'success' => true,
            'message' => 'Reply Sent',
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }else{

        $array = [
            'success' => false,
            'message' => 'Error While Processing',
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }

  }else{

        $array = [
            'success' => false,
            'message' => 'Fields Empty',
        ];
        $return = json_encode($array);
        echo "$return";
        exit();
    }
