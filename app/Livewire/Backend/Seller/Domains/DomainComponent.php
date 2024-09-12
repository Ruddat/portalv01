<?php

namespace App\Livewire\Backend\Seller\Domains;

use Livewire\Component;
use App\Models\ModSellerDomains;

class DomainComponent extends Component
{
    public $domain;
    public $shop_id;
    public $savedDomains = []; // Array für gespeicherte Domains
    public $editingDomainId = null;

    public function mount($shopId)
    {
        $this->shop_id = $shopId;
        $this->loadSavedDomains();
    }

    public function loadSavedDomains()
    {
        $this->savedDomains = ModSellerDomains::where('shop_id', $this->shop_id)->get();
    }

    public function saveDomain()
    {
        $this->validate([
            'domain' => 'required|string',
        ]);

        // Entferne "http://" oder "https://" und "www." falls vorhanden
        $cleanedDomain = preg_replace('/^(https?:\/\/)?(www\.)?/', '', $this->domain);

        // Prüfe, ob die Domain ohne "www." oder mit "www." schon existiert
        if (ModSellerDomains::where('domain', $cleanedDomain)
                ->orWhere('domain', 'www.' . $cleanedDomain)->exists()) {
            $this->addError('domain', 'Diese Domain oder eine ähnliche Version existiert bereits.');
            return;
        }

        // Wenn wir bearbeiten
        if ($this->editingDomainId) {
            $domain = ModSellerDomains::find($this->editingDomainId);

            if ($domain) {
                $domain->update([
                    'domain' => $cleanedDomain,
                ]);
            } else {
                $this->addError('domain', 'Domain nicht gefunden.');
                return;
            }

            $this->editingDomainId = null;
        } else {
            // Neue Domain speichern
            ModSellerDomains::create([
                'domain' => $cleanedDomain,
                'shop_id' => $this->shop_id,
            ]);
        }

        $this->loadSavedDomains(); // Aktualisiere die gespeicherten Domains
        $this->reset('domain');
    }

    public function editDomain($id)
    {
        $domain = ModSellerDomains::find($id);

        if ($domain) {
            $this->editingDomainId = $id;
            $this->domain = $domain->domain;
        } else {
            $this->addError('domain', 'Domain nicht gefunden.');
        }
    }

    public function deleteDomain($id)
    {
        $domain = ModSellerDomains::find($id);

        if ($domain) {
            $domain->delete();
            $this->loadSavedDomains(); // Aktualisiere die gespeicherten Domains
        } else {
            $this->addError('domain', 'Domain nicht gefunden.');
        }

        // Wenn die gelöschte Domain im Bearbeitungsmodus war, setze das Bearbeitungsfeld zurück
        if ($this->editingDomainId === $id) {
            $this->reset('domain');
            $this->editingDomainId = null;
        }
    }

    public function cancelEdit()
    {
        $this->reset('domain');
        $this->editingDomainId = null;
    }

    public function render()
    {
        return view('livewire.backend.seller.domains.domain-component');
    }
}
