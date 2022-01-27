<?php

function get_variant_name($variant_one=null,$variant_two=null, $variant_three=null){
    $variant_name = '';
    if($variant_one!=null){
       $first =  DB::table('product_variants')->where('id',$variant_one)->select('variant')->first();
       $variant_name = $first->variant.'/';
    }
    if($variant_two!=null){
        $second =  DB::table('product_variants')->where('id',$variant_two)->select('variant')->first();
       $variant_name = $variant_name . $second->variant .'/';
    }
    if($variant_three!=null){
        $third =  DB::table('product_variants')->where('id',$variant_two)->select('variant')->first();
        $variant_name = $variant_name . $third->variant;
    }
    return $variant_name;
}
