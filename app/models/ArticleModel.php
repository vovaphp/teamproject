<?php

namespace models;

class ArticleModel
{
    /**
     * @var string table name
     */
    protected $table = 'articles';
    /**
     * @var \mysqli
     */
    protected $db;

    /**
     * Article doc constructor
     */
    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error != 0) {
            die($this->db->connect_error);//TODO добавить исключение
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function selectArticle(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_assoc();

    }

    /**
     * add new article in storage
     * @param array $article associated arrey off article params
     * @return bool
     */
/*    public function add(array $article)
    {
        $sql = "INSERT INTO {$this->table} (title, text) VALUES ('{$article['title']}', '{$article['text']}')";
        return $this->db->query($sql);
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function allReverse()
    {
        $result = $this->all();
        krsort($result);
        foreach ($result as $key => $value) {
            foreach ($value as $tagsName => $name){
                if($tagsName == 'text'){
                    $result[$key][$tagsName] = substr($result[$key][$tagsName], 0, 100).'...';
                }
            }
        }
        return $result;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
        return $this->db->query($sql);
    }

    public function editor(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $id";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_assoc();

    }

    public function rewriter(int $id, string $title, string $text)
    {
        $sql = "UPDATE {$this->table} SET title = '$title', text = '$text' WHERE id = '$id'";
        $result = $this->db->query($sql);
    }*/

}

