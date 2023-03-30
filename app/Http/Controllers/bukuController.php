<?php

namespace App\Http\Controllers;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bukuController extends Controller
{
    public function getbuku(){
        $buku = buku::get();
            return response()->json($buku);
    }
     public function detailbuku($id){
        $data = buku::where('id_buku','=',$id)
        ->get();
        return response()->json($data);
    }
    
    public function createbuku(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'judul_buku'=>'required',
            'pengarang'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = buku::create([
            'judul_buku'    =>$req->get('judul_buku'),
            'pengarang'    =>$req->get('pengarang')

        ]);
        if($save){
            return Response()->json(['status'=>true, 'message' => 'Sukses menambah buku']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal menambah buku']);
        }
    }
    public function updatebuku(Request $req,$id)
    {
        $validator = Validator::make($req->all(),[
            'judul_buku'=>'required',
            'pengarang'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = buku::where('id_buku',$id)->update([
            'judul_buku'    =>$req->get('judul_buku'),
            'pengarang' =>$req->get('pengarang')
        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' => 'Sukses mengubah Buku']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal mengubah Buku']);
        }
    }
    public function deletebuku($id)
    {
        $hapus=buku::where('id_buku',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true, 'message' => 'Sukses menghapus siswa']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal menghapus siswa']);
        }
    }
}
