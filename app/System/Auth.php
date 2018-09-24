<?php

namespace App\System;

use App\Models\User;

class Auth
{

    protected $loggedIn = false;
    protected $user;

    public function getUser()
    {
        return $this->user;
    }

    public function check($email = '', $pass = '')
    {

        if ($this->loggedIn) return true;

        if (!$email && !$pass) {
            $email = $_COOKIE['email'] ?? '';
            $pass = $_COOKIE['pass'] ?? '';
        }

        if ($email && $pass) {
            $user = User::where(['email' => $email]);

            if ($user) {
                $user = $user[0];

                if ($user && $pass == $user->pass) {
                    $this->user = $user;
                    $this->loggedIn = true;
                    return true;

                }
            }
        }
    }

    public function set($arr)
    {
        foreach ($arr as $key => $value) {
            setcookie($key, $value, time() + 3600 * 24 * 7, '/');
        }
    }

    public function remove($arr)
    {

        foreach ($arr as $key => $value) {
            setcookie($value, null, -1, '/');
        }

    }

    public function destroy()
    {
        $this->remove(['email', 'pass']);
    }

}