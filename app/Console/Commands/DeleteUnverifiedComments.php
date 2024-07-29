<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\ModAdminBlogComment;

class DeleteUnverifiedComments extends Command
{
    protected $signature = 'comments:delete-unverified';
    protected $description = 'Delete comments that are not verified within 30 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $timeLimit = Carbon::now()->subMinutes(30);

        $comments = ModAdminBlogComment::where('approved', false)
                    ->where('created_at', '<', $timeLimit)
                    ->delete();

        $this->info("Deleted $comments unverified comments.");
    }
}
