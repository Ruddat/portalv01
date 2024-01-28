<?php

namespace App\Livewire\Backend\Roles;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;

class EditPermissions extends Component
{

    public $user;
    public $selectedRole;
    public $selectedPermissions = [];

    public function mount($userId)
    {
        $this->user = User::find($userId);

        if ($this->user) {
            $this->selectedRole = optional($this->user->roles->first())->name;
            $this->selectedPermissions = $this->user->permissions->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $this->user->syncRoles([$this->selectedRole]);
        $this->user->syncPermissions($this->selectedPermissions);


                // Nach dem Speichern die letzten Berechtigungen aktualisieren
                $this->lastPermissions = $this->selectedPermissions;

        $this->dispatch('permissionsUpdated');

        session()->flash('message', 'Berechtigungen wurden erfolgreich aktualisiert.');
    }



    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('livewire.backend.roles.edit-permissions', compact('roles', 'permissions'));
    }
}
