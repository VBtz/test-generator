<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Artisan;

class DatabaseController extends Controller {

    public function migrate() {
        Artisan::call('migrate:fresh', ['--force' => true]);

        $this->registerUser("admin", "admin");
        $this->registerUser("test", "testtest");

        return dd(Artisan::output());
    }

    private function registerUser($login, $password) {
        $user = User::createNewUser($login, $login, $password);
        $user->save();
    }
}
