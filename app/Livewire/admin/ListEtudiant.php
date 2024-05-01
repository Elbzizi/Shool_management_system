<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ListEtudiant extends Component
{


    public $id, $name, $prenom, $sexe, $cin, $photo, $adress, $role, $dateNaissance, $statut, $tel, $email, $password;
    public $search;
    public $successMessage;


    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        $etudiants = User::where('statut','active')
        ->where(function($query){
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('prenom', 'like', '%' . $this->search . '%');
        })
        ->orderBy('name', 'asc')
        ->orderBy('prenom', 'asc')
        ->paginate(10);

        return view('livewire.admin.list-etudiant', [
            'etudiants' => $etudiants,

        ]);
        $this->search = '';
    }
    // create ------------------------------------------------------------------
    protected $rules = [
        'name' => 'required',
        'prenom' => 'required',
        'cin' => 'required|min:8|max:8',
        'adress' => 'required',
        'statut' => 'required',
        'tel' => 'required|min:10|max:10',
        'email' => 'required|email',
    ];


    // resetInput ------------------------------------------------------------------
    public function resetInput() {

        $this->name = null;
        $this->prenom = null;
        $this->sexe = null;
        $this->cin = null;
        $this->photo = null;
        $this->adress = null;
        $this->statut = null;
        $this->tel = null;
        $this->email = null;
    }
    // delete ------------------------------------------------------------------
    public function delete($id){
        $etudiants = User::find($id);
        if($etudiants){
            $etudiants->delete();
            $this->successMessage = 'Etudiant supprimé avec succès';
            // dd($this->successMessage);
            session()->flash('successMessage', 'Etudiant supprimé avec succès');
        }
        else{
            session()->flash('error', 'Étudiant non trouvé.');
        }
    }
    // filter ------------------------------------------------------------------


    public function filter()
    {
        // $this->resetPage(); // Reset pagination to the first page when filtering
    }
    public function clearSearch()
    {
        $this->search = '';
        // $this->resetPage(); // Reset pagination to the first page when clearing search
    }

}