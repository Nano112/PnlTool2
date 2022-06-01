<?php

namespace App\Http\Livewire;

use App\Models\Isin;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ReposTable extends LivewireDatatable
{
    public $model = Isin::class;

    public function columns()
    {
        return [
            Column::name('isin')->label('ISIN')->searchable(),
            Column::name('name')->label('Name')->searchable(),
            Column::name('currency')->label('Currency')->filterable(Isin::groupBy('currency')->pluck('currency')),
            Column::name('repo_rate')->label('Repo Rate')->editable(),
            Column::name('comment')->label('Comment')->editable()->searchable(),
            Column::delete(),
        ];
    }
}
