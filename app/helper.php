<?php

if (!function_exists('active')) {

    /**
     * Return link active class if route matches the conditions. Allows routes
     * to be checked against wildcards and blacklisted routes.
     *
     * @return string
     */
    function active($routes, $excludeRoutes = array(), $active = ' class=active', $notActive = '')
    {
        // get current route
        $currentRoute = Route::currentRouteName();

        // remove excluded routes
        foreach ($excludeRoutes as $route) {
            if (str_is($route, $currentRoute)) {
                return $notActive;
            }
        }

        // check wanted routes
        foreach ($routes as $route) {
            return (str_is($route, $currentRoute)) ? $active : $notActive;
        }
    }
}
