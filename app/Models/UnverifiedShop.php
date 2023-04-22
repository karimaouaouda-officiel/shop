<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnverifiedShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand',
        'description',
        'brand_picture',
        'brand_cover',
        'facebook_account',
        'instagram_account',
        'youtube_channel'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setAsVerified()
    {
        //code to verify
    }

    public function setAsRefuse()
    {
        //code to refuse
    }
}