<?php

namespace app\services;

use app\Models\Link;

class LinkService extends \yii\base\Component
{
    public function isUrl(string $string) : bool
    {
        $pattern = '/^((ftp|http|https):\/\/)?(www\.)?([A-Za-zА-Яа-я0-9]{1}[A-Za-zА-Яа-я0-9\-]*\.?)*\.{1}[A-Za-zА-Яа-я0-9-]{2,8}(\/([\w#!:.?+=&%@!\-\/])*)?/';
        if (preg_match($pattern, $string) === 1) return true;
        return false; 
    }

    public function toggleHttp(string $string) : string
    {
        
        if (\mb_substr($string,0,4) === 'http') return $string;
        return 'http://' . $string;

    }

    public function genAlias(int $length = 30) : string
    {
        $alias = $this->genString($length);

        while ( !empty( Link::findOne(['alias'=>$alias]) ) ) {
            $alias = $this->genString($length);
        }

        return $alias;
    }

    private function genString(int $length) : string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}