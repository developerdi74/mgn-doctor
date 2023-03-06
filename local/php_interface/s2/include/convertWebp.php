<?
//Функция перевода изображения в webp
function makeWebp ($src, $rewrite = true) {
    if ($src && function_exists('imagewebp')) {
        $newImgPath = str_replace(array('.jpg', '.jpeg', '.gif', '.png'), '.webp', $src);
        $newImgPathAvif = str_replace(array('.jpg', '.jpeg', '.gif', '.png'), '.avif', $src);
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].$newImgPath) || $rewrite) {
            $info = getimagesize($_SERVER['DOCUMENT_ROOT'].$src);
            if ($info !== false && ($type = $info[2])) {
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        $newImg = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$src);
                        break;
                    case IMAGETYPE_GIF:
                        $newImg = imagecreatefromgif($_SERVER['DOCUMENT_ROOT'].$src);
                        break;
                    case IMAGETYPE_PNG:
                        $newImg = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].$src);
                        imagepalettetotruecolor($newImg);
                        imagealphablending($newImg, true);
                        imagesavealpha($newImg, true);
                        break;
                }
                if ($newImg) {
                    imagewebp($newImg, $_SERVER['DOCUMENT_ROOT'].$newImgPath, 90);
                    imagedestroy($newImg);
                }
            }
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$newImgPathAvif)){
            $arrPath['AVIF'] = $newImgPathAvif;
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$newImgPath)) { // Файл мог не создаться по каким-либо причинам
            $arrPath['WEBP'] = $newImgPath;
            return $arrPath;
        }
    }

    return false;
}
?>