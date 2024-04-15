<?php

namespace App\Livewire\Reports;

use App\Models\PeopleForm;
use Livewire\Component;

class ChartPerHour extends Component
{

    public $votes = [];
    public $total_votes, $total_registers;


    public function render()
    {

        $this->total_votes = PeopleForm::where('vote', 1)->count();
        $this->total_registers = PeopleForm::all()->count();

        array_push($this->votes, array(
            'hora' => '8:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 8:00')
                ->where('updated_at', '<', '2024-06-02 9:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '9:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 9:00')
                ->where('updated_at', '<', '2024-06-02 10:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '10:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 10:00')
                ->where('updated_at', '<', '2024-06-02 11:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '11:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 11:00')
                ->where('updated_at', '<', '2024-06-02 12:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '12:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 12:00')
                ->where('updated_at', '<', '2024-06-02 13:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '13:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 13:00')
                ->where('updated_at', '<', '2024-06-02 14:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '14:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 14:00')
                ->where('updated_at', '<', '2024-06-02 15:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '15:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 15:00')
                ->where('updated_at', '<', '2024-06-02 16:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '16:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 16:00')
                ->where('updated_at', '<', '2024-06-02 17:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '17:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 17:00')
                ->where('updated_at', '<', '2024-06-02 18:00')
                ->count()
        ));
        array_push($this->votes, array(
            'hora' => '18:00',
            'total' => PeopleForm::where('vote', 1)
                ->where('updated_at', '>=', '2024-06-02 18:00')
                ->where('updated_at', '<', '2024-06-02 19:00')
                ->count()
        ));

        return view('livewire.reports.chart-per-hour', [$this->votes, $this->total_votes]);
    }
}
