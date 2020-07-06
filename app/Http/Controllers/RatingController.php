<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use DB;

class RatingController extends Controller
{
    public function createRating(Request $request){
        $user_id = $request->user_id;
        $poem_id = $request->poem_id;
        $rating= $request->rating;
        // $user_id = $rating->user_id;
        // $poem_id = $rating->poem_id;
        // $rating = $rating->rating;
        $ratedPoem = DB::table('ratings')->where('userID', $user_id)->where('poemID', $poem_id)->get()->first();
        if(isset($ratedPoem)){
            $ratedPoem =  DB::table('ratings')
            ->where('userID', $user_id)
            ->where('poemID', $poem_id)
            ->update(['rating' => $rating]);
        }else{
        DB::table('ratings')->insert(
            array('userID' => $user_id, 'poemID' => $poem_id, 'rating' => $rating)
         );
        
        }
        $data['user_id']=$user_id;
        $data['poem_id'] = $poem_id;
        $data['rating'] = $rating;
        return response()->json($data);
    }
    public function getCurrentRating($poem_id, $user_id){
     
      
        $ratedPoem = DB::table('ratings')->where('userID', $user_id)->where('poemID', $poem_id)->get()->first();
        
        //  ->where('userID', $user_id)
        //  ->where('poemID', $poem_id);
         if(!empty($ratedPoem)){
            $data['rating'] = $ratedPoem->rating;
         }
         else{
             $data['rating'] = null;
         }
         return response()->json($data);
    }
    public function resetRating($poem_id, $user_id){
        $poem =  DB::table('ratings')
        ->where('userID', $user_id)
        ->where('poemID', $poem_id)
        ->update(['rating' => 0]);

    }
    public function getAvgRating($poem_id){
        $rating_column =  DB::table('ratings')
        ->select('rating')
        ->where('poemID', $poem_id)
        ->get();
        $iteration = 0;
        $total_rating = 0;
        for($i=0;$i<count($rating_column);$i++){
            $total_rating=$total_rating + $rating_column[$i]->rating;

        }
        $avg_rating = round($total_rating/$i, 1);
        return response()->json($avg_rating);
    }
}
