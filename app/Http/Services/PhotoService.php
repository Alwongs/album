<?php

namespace App\Http\Services;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\Auth;

class PhotoService
{
    public static function transliterate($string) 
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'i',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'kh',  'ц' => 'tc',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'iu',  'я' => 'ia',
            '’' => '_',   '.' => '_',   ' ' => '_',
            
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'I',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'Kh',  'Ц' => 'Tc',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Shch',
            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Iu',  'Я' => 'Ia',
        );

        return strtolower(strtr($string, $converter));
    }  

    public function saveInStorage($request)
    {
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $extention = $request->file('image')->getClientOriginalExtension();
            $newImageName = now()->format('Ymd_His') . '-' . self::transliterate($request->title) . '.' . $extention;
    
            if (!File::exists(Storage::path('images/photos'))) {
                Storage::makeDirectory('images/photos');
            }     
    
            if (!File::exists(Storage::path('images/previews'))) {
                Storage::makeDirectory('images/previews');
            }            
            
            $image->scale(height: 1080);
            $image->save(Storage::path('images/photos/') . $newImageName);
    
            $image->scale(height: 150);
            $image->save(Storage::path('images/previews/') . $newImageName);

            return $newImageName;
        } else {
            return null;
        }
    }

    public function prepearData($data, $newImageName )
    {
        $data['user_id'] = Auth::user() ? Auth::user()->id : 0;
        $data['photo'] = $newImageName;

        return $data;
    }

    public function removeFromStorage($photo)
    {
        $photoPath = 'images/photos/' . $photo->photo;
        $previewPath = 'images/previews/' . $photo->photo;

        if (File::exists(Storage::path($photoPath))) {
            Storage::delete($photoPath);
        }
        if (File::exists(Storage::path($previewPath))) {
            Storage::delete($previewPath);
        }
    }

    public function filterPhotosArray($photos, $userRole = 'A')
    {
        if ($userRole == 'A') return $photos;

        $accessTypes = $userRole == 'F' ? ['F', 'G'] : ['G'];
        $filteredPhotos = [];
        foreach ($photos as $photo) {
            if (in_array($photo->access, $accessTypes)) {
                $filteredPhotos[] = $photo;
            }
        }
        return $filteredPhotos;
    }

    public function checkPhotoAccess($photo_access, $userRole = 'A')
    {
        if ($userRole == 'A') return true;
        if ($userRole == 'F' && $photo_access != 'A') return true;
        if ($userRole == 'G' && $photo_access == 'G') return true;

        return false;
    }

    public function checkIfFollower($photo_user_id, $followed_id)
    {
        return $photo_user_id == $followed_id ? true : false;
    }

    public function getAllowedAccesses($role)
    {
        $accessArray = ['G'];

        switch ($role) {
            case 'A':
                $accessArray = ['A', 'F', 'G'];
                break;
            case 'F':
                $accessArray = ['F', 'G'];
                break;
        }

        return $accessArray;
    }    
}

