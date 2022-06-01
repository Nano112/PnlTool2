<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Axes;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AxesTable extends LivewireDatatable
{
    public $model = Axes::class;

    public function mount(
        $model = false,
        $include = [],
        $exclude = [],
        $hide = [],
        $dates = [],
        $times = [],
        $searchable = [],
        $sort = null,
        $hideHeader = null,
        $hidePagination = null,
        $perPage = null,
        $exportable = false,
        $hideable = false,
        $beforeTableSlot = false,
        $buttonsSlot = false,
        $afterTableSlot = false,
        $params = []
    )
    {
        parent::mount(
            $model,
            $include,
            $exclude,
            $hide,
            $dates,
            $times,
            $searchable,
            $sort,
            $hideHeader,
            $hidePagination,
            $perPage,
            $exportable,
            $hideable,
            $beforeTableSlot,
            $buttonsSlot,
            $afterTableSlot,
            $params
        );
        $this->activeDateFilters[5] = [
            'start' => Carbon::today()->format('Y-m-d'),
            'end' => Carbon::today()->addDays(1)->format('Y-m-d'),
        ];
        $this->refreshLivewireDatatable();
    }

    public function columns()
    {
        return [
            Column::name('cusip')->label('CUSIP')->searchable(),
            Column::name('size')->label('Size')->searchable(),
            Column::name('type')->label('Type')->searchable()->filterable(['ASK','BID'])->view('components.ask-bid-icon'),
            Column::name('dealer')->label('Dealer')->searchable(),
            Column::name('dealer_code')->label('Dealer Code')->searchable(),
            DateColumn::name('created_at')->filterable(),
            Column::delete(),
        ];

    }
}
