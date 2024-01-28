<!-- role-permission-manager.blade.php -->

<div>
    <h2>Rollen und Berechtigungen verwalten</h2>

    <!-- Tabelle mit Benutzerdaten anzeigen -->
    <table>
        <thead>
            <tr>
                <th>Benutzername</th>
                <th>Email</th>
                <th>Rolle</th>
                <th>IP-Adresse</th>
                <th>Eingetragen am</th>
                <th>Bearbeiten</th> <!-- Neues Spalten-Header für den Edit-Button -->
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles->isNotEmpty())
                            {{ $user->roles->first()->name }}
                        @else
                            Keine Rolle zugewiesen
                        @endif
                    </td>
                    <td>{{ $user->ip_address }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <button wire:click="editPermissions({{ $user->id }})">Editieren</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Rollen auswählen -->
    <div>
        <label for="selectedRole">Rolle auswählen:</label>
        <select wire:model="selectedRole" id="selectedRole">
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Berechtigungen auswählen -->
    <div>
        <label>Berechtigungen auswählen:</label>
        @foreach($permissions as $permission)
            <label>
                <input type="checkbox" wire:model="selectedPermissions.{{ $permission->id }}"> {{ $permission->name }}
            </label><br>
        @endforeach
    </div>

    <button type="submit" wire:click="save">Speichern</button>
    @if ($selectedUserId)
    <livewire:backend.roles.edit-permissions :userId="$selectedUserId" :key="$selectedUserId" />
@endif

</div>
