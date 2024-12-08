<?php

namespace Modules\Main\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeometryCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) return null;

        // Retrieve the latitude and longitude using raw SQL functions
        $result = DB::table($model->getTable())
            ->selectRaw('ST_X(' . $key . ') as longitude, ST_Y(' . $key . ') as latitude')
            ->where('id', $model->id)
            ->first();

        return [
            'latitude' => $result->latitude,
            'longitude' => $result->longitude,
        ];

    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Assuming $value is an array like ['lat' => ..., 'lng' => ...]

        $longitude = $value['lng'] ?? $value[0] ?? null;
        $latitude = $value['lat'] ?? $value[1] ?? null;
        if ($longitude && $latitude) {

            return DB::raw("ST_GeomFromText('POINT($longitude $latitude)')");
        }

        return null;
    }
}
