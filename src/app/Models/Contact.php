<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'gender',
        'email',
        'postcode',
        'address',
        'building_name',
        'opinion',
    ];

    public function setNameAttribute($value)
    {
        $fullName = Str::limit($value, 255);
        $this->attributes['name'] = $fullName;
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
        $this->attributes['name'] = $this->attributes['last_name'] . ' ' . $value;
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;
        $this->attributes['name'] = $value . ' ' . $this->attributes['first_name'];
    }

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
