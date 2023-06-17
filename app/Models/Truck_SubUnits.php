<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Truck_SubUnits extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'truck_subunits';
    protected $fillable = ['main_truck', 'subunit', 'start_date', 'end_date'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            $validator = Validator::make($model->toArray(), [
                'main_truck' => [
                    'required',
                    'string',
                    'max:255'

                ],
                'subunit' => [
                    'required',
                    'string',
                    'max:255',
                    'different:main_truck',

                ],
                'start_date' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($model) {
                        $existingRecord = Truck_SubUnits::where(function ($query) use ($model) {
                            $query->where('main_truck', $model->main_truck)
                                ->orWhere('subunit', $model->subunit);
                        })
                            ->where(function ($query) use ($model) {
                                $query->where('start_date', '<=', $model->start_date)
                                    ->where('end_date', '>=', $model->start_date);
                            })
                            ->orWhere(function ($query) use ($model) {
                                $query->where('start_date', '<=', $model->end_date)
                                    ->where('end_date', '>=', $model->end_date);
                            })
                            ->exists();

                        if ($existingRecord) {
                            $fail('An entry with a matching main truck or subunit and overlapping start or end date already exists.');
                        }
                    }
                ],
                'end_date' => [
                    'required',
                    'date',

                ]

            ]);

            if ($validator->fails()) {
                throw new \InvalidArgumentException(implode("\n", $validator->errors()->all()));
            }
        });
    }
}
