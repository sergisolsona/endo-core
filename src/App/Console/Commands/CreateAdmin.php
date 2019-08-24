<?php

namespace Endo\EndoCore\App\Console\Commands;

use Endo\EndoCore\App\Models\EndoRole;
use Endo\EndoCore\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'endo:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new admin user';

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
        $pol = User::where('email', 'pol@6tems.com')->first();

        $defaultEmail = $pol ? null : 'pol@6tems.com';
        $defaultName = $pol ? null : 'suport';
        $defaultLastName = $pol ? null : '6TEMS';

        do {
            $email = $this->ask('User email?', $defaultEmail);

            $userExists = User::where('email', $email)->first();

            if ($userExists) {
                $this->warn($email . ' already exists');
            }
        } while ($userExists);

        $name = $this->ask('User name?', $defaultName);
        $lastname = $this->ask('User lastname?', $defaultLastName);

        $password = $this->secret('User password?');

        $adminRole = EndoRole::where('name', 'admin')->first();

        User::create([
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => Hash::make($password),
            'endo_role_id' => $adminRole->id,
        ]);

        $this->info('Admin user created successfully');
    }
}
