<?php

namespace App\Livewire\Backend\Admin\Marketing;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MarketingCampaignParticipants;

class CampaignParticipants extends Component
{

    use WithPagination;

    public function deleteParticipant($id)
    {
        $participant = MarketingCampaignParticipants::find($id);

        if ($participant) {
            $participant->delete();
            session()->flash('message', 'Participant deleted successfully.');
        }
    }

    public function render()
    {

        $participants = MarketingCampaignParticipants::with(['shop', 'marketingSetting'])->paginate(10);

        return view('livewire.backend.admin.marketing.campaign-participants', [
            'participants' => $participants,
        ]);
    }
}
