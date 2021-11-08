<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\Doctor\Infrastructure\SaveAllDoctorsController;
use Src\DoctorSlots\Infrastructure\SaveAllDoctorSlotsController;

class PullSlotsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slots:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pull the slots of all doctors from the API and persist them in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private SaveAllDoctorsController $saveAllDoctorsController,
        private SaveAllDoctorSlotsController $saveAllDoctorSlotsController
    )
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
        $this->info("Saving Doctors");
        $this->saveAllDoctorsController->__invoke();
        $this->info("Doctors saved succesfully");
        $this->info("Saving DoctorSlots");
        $this->saveAllDoctorSlotsController->__invoke();
        $this->info("DoctorSlots saved succesfully");
    }
}
