<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Asn
 *
 * @property int $id
 * @property int $label_id
 * @property string $value
 * @property bool $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Label|null $label
 * @method static \Illuminate\Database\Eloquent\Builder|Asn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Asn query()
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereLabelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Asn whereValue($value)
 * @mixin \Eloquent
 */
class Asn extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label_id',
        'value',
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

    public function label(): BelongsTo
    {
        return $this->belongsTo(Label::class);
    }
}
