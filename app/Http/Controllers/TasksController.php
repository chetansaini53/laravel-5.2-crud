<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use Session;
use DB;
class TasksController extends BaseController
{
    //middle ware to authenticate all the request
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
//        dd($request);
//        $input = $request->all();
        $search = $request['search'];
        $tasks = Task::where('title', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%")->paginate(2);
        return view('tasks.index', ['tasks' => $tasks,'search'=>$search, 'recs' =>Task::recentTask()]);
        //$tasks = Task::all();
        //return view('tasks.index')->withTasks($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       // dd($input);
        $this->validate($request, [
            'title' => 'required|max:20',
            'description' => 'required|max:200'
            ]);
        $input['seo_url'] = $this->seo_url($input['title']);
        $task = Task::create($input);
        
        Session::flash('flash_message', 'Task successfully added!');
        return redirect("/home");
    }
    

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $task = Task::where('seo_url', '=', $id)->firstOrFail();
        //return response()->json(['task' => $task, 'recs' =>Task::recentTask()]);
        return view('tasks.show', ['task' => $task, 'recs' =>Task::recentTask()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::where('seo_url', '=', $id)->firstOrFail();
        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Task::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:20',
            'description' => 'required|max:200'
            ]);
        $input = $request->all();
        $task->fill($input)->save();
        Session::flash('flash_message', 'Task successfully Updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    Task::where('seo_url', '=', $id)->delete();
    Session::flash('flash_message', 'Task successfully deleted!');
    return redirect()->route('tasks.index');
    }
}
