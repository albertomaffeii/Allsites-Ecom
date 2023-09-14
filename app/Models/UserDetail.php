<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $guarded = [];

    protected $fillable = [
        'personal_tax_code',
        'billing_email',
        'phone',
        'pin_code',
        'country',
        'address',
        'user_id',
        'profile_image',
        'panel_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
