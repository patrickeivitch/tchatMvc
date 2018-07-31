<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author pkpwang
 */
class Message 
{
    protected $sender_id;
    protected $created_at;
    protected $msg;
    
    /**
     * 
     * @return type
     */
    public function getSenderId()
    {
        return $this->sender_id;
    }
    /**
     * 
     * @param type $sender_id
     * @return \Message
     */
    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }
    
    /**
     * 
     * @param array $datas
     */
    public function __construct()
    {
        return $this;
    }
    
    public function getMessage()
    {
        return $this->msg;
    }
    
    /**
     * 
     * @param type $message
     * @return \Message
     */
    public function setMessage($message)
    {
        $this->msg = $message;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function insertMessage($msg, $id)
    {
        return Connection::insertMessage($msg, $id);
    }
}
