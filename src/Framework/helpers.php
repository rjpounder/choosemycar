<?php

if (!function_exists('csv_to_array')) {
    function csv_to_array($file,$headers)
    {
        $return = [];
        $row = 1;
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $num = count($data);
                if($row > 1){
                    for ($c = 0; $c < $num; $c++) {
                        $return[$row-2][$headers[$c]] = $data[$c];
                    }
                }
                $row++;
            }
            fclose($handle);
        }

        return $return;
    }
}

if (!function_exists('dd')) {
    /**
     * simple dump & dive method for debugging
     * @param mixed ...$args
     */
    function dd(...$args)
    {
        foreach ($args as $arg) {
            echo "<pre>";
            var_dump($arg);
            echo "</pre>";
        }
        die();
    }
}

if (!function_exists('app_path')) {
    /**
     * gets the apps base path
     * @param string $path
     * @return string
     */
    function app_path($path = '')
    {
        return __DIR__.'/../'.$path;
    }
}
