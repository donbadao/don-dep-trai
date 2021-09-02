<?php

namespace App\Console\Commands;

use App\Models\Radoms;
use Illuminate\Console\Command;

class Random extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:random';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Radom String';

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
        $randoms = new Radoms();
        $randoms->random_string = uniqid();
        $randoms->save();
        $this->info("Tao radom thanh cong");
        return 0;
    }
}
