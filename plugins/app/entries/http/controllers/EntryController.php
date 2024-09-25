<?php namespace App\Entries\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use App\Entries\Models\Entry;
use App\Tasks\Models\Task;
use App\Entries\Http\Resources\EntryResource;

class EntryController extends Controller
{
    public function entriesIndex()
    {
        $entries = Entry::where('user_id', auth()->user()->id)->get();
        return EntryResource::collection($entries);
    }
    public function entryCreate()
    {
        $data = request()->all();
        Task::findOrFail($data['task_id']);

        $user = auth()->user();
        $entry = new Entry();
        $entry->fill($data);
        $entry->user_id = $user->id;

        $task = Task::find($entry->task_id);
        $user = auth()->user();
        if ($user['id'] !== $task['user_id']) throw new Exception('Unauthorized');
        if (!isset($entry->time_start) && isset($entry->time_end)) throw new Exception('If end of the entry is set, then beginning must be set too');
        if (!(isset($entry->time_start) && isset($entry->time_end))) $entry->time_start = now();

        $entry->save();
        return EntryResource::make($entry);
    }
    public function entryFinish()
    {
        $data = request()->all();
        Entry::findOrFail($data['id']);
        $entry = Entry::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $entry['user_id']) throw new Exception('Unauthorized');
        if (!$entry['is_active']) throw new Exception('Entry is already finished');
        $entry->time_end = now();
        $entry->save();
        return EntryResource::make($entry);
    }
}