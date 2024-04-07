<?php

namespace App\Livewire\Subordinates;

use App\Models\PeopleForm;
use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class MainSubordinates extends Component
{
    use WithPagination;

    protected $perPage = 10;

    public $userFromView, $roleUserFromView, $ownerUserName, $loggedUser;

    public function mount($id)
    {
        $this->userFromView = intval($id);
        $this->roleUserFromView = User::find($id)->getRoleNames()->first();
        $this->ownerUserName = User::find($id)->name;
        $this->loggedUser = Auth::user()->id;

        if (is_numeric($id)) {
            if (!$this->checkuserFromViewOrBoss($this->userFromView)) {
                abort(403, 'No tienes permiso para acceder a este contenido');
            }
        } else {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.subordinates.main-subordinates', [
            'subordinates' => User::whereHas('boss', function ($query) {
                $query->where('boss_id', $this->userFromView);
            })->paginate($this->perPage),
        ]);
    }

    public function downloadCapturerPerAnalystListReport($id)
    {
        $data = [];

        $subordinates = User::role('Data Capturer')
            ->get();

        foreach ($subordinates as $subordinate) {
            $counter = PeopleForm::where('user_id', $subordinate->id)->count();
            array_push($data, ['name' => $subordinate->name, 'form_counter' => $counter]);
        }

        $pdf = Pdf::loadView('pdf.all_capturers_counter', [
            'forms' => $data,
        ])->setPaper('letter');

        $pdf->output();
        $domPdf = $pdf->getDomPDF();

        $canvas = $domPdf->get_canvas();
        $canvas->page_text(10, 10, 'Página {PAGE_NUM} de {PAGE_COUNT}', null, 10, [0, 0, 0]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'reporte_formularios_capturistas.pdf');
    }

    public function downloadCapturerReport($id)
    {
        $capturer = User::find($id);
        $count_forms = PeopleForm::where('user_id', $id)->count();
        $forms = PeopleForm::where('user_id', $id)->get();

        $pdf = Pdf::loadView('pdf.capturer_report', ['forms' => $forms])->setPaper('letter');

        $pdf->output();
        $domPdf = $pdf->getDomPDF();

        $canvas = $domPdf->get_canvas();
        $canvas->page_text(10, 10, $capturer->name . ' - Total: ' . $count_forms . ' - Página {PAGE_NUM} de {PAGE_COUNT}', null, 10, [0, 0, 0]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'reporte_' . str_replace(' ', '_', strtolower($capturer->name)) . '.pdf');
    }

    public function checkuserFromViewOrBoss($user_from_view): bool
    {
        $flag = false;
        $searched_user = 0;
        $check = true;
        $array_of_users = [];

        if ($user_from_view === $this->loggedUser) {
            $flag = true;
        } else {
            while ($check == true) {
                try {
                    $searched_user = User::findOrFail($user_from_view)->boss()->get()[0]->boss_id;
                    array_push($array_of_users, $searched_user);
                    $user_from_view = $searched_user;
                    $check = true;
                } catch (Exception $err) {
                    $check = false;
                }
            }
            if (in_array($this->loggedUser, $array_of_users)) {
                $flag = true;
            }
        }

        return $flag;
    }
}
