<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add users to database';

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
        $input['name'] = $this->ask('Your name?');
        $input['email'] = $this->ask('Your email?');
        $input['password'] = $this->secret('What is the password?');

        if($input['name'] != null && $input['email'] != null && $input['password'] != null) {
            $input['password'] = Hash::make($input['password']);
            User::create($input);
            $this->info('User Create Successfully.');
            return 1;
        }else{
            $this->info('Create user failed. All details are required');
            return 0;
        }
    }
}
