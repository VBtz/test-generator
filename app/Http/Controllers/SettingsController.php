<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class SettingsController extends Controller {

    public function index($testId) {
        return view('settings', [
            'test' => Test::findOrFail($testId)
        ]);
    }

    public function onSaveName(Request $request) {
        $test = Test::findOrFail($request->test);
        $test->name = $request->name;
        $test->successMessage = $request->successMessage;

        $test->update();
        return redirect()->back();
    }
}
