<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

/**
 * Class IpAddress
 *
 * @package App\Nova
 *
 * @property-read \App\Models\Label $label
 * @property-read string $address
 * @property-read string $subnet
 */
class IpAddress extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\IpAddress::class;

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
        'id', 'address',
    ];

    public function title(): string
    {
        return $this->address;
    }

    public function subtitle(): string
    {
        return $this->label->name . ', ' . $this->subnet;
    }

    public function fields(Request $request): array
    {
        return [
            ID::make()
                ->asBigInt()
                ->sortable(),

            BelongsTo::make('Label'),

            Text::make('Address')
                ->rules('required', 'max:255', 'ipv4'),

            Number::make('Netmask')
                ->rules('required', 'min:0', 'max:32'),

            Boolean::make('Enabled'),
        ];
    }
}
