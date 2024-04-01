<?php

namespace App\Console\Commands\Auth;

use App\Models\User;
use Illuminate\Console\Command;

class Register extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a new user with the given credentials.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = [
            'name' => $this->ask('Name?'),
            'email' => $this->ask('Email?'),
            'password' => $this->secret('Password?'),
            'password_confirmation' => $this->secret('Confirm Password?'),
        ];

        $validator = validator($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => !empty($input['password']) ? bcrypt($input['password']) : null,
        ]);

        $this->line(json_encode($user->toArray(), JSON_PRETTY_PRINT));

        return Command::SUCCESS;
    }
}
