<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GuestLoginController extends Controller
{
    public function login()
    {
      $email = 'guest@guest.guest';
      $password = 'guestpassword';

      if(Auth::attempt(['email' => $email, 'password' => $password])){
        return redirect()->route('tasks.index', [
        'user_id' => Auth::id()
        ]);
      }

      return redirect()->back();
    }
}
