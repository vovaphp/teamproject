<?php

namespace helpers;

class Validation
{
    static public function fieldsUser(array $user):bool{
        if (strlen($user['login']) >= 4  && $user['password'] === $user['passRepeat'] && isset($user['e-mail'])){
            return true;
//            if (preg_match("/a-zA-Z0-9`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]/", )) {
//            }
        }
        return false;
    }

    /**
     * @param array $article
     * @return bool
     * return array with errors
     */
    static public function validateArticle($article){
        $errorsArray =[];

        if (empty($article['title'])) {
            $errorsArray[] = 'вы не ввели заголовок';
        }

        if (empty($article['text'])) {
            $errorsArray[] = 'содержание не может быть пустым';
        }

        if (empty($_FILES['imageFile']['name'])) {
            if (empty($article['newImageFile'])){
                $errorsArray[] = 'вы не выбрали файл';
            }
        }
        return $errorsArray;
    }
}