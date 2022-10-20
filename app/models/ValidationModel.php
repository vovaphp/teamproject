<?php

namespace models;

class ValidationModel
{
    static public function fieldsUser(array $user):bool{
        if (strlen($user['login'])> 4  && $user['password'] === $user['passRepeat'] && isset($user['e-mail'])){
            return true;
//            if (preg_match("/a-zA-Z0-9`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]/", )) {
//            }
        }
        return false;
    }
}