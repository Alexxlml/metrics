<?php

namespace App\Livewire\Reports;

use App\Models\Section;
use Livewire\Component;
use App\Models\PeopleForm;

class ChartPerSection extends Component
{
    public $votes = [];
    public $total_votes, $total_registers;

    public function render()
    {
        $this->total_votes = PeopleForm::where('vote', 1)->count();
        $this->total_registers = PeopleForm::all()->count();

        $sections = Section::all()->pluck('number', 'id');

        foreach ($sections as $id => $section) {
            array_push($this->votes, array(
                'label' => intval($section),
                'total' => PeopleForm::where('vote', 1)
                    ->where('section_id', $id)->count()
            ));
        }

        return view('livewire.reports.chart-per-section', [$this->votes]);
    }
}
