<?php

namespace app\services;

use app\helpers\PicturesCollection;

class DecisionCollection
{
    public static function add($query): void
    {
        if (array_key_exists('picture_id', $query) && array_key_exists('decision', $query)) {
            $content = self::getAllDecisionInCache();

            $content[$query['picture_id']] = $query['decision'];
            PicturesCollection::addPictureId($query['picture_id']);
            self::putAllDecisionInCache($content);
        }
    }

    public static function getAllDecisionInCache()
    {
        $data = file_get_contents(dirname(__DIR__) . '/collectionsCache/decision.cache');
        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }

    public static function putAllDecisionInCache($content): void
    {
        $data = json_encode($content, JSON_FORCE_OBJECT);
        file_put_contents(__DIR__ . '/../collectionsCache/decision.cache', $data);
    }

}
