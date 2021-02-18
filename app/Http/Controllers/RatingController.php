<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use DB;
use App\Poem;
use App\User;

class RatingController extends Controller
{
    public function getCurrentRating(Request $request)
    {
        $rating = User::find($request->user_id)->poemRating()->where('poem_id', $request->poem_id)->first();
        if ($rating) {
            $rating = $rating->pivot->rating;
            return response()->json($rating);
        } else {
            return false;
        }
    }

    public function resetRating(Request $request)
    {
        $user_id = $request->user_id;
        $poem_id = $request->poem_id;
        $detach = User::find($user_id)->poemRating()->detach($poem_id);
        if ($detach) {
            return response()->json('success reset');
        } else {
            return response()->json('error');
        }
    }

    public function getAvgRating(Request $request)
    {
        $poems = Poem::find($request->poem_id)->userRating;
        //dd($poems);
        if (isset($poems) && $poems->count() > 0) {
            $avgRating = $poems->avg('pivot.rating');
            return response()->json($avgRating);
        } else {
            return false;
        }
    }

    public function setRating(Request $request)
    {
        $user_id = $request->user_id;
        $poem_id = $request->poem_id;
        $rating = $request->rating;
        $sync = User::find($user_id)->poemRating()->sync([$poem_id => ['rating' => $rating]], false);
        if ($sync) {
            return response()->json($rating);
        } else {
            return response()->json('error');
        }
    }
}
