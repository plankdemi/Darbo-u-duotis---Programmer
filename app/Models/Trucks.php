<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Trucks extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'trucks';
    protected $primaryKey = 'unitNumber';
    public $incrementing = false;
    protected $fillable = ['unitNumber', 'year', 'notes'];


    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {




            $validator = Validator::make($model->toArray(), [

                'unitNumber' => [
                    'required',
                    'string',
                    'max:255',

                ],

                'year' => [
                    'required',
                    'integer',
                    'min:1900',
                    'max:' . (date('Y') + 5)
                ],

                'notes' => [
                    'string',
                    'nullable'

                ]

            ]);

            if ($validator->fails()) {
                throw new \InvalidArgumentException(implode("\n", $validator->errors()->all()));
            }
        });
    }
}
