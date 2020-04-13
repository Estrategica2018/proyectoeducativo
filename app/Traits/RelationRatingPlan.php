<?php

namespace App\Traits;

use App\Models\CompanySequence;
use App\Models\Element;
use App\Models\Kit;
use App\Models\MomentExperience;
use App\Models\SequenceMoment;

trait RelationRatingPlan
{
    //
    public function relation_rating_plan ($shopingCarts){
        //cache()->flush();
        $sequencesCache = cache()->tags('connection_sequences')->rememberForever('sequences',function(){
            return CompanySequence::all();
        });
        $momentsCache = cache()->tags('connection_moments')->rememberForever('moments',function(){
            return SequenceMoment::all();
        });
        $experiencesCache = cache()->tags('connection_experiences')->rememberForever('experiences',function(){
            return MomentExperience::all();
        });
        $kitsCache = cache()->tags('connection_experiences')->rememberForever('kits',function(){
            return Kit::all();
        });
        $elementCache = cache()->tags('connection_experiences')->rememberForever('elements',function(){
            return Element::all();
        });

        for ($i=0; $i < count($shopingCarts); $i++) {
            //$data = array();
            switch (intval($shopingCarts[$i]->type_product_id)) {
                case 1://sequence
                    foreach ($shopingCarts[$i]['shopping_cart_product'] as $sequenceA){
                        //dd($sequencesCache->where('id', $sequenceA['product_id']));
                        foreach ($sequencesCache->where('id', $sequenceA['product_id']) as $dataArray){
                            $sequenceA['sequence'] = $dataArray;
                        }

                    }

                    break;
                case 2://moment
                    foreach ($shopingCarts[$i]['shopping_cart_product'] as $sequenceA){
                        $id = $momentsCache->where('id', $sequenceA['product_id'])->pluck('sequence_company_id')->toArray();
                        foreach ($sequencesCache->whereIn('id', $id) as $sequenceB){
                            $sequenceA['sequenceStruct_moment'] = $sequenceB;
                        }
                    }
                    break;
                case 3://experience
                    foreach ($shopingCarts[$i]['shopping_cart_product'] as $sequenceA){
                        $id = $experiencesCache->where('id', $sequenceA['product_id'])->pluck('sequence_moment_id')->toArray();
                        foreach ($sequencesCache->whereIn('id', $momentsCache->whereIn('id', $id)->pluck('sequence_company_id')->toArray()) as $sequenceB){
                            $sequenceA['sequenceStruct_experience'] = $sequenceB;
                        }
                    }
                    break;
                case 4: //kit
                    foreach ($shopingCarts[$i]['shopping_cart_product'] as $kit){
                        $kit['kiStruct'] = $kitsCache->where('id',$kit['product_id']);
                    }
                    break;
                case 5: //element
                    foreach ($shopingCarts[$i]['shopping_cart_product'] as $element){
                        $element['elementStruct'] = $elementCache->where('id',$element['product_id']);
                    }
                    break;
            }
        }
        return $shopingCarts;
    }



}