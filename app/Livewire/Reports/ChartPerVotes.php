<?php

namespace App\Livewire\Reports;

use App\Models\PeopleForm;
use Livewire\Component;

class ChartPerVotes extends Component
{

    public $votes = [];
    public $total_votes, $total_registers;

    public function render()
    {
        $this->total_votes = PeopleForm::where('vote', 1)->count();
        $this->total_registers = PeopleForm::all()->count();

        array_push($this->votes, array(
            'label' => 'Confirmados',
            'total' => PeopleForm::where('vote', 1)->count()
        ));
        array_push($this->votes, array(
            'label' => 'No Confirmados',
            'total' => PeopleForm::where('vote', 0)->count()
        ));

        return view('livewire.reports.chart-per-votes', [$this->votes]);
    }
}
