<?php

if(!function_exists("createDirectory")) {
    function createDirectory($uploadPath = "uploads") {
        $explodePath = explode("/", $uploadPath);
        $currentPath = '';

        foreach ($explodePath as $pathPart) {
            $currentPath .= $pathPart . '/';
            if (!is_dir($currentPath)) {
                mkdir($currentPath);
            }
        }
    }
}