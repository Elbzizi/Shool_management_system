<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use App\Models\Groupe;
use App\Models\Matier;
use App\Models\admin_matier_groupe;
use Livewire\Component;

class Matiers extends Component
{
    public $matiers ,$matier ,$coeff ,$duree , $enseignants , $enseignant ,$groupes , $groupe, $pivots;
    public $admin_id , $matier_id , $groupe_id;
    public function render()
    {
        $this->matiers = Matier::get();
        $this->enseignants = Admin::where('role','enseignant')->get();
        $this->groupes = Groupe::get();
        $this->pivots = Admin::with(['matiers' => function ($query) {
            $query->withPivot('groupe_id');
        }])->get();

        return view('livewire.admin.matiers');
    }
    public function create() {

        Matier::create([
            'nom_matier' => $this->matier,
            'Coefficient' => $this->coeff,
            'duree' => $this->duree,
        ]);

        session()->flash('message', 'Matier Ajouté');
        $this->matier = '';
        $this->coeff = '';
        $this->duree = '';

    }
    public function affecter() {
        admin_matier_groupe::create([
            'groupe_id' => $this->groupe_id,
            'admin_id' => $this->admin_id,
            'matier_id' => $this->matier_id,
        ]);
    }

}
