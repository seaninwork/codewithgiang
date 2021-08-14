<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class crudController extends Controller
{
    public function index(){
        //Lấy danh sách từ database
        $getData = DB::table('note')->get();
        
        //Gọi đến view va goi data
        return view('crud')->with('list', $getData);
    }

    public function store(Request $request){
        
        //Lấy giá trị học sinh đã nhập
        $allRequest  = $request->all();
        $title  = $allRequest['title'];
        $content = $allRequest['content'];
        
        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'title'  => $title,
            'content' => $content
        );
        
        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('note')->insert($dataInsertToDatabase);
        return redirect('crud');
    }

    public function delete($id){
        $deleteData = DB::table('note')->where('id', '=', $id)->delete();
        return redirect('crud');
    }

    public function edit($id)
    {
        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('note')->select('id','title','content')->where('id',$id)->get();
        
        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData
        return view('edit')->with('getData', $getData);
    }

    public function update(Request $request)
    {
        
        $updateData = DB::table('note')->where('id', $request->idExample)->update([
            'title' => $request->title,
            'content' => $request->content,
            'time' => date('Y-m-d H:i:s')
        ]);

        //Thực hiện chuyển trang
        return redirect('crud');
    }

}
