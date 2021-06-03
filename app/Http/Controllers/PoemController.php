<?php

namespace App\Http\Controllers;

use App\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Author;
use App\HistoryPerson;
use App\Category;
use Storage;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->is_users == 'true') {
            $poems = Poem::whereHas('author', function (Builder $query) {
                $query->where('creator_type', 'App\User');
            });
        } else {
            $poems = Poem::whereHas('author', function (Builder $query) {
                $query->where('creator_type', 'App\HistoryPerson');
            });
        }
        if (!empty($request->categories)) {
            $categories = $request->categories;
            $poems = $poems->whereIn('category_id', $categories);
        }
        if (!empty($request->historyPeople)) {
            $historyPeople = $request->historyPeople;
            $poems = $poems->whereIn('author_id', $historyPeople);
        }

        $poems = $poems->get();
        $poems->map(function ($poem) {
            $poem->author = $poem->author->creators;
            return $poem;
        });
        return response()->json($poems);
    }

    public function myPoems(Request $request){
        $poems = Poem::whereHas('author', function (Builder $query) use ($request) {
            $query->where('creator_type', 'App\User');
            $query->where('creator_id', $request->user_id);
        });
        if (!empty($request->categories)) {
            $categories = $request->categories;
            $poems = $poems->whereIn('category_id', $categories);
        }
        if (!empty($request->historyPeople)) {
            $historyPeople = $request->historyPeople;
            $poems = $poems->whereIn('author_id', $historyPeople);
        }

        $poems = $poems->get();
        $poems->map(function ($poem) {
            $poem->author = $poem->author->creators;
            return $poem;
        });
        return response()->json($poems);
    }

    public function usersPoemsIndex(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isHistoryAuthor === true) {
            $validator = Validator::make($request->all(), [
                'author_id' => 'required',
                'year_of_created' => 'string|required',
                'title' => 'string|max:50',
                'content' => 'required|string',
                'category_id' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'author_id' => 'required',
                'title' => 'string|max:50',
                'content' => 'required|string',
                'category_id' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        if (!$request->title) {
            $request->title = '****';
        }
        if (!$request->year_of_created) {
            $now = Carbon::now();
            $request->year_of_created = $now->year;
        }
        $poem = new Poem;
        if ($request->isHistoryAuthor) {
            $creator = HistoryPerson::find($request->author_id);
        } else {
            $creator = User::find($request->author_id);
        }
        $poem->title = $request->title;
        $poem->content = $request->content;
        $poem->year_of_created = $request->year_of_created;
        $poem->categories()->associate(Category::find($request->category_id));
        $poem->author()->associate($creator->creators->first());
        $poem->save();
        return response()->json($poem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function show(Poem $poem)
    {
        $poem->isHistoryAuthor = $poem->author->creator_type == 'App\HistoryPerson' ? true : false;
        if ($poem->isHistoryAuthor) {
            $poem->historyPerson = $poem->author->creators->id;
        }
        $poem->author->creators->first()->id;
        return response()->json($poem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function edit(Poem $poem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poem $poem)
    {
        if ($request->isHistoryAuthor === true) {
            $validator = Validator::make($request->all(), [
                'author_id' => 'required',
                'year_of_created' => 'string|required',
                'title' => 'string|max:50',
                'content' => 'required|string',
                'category_id' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'author_id' => 'required',
                'title' => 'string|max:50',
                'content' => 'required|string',
                'category_id' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        if (!$request->title) {
            $request->title = '****';
        }
        if (!$request->year_of_created) {
            $now = Carbon::now();
            $request->year_of_created = $now->year;
        }
        //create poem
        //dd($request);
        $poem = Poem::find($request->id);
        if ($request->isHistoryAuthor) {
            $creator = HistoryPerson::find($request->author_id);
        } else {
            $creator = User::find($request->author_id);
        }
        $poem->title = $request->title;
        $poem->content = $request->content;
        $poem->year_of_created = $request->year_of_created;
        $poem->categories()->associate(Category::find($request->category_id));
        $poem->author()->associate($creator->creators->first());
        $poem->save();
        return response()->json($poem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poem $poem)
    {
        $poem->delete();
        return response()->json('success');
    }
    public function closed()
    {
        $data = "Only authorized users can see this";
        return response()->json(compact('data'), 200);
    }

    public function getPoemsByUser(Request $request)
    {
        if (User::find($request->user_id)->creators) {
            $author = User::find($request->user_id)->creators->first();
            $poems = $author->poems;
            return response()->json($poems);
        }
    }
}
