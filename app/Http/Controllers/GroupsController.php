<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Friends;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Groups::orderBy('id', 'desc')->paginate(5);
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups|max:255',
            'description' => 'required',
        ]);

        $groups = new groups;

        $groups->name = $request->name;
        $groups->description = $request->description;

        $groups->save();

        return redirect('/groups');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $groups = Groups::where('groups_id', $id)->first();
        return view('groups.show', ['groups' => $groups]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = groups::where('id', $id)->first();
        return view('groups.edit', ['group' => $group]);
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
        $request->validate([
            'name' => 'required|unique:groups|max:255',
            'description' => 'required',
        ]);

        groups::find($id)->update(
            [
                'name' => $request->name,
                'description' => $request->description
            ]
        );

        return redirect('/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        groups::find($id)->delete();
        return redirect('/groups');
    }

    public function addmembers($id)
    {
        $friend = Friends::where('groups_id', '=',)->get();
        $group = Groups::where('id', $id)->first();
        return view('groups.addmembers', ['group' => $group, 'friend' => $friend]);
    }

    public function updateaddmembers(Request $request, $id)
    {
        $friend = Friends::where('id', $request->friend_id)->first();
        Friends::find($friend->id)->update([
            'groups_id' => $id
        ]);

        return redirect('/groups/addmembers/' . $id);
    }

    public function deleteaddmembers(Request $request, $id)
    {

        Friends::find($id)->update([
            'groups_id' => 0
        ]);

        return redirect('/groups');
    }
}
