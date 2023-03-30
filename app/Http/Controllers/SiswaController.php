<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function getsiswa()
    {
        // $dt_siswa=Siswa::join('kelas','kelas.id_kelas','=','siswa.id_kelas')
        // ->get();
        $dt_siswa = Siswa::join('kelas' , 'siswa.id_kelas' , '=' , 'kelas.id_kelas')->get();
        return response()->json($dt_siswa);
    }

    public function detailsiswa($id_siswa){
        $dt_siswa=Siswa::join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->where('id_siswa', '=', $id_siswa) 
        ->get();
        return response()->json($dt_siswa);
       }
    public function createsiswa(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save = Siswa::create([
            'nama_siswa'    =>$req->get('nama_siswa'),
            'tanggal_lahir' =>$req->get('tanggal_lahir'),
            'gender'        =>$req->get('gender'),
            'alamat'        =>$req->get('alamat'),
            'id_kelas'      =>$req->get('id_kelas'),

        ]);
        if($save){
            return Response()->json(['status'=>true, 'message' => 'Sukses menambah siswa']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal menambah siswa']);
        }
    }
    public function updatesiswa(Request $req,$id)
    {
        $validator = Validator::make($req->all(),[
            'nama_siswa'=>'required',
            'tanggal_lahir'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'id_kelas'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $ubah = Siswa::where('id_siswa',$id)->update([
            'nama_siswa'    =>$req->get('nama_siswa'),
            'tanggal_lahir' =>$req->get('tanggal_lahir'),
            'gender'        =>$req->get('gender'),
            'alamat'        =>$req->get('alamat'),
            'id_kelas'        =>$req->get('id_kelas'),

        ]);
        if($ubah){
            return Response()->json(['status'=>true, 'message' => 'Sukses mengubah siswa']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal mengubah siswa']);
        }
    }
    public function deletesiswa($id)
    {
        $hapus=Siswa::where('id_siswa',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>true, 'message' => 'Sukses menghapus siswa']);
        }else {
            return Response()->json(['status'=>false, 'message' => 'Gagal menghapus siswa']);
        }
    }
}