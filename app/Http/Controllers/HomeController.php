<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Berita;
use App\Pengumuman;

class HomeController extends Controller
{
    //untuk menampilkan aplikasi
    public function pengumuman() {
      // Menampilkan aplikasi berita
      if(Berita::all()->count() > 0){
        $berita = Berita::all()->sortByDesc("updated_at")->take(4);
        $i = 0;
        foreach($berita as $date){
          $dateResult[$i] = date($date->updated_at);
          $i += 1;
        }
      }else{
        $berita = '0';
        $dateResult = '0';
      }
      // Menampilkan aplikasi pengumuman
      if(Pengumuman::all()->count() > 0){
        $pengumuman = Pengumuman::all()->sortByDesc("updated_at")->take(5);
        $i = 0;
        foreach($pengumuman as $info){
          $dateInfo[$i] = date($info->updated_at);
          $i += 1;
        }
      }else{
        $pengumuman = '0';
        $dateInfo = '0';
      }
      return view('/home', ['pengumuman'=> $pengumuman,
        'berita' => $berita, 'date' => $dateResult, 'dateInfo' => $dateInfo,
        'user' => Auth::user()]);
    }
}
function date($tanggal){
        $dateSpace = explode(' ',$tanggal);
        $dateArray = explode('-',$dateSpace[0]);
        $time = explode(':',$dateSpace[1]);
        // Nama Bulan
        if($dateArray[1] == '01'){
          $bulan = 'Januari';
        }
        if($dateArray[1] == '02'){
          $bulan = 'Februari';
        }
        if($dateArray[1] == '03'){
          $bulan = 'Maret';
        }
        if($dateArray[1] == '04'){
          $bulan = 'April';
        }
        if($dateArray[1] == '05'){
          $bulan = 'Mei';
        }
        if($dateArray[1] == '06'){
          $bulan = 'Juni';
        }
        if($dateArray[1] == '07'){
          $bulan = 'Juli';
        }
        if($dateArray[1] == '08'){
          $bulan = 'Agustus';
        }
        if($dateArray[1] == '09'){
          $bulan = 'September';
        }
        if($dateArray[1] == '10'){
          $bulan = 'Oktober';
        }
        if($dateArray[1] == '11'){
          $bulan = 'November';
        }
        if($dateArray[1] == '12'){
          $bulan = 'Desember';
        }
        $dateResult = $dateArray[2]." ".$bulan." ".$dateArray[0].", at ".$time[0].":".$time[1];
        return $dateResult;
    }
