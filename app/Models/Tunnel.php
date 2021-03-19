<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tunnel
 *
 * @property int $id
 * @property string $name
 * @property int $where_from
 * @property int $where_to
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $enabled
 * @property bool $reverse
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereReverse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereWhereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tunnel whereWhereTo($value)
 * @mixin \Eloquent
 */
class Tunnel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'where_from', 'where_to', 'address', 'reverse', 'enabled',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'where_from' => 'int',
        'where_to' => 'int',
        'reverse' => 'bool',
        'enabled' => 'bool',
    ];
}
