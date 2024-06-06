<?php
namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;

class ShowData extends Controller
{
    public function index(){
        
        $datas = Data::all();

    return view('showdata',compact('datas'));
    }
    public function insert(Request $request){
        $name = $request->input('name');
        $des = $request->input('description');
        $data = new Data();
        $data->name = $name;
        $data->description = $des;
        $data->save();
        return redirect()->route('showdata');
    }
}
