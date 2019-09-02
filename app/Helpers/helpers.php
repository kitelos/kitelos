<?php

if (! function_exists ('generate_permissions')) {
    function generate_permissions () {
        return app(\App\Helpers\Helper::class)->generatePermissions();
    }
}

if (! function_exists('parse_boolean')) {
    function parse_boolean($value = false) {
        return app(\App\Helpers\Helper::class)->parseBoolean($value);
    }
}

if (! function_exists('permiss')) {
    function permiss ( $permission ) {
        return app(\App\Helpers\Helper::class)->permiss( $permission );
    }
}