<?php
    if (! function_exists('isActive')) {

        function isActive($href, $class = 'active')
        {
            return $class = (strpos(route::currentRouteName(), $href) === 0 ? $class : '');
        }
    }
