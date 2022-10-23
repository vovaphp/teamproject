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

    /**
     * @return array|mixed
     * return array with articles from DB
     */
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

        return $result->fetch_all(MYSQLI_ASSOC);
        //результат выборки:
        //id 	title 	image   text 	date 	login
    }

    /**
     * @param int $articleId
     * @return array|null
     */
    public function selectArticle(int $articleId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = $articleId";
        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_assoc();

    }

    /**
     * @param array $article
     * @param int $userId
     * @return bool|\mysqli_result
     * add article to DB
     */
    public function add(array $article, int $userId)
    {
        $sql = "INSERT INTO {$this->table} (`title`, `text`, `image`, `user_id`) 
        VALUES ('{$article['title']}','{$article['text']}','{$article['url']}','{$userId}')";
        return $this->db->query($sql);
    }

    public function update(array $article, int $articleId, int $userId)
    {
        $sqlUpdateArticle = "UPDATE {$this->table} SET title = '{$article['title']}', text = '{$article['text']}', image = '{$article['url']}' WHERE id = {$articleId} ";
        $sqlAddEditRecord = "INSERT INTO users_edit_articles (`user_id`, `article_id`) VALUES ('{$userId}','{$articleId}')";

        if ($this->db->query($sqlUpdateArticle)){
            return $this->db->query($sqlAddEditRecord);
        }
    }

    /**
     * @param int $articleId
     * @return bool|\mysqli_result
     * delete article from DB
     */
    public function destroy(int $articleId)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$articleId}";
        return $this->db->query($sql);
    }

    /**
     * @param int $articleId
     * @return array|null
     * return array with one article
     */
    public function show(int $articleId)
    {
        $sql = "SELECT {$this->table}.id, {$this->table}.title, {$this->table}.image, {$this->table}.text, 
        {$this->table}.date, users.login FROM {$this->table} INNER JOIN users WHERE 
        {$this->table}.user_id = users.id and {$this->table}.id={$articleId};";

        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }
        return $result->fetch_assoc();
    }

    /**
     * @param int $userId
     * @return int|null
     * return count of user articles
     */
    public function getCountArticlesByUserId(int $userId)
    {
        $sql = "SELECT COUNT(id) FROM articles WHERE user_id = {$userId};";

        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return null;
        }
        return (int)$result->fetch_assoc()['COUNT(id)'];
    }

/*    public function rewriter(int $id, string $title, string $text)
    {
        $sql = "UPDATE {$this->table} SET title = '$title', text = '$text' WHERE id = '$id'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc(MYSQLI_ASSOC);
    }*/


/*    public function getAllTitle()
    {
        $sql = "SELECT id, title FROM {$this->table};";

        $result = $this->db->query($sql);
        if (!$result) {
            //TODO log with select error
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }*/
}