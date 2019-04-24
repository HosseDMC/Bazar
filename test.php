<?php

if (!function_exists('array_key_first')) {
    /**
     * Gets the first key of an array
     *
     * @param array $array
     * @return mixed
     */
    function array_key_first(array $array)
    {
        if (count($array)) {
            reset($array);
            return key($array);
        }

        return null;
    }
}



$fileList = array();
$files = glob('Uploads/*.jpg');
foreach ($files as $file) {
    $fileList[filemtime($file)] = $file;
}
ksort($fileList);
$fileList = array_reverse($fileList, TRUE);
$firstKey = array_key_first($fileList);
print_r($fileList[$firstKey]);


?>
