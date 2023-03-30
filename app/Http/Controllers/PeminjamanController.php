<?php
namespace App\Http\Controllers;
use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use illuminate\Support\Facades\Hash;

class PeminjamanController extends Controller
{
    public function getpeminjaman(Request $req,$id)
    {
       $dt_peminjaman=Peminjaman::
        join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
       ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
       ->join('buku','buku.id_buku','=','peminjaman.id_buku')
       ->where('id_peminjaman',$id)
      ->get();
      return Response()->json($dt_peminjaman);
    }

    public function getpeminjaman1(Request $req)
    {
       $dt_peminjaman1=peminjaman::
       join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
       ->get();
      return Response()->json($dt_peminjaman1);
    }
    

    public function createpeminjaman(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id_siswa'=>'required',
            'id_kelas'=>'required',
            'id_buku'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $kembali = Carbon::now()->addDays(7);
        $dipinjam = Carbon::now();
        $save = peminjaman::create([
            'id_siswa' =>$req->get('id_siswa'),
            'id_kelas' =>$req->get('id_kelas'),
            'id_buku' =>$req->get('id_buku'),
            'tgl_peminjaman' =>$dipinjam,
            'tgl_kembali' =>$kembali,
            'status' => 'Dipinjam',
        ]);
        if($save){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah Peminjaman']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah Peminjaman']);
        }
    }
    public function updatepeminjaman(Request $req,$id)
    {
        $validator = Validator::make($req->all(),[
            'id_siswa'=>'required',
            'id_kelas'=>'required',
            'id_buku'=>'required',

        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = peminjaman::where('id_peminjaman',$id)->update([
            'id_siswa'    =>$req->get('id_siswa'),
            'id_kelas' =>$req->get('id_kelas'),
            'id_buku' =>$req->get('id_buku'),

        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' => 'Sukses mengubah Peminjaman']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal mengubah Peminjaman']);
}
    }
public function deletepeminjaman($id){
    $hapus=Peminjaman::where('id_peminjaman',$id)->delete();
    if($hapus){
        return Response()->json(['status'=>true,'message' => 'Sukses menghapus Data Peminjaman']);
    } else {
        return Response()->json(['status'=>false, 'message' => 'Gagal menghapus Data Peminjaman']);
    }
    }
public function kembalipeminjaman($id){
    $hapus=peminjaman::where('id_peminjaman',"=",$id)
    ->update([
        'status' => 'Kembali'
    ]);
    if($hapus){
        return Response()->json(['status'=>true,'message' => 'Sukses Mengembalikan buku ']);
    } else {
        return Response()->json(['status'=>false,'message' => 'Gagal Mengembalikan buku ']);
    }
}
}