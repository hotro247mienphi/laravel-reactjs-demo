<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateUserStatusRandom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:random-status-user';

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
     * @return mixed
     */
    public function handle()
    {
        // $sql = sprintf('UPDATE users SET status = IF(RAND() > 0.5, %d, %d) WHERE 1', User::STATUS_ACTIVATE, User::STATUS_DEACTIVATE);

        $sql = sprintf('UPDATE users SET status = CASE WHEN RAND() > 0.5 THEN %s ELSE %s END', User::STATUS_ACTIVATE, User::STATUS_DEACTIVATE);
        $affected = DB::update($sql);
        $this->info('Affected ' . $affected . ' records.');
    }

}
