<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugado
{
    /**
     * @var string
     */
    private $colunaTitulo = 'titulo';

    /**
     * @var string
     */
    private $colunaSlug = 'slug';

    /**
     * Boot do Slugado.
     *
     * @return void
     */
    public static function bootSlugado()
    {
        //
        static::saving(function ($model) {
            $model->prepareSlug();
        });
    }

    /**
     * Definindo a coluna do titulo.
     *
     * @return string
     */
    private function colunaTitulo()
    {
        return ($this->SlugTitulo) ? $this->SlugTitulo : $this->colunaTitulo;
    }

    /**
     * Definindo a coluna que vai receber o slug.
     *
     * @return string
     */
    private function colunaSlug()
    {
        return ($this->SlugColuna) ? $this->SlugColuna : $this->colunaSlug;
    }

    /**
     * Prepare slug model.
     *
     * @return void
     */
    public function prepareSlug()
    {
        if ($this->slug == '') {
            $slugado = Str::slug($this[$this->colunaTitulo]);
            $workingModel = clone $this;
            $count = 0;
            while ($workingModel->where($this->colunaSlug, '=', $slugado)->first()) {
                $count += 1;
                $slugado = Str::slug($this->titulo.'-'.dechex($count));
            }
            $this->salvaSlug($slugado);
        }
    }

    /**
     * @param string $slug
     */
    public function salvaSlug($slug)
    {
        $this[$this->colunaSlug] = $slug;
    }
}
