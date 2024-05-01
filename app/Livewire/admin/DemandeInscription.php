<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class DemandeInscription extends Component

{
    public $id, $name, $prenom, $sexe, $cin, $photo, $adress, $role, $dateNaissance, $statut, $tel, $email, $password;
    public $desactiveEtudiants ;
    public $selectedetudiants = [];
    public $selectAll ;
    public $showEtudiantDetails ;

    public function mount()
    {
        $this->selectedetudiants = new Collection();

    }


    public function render(){
        $this->desactiveEtudiants = User::where('statut','desactive')->get();

        return view('livewire.admin.demande-inscription');}



    public function selectOne($id)
    {


        $selectedetudiants = $this->selectedetudiants->toArray();

        if(count($selectedetudiants)>0){
            $selectedetudiants[] = $id;
            $this->showEtudiant(end($selectedetudiants) ?? null);
        }
        else{

            $this->showEtudiantDetails = null;
        }
    }

    public function accepter($id = null){
        if ($id !== null) {
            $etudiantt =User::find($id);
            $etudiantt->statut = 'active';
            $etudiantt->save();
            session()->flash('success', 'L`étudiant a été accepté avec succès.');

        } else {
            if($this->selectedetudiants){
                foreach ($this->selectedetudiants as $etudiant_Id) {
                    $etudiant = User::find($etudiant_Id);
                    $etudiant->statut = 'active';
                    $etudiant->save();
                }
            }
            else{
                User::where('statut','desactive')->update(['statut' => 'active']);
                session()->flash('success', 'Tous les etudiants ont été activés');
            }
            session()->flash('success', 'Les étudiants sélectionnés ont été acceptés avec succès.');
            $this->selectedetudiants = new Collection();

        }
        $this->showEtudiantDetails = null;


    }



    public function refuser(){
        dd('non');
    }

    public function showEtudiant($id) {
        $this->showEtudiantDetails = User::findorFail($id);
    }
     // create ------------------------------------------------------------------
     protected $rules = [
        'name' => 'required|min:3|max:50',
        'prenom' => 'required|min:3|max:50',
        'sexe' => 'required',
        'cin' => 'required|min:8|max:8',
        'dateNaissance' => 'required',
        // 'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'adress' => 'required|min:5|max:250',
        'statut' => 'required',
        'tel' => 'required|min:10|max:10',
        'email' => 'required|email',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->resetValidation();
    }

    public function create() {

        $this->validate();

        $this->password = $this->cin;
        User::create([
            'name' => $this->name,
            'prenom' => $this->prenom,
            'sexe' => $this->sexe,
            'cin' => $this->cin,
            // 'photo' => $this->photo,
            'adress' => $this->adress,
            'date_naissane' =>$this->dateNaissance,
            'tel' => $this->tel,
            'email' => $this->email,
            'password' =>$this->password,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $this->resetInput();
        $this->notification = "L'étudiant a été ajouté avec succès";
        $this->dispatch('close-modal');

    }

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
}