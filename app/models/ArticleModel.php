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
            throw new \Exception($this->db->connect_error);
        }
    }

    public function all()
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.title, {$this->table}.image, {$this->table}.text, 
        {$this->table}.date, users.login FROM {$this->table} INNER JOIN users 
        WHERE {$this->table}.user_id = users.id";

        $result = $this->db->query($sql);

        if (!$result) {
            //TODO log with select error
            return [];
        }
        //TODO debug
        return $result->fetch_all(MYSQLI_ASSOC);
        //результат выборки:
        //id 	title 	image   text 	date 	login
    }


    public function add(array $article, int $userId)
    {
        $sql = "INSERT INTO {$this->table} (`title`, `text`, `image`, `user_id`) 
        VALUES ('{$article['title']}','{$article['text']}','{$article['url']}','{$userId}')";
        return $this->db->query($sql);
    }


    public function update(array $article, int $articleId, int $userId)
    {
        $sqlUpdateArticle = "UPDATE {$this->table} SET title = '{$article['title']}', text = '{$article['text']}', url = '{$article['url']}' WHERE id = {$articleId} ";
        $sqlAddEditRecord = "INSERT INTO users_edit_articles(`user_id`, `article_id`) VALUES ('{$articleId}','{$userId}')";

        if ($this->db->query($sqlUpdateArticle)){
            return $this->db->query($sqlAddEditRecord);
        }
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

    public function show(int $id)
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.title, {$this->table}.image, {$this->table}.text, 
        {$this->table}.date, users.login FROM {$this->table} INNER JOIN users WHERE 
        {$this->table}.user_id = users.id and {$this->table}.id={$id};";

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
        return $result->fetch_assoc(MYSQLI_ASSOC);
    }


    public function getAllTitle()
    {
        $sql = "SELECT id, title FROM {$this->table};";

        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        //TODO debug
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}