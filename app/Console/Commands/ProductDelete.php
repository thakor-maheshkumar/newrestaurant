<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
class ProductDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:productDelete';

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
     * @return int
     */
    public function handle()
    {
        DB::table('foodchefs')->truncate();

       // Mail::to('test@g.com')->from('admin@admin.com')->subject('Record Deleted Successfully')->view('emails.multiple');    
    }
}
