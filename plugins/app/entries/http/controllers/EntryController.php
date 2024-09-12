<?php namespace App\Entries\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Entries\Models\Entry;
use App\Tasks\Models\Task;
use App\Entries\Http\Resources\EntryResource;
use DateTime;

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
            $start = new DateTime($data['time_start']);
            $end = new DateTime($data['time_end']);
            $diffObject = $start->diff($end);
            $daysDiff = $diffObject->format('%a');
            $data['tracked_time'] = $diffObject->format('%H') + ($daysDiff * 24 ) . ':' . $diffObject->format('%I') . ':' . $diffObject->format('%S');
            $data['isActive'] = false;

            //update total_time in Task
            $taskTotalTime = (Task::where('id', $data['task_id'])->get()[0]['total_time']);
            list($hours, $minutes, $seconds) = explode(':', $taskTotalTime);
    
            $seconds = (int)$seconds + $diffObject->format('%S');
            $addMinutes = intdiv($seconds, 60);
            $seconds = $seconds % 60;

            $minutes = (int)$minutes + $addMinutes + $diffObject->format('%I');
            $addHours = intdiv($minutes, 60);
            $minutes = $minutes % 60;

            $hours = (int)$hours + $diffObject->format('%H') + $addHours + ($daysDiff * 24 );

            $updatedTotalTime = $hours . ':' . $minutes . ':' . $seconds;
            Task::where('id', $data['task_id'])->update(['total_time' => $updatedTotalTime]);
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
        $start = new DateTime($entry[0]['time_start']);
        $end = new DateTime(now());
        $diffObject = $start->diff($end);
        $daysDiff = $diffObject->format('%a');
        $tracked_time = $diffObject->format('%H') + ($daysDiff * 24 ) . ':' . $diffObject->format('%I') . ':' . $diffObject->format('%S');

        //update total_time in Task
        $taskTotalTime = (Task::where('id', $entry[0]['task_id'])->get()[0]['total_time']);
        list($hours, $minutes, $seconds) = explode(':', $taskTotalTime);
    
        $seconds = (int)$seconds + $diffObject->format('%S');
        $addMinutes = intdiv($seconds, 60);
        $seconds = $seconds % 60;

        $minutes = (int)$minutes + $addMinutes + $diffObject->format('%I');
        $addHours = intdiv($minutes, 60);
        $minutes = $minutes % 60;

        $hours = (int)$hours + $diffObject->format('%H') + $addHours + ($daysDiff * 24 );

        $updatedTotalTime = $hours . ':' . $minutes . ':' . $seconds;
        Task::where('id', $entry[0]['task_id'])->update(['total_time' => $updatedTotalTime]);

        Entry::where('id', $data['id'])->update(['tracked_time' => $tracked_time]);
        Entry::where('id', $data['id'])->update(['time_end' => now()]);
        Entry::where('id', $data['id'])->update(['isActive' => false]);
        return 'Entry finished';
    }
}