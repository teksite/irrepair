<?php

namespace Modules\Main\Console;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Main\Models\Role;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeAdministratorUser extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:superadmin';

    /**
     * The console command description.
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     */
    protected array $data = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data['name'] = $this->ask('What is your full name?', 'Sina Zangiband');
        $data['username'] = $this->ask('choose a username?', 'szb09126037279');
        $data['nickname'] = $this->ask('choose a nickname to show?', $data['name']);
        $data['phone'] = $this->ask('What is your phone number?', '09126037279');
        $data['email'] = $this->ask('What is your email?', 'sina.zangiband@gmail.com');
        $data['slug'] = $this->ask('What is your slug?', 'szb9126037279');

        $password = $this->secret('choose a strong password (the password is hidden for safety purpose)?');
        $madePassword='sina.zangiband@gmail.com' ?? Str::password(16);
        $data['password'] = Hash::make($password  ?? $madePassword);

        $this->data = $data;

        $this->checkUser();
        $user = User::query()->forceCreate($data);
        $user->markEmailAsVerified();

        if (is_null($password)) $this->warn("you didn't choose a password so we made you a one. your password is: " . $madePassword);

        $administratorRole = Role::query()->firstWhere('title', 'administrator');

        if (!!$administratorRole) $user->roles()->attach($administratorRole->id);
        $this->info('super admin is created');

    }


    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    protected function checkUser()
    {
        foreach ($this->data as $column => $text) {
            if (in_array($column, ['name', 'password'])) continue;
            $this->checkColumn($column, $text);

        }

    }

    protected function checkColumn($column, $text)
    {
        if ($userExist = User::query()->where($column, $text)->exists()) {
            $this->error($text . " has already taken choose another one.");
            $text = $this->ask("new $column:");

            $this->notValid($column, $text);

            $this->checkColumn($column, $text);
        }
        $this->data[$column]=$text;
    }
    protected function notValid($column , $text){
        if(is_null($text) || trim($text) == "") {
            $text = $this->ask("new $column: ");
            $this->notValid($column , $text);
        }
    }



}
