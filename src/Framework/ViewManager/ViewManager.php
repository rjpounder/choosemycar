<?php

namespace Framework\ViewManager;

use Framework\Contracts\ViewManagerContract;

class ViewManager implements ViewManagerContract
{
    public static $reserved = [
        'view',
        'variables',
        'key',
        'value',
        'reserved',
    ];

    public static function viewPath($view)
    {
        return app_path('/Views/'.$view.'.view.php');
    }
    public static function viewExists($view = '')
    {
        return file_exists(self::viewPath($view));
    }

    /**
     * @param string $view
     * @param array $variables
     * @return bool
     * @throws \Exception
     */
    public static function view($view = '', $variables = [])
    {
        if (self::viewExists($view)) {
            foreach ($variables as $key => $value) {
                if (!in_array($key, self::$reserved) && (strpos($key, '_') > 1 || strpos($key, '_') === false) && strpos($key, '$') === false) {
                    $$key = $value;
                } else {
                    throw new \Exception('using a reversed keyword in view variables, pls reference Framework\\ViewManager, offender: '.$key);
                }
            }
            include(self::viewPath($view));
            return true;
        }

        throw new \Exception('View not found '.$view);
    }
}
