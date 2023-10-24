<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'gender',
        'email',
        'postcode',
        'address',
        'building_name',
        'opinion',
    ];
    public function scopeSearch($query)
    {
        if (request('name')) {
            $query->where('name', 'LIKE', '%' . request('name') . '%');
        }

        if (request('gender') && request('gender') !== 'all') {
            $query->where('gender', request('gender'));
        }

        if (request('email')) {
            $query->where('email', 'LIKE', '%' . request('email') . '%');
        }

        if (request('created_at')) {
            $query->whereDate('created_at', '=', request('created_at'));
        }
        return $query;
    }
}
