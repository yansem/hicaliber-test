<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class House extends Model
{
    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages'
    ];

    public function scopeWithSearch($query, array $params)
    {
        return $query
            ->when(isset($params['name']), function ($query) use ($params) {
                return $query->where('name', 'like', '%' . $params['name'] . '%');
            })
            ->when(isset($params['price']), function ($query) use ($params) {
                $query->whereBetween('price', [$params['price'][0], $params['price'][1]]);
            })
            ->when(isset($params['bedrooms']), function ($query) use ($params) {
                $query->where('bedrooms', '=', $params['bedrooms']);
            })
            ->when(isset($params['bathrooms']), function ($query) use ($params) {
                $query->where('bathrooms', '=', $params['bathrooms']);
            })
            ->when(isset($params['storeys']), function ($query) use ($params) {
                $query->where('storeys', '=', $params['storeys']);
            })
            ->when(isset($params['garages']), function ($query) use ($params) {
                $query->where('garages', '=', $params['garages']);
            });
    }
}
