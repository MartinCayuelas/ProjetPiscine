<?php

class File {

    public static function build_path($path_array) {

        $DS = DIRECTORY_SEPARATOR;

        $ROOT_FOLDER = __DIR__ . "/..";

        return $ROOT_FOLDER . $DS . join('/', $path_array);
    }

}
