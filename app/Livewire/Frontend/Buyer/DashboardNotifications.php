<?php

namespace App\Livewire\Frontend\Buyer;

use App\Models\Client;
use Livewire\Component;

class DashboardNotifications extends Component
{
    public $client;
    public $email_notifications;
    public $push_notifications;
    public $account_changes;
    public $group_changes;
    public $product_updates;
    public $new_products;
    public $promotional_offers;
    public $comment_notifications;
    public $share_notifications;
    public $follow_notifications;
    public $group_post_notifications;
    public $private_message_notifications;
    public $auto_group_subscribe;
    public $auto_product_subscribe = 1;
    public function mount()
    {
        // Hole den authentifizierten Benutzer
        $this->client = Client::find(auth()->id());


        $client = Client::find(auth()->id());

        if ($this->client) {
            $this->email_notifications = $this->client->email_notifications;
            $this->push_notifications = $this->client->push_notifications;
            $this->auto_group_subscribe = '1';
            $this->account_changes = $this->client->account_changes;
            $this->group_changes = $this->client->group_changes;
            $this->product_updates = $this->client->product_updates;
            $this->new_products = $this->client->new_products;
            $this->promotional_offers = $this->client->promotional_offers;
            $this->comment_notifications = $this->client->comment_notifications;
            $this->share_notifications = $this->client->share_notifications;
            $this->follow_notifications = $this->client->follow_notifications;
            $this->group_post_notifications = $this->client->group_post_notifications;
            $this->private_message_notifications = $this->client->private_message_notifications;
        }
    }

    public function updateSettings()
    {
        // Validierung der Einstellungen
        $this->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'account_changes' => 'boolean',
            'group_changes' => 'boolean',
            'product_updates' => 'boolean',
            'new_products' => 'boolean',
            'promotional_offers' => 'boolean',
            'comment_notifications' => 'boolean',
            'share_notifications' => 'boolean',
            'follow_notifications' => 'boolean',
            'group_post_notifications' => 'boolean',
            'private_message_notifications' => 'boolean',
        ]);

        // Aktualisieren der Benachrichtigungseinstellungen des Clients
        $this->client->update([
            'email_notifications' => $this->email_notifications,
            'push_notifications' => $this->push_notifications,
            'account_changes' => $this->account_changes,
            'group_changes' => $this->group_changes,
            'product_updates' => $this->product_updates,
            'new_products' => $this->new_products,
            'promotional_offers' => $this->promotional_offers,
            'comment_notifications' => $this->comment_notifications,
            'share_notifications' => $this->share_notifications,
            'follow_notifications' => $this->follow_notifications,
            'group_post_notifications' => $this->group_post_notifications,
            'private_message_notifications' => $this->private_message_notifications,
        ]);

        session()->flash('message', 'Notification settings updated successfully.');
    }

    public function render()
    {

        // Stelle sicher, dass die neuesten Daten geladen werden
        $this->client = Client::find(auth()->id());

        return view('livewire.frontend.buyer.dashboard-notifications')
            ->layout('layouts.buyerdashboard');
    }
}
