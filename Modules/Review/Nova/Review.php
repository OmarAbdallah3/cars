<?php

namespace Modules\Review\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use League\Glide\Manipulators\Background;
use Modules\Car\Entities\Car;
use Modules\Car\Nova\Car as NovaCar;
use Modules\Review\Custom\CustomRating;
use Nikaia\Rating\Rating as RatingRating;
use NovaField\Rating\Rating ;
use Spatie\LaravelIgnition\Solutions\MakeViewVariableOptionalSolution;

use function Laravel\Prompts\text;

class Review extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Modules\Review\Entities\Review>
     */
    public static $model = \Modules\Review\Entities\Review::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Comment')
            ->rules('required','max:255'),

            Text::make('Rate', 'rate', function () {
                return '<div class="rating">
        <input type="radio" id="rate" name="rate" value="5" /><label for="star5"></label>
        <input type="radio" id="rate" name="rate" value="4" /><label for="star4"></label>
        <input type="radio" id="rate" name="rate" value="3" /><label for="star3"></label>
        <input type="radio" id="rate" name="rate" value="2" /><label for="star2"></label>
        <input type="radio" id="rate" name="rate" value="1" /><label for="star1"></label>
    </div>    ';
            })->asHtml()
            ->exceptOnForms(),

            Number::make('Rate')
            ->onlyOnForms()
            ->rules('required')
            ->min(1)
            ->max(5),

            BelongsTo::make('User'),

            BelongsTo::make('Car'),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
