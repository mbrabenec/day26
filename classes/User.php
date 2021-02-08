<?php


class User 
{
    public function __construct($username)
    {
         $this->created_at = date('Y-m-d H:i:s');
         $this->username = $username;      
    }

    public $id = null;
    public $username = null;
    public $name = null;
    public $password = null;
    public $number_of_posts = 0;
    public $created_at = null;

    public function dump () 
    {
        var_dump($this);
    }

    public function riaseNrOfPosts()
    {
        $this->number_of_posts++;
    }

    public function __toString()
    {
        return $this->username;
    }
    



}