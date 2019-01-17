<?php

namespace App\Http\Controllers;
use App\Crud;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$datas = Crud::all();
        return view('home',[
			"datas" => $datas
		]);
    }
	
	public function store(Request $request){
		
		$imageFile = $request->file('image');
		$imageExt = $imageFile->getclientoriginalextension();
		$uniqueName = rand().".".$imageExt;
		$folderName = "image/";
		$imageFile->move($folderName,$uniqueName);		
		$imageDbUrl = $folderName.$uniqueName;
		
		$data = new Crud();
		$data->name = $request->name;
		$data->gender = $request->gender;
		$data->sports = implode(",",$request->sports);
		$data->country = $request->country;
		$data->image = $imageDbUrl;
		$data->save();
		
		return redirect('/home')->with('message','Store data.');
		
	}
	
	public function edit($id){
		//return $id;
		$data = Crud::find($id);
        return view('edit',compact('data'));
	}
	public function update(Request $request){
		$crud = Crud::find($request->id);
		
		if($request->file('image')){
			
			unlink($crud->image);
			$imageFile  = $request->file('image');
			$imageExt   = $imageFile->getclientoriginalextension();
			$uniqueName = rand().".".$imageExt;
			$folderName = "image/";
			$imageDbUrl = $folderName.$uniqueName;
			$imageFile->move($folderName,$uniqueName);
			
			$crud->name    = $request->name;
			$crud->gender  = $request->gender;
			$crud->sports  = implode(",",$request->sports);
			$crud->country = $request->country;
			$crud->image   = $imageDbUrl;
			$crud->save();
			
		}else{
		
			$crud->name    = $request->name;
			$crud->gender  = $request->gender;
			$crud->sports  = implode(",",$request->sports);
			$crud->country = $request->country;
			$crud->save();
		}
		return redirect('/home')->with('message','Updated');
	}
	public function delete($id){
		$crud = Crud::find($id);
		unlink($crud->image);
		$crud->delete();
		return redirect('/home')->with('message','Deleted');
	}
}
