<?php

namespace app\helpers;

use SebastianBergmann\CodeCoverage\Driver\Selector;

class PicturesCollection
{
    private static int $max  = 10;

    public static function getMaxId()
    {
        return self::$max;
    }
    public static function addPictureId(int $pictureId): void
    {
        $content = self::getAllIdInCache();
        $content[] = $pictureId;
        self::putAllIdInCache($content);
    }

    public static function getPictureId(): int
    {
        if (self::isMaxCountAllIdInCache()) {
            return self::$max + 1;
        }
        $iter = function () use (&$iter) {
            $id = random_int(0, self::$max);
            $allId = self::getAllIdInCache();
            if (in_array($id, $allId)) {
                return $iter();
            }
            return $id;
        };
        return $iter();
    }

    private static function getAllIdInCache(): array
    {
        $data = file_get_contents(__DIR__ . '/../collectionsCache/picturesId.cache');
        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }

    private static function putAllIdInCache($content): void
    {
        $data = json_encode($content, JSON_FORCE_OBJECT);
        file_put_contents(__DIR__ . '/../collectionsCache/picturesId.cache', $data);
    }

    public static function isMaxCountAllIdInCache(): int
    {
        return count(self::getAllIdInCache()) >= self::$max;
    }

    /**
     * @return int
     */
    public static function deletePictureId($picture_id): void
    {
        $content = self::getAllIdInCache();

        foreach ($content as $key => $value) {
            if ($value === (integer)$picture_id) {

                unset($content[$key]);
            }
        }
        self::putAllIdInCache($content);
    }
}
