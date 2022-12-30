<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aspek;
use App\Models\Standar;
use App\Models\Indikator;
use App\Models\Realisasi;
use App\Models\FileRelasi;
use App\Models\Rekomendasi;
use App\Models\HasilRekomendasi;
use App\Models\Peningkatan;
use App\Models\FileDashboardModel;

use PDF;

class AdminController extends Controller
{
            public function beranda_show() {
                $data = [
                    'title' => 'Dashboard | Simutu',
                    'user'  => auth()->user(),
                    'file'  => FileDashboardModel::all()
                ];
                return view('admin.dashboard', $data);
            }

            public function beranda_store(Request $request) {
                $path = $request->file('file')->store('dokumen', 'public');
                $file = $request->file;
                $nameFile = $file->getClientOriginalName();                
                $file->move('dokumen_standar', $nameFile);
                FileDashboardModel::create([
                    'id_tahun_akademik' => 1,
                    'name'              => $request->name,
                    'file'              => $path,
                ]);

                return redirect()->route('admin_beranda_show');
            }

            public function penetapan_show() {
                $data = [
                    'title' => 'Penetapan | Simutu',
                    'user'  => auth()->user(),
                    'aspek' => Aspek::all()
                ];
                return view('admin.penetapan', $data);
            }

            /**
             *  =========================================
             *  ================ ASPEK ==================
             *  =========================================
             */

            public function aspek_store(Request $request) {
                Aspek::create([
                    'aspek' => $request->aspek
                ]);
                return redirect()->route('admin_penetapan_show');
            }

            public function aspek_delete($id) {
                $decrypt = decrypt($id);
                $data = Aspek::findOrFail($decrypt);
                $data->delete();

                return redirect()->route('admin_penetapan_show');
            }

            public function aspek_update($id) {        
                $data = Aspek::findOrFail($id);       

                //return $data->standar;
                echo json_encode($data);
            }

            public function aspek_edit(Request $request, $id) {        
                $data = Aspek::findOrFail($id);     
                
                $data->aspek = $request->standar;
                $data->save();
                return redirect()->route('admin_penetapan_show');
            }

            /**
             *  =========================================
             *  ================ STANDAR ================
             *  =========================================
             */          

            public function standar_delete($id) {                
                $data = Standar::findOrFail($id);
                $data->delete();

                return redirect()->route('admin_penetapan_show');
            }

            public function standar_store(Request $request) {     
                $request->validate([
                    'id_aspek'      => 'required',
                    'standar'       => 'required',
                    'file_tautan'   => 'required|mimes:doc,docx,pdf'
                ]);
                $path = $request->file('file_tautan')->store('dokumen', 'public');
                $file = $request->file_tautan;
                $nameFile = $file->getClientOriginalName();                
                $file->move('dokumen_standar', $nameFile);
                Standar::create([
                    'id_aspek'      => $request->id_aspek,
                    'standar'       => $request->standar,
                    'file_tautan'   => $path
                ]);
                return redirect()->route('admin_penetapan_show');
            }

            public function standar_update(Request $request, $id) {                                                              
                $data = Standar::findOrFail($id);                                                
                if($request->file()) {
                    $request->validate([
                        'file_tautan'   => 'required',
                    ]);
                    $path = $request->file('file_tautan')->store('dokumen', 'public');
                    $data->file_tautan = $path;
                }
                $data->standar = $request->standar;                
                $data->save();                
                return redirect()->route('admin_penetapan_indikator_show', ['id' => $id]);
            }

            /**
             *  =========================================
             *  ================ INDIKATOR ==============
             *  =========================================
             */
            
            public function indikator_show($id) {
                $data = [
                    'title'     => 'Penetapan | Simutu',
                    'user'      => auth()->user(),
                    'pics'      => ['Akademik','Keuangan','P3M','PLK','Asdir1','Asdir2','BPMI','TIK','Laboran','Perpustakaan','D3Komputer','D3Hotel','D3Akuntansi','D3Administrasi','D4Perhotelan','D4Manajemen'],
                    'id'        => $id,
                    'indikator' => Indikator::where('id_standar', $id)->get(),                    
                    'standar'   => Standar::find($id)
                ];                                 
                return view('admin.indikator', $data);
            }

            public function indikator_store(Request $request, $id) {
                
                $request->validate([
                    'indikator' => 'required',
                    'ketetapan' => 'required',
                    'pic' => 'required|array',
                ]);                  

                foreach($request->pic as $i){
                    Indikator::create([
                        'id_standar'        => $id,
                        'id_tahun_akademik' => 1,
                        'indikator'         => $request->indikator,
                        'value'             => $request->ketetapan,
                        'pic'               => $i
                    ]);
                }
                return redirect()->route('admin_penetapan_indikator_show', ['id' => $id]);
            } 
            
            public function indikator_destroy($id) {        
                $data = Indikator::findOrFail($id);
                $id_standar = $data->id_standar;
                $data->delete();

                return redirect()->route('admin_penetapan_indikator_show', ['id' => $id_standar]);
            }
            
            public function indikator_edit($id) {
                $data = Indikator::find($id);
                echo json_encode($data);
            }

            public function indikator_update(Request $request, $id){                 
                $data = Indikator::find($id);
                $data->indikator = $request->indikator;
                $data->value = $request->ketetapan;                                
                if($request->pic == null) {                    
                    $data->save();
                    return redirect()->route('admin_penetapan_indikator_show', ['id' => $request->id]);
                }
                else {
                    $data->pic = join(', ', $request->pic);
                    $data->save();
                    return redirect()->route('admin_penetapan_indikator_show', ['id' => $request->id]);
                }   
            }

            /**
             *  =========================================
             *  ================ REALISASI ==============
             *  =========================================
             */           

            public function realisasi_show() {                
                $data = [
                    'title'         => 'Realisasi | Simutu',
                    'user'          => auth()->user(),
                    'role'          => ['Akademik','Keuangan','P3M','PLK','Asdir1','Asdir2','BPMI','TIK','Laboran','Perpustakaan','D3Komputer','D3Hotel','D3Akuntansi','D3Administrasi','D4Perhotelan','D4Manajemen'],                    
                ];                     
                return view('admin.realisasi', $data);
            }

            public function realisasi_departemen_show($id) {
                $data = [
                    'title'         => 'Realisasi | Simutu',
                    'user'          => auth()->user(),
                    'name'          => $id,
                ];

                return view('admin.realisasi_per_departemen', $data);
            }

            public function realisasi_departemen_relasi_show($id) {
                $data = Indikator::find($id);
                echo json_encode($data);
            }

            public function realisasi_departemen_relasi_store(Request $request, $id) {                                      
                $realisasi = Realisasi::where('id_indikator', $id)->count();
                if($realisasi == 0){
                    //echo json_encode($request->kesesuaian);exit();
                    Realisasi::create([
                        'id_indikator'          => $id,
                        'id_tahun_akademik'     =>  '1',
                        'pic'                   => $request->pic,
                        'value'                 => $request->realisasi,
                        'alasan'                => $request->alasan,
                        'status'                => $request->kesesuaian,                    
                    ]);
                    return redirect()->route('admin_realisasi_detail_departemen_show',['name' => $request->pic, 'id' => $id]);
                }
                else {
                    return redirect()->route('admin_realisasi_departemen_show',['name' => $request->pic]);
                }                                
            }

            public function realisasi_departemen_detail_show($id) {
                $data = [
                    'title'         => 'Realisasi | Simutu',
                    'user'          => auth()->user(),
                    'id'            => $id,
                    'indikator'     => Indikator::find($id),
                    'realisasi'     => Indikator::find($id)->realisasi,                      
                ];
                $indikator = indikator::find($id);                
                return view('admin.realisasi_per_indikator', $data);
            }

            public function realisasi_update(Request $request, $id){
                $data = Realisasi::find($id);
                $data->value = $request->realisasi;
                $data->alasan = $request->alasan;
                $data->status = $request->tingkatan;
                $data->save();
                return redirect()->route('admin_realisasi_detail_departemen_show', ['id'=>$request->id_redirect]);
            }

            public function realisasi_file_store(Request $request, $id) {
                $path = $request->file('file')->store('dokumen', 'public');
                $file = $request->file;
                $nameFile = $file->getClientOriginalName();                
                $file->move('dokumen_standar', $nameFile);
                FileRelasi::create([                    
                    'id_realisasi'  => $id,
                    'nama'          => $request->nama,                    
                    'file'          => $path,
                    'pic'           => '',
                ]);
                return redirect()->route('admin_realisasi_detail_departemen_show', ['id'=>$request->id]);
            }

            /**
             *  =========================================
             *  ================ TEMUAN =================
             *  =========================================
             */  
            
             public function temuan_show(){
                $data = [
                    'title'         => 'Temuan & Rekomendasi | Simutu',
                    'user'          => auth()->user(),
                ]; 
                return view('admin.temuan', $data);
             }

             public function temuan_detail($pic, $id){
                $data = [
                    'title'         => 'Temuan & Rekomendasi | Simutu',
                    'user'          => auth()->user(),
                    'realisasis'    => Realisasi::where('status', $id)->where('pic', $pic),
                    'id'            => $id,
                    'pic'           => $pic,
                ]; 
                return view('admin.temuan_detail', $data);
             }

             public function temuan_search($id){
                $realisasi = Indikator::find($id)->realisasi->id;                    
                //$rekomendasi = Rekomendasi::where('id_realisasi', $realisasi)->value('rekomendasi');
                //return $rekomendasi;

                $data = [
                    'indikator'     => Indikator::find($id),                                    
                    'realisasi'     => Indikator::find($id)->realisasi,
                    'rekomendasi'   => Rekomendasi::where('id_realisasi', $realisasi)->value('rekomendasi')
                ];
                echo json_encode($data);
             }

             public function temuan_store(Request $request){
                $id = $request->id_for_redirect;
                $pic = $request->pic_for_redirect;     
                $rekomendasi = Rekomendasi::where('id_realisasi', $request->cek_realisasi)->count();
                if($rekomendasi == 0){
                    Rekomendasi::create([
                        'id_realisasi' => $request->id,
                        'rekomendasi'  => $request->rekomendasi
                    ]);
                    return redirect("/temuan/".$pic."/detail/".$id);
                }
                else {
                    $rekomendasi = Rekomendasi::where('id_realisasi', $request->cek_realisasi)->first();
                    $rekomendasi->rekomendasi = $request->rekomendasi;
                    $rekomendasi->save();
                    return redirect("/temuan/".$pic."/detail/".$id);
                }
                
             }

             /**
             *  =========================================
             *  ================ PENGENDALIAN ===========
             *  =========================================
             */
            public function pengendalian_show(){                
                $data = [
                    'title'                 => 'Temuan & Rekomendasi | Simutu',
                    'user'                  => auth()->user(),                    
                    'undangan'              => HasilRekomendasi::where('jenis_file', 'undangan')->where('id_tahun_akademik','1')->first(),                    
                    'absensi'               => HasilRekomendasi::where('jenis_file', 'Daftar Hadir')->where('id_tahun_akademik','1'),
                    'notulen'               => HasilRekomendasi::where('jenis_file', 'Notulensi Rapat')->where('id_tahun_akademik','1'),
                    'dokumentasi'           => HasilRekomendasi::where('jenis_file', 'Dokumentasi')->where('id_tahun_akademik','1'),
                ]; 
                //return $data;                
                return view('admin.pengendalian', $data);
            }

            public function pengendalian_get_pdf_show() {
                $temuan_rekomendasis = Realisasi::where('status','<','2')->with('indikator')->with('rekomendasi')->get();                
                $pdf = PDF::loadview('admin.load_pdf',['temuan_rekomendasis' => $temuan_rekomendasis])->setPaper('a4', 'landscape');;
                return $pdf->stream();
            }

            public function pengendalian_store(Request $request){
                //return $request->file('file[]');
                $count_file = count($request->file);
                foreach($request->file('file') as $i){                    
                    $path = $i->store('dokumen', 'public');
                    $file = $i;
                    $nameFile = $file->getClientOriginalName();

                    HasilRekomendasi::create([
                        'id_tahun_akademik' => '1',
                        'jenis_file'        => $request->jenis_dokumen,
                        'file'              => $path
                    ]);
                }
                return redirect()->route('admin_pengendalian_show');              
            }

            public function pengendalian_media_show(Request $request, $media){
                $data = HasilRekomendasi::where('jenis_file', $media)->where('id_tahun_akademik', '1')->get();
                foreach($data as $i){
                    return "<a href='/storage/".$i->file."' target='__blank'>.$i->file.</a>";
                }
            }
    
            /**
             *  =========================================
             *  ================ PENINGKATAN ============
             *  =========================================
             */

            public function peningkatan_show(){
                $data = [
                    'title'                 => 'Temuan & Rekomendasi | Simutu',
                    'user'                  => auth()->user(),
                    'realisasi'             => Realisasi::where('status', '>', 1)->get(),
                    'all_indikator'         => Realisasi::count(),
                    'file'                  => Peningkatan::all()
                ];
                return view('admin.peningkatan', $data);
            }

            public function peningkatan_store(Request $request){                
                foreach($request->file('file') as $i){
                    $path = $i->store('dokumen', 'public');
                    $file = $i;
                    $nameFile = $file->getClientOriginalName();

                    Peningkatan::create([
                        'id_tahun_akademik'     => '1',
                        'id_realisasi'          => $request->id_indikator,
                        //'nama'                  => $request->nama_file,
                        'file'                  => $path
                    ]);
                }
                return redirect()->route('admin_peningkatan_show');
            }
}
