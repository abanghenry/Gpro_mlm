<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::all();
        return view('admin.award.index')->with([
            'pageTitle' => "Awards",
            'awards' => $awards,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.award.create')->with([
            'pageTitle' => "Create award",
        ]);
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
            'name' => 'required|max:255',
            'pv' => 'required|numeric',
            'cash_equivalent' => 'required|numeric',
        ]);

        $award = new Award();
        $award->name            = $request->name;
        $award->pv              = $request->pv;
        $award->cash_equivalent = $request->cash_equivalent;
        $award->save();


        return redirect('admin/award')->with(['status'=>'Award Added successfully' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $award = Award::find($id);
        return view('admin.award.edit')->with('award', $award);
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
        $rules = [
            'name' => 'required|max:255|unique:awards,name,' . $id,
            'pv' => 'required|numeric',
            'cash_equivalent' => 'required|numeric',
        ];
        $this->validate($request, $rules);
        $award = Award::find($id);
        $award->name            = $request->name;
        $award->pv              = $request->pv;
        $award->cash_equivalent = $request->cash_equivalent;
        $award->save();

        return redirect('admin/award')->with(['status'=>'award updated successfully' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message="";
        $award = Award::find($id);
        if($award){
            $award->delete();
            $message="award deleted successfully";
        }
        return redirect('admin/award')->with(['status'=>$message]);
    }
}
