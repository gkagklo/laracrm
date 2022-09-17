<?php

namespace App\Console\Commands;
use App\Notifications\NotifyAdminUser;
use Illuminate\Console\Command;
use App\Models\User;

class EmailAdminUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:admin-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to admin which show the count of employees who has created today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $admins = User::where('role_id',1)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NotifyAdminUser());
        }
        
    }
}
