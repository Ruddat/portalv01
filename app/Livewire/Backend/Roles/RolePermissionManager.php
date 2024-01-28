<?php

namespace App\Livewire\Backend\Roles;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionManager extends Component
{

    public $selectedRole;
    public $selectedPermissions = [];
    public $selectedUserId;

    public function render()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('livewire.backend.roles.role-permission-manager', compact('users', 'roles', 'permissions'));
    }



    public function editPermissions($userId)
    {
        // Hier kannst du die Logik implementieren, um die Berechtigungen für einen bestimmten Benutzer zu bearbeiten
        // Zum Beispiel, eine andere Livewire-Komponente für die Bearbeitung öffnen oder eine Modalfenster anzeigen
        // ...

        $this->selectedUserId = $userId;
    }



    public function save()
    {
        $role = Role::findByName($this->selectedRole);

        // Berechtigungen für die Rolle aktualisieren
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('message', 'Rollen und Berechtigungen wurden erfolgreich aktualisiert.');

        $this->refresh();
    }

}
