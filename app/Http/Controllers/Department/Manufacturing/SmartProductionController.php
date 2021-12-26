<?php

namespace App\Http\Controllers\Department\Manufacturing;

use App\Http\Controllers\Controller;
use App\Mail\Internal\MRequest;
use App\Models\Admin\LabelSize;
use App\Models\Admin\LabelStyle;
use App\Models\Admin\LabelType;
use App\Models\Admin\Material;
use App\Models\Admin\MRLogs;
use App\Models\Admin\Order;
use Illuminate\Http\Request;

class SmartProductionController extends Controller{
    public function index(){
        $smallQty = 0;
        $mediumQty = 0;
        $largeQty = 0;

        $APCount = 0;
        $BCount = 0;
        $VS01Count = 0;
        $VS02Count = 0;
        $VS03Count = 0;
        $VS04Count = 0;

        $smallRibbonsCount = 0;
        $mediumRibbonsCount = 0;
        $largeRibbonsCount = 0;

        $APRibbonsCount = 0;
        $BRibbonsCount = 0;
        $VS01RibbonsCount = 0;
        $VS02RibbonsCount = 0;
        $VS03RibbonsCount = 0;
        $VS04RibbonsCount = 0;

        $wovSmallLabelQuantity = 0;
        $wovMediumLabelQuantity = 0;
        $wovLargeLabelQuantity = 0;
        $stSmallLabelQuantity = 0;
        $stMediumLabelQuantity = 0;
        $stLargeLabelQuantity = 0;
        $cSmallLabelQuantity = 0;
        $cMediumLabelQuantity = 0;
        $cLargeLabelQuantity = 0;

        $processingSmallQty = 0;
        $processingMediumQty = 0;
        $processingLargeQty = 0;

        $processingAPCount = 0;
        $processingBCount = 0;
        $processingVS01Count = 0;
        $processingVS02Count = 0;
        $processingVS03Count = 0;
        $processingVS04Count = 0;

        $processingSmallRibbonsCount = 0;
        $processingMediumRibbonsCount = 0;
        $processingLargeRibbonsCount = 0;

        $polyesterSmall = 0;
        $polyesterMedium = 0;
        $polyesterLarge = 0;
        $htSmall = 0;
        $htMedium = 0;
        $htLarge = 0;
        $cottonSmall = 0;
        $cottonMedium = 0;
        $cottonLarge = 0;

        $actualMaterialCount = Material::select('name', 'current_count')->get();

        $ribbons = Order::with([
            'labelstyle' => function ($query) {
                $query->select('id');
            },
            'labelsize' => function ($query) {
                $query->select('id');
            }
        ])->select('label_type', 'size_no', 'quantity')
            ->where('current_status_id', '<', 3)
            ->get();

        $labelSizes = LabelSize::select('id', 'name', 'width', 'height')->get();
        $labelTypes = LabelType::select('id', 'code')->get();
        foreach($actualMaterialCount as $material){
            if($material->name=="Polyester-s")
                $polyesterSmall=$material->current_count;
            else if($material->name=="Polyester-m")
                $polyesterMedium=$material->current_count;
            else if($material->name=="Polyester-lg")
                $polyesterLarge=$material->current_count;
            else if($material->name=="Heat Transfer-s")
                $htSmall=$material->current_count;
            else if($material->name=="Heat Transfer-m")
                $htMedium=$material->current_count;
            else if($material->name=="Heat Transfer-lg")
                $htLarge=$material->current_count;
            else if($material->name=="Cotton-s")
                $cottonSmall=$material->current_count;
            else if($material->name=="Cotton-m")
                $cottonMedium=$material->current_count;
            else if($material->name=="Cotton-lg")
                $cottonLarge=$material->current_count;
        }

        foreach ($ribbons as $ribbon) {
            for ($i = 0; $i < count(json_decode($ribbon->size_no)); $i++) {
                foreach ($labelSizes as $data) {
                    if (json_decode($ribbon->size_no)[$i] == $data->id) {
                        if ($data->name == 'Small')
                            $smallQty += json_decode($ribbon->quantity)[$i];
                        else if ($data->name == 'Medium')
                            $mediumQty += json_decode($ribbon->quantity)[$i];
                        else if ($data->name == 'Large')
                            $largeQty += json_decode($ribbon->quantity)[$i];
                    }
                }
                foreach ($labelTypes as $type) {
                    if ($ribbon->label_type == $type->id) {
                        if ($type->code == 'WOV'){
                            foreach ($labelSizes as $size) {
                                for ($i = 0; $i < count(json_decode($ribbon->size_no)); $i++) {
                                    if ($size->name == 'Small')
                                        $wovSmallLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Medium')
                                        $wovMediumLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Large')
                                        $wovLargeLabelQuantity += json_decode($ribbon->quantity)[$i];
                                }
                            }
                        } else if ($type->code == 'ST') {
                            foreach ($labelSizes as $size) {
                                for ($i = 0; $i < count(json_decode($ribbon->size_no)); $i++) {
                                    if ($size->name == 'Small')
                                        $stSmallLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Medium')
                                        $stMediumLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Large')
                                        $stLargeLabelQuantity += json_decode($ribbon->quantity)[$i];
                                }
                            }
                        } else if ($type->code == 'C') {
                            foreach ($labelSizes as $size) {
                                for ($i = 0; $i < count(json_decode($ribbon->size_no)); $i++) {
                                    if ($size->name == 'Small')
                                        $cSmallLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Medium')
                                        $cMediumLabelQuantity += json_decode($ribbon->quantity)[$i];
                                    if ($size->name == 'Large')
                                        $cLargeLabelQuantity += json_decode($ribbon->quantity)[$i];
                                }
                            }
                        }
                    }
                }
            }
        }
        foreach ($labelSizes as $data) {
            if ($data->name == 'Small'){
                $smallRibbonsCount = $smallQty * ($data->width * $data->height);
                $wovSmallLabelCount = $wovSmallLabelQuantity * ($data->width * $data->height);
                $stSmallLabelCount = $stSmallLabelQuantity * ($data->width * $data->height);
                $cSmallLabelCount = $cSmallLabelQuantity * ($data->width * $data->height);
            } else if ($data->name == 'Medium'){
                $mediumRibbonsCount = $smallQty * ($data->width * $data->height);
                $wovMediumLabelCount = $wovMediumLabelQuantity * ($data->width * $data->height);
                $stMediumLabelCount = $stMediumLabelQuantity * ($data->width * $data->height);
                $cMediumLabelCount = $cMediumLabelQuantity * ($data->width * $data->height);
            } else if ($data->name == 'Large'){
                $largeRibbonsCount = $smallQty * ($data->width * $data->height);
                $wovLargeLabelCount = $wovLargeLabelQuantity * ($data->width * $data->height);
                $stLargeLabelCount = $stLargeLabelQuantity * ($data->width * $data->height);
                $cLargeLabelCount = $cLargeLabelQuantity * ($data->width * $data->height);
            }
        }
        $stickerTotalCount = ($stSmallLabelQuantity+$stMediumLabelQuantity+$stLargeLabelQuantity)/1000;
        $wovenTotalCount = ($wovSmallLabelCount+$wovMediumLabelCount+$wovLargeLabelCount)/1000;
        $careTotalCount = ($cSmallLabelCount+$cMediumLabelCount+$cLargeLabelCount)/1000;
        $totalRibbonCount = ($smallRibbonsCount + $mediumRibbonsCount + $largeRibbonsCount)/1000;


        //Processing Orders Calculations
        $processingRibbons = Order::with([
            'labelstyle' => function ($query) {
                $query->select('id');
            },
            'labelsize' => function ($query) {
                $query->select('id');
            }
        ])->select('style_no', 'size_no', 'quantity')
            ->where('current_status_id', '=', 3)
            ->get();
        foreach ($processingRibbons as $ribbon) {
            for ($i = 0; $i < count(json_decode($ribbon->size_no)); $i++) {
                foreach ($labelSizes as $data) {
                    if (json_decode($ribbon->size_no)[$i] == $data->id) {
                        if ($data->name == 'Small')
                            $processingSmallQty += json_decode($ribbon->quantity)[$i];
                        else if ($data->name == 'Medium')
                            $processingMediumQty += json_decode($ribbon->quantity)[$i];
                        else if ($data->name == 'Large')
                            $processingLargeQty += json_decode($ribbon->quantity)[$i];
                    }
                }
                // TODO
            }
        }
        $processingTotalQty = $processingSmallQty + $processingMediumQty + $processingLargeQty;
        foreach ($labelSizes as $data) {
            if ($data->name == 'Small')
                $processingSmallRibbonsCount = $processingSmallQty * ($data->width * $data->height);
            else if ($data->name == 'Medium')
                $processingMediumRibbonsCount = $processingMediumQty * ($data->width * $data->height);
            else if ($data->name == 'Large')
                $processingLargeRibbonsCount = $processingLargeQty * ($data->width * $data->height);
        }
        $processingTotalRibbonCount = ($processingSmallRibbonsCount + $processingMediumRibbonsCount + $processingLargeRibbonsCount)/1000;
        //Processing Orders Calculations - END

        $params = [
            'totalUpcomingOrders' => count($ribbons),
            'smallRibbonsCount' => $smallRibbonsCount/1000,
            'mediumRibbonsCount' => $mediumRibbonsCount/1000,
            'largeRibbonsCount' => $largeRibbonsCount/1000,
            'totalRibbonCount' => $totalRibbonCount,
            'totalProcessingOrders' => count($processingRibbons),
            'processingTotalRibbonCount' => $processingTotalRibbonCount,
            'processingSmallRibbonsCount' => $processingSmallRibbonsCount/1000,
            'processingMediumRibbonsCount' => $processingMediumRibbonsCount/1000,
            'processingLargeRibbonsCount' => $processingLargeRibbonsCount/1000,
            'wovSmallLabelCount' => $wovSmallLabelCount/1000,
            'wovMediumLabelCount' => $wovMediumLabelCount/1000,
            'wovLargeLabelCount' => $wovLargeLabelCount/1000,
            'wovenTotalCount' => $wovenTotalCount,
            'stSmallLabelCount' => $stSmallLabelCount/1000,
            'stMediumLabelCount' => $stMediumLabelCount/1000,
            'stLargeLabelCount' => $stLargeLabelCount/1000,
            'stickerTotalCount' => $stickerTotalCount,
            'cSmallLabelCount' => $cSmallLabelCount/1000,
            'cMediumLabelCount' => $cMediumLabelCount/1000,
            'cLargeLabelCount' => $cLargeLabelCount/1000,
            'careTotalCount' => $careTotalCount,
            'polyesterSmall' => $polyesterSmall,
            'polyesterMedium' => $polyesterMedium,
            'polyesterLarge' => $polyesterLarge,
            'htSmall' => $htSmall,
            'htMedium' => $htMedium,
            'htLarge' => $htLarge,
            'cottonSmall' => $cottonSmall,
            'cottonMedium' => $cottonMedium,
            'cottonLarge' => $cottonLarge
        ];
        return view('departments.manufacturing.smartproduction.index')->with($params);
    }
}
