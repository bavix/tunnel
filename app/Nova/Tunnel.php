<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

/**
 * Class Tunnel
 *
 * @package App\Nova
 *
 * @property-read string $name
 */
class Tunnel extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Tunnel::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
    ];

    public function title(): string
    {
        return $this->name;
    }

    public function fields(Request $request): array
    {
        return [
            ID::make()
                ->asBigInt()
                ->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Where From')
                ->rules('required'),

            Number::make('Where To')
                ->rules('required'),

            Text::make('Address')
                ->rules('required', 'max:255'),

            Boolean::make('Reverse'),

            Boolean::make('Enabled'),
        ];
    }
}
