

<?php

public function showLoginForm()
{
    $admin = request()->query('admin');
    return view('auth.login', compact('admin'));
}

