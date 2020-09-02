<?php

namespace src\Classes\Telegram;

class Telegram {

    private $chat_id;
    private $token;
    private $url;
    private $message;

    public function __construct($chat_id, $token) 
    {
        $this->set_chat_id($chat_id);
        $this->set_token($token);
    }   

    private function set_chat_id($chat_id) 
    {
        $this->chat_id = $chat_id;
    }

    private function set_token($token) 
    {
        $this->token = $token;
    }

    private function set_url($url) 
    {
        $this->url = $url;
    }

    private function set_message($message) 
    {
        $this->message = $message;
    }

    public function sendMessage($message)
    {
        $this->set_message($message);
        $this->set_url("https://api.telegram.org/bot".$this->token."/sendMessage?chat_id=".$this->chat_id."&text=".$this->message);
        file_get_contents($this->url);
    }

}



?>