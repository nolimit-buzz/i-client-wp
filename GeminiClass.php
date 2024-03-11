<?php

// namespace AccountPlannerWP\Classes;


use Gemini\Client;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use GuzzleHttp\Client as GuzzleClient;

class GeminiClass{


 function __construct(){

       
 }


 public function test($message_array){
    $yourApiKey ='AIzaSyA49G81GcV-Wl6X_LlLve1z9QxTrxXB4C8';
    $client = Gemini::client($yourApiKey);

 
//     $result = $client->geminiPro()->generateContent('I need a favor');

//    return  $result->text(); // Hello! How can I assist you today?
$message_array = $message_array ? $message_array : [];
    $message_array = array_slice($message_array, 0, -1); //excl. last element since is the main question to ask
    $history = [];
    $history_user_assistant = "";

    foreach($message_array as $message){

        $the_content = $message['content'] ? $message['content'] : '';
        $the_role = $message['role'];

        if($the_role == "user"){
            $history_user_assistant = Content::parse(part: $the_content);
        }else{
            $history_user_assistant = Content::parse(part: $the_content , role: Role::MODEL);
        }
 
        array_push($history, $history_user_assistant);

    }

    $message_array_last_question = end($message_array); // last element since is the main question to ask
 

    $chat = $client
    ->geminiPro()
    ->startChat(history: [ 
        $history 
    ]);
    $last_question = $message_array_last_question['content'];
    $response = $chat->sendMessage(  $last_question  );
    echo $response->text(); 

 }

    /**
     * @return self
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }

 
}
