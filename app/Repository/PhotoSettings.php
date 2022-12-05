<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class PhotoSettings
{

    public static function storePhoto($photo, $title)
    {
        $date = date('Y-m-d');
        return $photo->store("{$title}/{$date}");
    }

    public function deletePhoto($photo)
    {
        return Storage::delete($photo);
    }

    public static function updatePhoto($photo, $title, $previousPhoto)
    {
        Storage::delete($previousPhoto);
        return static::storePhoto($photo, $title);
    }

    public static function destroyPhoto($previousPhoto)
    {
        Storage::delete($previousPhoto);
    }

    public static function storePhotos($photos, $titles)
    {
        $date = date('Y-m-d');
        foreach ($photos as $item) {
            $images[] = $item->store("{$titles}/{$date}");
        }
        return json_encode($images);
    }

    public static function updatePhotos($photos, $titles, $previousPhotos)
    {
        Storage::delete($previousPhotos);
        return static::storePhotos($photos, $titles);
    }

    public static function destroyPhotos($previousPhotos)
    {
        Storage::delete($previousPhotos);
    }
}
