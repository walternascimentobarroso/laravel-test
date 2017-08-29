<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use ZipArchive;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database {--dump=pg_dump} {--local=..\\}';
    // protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run backup on database';

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
    public function handle() {
        $date = date('d.m.Y--H-i');
        $this->output->progressStart(100);
        $this->info('');
        $name = getenv('DB_USERNAME');
        $db = getenv('DB_DATABASE');
        $dir = getenv('DP_DIREC') ? getenv('DP_DIREC') : $this->option('local');
        $local = $dir . $date . ".bkp";
        $host = getenv('DB_HOST');
        $dump = getenv('DP_LOCAL') ? getenv('DP_LOCAL') : $this->option('dump');
        $senha = getenv('DB_PASSWORD');

        putenv("PGPASSWORD={$senha}");
        $command = "{$dump} -h {$host} -U {$name} {$db} > {$local}";

        $this->output->progressAdvance();
        exec($command, $output, $returnVar);
        $this->output->progressFinish();
        $this->info("Backup Success");
        $localZip = $dir . $date. ".zip";
        $zip = new ZipArchive();
        if( $zip->open($localZip, ZipArchive::CREATE )  === true){
            $zip->addFile(  "{$local}" , $local );
            $zip->close();
        }
        unlink($local);
    }
}
