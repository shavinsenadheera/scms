<?php

namespace App\Console\Commands;

use App\Mail\RemindThresholdMaterials;
use App\Models\Admin\Material;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RemindTresholdMaterials extends Command{
    protected $signature = 'command:thresholdmaterials';
    protected $description = 'This executes every day at 6.00am to identify the threshold materials!';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        $thresholdMaterials = Material::select('id', 'current_count', 'threshold')->get();
        foreach ($thresholdMaterials as $thresholdMaterial) {
            if($thresholdMaterial->current_count < $thresholdMaterial->threshold){
                $details = array('id' => $thresholdMaterial->id);
                Mail::to('storemanager@abctl.com')->send(new RemindThresholdMaterials($details));
            }
        }
    }
}
