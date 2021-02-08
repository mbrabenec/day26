<?php

class Article
{
    public $id = null;
    public $title = null;
    public $body = null;
    public $language = null;
    public $author = null;
    public $photo = null;
    public $published_at = null;

    /**
     * update this record in the database
     */

    public function update()
    {
        update($this->id, $article);
    }

    /**
     * insert this as a new record in the database
     */
    public function insert()
    {
        $this->id = insert($this);
    }

    /**
     * inserts or updates this record in the database
     */
    public function save()
    {
        if ($this->id === null) {
            $this->insert();
        } else {
            $this->update();
        }
    }
}