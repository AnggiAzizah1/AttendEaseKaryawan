<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class LoginController extends Controller
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path('path/to/facerecognition-c8264-firebase-adminsdk-nodyk-90850d2e73.json'))
                                 ->withDatabaseUri('https://facerecognition-c8264-default-rtdb.firebaseio.com/');

        $this->database = $factory->createDatabase();
    }

    public function home()
    {
        return view('home');
    }

    public function showAdminLogin()
    {
        return view('login_admin');
    }

    public function loginAdmin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $ref = $this->database->getReference('akun');
        $accounts = $ref->getValue();

        if ($accounts) {
            foreach ($accounts as $user) {
                if ($user['username'] === $username && password_verify($password, $user['password'])) {
                    Session::put('user', $username);
                    return redirect('/dashboard');
                }
            }
        }

        return view('login_admin', ['message' => 'Username atau Password salah!']);
    }
}
