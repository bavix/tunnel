<?php

declare(strict_types=1);

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

/**
 * Class Label
 *
 * @package App\Nova
 *
 * @property-read string $name
 * @property-read string $description
 */
class Label extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\Label::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description',
    ];

    public function title(): string
    {
        return $this->name;
    }

    public function subtitle(): ?string
    {
        return $this->description;
    }

    public function fields(Request $request): array
    {
        return [
            ID::make()
                ->asBigInt()
                ->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->updateRules('unique:labels,name,{{resourceId}}'),

            Text::make('Description')
                ->nullable()
                ->rules('max:255')
                ->displayUsing(function ($value) {
                    return Str::words($value, 12, '...');
                }),

            Boolean::make('Enabled'),

            HasMany::make('Ip Addresses', 'IpAddresses'),
        ];
    }
}
