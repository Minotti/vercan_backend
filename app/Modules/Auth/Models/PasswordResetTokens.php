<?php

namespace App\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetTokens extends Model
{
    protected $primaryKey = null;

    public $incrementing = false;

    protected $table = 'password_reset_tokens';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    protected $dates = [
        'created_at'
    ];
}
