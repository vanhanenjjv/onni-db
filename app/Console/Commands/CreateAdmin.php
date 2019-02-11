<?php

namespace OWS\Console\Commands;

use Illuminate\{
    Console\Command,
    Support\Facades\Hash
};
use OWS\User;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        // Should probably validate these?
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        $this->comment($email.$password);
    }
}
