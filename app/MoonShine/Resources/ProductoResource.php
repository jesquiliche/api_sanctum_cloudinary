<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\MoonShine\Pages\Producto\ProductoIndexPage;
use App\MoonShine\Pages\Producto\ProductoFormPage;
use App\MoonShine\Pages\Producto\ProductoDetailPage;
use MoonShine\Fields\ID;
use MoonShine\Resources\ModelResource;
use MoonShine\Pages\Page;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Producto>
 */
class ProductoResource extends ModelResource
{
    protected string $model = Producto::class;

    protected string $title = 'Productos';

    /**
     * @return list<Page>
     */
    public function pages(): array
    {
        return [
            ProductoIndexPage::make($this->title()),
            ProductoFormPage::make(
                $this->getItemID()
                    ? __('moonshine::ui.edit')
                    : __('moonshine::ui.add')
            ),
            ProductoDetailPage::make(__('moonshine::ui.show')),
        ];
    }

    /**
     * @param Producto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return ['nombre' => 'required|string|max:255',
        'bodega' => 'nullable|string|max:255',
        'descripcion' => 'required|string',
        'maridaje' => 'required|string',
        'precio' => 'required|numeric',
        'graduacion' => 'required|numeric',
        'ano' => 'nullable|integer',
        'sabor' => 'nullable|string|max:255',
        'tipo_id' => 'required|exists:tipos,id',
        'imagen'=>'nullable:string',
        //'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'denominacion_id' => 'required|exists:denominaciones,id',
];
    }

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Image::make('imagen'),
            BelongsTo::make('Tipo', 'tipo', 'nombre')->nullable(),
            BelongsTo::make('D.O.P', 'denominacion', 'nombre')->nullable(),
            Text::make('Nombre', 'nombre')->sortable(),
            Textarea::make('Descripción', 'descripcion'),
            Text::make('Maridaje', 'maridaje'),
            Number::make('Precio', 'precio')->min(1)->max(1000)->step(0.10),
            Number::make('Graduacion', 'graduacion')->min(1)->max(100)->step(0.10),
            Number::make('Año', 'ano')->min(1950)->max(2030)->step(1),
            Text::make('Sabor', 'sabor'),
        ];
    }

    public function filters(): array
    {
        return [

            BelongsTo::make('Tipo', 'tipo', 'nombre')->nullable(),
            BelongsTo::make('Denominación', 'denominacion', 'nombre')->nullable(),
            Text::make('Nombre', 'nombre'),
        ];
    }
   
}