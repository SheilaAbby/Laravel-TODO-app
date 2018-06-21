<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
use Session;

class TodosController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
    public function store(Request $request){ //everytime you are taking users data you have to include the request object
    	$this->validate($request,[
			'todo'=>'required|min:5'
			]);

//inserting data to the database
    	$todo=new Todo(); //Todo is our model
    	$todo->user_id=Auth::user()->id;
    	$todo->todo=$request->todo;//request is the todo name from the input form.
    	$todo->save();//save the contents of this column


//notifying the user that their information was received

    	Session::flash('success','Your task was saved successfully');
    	return redirect()->back();
    }

    public function edit($id){
    	$todo=Todo::find($id); //find a todo with a given id
    	return view('edit')->with('todo',$todo);//return view from where we can edit our todo
    	
    }
public function update(Request $request,$id){
	$this->validate($request,[
		'todo' => 'required|min:5'
		]);
			 $todo=Todo::find($id);
			 if($todo->user_id != Auth::id()){
				 return redirect()->route('home')->with('warning','Unauthorised!!');
			 }
			 


//finding the todo to update
		$todo=Todo::find($id);
		$todo->todo=$request->todo;
		$todo->save();

		return redirect()->route('home')->with('success','Todo Updated!');
}

public function delete($id){
	$todo=Todo::find($id);
	$todo->delete();

	return redirect()->route('home')->with('success','Todo Deleted');
}

}