<?php

namespace App\Livewire\Frontend\Votings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModSellerReplays;

class ReplayList extends Component
{
    use WithPagination;

    public $votingId;

    public function mount($votingId)
    {
        $this->votingId = $votingId;
    }

    public function render()
    {
        $replays = ModSellerReplays::where('voting_id', $this->votingId)
            ->orderBy('created_at', 'desc') // Sortiere nach dem neuesten Datum
            ->paginate(3);

        return view('livewire.frontend.votings.replay-list', [
            'replays' => $replays,
        ]);
    }
}
