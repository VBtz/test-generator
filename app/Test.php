<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model {

    use SoftDeletes;

    protected $table = 'tests';
    protected $fillable = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function questions() {
        return $this->hasMany(Question::class, 'test_id')->get();
    }
}
