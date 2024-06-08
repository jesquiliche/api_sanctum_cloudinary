<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tipo;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;

use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Tipo>
 */
class TipoResource extends ModelResource
{
    protected string $model = Tipo::class;

    protected string $title = 'Tipos';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make(
                    'Nombre',
                    'nombre',
                ),
                Textarea::make(
                    'Descripción',
                    'descripcion',
                )
            ]),
        ];
    }


    /**
     * @param Tipo $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return ['nombre'=>'required','descripcion'=>'required'];
    }
}
