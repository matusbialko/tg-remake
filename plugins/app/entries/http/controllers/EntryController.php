<?php namespace App\Entries\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Entries\Models\Entry;
use App\Tasks\Models\Task;
use App\Entries\Http\Resources\EntryResource;

class EntryController extends Controller
{
    public function entriesIndex()
    {
        $entry = Entry::where('user_id', auth()->user()->id)->get();
        return EntryResource::collection($entry);
    }
    public function entryCreate()
    {
        $data = request()->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;

        Task::findOrFail($data['task_id']);
        $task = Task::find($data['task_id']);
        $user = auth()->user();
        if ($user['id'] !== $task['user_id']) die('Unauthorized');
        if (!isset($data['time_start']) && isset($data['time_end'])) die('If end of the entry is set, then beginning must be set too');
        if (!(isset($data['time_start']) && isset($data['time_end']))) $data['time_start'] = now();

        $entry = Entry::create($data);
        return new EntryResource($entry);
    }
    public function entryFinish()
    {
        $data = request()->all();
        Entry::findOrFail($data['id']);
        $entry = Entry::find($data['id']);
        $user = auth()->user();
        if ($user['id'] !== $entry['user_id']) die('Unauthorized');
        if (!$entry['isActive']) die('Entry is already finished');
        Entry::find($data['id'])->update([
            'time_start' => $entry['time_start'],
            'time_end' => now()
        ]);
        return 'Entry finished';
    }
}