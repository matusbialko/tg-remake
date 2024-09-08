<?php namespace App\Entries\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Entries\Models\Entry;
use App\Tasks\Models\Task;
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
    
        Task::findOrFail($data['task_id']);
        if (!isset($data['time_start']) && isset($data['time_end'])) die('If end of the entry is set, then beginning must be set too');
        if (isset($data['time_start']) && isset($data['time_end'])) {
            $data['isActive'] = false;
        } else {
            $data['time_start'] = now();
            $data['isActive'] = true;
        }
        
        $data['id'] = count(Entry::all());
        $entry = Entry::create($data);
        return new EntryResource($entry);
    }
    public function entryFinish()
    {
        $data = request()->all();
        Entry::findOrFail($data['id']);
        $entry = Entry::where('id', $data['id'])->get();
        if (!$entry[0]['isActive']) die('Entry is already finished');
        Entry::where('id', $data['id'])->update(['time_end' => now()]);
        Entry::where('id', $data['id'])->update(['isActive' => false]);
        return 'Entry finished';
    }
}