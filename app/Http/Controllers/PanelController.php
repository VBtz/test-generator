<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class PanelController extends Controller {

    public function index() {
        return view('panel', [
            'tests' => Test::paginate(4)
        ]);
    }

    public function onDelete(Request $request) {
        $test = Test::findOrFail($request->hiddenId);
        $test->delete();

        return redirect()->back();
    }
}
