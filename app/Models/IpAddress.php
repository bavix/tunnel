<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\IpService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\Pure;

/**
 * App\Models\IpAddress
 *
 * @property int $id
 * @property int $label_id
 * @property string $address
 * @property int $netmask
 * @property string $subnet
 * @property string $range
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Label $label
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereLabelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereNetmask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpAddress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IpAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label_id',
        'address',
        'netmask',
        'enabled',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'bool',
    ];

    #[Pure]
    public function getRangeAttribute(): string
    {
        return sprintf('%s/%d', $this->address, $this->netmask);
    }

    public function getSubnetAttribute(): string
    {
        return app(IpService::class)
            ->subnet($this->range);
    }

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }
}
