<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ajaxController extends Controller
{
    public function index(){
        //Lấy danh sách từ database
        $getData = DB::table('note')->get();
        
        //Gọi đến view va goi data
        return view('crudajax')->with('list', $getData);
    }

    public function store(Request $request){
        
        $allRequest  = $request->all();
        $title  = $allRequest['title'];
        $content = $allRequest['content'];
        $tags = $allRequest['tags'];
        
        $length = 25;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $idCon = '';
        for ($i = 0; $i < $length; $i++) {
            $idCon .= $characters[rand(0, $charactersLength - 1)];
        }

        foreach($tags as $t) {
            $data_to_insert = [
                'tag' => $t,
                'idCon' => $idCon
            ];
            DB::table('tags')->insert($data_to_insert);
        }

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'title'  => $title,
            'content' => $content,
            'status' => '',
            'idCon' => $idCon
        );

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('note')->insert($dataInsertToDatabase);
        return response()->json($dataInsertToDatabase);
    }

    public function delete(Request $request){
	    $allRequest  = $request->all();
        $id  = $allRequest['id'];
        DB::table('note')->delete($id);
    }

    public function edit(Request $request){
	    $allRequest  = $request->all();
        $id  = $allRequest['id'];
        $title  = $allRequest['title'];
        $content  = $allRequest['content'];

        DB::table('note')
                ->where('id', $id)
                ->update(['title' => $title,  'content' => $content]);
    }

    public function finish(Request $request){
	    $allRequest  = $request->all();
        $id  = $allRequest['id'];
        $finish = "finish";
        DB::table('note')
                ->where('id', $id)
                ->update(['status' => $finish]);
    }

}
