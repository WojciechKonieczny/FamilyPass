<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
 *             $table->string('name');
            $table->string('url')->nullable();
            $table->string('username');
            $table->string('password');
            $table->text('comment')->nullable();
 */

class Password extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'username',
        'password',
        'comment',
        'user_id'
    ];

    // kazde haslo moze miec jednego uzytkownika
    public function user() {
        return $this->belongsTo(User::class);
    }
}
