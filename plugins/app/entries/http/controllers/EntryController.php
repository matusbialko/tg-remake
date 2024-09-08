<?php namespace App\Entries\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Entries\Models\Entry;
use App\Entries\Http\Resources\EntryResource;

class EntryController extends Controller
{
    public function entriesIndex()
    {
        //$entries = Entry::where('user_id', auth()->user()->id)->get();
        return EntryResource::collection(Entry::all());
    }
    public function entryCreate()
    {
        $data = request()->all();
        //$user = auth()->user();
        //$data['name'] = $user->name;
        //$data['user_id'] = $user->id;
        $entry = Entry::create($data);
        return new EntryResource($entry);
    }
}