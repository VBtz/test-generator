<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $table = 'questions';
    protected $fillable = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function test() {
        return $this->hasMany(Test::class, 'test_id')->first();
    }
}
