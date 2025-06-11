<?php

namespace App\Helpers;

use App\Models\Block;
use App\Models\GramPanchyat;
use App\Models\User;
use App\Models\UserVillage;
use App\Models\Village;
use Carbon\Carbon;

class Helpers
{
    public static function getUserName($id)
    {
        return User::find($id)->name;
    } 
    public static function getBlockName($id)
    {
        return Block::find($id)->name ?? null;
    } 

    public static function getGPName($id)
    {
        return GramPanchyat::find($id)->name ?? null;
    } 

    public static function getVillageName($id)
    {
        return Village::find($id)->name ?? null;
    } 

    public static function getUserVillages($id)
    {
        $user_villages = UserVillage::where('user_id',$id)->get()->pluck('village_id')->toArray();
        if(count($user_villages) > 0)
        {
            $villages = Village::whereIn('id',$user_villages)->get()->pluck('name')->toArray();
            return implode(',',$villages);
        }
        return null;
    } 

    public static function getMonths()
    {
        return [
          'Jan',  
          'Feb',  
          'March',  
          'April',  
          'May',  
          'June',  
          'July',  
          'August',  
          'Sep',  
          'Oct',  
          'Nov',  
          'Dec',  
        ];
    } 
    public static function getCurrentYear()
    {
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            array_push($months, Carbon::now()->subMonth($i)->format('M Y'));
        };
        return $months;
    } 
    public static function yearRange()
    {
        $currentYear = Carbon::now()->format('Y');
        $pastYear = Carbon::now()->subMonth(12)->format('Y');
        if($currentYear == $pastYear)
        {
            return $currentYear;
        }else{
            return $pastYear .'-'. $currentYear;
        }
    } 

}
