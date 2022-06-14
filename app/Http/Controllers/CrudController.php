<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return crud::orderBy('id', 'desc')->get();
        $search=$request->input('search');
        $filter=$request->input('filter');
        $query=crud::query();
        if(isset($filter)&&!empty($filter))
        {
            if(isset($search)&&!empty($search))
            {
                if($filter=='global')
                {
                    $query=$query->where('id','like','%'.$search.'%')
                    ->orWhere('name','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%')
                    ->orWhere('phone','like','%'.$search.'%');   
                }
                else{
                $query=$query->where($filter,'like',$search.'%');}
            }
        }
        $crud=$query->paginate(2, ['*'], 'page', $request->page);
        return response()->json($crud);
        // return crud::($request('search'),function($query){
        //     $query->where('name','like','%'.request('search').'%');
        // })->orderBy('id','asc')->paginate(2);
        // $crud = crud::orderby('id')->get();

        // return response()->json($crud);
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
        
        $crud=crud::create($request->all());
        return response()->json([
            'status'=>'success',
            'user'=>$crud
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crud = crud::find($id);

        return response()->json($crud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $crud = crud::find($id);
        $crud->update($request->all());

        return response()->json([
            'status' => 'success',
            'post'   => $crud
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $crud=crud::find($id);
        $crud->delete();
        return response()->json('deleted successfully');
    }
}
