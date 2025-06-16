<?php
function convertToWebP($sourcePath, $destinationPath, $quality = 80)
{
    // Get the image type from the source file
    $imageInfo = getimagesize($sourcePath);
    $imageType = $imageInfo[2];

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($sourcePath);
            break;
        default:
            return false;
    }

    if ($image === false) {
        return false;
    }

    // Correct image orientation if necessary
    if ($imageType == IMAGETYPE_JPEG) {
        $exif = exif_read_data($sourcePath);
        if ($exif !== false && isset($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 3:
                    $image = imagerotate($image, 180, 0);
                    break;
                case 6:
                    $image = imagerotate($image, -90, 0);
                    break;
                case 8:
                    $image = imagerotate($image, 90, 0);
                    break;
            }
        }
    }

    // Ensure the target directory exists
    $destinationDir = dirname($destinationPath);
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0755, true);
    }

    // Convert the image to WebP format
    $result = imagewebp($image, $destinationPath, $quality);
    imagedestroy($image);

    return $result;
}
