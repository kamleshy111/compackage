<?php

namespace App\Http\Controllers;

use Image;
use Exception;
use App\Models\Media;
// use Illuminate\Http\Request;

class MediaController extends Controller
{
    private static $sizes = [
        '150x150',
        '300x300',
        '1024x1024'
    ];

    /**
     * @param
     * $file        - File object to upload the file
     * $location    - Upload destination
     * $size        - specific size of the file
     * $old         - existing file id if already exists
     * $thumb       - thubm sizes
     *  
     * Upload images in the given folder and replace if image already exists.
     */
    public static function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
    {
        // Create Directory if not created already.
        $path = self::makeDirectory($location);
        $thumb_path = self::makeDirectory($location . '/thumbnails');
        
        // Throw error if unable to create file due to permission or any reason
        if (!$path) throw new Exception('File could not been created.');
        if (!$thumb_path) throw new Exception('File could not been created.');

        $thumb_path = $location . '/thumbnails';

        // Remove existing file & thumbnails if we are updating.
        if (!empty($old)) {
            $oldMedia = Media::find($old);

            if( ! empty( $oldMedia ) ) {
                self::removeFile($oldMedia->path.'/'. $oldMedia->filenname);
    
                $pathinfo = pathinfo($oldMedia->filenname);
                foreach($oldMedia->size as $size1) {
                    if( $size1 != 'full' ) {
                        self::removeFile($oldMedia->path.'/thumbnails/thumb_'. $pathinfo['filename'] . '_' . $size1 . '.' . $pathinfo['extension']);
                    }
                }
            }
        }

        // Create new names of the images
        $filename = uniqid() . time();
        $filenameWithExtention = $filename . '.' . $file->getClientOriginalExtension();

        $image = Image::make($file);

        // resize the image if size is provided.
        if (!empty($size)) {
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
        }

        $image->save($location . '/' . $filenameWithExtention);

        // Create thumbnails
        $avail_sizes = ['full'];
        if ( ! empty(self::$sizes) ) {
            foreach( self::$sizes as $size ) {
                $thumb = explode('x', $size);
                $avail_sizes[] = $size;
                Image::make($file)->resize($thumb[0], $thumb[1])->save($thumb_path . '/thumb_' . $filename . '_' . $size . '.' . $file->extension());
            }
        }

        // Put an entry in the media table
        $newMedia = new Media();
        $newMedia->filenname = $filenameWithExtention;
        $newMedia->extension = $file->extension();
        $newMedia->path = $location;
        $newMedia->size = $avail_sizes;
        $newMedia->notes = 'Added by '. auth()->user()->name;
        $newMedia->uploaded_by = auth()->id();
        $newMedia->save();

        return $newMedia->id;
    }

    // Make directory if not created
    public static function makeDirectory($path)
    {
        if (file_exists($path)) return true;
        return mkdir($path, 0755, true);
    }

    // Remove file if exists
    public static function removeFile($path)
    {
        return file_exists($path) && is_file($path) ? @unlink($path) : false;
    }

    // Image Path
    public static function imagePath()
    {
        $data['user_avatar'] = [
            'path' => 'uploads/user_avatar',
            'size' => '200x200',
        ];

        return $data;
    }

    /**
     * Delete media
     */
    public static function deleteMedia($id) {
        $existingMedia = Media::find($id);
        if( ! empty( $existingMedia ) ) {
            if( file_exists( public_path( $existingMedia->path . '/' . $existingMedia->filenname) ) ) {
                unlink(public_path( $existingMedia->path . '/' . $existingMedia->filenname));
            }
            $existingMedia->delete();
        }
        return 1;
    }

    /**
     * Get attachment
     */
    public static function getAttachment( $id ) {
        $newMedia = Media::find( $id );
        if( ! empty( $newMedia ) ) {
            return $newMedia->path . '/' . $newMedia->filenname;
        } else {
            return '';
        }
    }
    // File Upload END
}
