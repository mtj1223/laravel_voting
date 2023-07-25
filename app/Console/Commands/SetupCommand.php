<?php

namespace App\Console\Commands;

use App\Models\Votes;
use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->call('migrate');

        Votes::create([
            "name"=>"Plantation in City Parks",
            "description"=>"Plantation in City Parks should be increased to provide more benefits to the city",
            "upvotes"=>0,
            "downvotes"=>0,

        ]);

        Votes::create([
            "name"=>"Morality of the Police",
            "description"=>"Police should be more moral and more respectful to the citizens of the city",
            "upvotes"=>0,
            "downvotes"=>0,

        ]);

        Votes::create([
            "name"=>"Education",
            "description"=>"Education should be more accessible and affordable",
            "upvotes"=>0,
            "downvotes"=>0,
            ]);

        Votes::create([
            "name"=>"Healthcare",
            "description"=>"Healthcare should be more accessible and affordable",
            "upvotes"=>0,
            "downvotes"=>0,
            ]);
    }
}
