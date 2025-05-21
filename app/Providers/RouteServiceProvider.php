<?php

public const HOME = '/dashboard';

public static function redirectTo()
{
    return auth()->user()->is_admin ? '/admin/dashboard' : '/dashboard';
}

