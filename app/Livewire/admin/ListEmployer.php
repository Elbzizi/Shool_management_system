<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;

class ListEmployer extends Component
{
    public $Employers , $name , $prenom, $sexe, $dateNaissance, $cin, $adress, $matier, $email,$tel , $photo ,$password ,$inputrole;
    public $role;

    public function mount(){
        $this->Employers = Admin::where('role','!=','directeur')->get();
    }
    public function render()
    {
        return view('livewire.admin.list-employer');
    }
    public function filter(){
        if ($this->role==='all') {
            $this->Employers = Admin::where('role','!=','directeur')->get();
        } else {
            $this->Employers = Admin::where('role',$this->role)->get();
        }
    }


    protected $rules = [
        'name' => 'required|max:50',
        'prenom' => 'required|max:50',
        'sexe' => 'required',
        'dateNaissance' => 'required',
        'cin' => 'required|min:8|max:8',
        // 'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'adress' => 'required|min:5|max:250',
        'email' => 'required|email',
        'tel' => 'required|min:10|max:10',
        'role' => 'required'
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->resetValidation();
    }

    public function addEmployer(){
        $this->validate();
        if($this->password = null){
            $password = $this->prenom.$this->cin;
        }
        else(
            $password = $this->password
        );
        Admin::create([
            'name'=>$this->name,
            'prenom'=>$this->prenom,
            'sexe'=>$this->sexe,
            'dateNaissance'=>$this->dateNaissance,
            'cin'=>$this->cin,
            'adress'=>$this->adress,
            // 'matier'=>$this->matier,
            'email'=>$this->email,
            'tel'=>$this->tel,
            'photo'=>$this->photo,
            'password'=>bcrypt($password),
            'role'=>$this->inputrole,
        ]);
        $this->resetInput();
        // $this->notification = "L'étudiant a été ajouté avec succès";
        toastr()->success("L'étudiant a été ajouté avec succès");

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
