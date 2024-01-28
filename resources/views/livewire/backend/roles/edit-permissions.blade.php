<div>
    <h2>Berechtigungen bearbeiten für {{ $user->name }}</h2>

    <form wire:submit.prevent="save">
        <!-- Rolle auswählen -->
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

        <button type="submit">Speichern</button>
    </form>
</div>
