<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestCreateRequest;
use App\Test;

class CreateTestController extends Controller {

    public function index() {
        return view('create');
    }

    public function onCreate(TestCreateRequest $request) {
        $test = new Test();
        $test->name = $request->name;
        $test->successMessage = 'Поздравляем! Вы прошли тест.';
        $test->save();

        return redirect()->route('settings', [
            'test' => $test
        ]);
    }
}
