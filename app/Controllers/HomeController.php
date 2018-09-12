<?php

namespace App\Controllers;

use \Auth;
use App\Models\Vacancy;

class HomeController
{
	public function index()
	{
		$items = Vacancy::all();
		return render('home', ['title' => 'Home' ,'items' => $items]);
	}

    public function login()
    {
        return render('login');
    }

	public function auth()
	{
	    $email = $_POST['email'] ?? '';
        $pass = $_POST['pass'] ?? '';

	    if ($email && $pass) {

	        if (Auth::check($email, md5($pass))) {
	            Auth::set(['email' => $email, 'pass' => md5($pass)]);
                return redirect('home.index');
            } else {
                return render('login', ['message' => 'Incorrect email/pass or user doesn\'t exists']);
            }
        }
        return render('login');
	}


	public function register()
	{
		return render('home');
	}

	public function logout()
	{
        Auth::destroy();
        return redirect('home.index');
	}		
	
}