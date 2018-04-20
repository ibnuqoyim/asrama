@extends('layouts.default')


@section('title','Dashboard')

@section('main_menu')
	@parent

@endsection

@section('header_title','Dashboard')
@section('content')
<div class="container">
	<br><br>
	<div class="row">
		<!-- SIDER -->
		<div class="col-md-3">
			<div class="sider">
				<div class="sider_header">
					<h4><b><span class="fa fa-address-card"></span> Informasi Pengguna</b></h4>
				</div>
				<div class="sider_body">
					<i>Username</i><br>
					<b><span class="fa fa-user"></span> {{$user->username}}</b><br>
					<i>Nama Lengkap</i><br>
					<b><span class="fa fa-drivers-license-o"></span>  {{$user->name}}</b><br>
					<i>Email</i><br>
					<b><span class="fa fa-envelope"></span> {{$user->email}}</b><br><br>
					<b><i><a href="#"><span class="fa fa-key"></span> Ganti Password</a></i></b>
				</div>
			</div><br>

			@if($userPenghuni != '0')
			<div class="sider">
				<div class="sider_header">
					<h4><b><span class="fa fa-cogs"></span> Aplikasi</b></h4>
				</div>
				<style>
					a.tablinks {
						color: black;
					}
					a.active {
						font-weight: bold;
						font-style: italic;
					}
				</style>
				<script>
					function dapatkanId(pan){
						var x = document.getElementById(pan);
						$(document).ready(function(){
							$(x).toggle(500);
						});
					}
					function siderLoad(evt) {
					    var i, tablinks;
					    tablinks = document.getElementsByClassName("tablinks");
					    for (i = 0; i < tablinks.length; i++) {
					        tablinks[i].className = tablinks[i].className.replace(" active", "");
					    }
					    evt.currentTarget.className += " active";
					}
				</script>
				@if($user->is_penghuni == 1)
					<div class="sider_pan" onclick="dapatkanId('pan_penghuni')" style="cursor: pointer;"><b><i class="fa fa-angle-down"></i> Penghuni</b></div>
					<div class="sider_body" id="pan_penghuni" style="display: block">
						<a class="tablinks active" href="#" onclick="siderLoad(event)">Utama</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Informasi Pembayaran</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Lapor Kerusakan</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Pindah Kamar</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Keluar Asrama</a><br>
					</div>
				@endif 
				@if($user->is_pengelola == 1)
					<div class="sider_pan" onclick="dapatkanId('pan_pengelola')" style="cursor: pointer;"><b><i class="fa fa-angle-down"></i> Pengelola Asrama</b></div>
					<div class="sider_body" id="pan_pengelola" style="display: none">
						<a class="tablinks" href="#" onclick="siderLoad(event)">Utama</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Informasi Pembayaran</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Lapor Kerusakan</a><br>
					</div>
				@endif
				@if($user->is_sekretariat == 1)
					<div class="sider_pan" onclick="dapatkanId('pan_sekretariat')" style="cursor: pointer;"><b><i class="fa fa-angle-down"></i> Sekretariat</b></div>
					<div class="sider_body" id="pan_sekretariat" style="display: none">
						<a class="tablinks" href="#" onclick="siderLoad(event)">Utama</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Informasi Pembayaran</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Lapor Kerusakan</a><br>
					</div>
				@endif
				@if($user->is_ppimpinan == 1)
					<div class="sider_pan" onclick="dapatkanId('pan_pimpinan')" style="cursor: pointer;"><b><i class="fa fa-angle-down"></i> Pimpinan</b></div>
					<div class="sider_body" id="pan_pimpinan" style="display: none">
						<a class="tablinks" href="#" onclick="siderLoad(event)">Utama</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Informasi Pembayaran</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Lapor Kerusakan</a><br>
					</div>
				@endif
				@if($user->is_admin == 1)
					<div class="sider_pan" onclick="dapatkanId('pan_admin')" style="cursor: pointer;"><b><i class="fa fa-angle-down"></i> Admin</b></div>
					<div class="sider_body" id="pan_admin" style="display: none">
						<a class="tablinks" href="#" onclick="siderLoad(event)">Utama</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Informasi Pembayaran</a><br>
						<a class="tablinks" href="#" onclick="siderLoad(event)">Lapor Kerusakan</a><br>
					</div>
				@endif
			</div>
			@endif
		</div>
		<!-- KONTEN UTAMA -->
		<div class="col-md-9">
			@if($userPenghuni == '0' && $user->is_penghuni == 1)
				<h1 style="margin-top: 0px;"><b>Data Diri Penghuni</b></h1>
				<p>Sebelum melanjutkan pada daftar aplikasi, silahkan melengkapi data diri Anda pada form di bawah ini.</p>
				<form action="{{route('dashboard')}}" method="post" class="flp">
					{{ csrf_field() }}
					<div style="border: 1px solid #C9C9C9; border-radius: 5px;">
						<div style="background-color: #E8E8E8; padding: 10px 15px 10px 15px">
							Kemahasiswaan
						</div>
						<div style="padding: 10px 15px 10px 15px;">
							<p>Apakah Anda mahasiswa ITB?</p>
								<input id="nim" name="nim" type="radio" value="1"> Yes, I am a student<br>
								<input id="nim" name="nim" type="radio" value="0"> No, I am not a student<br>
							<div id="msg" style="display: none;"><br>
								<input type="number" class="input" placeholder="Masukkan NIM Anda">
							</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$("input[type=radio][name=nim]").change(function(){
								  var nim = $(this).val();
								  if (nim == 1){
								  	$('#msg').show(500);
								  	$('#itb').show(500);
								  	$('#non_itb').hide(500);
								  }else{
								  	$('#msg').hide(500);
								  	$('#itb').hide(500);
								  	$('#non_itb').show(500);
								  }
								});
							});
						</script>
					</div><br>
					<div style="border: 1px solid #C9C9C9; border-radius: 5px;">
						<div style="background-color: #E8E8E8; padding: 10px 15px 10px 15px">
							Data Diri
						</div>
						<div style="padding: 10px 15px 10px 15px;"><br>
							<input class="input" name="nomor_identitas" type="text" value="{{old('nomor_identitas')}}" placeholder="Nomor Identitas" required><br><br>
							<input class="input" name="jenis_identitas" type="text" value="{{old('jenis_identitas')}}" placeholder="Jenis Identitas (contoh: SIM, KTP, paspor)" required><br><br>
							<input class="input" name="tempat_lahir" type="text" value="{{old('tempat_lahir')}}" placeholder="Kota Lahir" required><br><br>
							<div class="input-group">
								<div class="input-group-addon" >
									<i class="fa fa-calendar"></i>
								</div>
								<input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width: 100%;" class="form-control" id="date" name="date" placeholder="Tanggal Lahir (YYYY-MM-DD)" type="text" required>
							</div><br>
							<input class="input" name="tempat_lahir" type="text" value="{{old('tempat_lahir')}}" placeholder="Kota Lahir" required><br><br>
							Golongan Darah:<br>
							<input type="radio" name="gol_darah" value="O" required> O
							<span style="display: inline-block; width: 50px;"></span>
							<input type="radio" name="gol_darah" value="AB" required> AB
							<span style="display: inline-block; width: 50px;"></span>
							<input type="radio" name="gol_darah" value="A" required> A
							<span style="display: inline-block; width: 50px;"></span>
							<input type="radio" name="gol_darah" value="B" required> B
							<span style="display: inline-block; width: 50px;"></span><br><br>
							Jenis Kelamin:<br>
							<input type="radio" name="kelamin" value="L" required> Laki-laki
							<span style="display: inline-block; width: 50px;"></span>
							<input type="radio" name="kelamin" value="P" required> Perempuan<br><br>
							Asal Negara:<br>
							<select id="country" name ="negara"></select></br></br>
							Propinsi/State:<br>
							<select name ="propinsi" id ="state"></select></br></br>
							<script language="javascript">
								populateCountries("country", "state");
							</script>
							<input class="input" name="kota" type="text" value="{{old('kota')}}" placeholder="Nama Kota" required><br><br>
							<input class="input" name="alamat" type="text" value="{{old('alamat')}}" placeholder="Alamat" required><br><br>
							<input class="input" name="kode_pos" type="text" value="{{old('kodepos')}}" placeholder="Kode Pos" required><br><br>
							<input class="input" name="agama" type="text" value="{{old('agama')}}" placeholder="Agama" required><br><br>
							<input class="input" name="pekerjaan" type="text" value="{{old('pekerjaan')}}" placeholder="Pekerjaan" required><br><br>
							Warga Negara:<br>
							<select id="country2" name ="warga_negara"></select><br><br>
							<input class="input" name="telepon" type="text" value="{{old('telepon')}}" placeholder="Telepon" required><br><br>
							<input class="input" name="kontak_darurat" type="text" value="{{old('kontak_darurat')}}" placeholder="Kontak Darurat" required><br><br>
							<div id="non_itb" style="display: none;">
							<input class="input" name="instansi" type="text" value="{{old('instansi')}}" placeholder="Nama Instansi" required><br><br>
							</div>
							{{-- @if ($info_penghuni->pekerjaan == 'Mahasiswa ITB')
                                <input id="instansi" type="text" class="form-control" name="instansi" value="Institut Teknologi Bandung" readonly="true" required>
                            @else
                                <input id="instansi" type="text" class="form-control" name="instansi" value="{{ $info_penghuni->instansi }}" required>
                            @endif --}}
							<div id="itb" style="display: none;">
								<input class="input" name="instansi" type="text" value="Institut Teknologi Bandung" class="input"><br><br>
							</div>
							<script language="javascript">
								populateCountries("country2");
							</script>
						</div>
					</div><br>
					<div style="border: 1px solid #C9C9C9; border-radius: 5px;">
						<div style="background-color: #E8E8E8; padding: 10px 15px 10px 15px">
							Data Orang Tua / Wali
						</div>
						<div style="padding: 10px 15px 10px 15px;"><br>
							<input class="input" name="nama_ortu_wali" type="text" value="{{old('nama_ortu_wali')}}" placeholder="Nama Orang Tua / Wali" required><br><br>
							<input class="input" name="pekerjaan_ortu_wali" type="text" value="{{old('pekerjaan_ortu_wali')}}" placeholder="Pekerjaan Orang Tua / Wali" required><br><br>
							<input class="input" name="telepon_ortu_wali" type="text" value="{{old('telepon_ortu_wali')}}" placeholder="Telepon Orang Tua / Wali" required><br><br>
							<button type="submit" class="button">Submit</button><br><br>
						</div>
					</div><br>
				</form> 
			@endif
			@if($user->is_penghuni == 1 && $userPenghuni == '1')
				<h1><b>Informasi Pendaftaran</b></h1>
				<p>Terimakasih telah bergabung dengan UPT Asrama ITB. Silahkan daftarkan diri Anda untuk permohonan tinggal di asarama.
					Syarat dan ketentuan adalah sebagai berikut:<br>
					<h4><b>PENGHUNI REGULER</b></h4>Penghuni reguler adalah penghuni dengan status mahasiswa ITB. Seorang penghuni reguler hanya dapat mendaftar pada periode tertentu yang waktunya telah ditetapkan oleh pihak asrama.<br>
					<h4><b>PENGHUNI NON REGULER</b></h4>Penghuni Non Reguler terbuka bagi siapa saja yang ingin mendaftar ke asrama. Penghuni Non Reguler dapat menetapkan tanggal masuk dan tanggal keluar dari asrama sesuai keperluan tinggal.</p>
			@endif
			@if($reguler == '0' && $nonReguler == '0' && $userPenghuni == '1')
			<div style="text-align: center;"><a href="#"><button class="button">Daftar Sekarang</button></a>
			</div>
			@endif
		</div>
	</div>
	<br><br><br>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	})
</script>
@endsection
