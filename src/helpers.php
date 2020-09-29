<?php


if (! function_exists('admin_url')) {
    /**
     * Get admin url
     *
     * @param $path
     *
     * @param array $parameters
     * @param null $secure
     *
     * @return string
     */
    function admin_url($path = null, $parameters = [], $secure = null)
    {
        $path = ! $path || (substr($path, 0, 1) == '/') ? $path : '/'.$path;

        return url(config('tessa.base.route_prefix', 'admin').$path, $parameters, $secure);
    }
}

if (! function_exists('admin_view')) {

    /**
     * Get view string with namespace
     *
     * @param $view
     *
     * @return string
     */
    function admin_view($view)
    {
        $theme = 'tessa_admin::';

        return $theme.$view;
    }
}