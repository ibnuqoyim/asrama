<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Daftar_asrama_reguler;
use App\Daftar_asrama_non_reguler;
use App\User_nim;
use App\User_penghuni;
use App\Asrama;
use App\Next_periode;
use App\Periode;
use App\Blacklist;
use App\Keluar_asrama;
use App\kerusakan_kamar;
use App\Pengelola;
class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get user ID
        $userID = Auth::User()->id;
        // Get user information
        $user = User::find($userID);
        // Mengambil data pada tabel reguler
        if(Daftar_asrama_reguler::where(['id_user'=>$userID])->count() < 1){
        	$reguler = '0';
        }else{
        	$reguler = User::find($userID)->Daftar_asrama_reguler;
        }
        // Mengambil data pada tabel non reguler
        if(Daftar_asrama_non_reguler::where(['id_user'=>$userID])->count() < 1){
        	$nonReguler = '0';
        }else{
        	$nonReguler = User::find($userID)->Daftar_asrama_non_reguler;
        }
        // Mengambil data dari nim penghuni
        if(User_penghuni::where(['id_user'=>$userID])->count() < 1){
        	$userPenghuni = '0';
        }else{
        	$userPenghuni = User::find($userID)->user_penghuni;
        }
        // Mengambil data nim user
        if(User_nim::where(['id_user'=>$userID])->count() < 1){
        	$userNim = '0';
        }else{
        	$userNim = User::find($userID)->user_nim;
        }
        // Mengambil data pengelola
        if(Pengelola::where(['id_user'=>$userID])->count() < 1){
        	$pengelola = '0';
        	$pengelolaAsrama = '0';
        }else{
        	$pengelola = User::find($userID)->pengelola;
        	$pengelolaAsrama = Pengelola::find($pengelola->id_pengelola)->asrama;
        }
        // Mengambil data jurusan dan fakultas dari User NIM bila ada
        return view('/dashboard',['reguler'=>$reguler,
        			'nonReguler'=>$nonReguler,
        			'userNim'=>$userNim,
        			'userPenghuni'=>$userPenghuni,
        			'user'=>$user,'pengelola'=>$pengelola,
        			'pengelolaAsrama'=>$pengelolaAsrama]);
    }

    public function save_info(Request $request) {
        if(Auth::guest()) {
            return redirect ('login');
        } else {
            $user = Auth::user();
            $user_penghuni = ($user->user_penghuni == null) ? new User_penghuni : $user->user_penghuni;
            $user_penghuni->id_user = $user->id;
            $user_penghuni->nomor_identitas = $request->nomor_identitas;
            $user_penghuni->jenis_identitas = $request->jenis_identitas;
            $user_penghuni->tempat_lahir = $request->tempat_lahir;
            $user_penghuni->gol_darah = $request->gol_darah;
            $user_penghuni->jenis_kelamin = $request->kelamin;
            $user_penghuni->tanggal_lahir = $request->date;
            $user_penghuni->kodepos = $request->kode_pos;
            $user_penghuni->negara = $request->negara;
            $user_penghuni->propinsi = $request->propinsi;
            $user_penghuni->kota = $request->kota;
            $user_penghuni->alamat = $request->alamat;
            $user_penghuni->agama = $request->agama;
            $user_penghuni->pekerjaan = $request->pekerjaan;
            $user_penghuni->warga_negara = $request->warga_negara;
            $user_penghuni->telepon = $request->telepon;
            $user_penghuni->kontak_darurat = $request->kontak_darurat;
            $user_penghuni->instansi = $request->instansi;
            $user_penghuni->nama_ortu_wali = $request->nama_ortu_wali;
            $user_penghuni->pekerjaan_ortu_wali = $request->pekerjaan_ortu_wali;
            $user_penghuni->telepon_ortu_wali = $request->telepon_ortu_wali;
            $user_penghuni->save();

            return redirect('dashboard');
            
        }
    }
}
