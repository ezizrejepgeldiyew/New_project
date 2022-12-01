<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class PhotoSettings
{

    public static function StorePhoto($photo, $title)
    {
        $date = date('Y-m-d');
        return $photo->store("{$title}/{$date}");
    }

    public function DeletePhoto($photo)
    {
        return Storage::delete($photo);
    }

    public static function UpdatePhoto($photo, $title, $previous_photo)
    {
        Storage::delete($previous_photo);
        return static::StorePhoto($photo, $title);
    }

    public static function DestroyPhoto($previous_photo)
    {
        Storage::delete($previous_photo);
    }

    public static function StorePhotos($photos, $titles)
    {
        $date = date('Y-m-d');
        foreach ($photos as $item) {
            $images[] = $item->store("{$titles}/{$date}");
        }
        return json_encode($images);
    }

    public static function UpdatePhotos($photos, $titles, $previous_photos)
    {
        Storage::delete($previous_photos);
        return static::StorePhotos($photos, $titles);
    }

    public static function DestroyPhotos($previous_photos)
    {
        Storage::delete($previous_photos);
    }
}
