<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

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
    public function checkPass()
    {
        $password = $this->secret('Enter password ');
        $confirmPassword = $this->secret('Confirm password ');
        if ($password != $confirmPassword) {
            $this->error('Your Passwords do not match');
            $this->line('=======================');

            return $this->checkPass();
        } else {
            return $password;
        }
    }

    public function checkUser()
    {
        $user = $this->ask('Enter Username (Minimum 6 Characters)');
        if (strlen($user) < 6) {
            $this->error('Minimum character length is 6');
            $this->line('======================');

            return $this->checkUser();
        }
        $getUser = User::where('username', $user)->exists();
        if ($getUser) {
            $this->error('Username already exists');
            $this->line('=======================');

            return $this->checkUser();
        } else {
            return $user;
        }
    }

    public function handle(): int
    {
        $fullName = $this->ask('Enter name ');
        $username = $this->checkUser();
        $email = $this->ask('Enter email ');
        $password = $this->checkPass();

        if ($this->confirm('Are you sure you want to create this user?'."\n".
            'Name: '.$fullName."\n".
            'Username: '.$username."\n".
            'Email: '.$email."\n".
            'Password: [hidden]')) {
            User::query()
                ->create([
                    'name' => $fullName,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
            $this->info('The admin account has been created successfully.');

            return self::SUCCESS;
        } else {
            $this->info('No changes were made.');

            return self::SUCCESS;
        }
    }
}
