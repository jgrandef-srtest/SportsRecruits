<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Rankings;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class NormalizeRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'normalize:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moves ranks from Users model to Rankings model ';

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
    public function handle(User $user)
    {
	// in theory we should probably do some better Exception handling / formatting but that requires 
	// meddling around with the existing report() / render() methods of the exception handler in the base install
		
	//Move ranking data from users.ranking to rankigns.ranking
	$users = $user::all();
	foreach ($users as $u) {
		$r = new Rankings();
		$r->user_id = $u->id;
		$r->ranking = $u->ranking;
		$r->save();
	}

	//Drop rankigns table
        if (Schema::hasColumn('users', 'ranking')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('ranking');
            });
        }

	echo "Great Success!\n" . count($users) . " user rankings added to rankings table.\nColumn users.ranking dropped.\n";
		
    }
}
