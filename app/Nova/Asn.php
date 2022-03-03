<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

/**
 * Class Asn
 *
 * @package App\Nova
 *
 * @property-read \App\Models\Label $label
 * @property-read string $value
 */
class Asn extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Asn::class;

    /**
     * @var string[]
     */
    public static $with = ['label'];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'value',
    ];

    public function title(): string
    {
        return $this->value;
    }

    public function subtitle(): string
    {
        return $this->label->name;
    }

    public function fields(Request $request): array
    {
        return [
            ID::make()
                ->asBigInt()
                ->sortable(),

            BelongsTo::make('Label'),

            Text::make('Value')
                ->rules('required', 'max:255'),

            Boolean::make('Enabled'),
        ];
    }
}
