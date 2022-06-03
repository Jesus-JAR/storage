<?php

namespace App\Http\Livewire;

use App\Http\Requests\RequestUpdateUser;
use Livewire\Component;
use App\Models\User;
use App\Models\Bussines;
class LiveModal extends Component
{
    public $showModal = 'hidden';
    public $user = null;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $dni;
    public $cod_emp;
    public $work_hours;
    public $rol;
    public $rol_user;

    protected $listeners = [
        'showModal'

    ];

    public function render()
    {

        return view('livewire.live-modal',['bussines' => Bussines::all()]);
    }

    public function showModal(User $user)
    {
        //dd($user);
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->phone = $user->phone;
        $this->dni = $user->dni;
        $this->work_hours = $user->work_hours;
        $this->cod_emp = $user->cod_emp;

        $this->showModal = '';
    }

    public function closeModal()
    {
        $this->reset();
        $this->showModal = 'hidden';
    }

    public function updateUser()
    {
        $requestUser = new RequestUpdateUser();
        $values = $this->validate($requestUser->rules(), $requestUser->messages());

        // se comprueba el rol para eliminarlo
        if ($this->user->hasRole('Admin')){
            $this->rol_user = 'Admin';
        }elseif ($this->user->hasRole('Manager')){
            $this->rol_user = 'Manager';
        }else{
            $this->rol_user = 'Developer';
        }
        $this->user->removeRole($this->rol_user);
        $this->user->assignRole($this->rol);

        $this->user->update($values);
        $this->emit('userListUpdate');
        $this->reset();


    }

    public function updated($label)
    {
        //dd($label);
        $requestUser = new RequestUpdateUser();
        $this->validateOnly($label, $requestUser->rules(), $requestUser->messages());
    }
}
