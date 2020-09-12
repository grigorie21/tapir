<?php

namespace App\Console\Commands;

use App\Http\Resources\API\Ad\AdResource;
use Illuminate\Console\Command;

class AdGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:get {id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all ads or one';

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
//        dd(1);
        if($this->argument('id')){
            $model = \App\Models\Ad::find($this->argument('id'));

            dump((string)(new AdResource($model)));
        }

        $model = \App\Models\Ad::all();

        dump(AdResource::collection($model));
    }
}
