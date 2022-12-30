<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\CollectionDataTable;

use App\Models\Aspek;
use App\Models\Standar;
use App\Models\Realisasi;
use App\Models\Indikator;
use App\Models\FileRelasi;
use App\Models\Rekomendasi;
use App\Models\HasilRekomendasi;


class SSPController extends Controller
{
    public function aspek() {
        $model = Aspek::with('standars');
        return DataTables::of($model)
                ->addColumn('action', function($row){
                    $button = '<a href="#show_standar" id="'.$row->id.'" onClick="show(this.id)" class="uk-button uk-button-primary uk-button-small show" uk-toggle><span uk-icon="info"></span></a>';
                    return $button;
                })->rawColumns(['action'])->make(true);
    }
    
    public function standar($id){        
        $model = Standar::where('id_aspek', $id)->get();        
        return DataTables::of($model) 
                ->addColumn('action', function($row){
                    $button = '<a href="/penetapan/indikator/'.$row->id.'/show" class="uk-button uk-button-primary uk-button-small show"><span uk-icon="info"></span></a> ';
                    $button = $button.'<a href="/penetapan/standar/'.$row->id.'/delete" class="uk-button uk-button-danger uk-button-small show"><span uk-icon="trash"></span></a>';
                    return $button;
                })->rawColumns(['action'])->make(true);
    }

    public function role() {
        $model = [                                
                    ['role' => 'Akademik' ], 
                    ['role' => 'Keuangan' ], 
                    ['role' => 'P3M' ], 
                    ['role' => 'PLK' ], 
                    ['role' => 'Asdir1' ], 
                    ['role' => 'Asdir2' ], 
                    ['role' => 'BPMI' ], 
                    ['role' => 'TIK' ], 
                    ['role' => 'Laboran' ], 
                    ['role' => 'Perpustakaan' ], 
                    ['role' => 'D3Komputer' ], 
                    ['role' => 'D3Hotel' ], 
                    ['role' => 'D3Akuntansi' ], 
                    ['role' => 'D3Administrasi' ], 
                    ['role' => 'D4Perhotelan' ], 
                    ['role' => 'D4Manajemen' ]                
                ];
        return DataTables::of($model)
                    ->addIndexColumn('PIC')
                    ->addColumn('aksi', function($row){                                                  
                        foreach($row as $i){           
                            $indikator = Indikator::where('pic', 'LIKE', '%'.$i.'%')->count();                  
                            if($indikator == 0) {
                                return $button = '<a href="#" class="uk-button uk-button-danger uk-button-small"><span uk-icon="ban"></span></a> ';                                                    
                            }
                            else {
                                return $button = '<a href="/realisasi/'.$i.'/departemen" class="uk-button uk-button-primary uk-button-small"><span uk-icon="info"></span></a> ';                                                    
                            }
                        }
                    })
                    ->addColumn('info', function($row) {                         
                        foreach($row as $i){
                            $realisasi = Realisasi::where('pic', $i)->count();
                            $indikator = Indikator::where('pic', 'LIKE', '%'.$i.'%')->count();                                                  
                            if($realisasi > 0){
                                $hasil = ($realisasi*100)/$indikator;
                                if($hasil == 100){
                                    return 'Sebanyak '.$realisasi.' realisasi telah terisi dari '.$indikator.' indikator <span class="uk-badge uk-label-success">'.$hasil.'</span>';                                            
                                }
                                else if($hasil >= 70 && $hasil <= 99){
                                    return 'Sebanyak '.$realisasi.' realisasi telah terisi dari '.$indikator.' indikator <span class="uk-badge uk-label">'.$hasil.'</span>';                                
                                }
                                else if($hasil >= 45 && $hasil <= 69){
                                    return 'Sebanyak '.$realisasi.' realisasi telah terisi dari '.$indikator.' indikator <span class="uk-badge uk-label-warning">'.$hasil.'</span>';                                            
                                }
                                else {
                                    return 'Sebanyak '.$realisasi.' realisasi telah terisi dari '.$indikator.' indikator <span class="uk-badge uk-label-danger">'.$hasil.'</span>';
                                }
                            }                                                      
                            else {
                                return 'Sebanyak '.$realisasi.' realisasi telah terisi dari '.$indikator.' indikator <span class="uk-badge uk-label-danger">0%</span>';
                            }
                        }
                    })                    
                    ->rawColumns(['PIC','aksi','info'])
                    ->make(true);
    }

    public function realisasi($name) {
        $model = Indikator::with('realisasi')->where('pic', 'LIKE', '%'.$name.'%')->get();    
        return DataTables::of($model)
        ->addColumn('indikator', function($row){
            return $row->indikator;
        })
        ->addColumn('SN Dikti', function($row){
            return $row->value;
        })
        ->addColumn('realisasi', function($row){
            $realisasi = $row->realisasi;
            if($realisasi == '') {
                return array(["value" => '-']);
            }
            else {
                return array($row->realisasi);
            }
        })
        ->addColumn('keterangan', function($row){
            $id = $row->realisasi;
            if($id == ''){
                return '<div class="uk-inline">
                            <a class="uk-button uk-button-small" disabled><span uk-icon="minus"></span></a>
                            <div class="uk-card uk-card-body uk-card-default" uk-drop>
                                Realisasi belum di input
                            </div>
                        </div>';                
            }
            else {
                $file = FileRelasi::where('id_realisasi', 1)->count();
                if($file == 0){
                    return '<div class="uk-inline">
                            <a class="uk-button uk-button-small" disabled><span uk-icon="ban"></span></a>
                            <div class="uk-card uk-card-body uk-card-default" uk-drop>
                                Realisasi ini belum terlampir file bukti
                            </div>
                        </div>';
                }
                else {
                    return '<div class="uk-inline">
                            <a class="uk-button uk-button-small" disabled><span uk-icon="check"></span></a>
                            <div class="uk-card uk-card-body uk-card-default" uk-drop>
                                Realisasi ini telah terlampir file bukti
                            </div>
                        </div>';
                }; 
                
            }             
        })
        ->addColumn('action', function($row){
            $realisasi = $row->realisasi;                              
            if($realisasi == null){               
                return $button = '<a href="#" id="'.$row->id.'" onClick="addRealisasi(this.id)" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #add_new_realisasi"><span uk-icon="plus"></span></a> ';     
            }                
            else {                                                                                                                                                       
                $button = '<a href="'.route("admin_realisasi_detail_departemen_show", ["id"=>$row->id]).'" class="uk-button uk-button-primary uk-button-small"><span uk-icon="info"></span></a> ';                    
                $button = $button.'<a href="#" class="uk-button uk-button-danger uk-button-small"><span uk-icon="trash"></span></a>';
                return $button; 
            }                   
        })
        ->rawColumns(['keterangan','action'])
        ->toJson();        
    }

    public function file($id){
        $model = FileRelasi::query()->where('id_realisasi', $id);

        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
            $button = '<a href="'.asset('/storage/'.$row->file).'" class="uk-button uk-button-primary uk-button-small"><span uk-icon="info"></span></a> ';                    
            $button = $button.'<a href="#" class="uk-button uk-button-danger uk-button-small"><span uk-icon="trash"></span></a>';
            return $button; 
        })     
        ->rawColumns(['action'])  
        ->toJson();
    }

    public function temuan(){
        $model = [                                
            ['role' => 'Akademik' ], 
            ['role' => 'Keuangan' ], 
            ['role' => 'P3M' ], 
            ['role' => 'PLK' ], 
            ['role' => 'Asdir1' ], 
            ['role' => 'Asdir2' ], 
            ['role' => 'BPMI' ], 
            ['role' => 'TIK' ], 
            ['role' => 'Laboran' ], 
            ['role' => 'Perpustakaan' ], 
            ['role' => 'D3Komputer' ], 
            ['role' => 'D3Hotel' ], 
            ['role' => 'D3Akuntansi' ], 
            ['role' => 'D3Administrasi' ], 
            ['role' => 'D4Perhotelan' ], 
            ['role' => 'D4Manajemen' ]                
        ];

        return DataTables::of($model)
        ->addColumn('lv1', function($row){
            foreach($row as $i){
                $realisasi = Realisasi::where('pic', $i)->where('status', '0')->count();
                return '<a class="uk-badge uk-label-danger" href="'.route("admin_temuan_detail",['pic'=>$i, 'id'=>0]).'">'.$realisasi.'</a>';
            }
        })
        ->addColumn('lv2', function($row){
            foreach($row as $i){
                $realisasi = Realisasi::where('pic', $i)->where('status', '1')->count();
                return '<a class="uk-badge uk-label-warning" href="'.route("admin_temuan_detail",['pic'=>$i, 'id'=>1]).'">'.$realisasi.'</a>';
            }
        })
        ->addColumn('lv3', function($row){
            foreach($row as $i){
                $realisasi = Realisasi::where('pic', $i)->where('status', '2')->count();
                return '<a class="uk-badge uk-label-default" href="'.route("admin_temuan_detail",['pic'=>$i, 'id'=>2]).'">'.$realisasi.'</a>';
            }
        })
        ->addColumn('lv4', function($row){
            foreach($row as $i){
                $realisasi = Realisasi::where('pic', $i)->where('status', '3')->count();
                return '<a class="uk-badge uk-label-success" href="'.route("admin_temuan_detail",['pic'=>$i, 'id'=>3]).'">'.$realisasi.'</a>';
            }
        })
        ->rawColumns(['lv1','lv2','lv3','lv4'])
        ->toJson();
    }

    public function temuan_detail($name, $id){
        $model = Realisasi::where('pic',$name)->where('status', $id);                
        
        return DataTables::eloquent($model)
        ->addColumn('indikator', function($row){
            $indikator = $row->indikator;          
            return $indikator->toArray();            
        })
        ->addColumn('sn_dikti', function($row){
            $indikator = $row->indikator;            
            return $indikator->toArray(); 
        })
        ->addColumn('value', function($row){
            $rekomendasi = Rekomendasi::where('id_realisasi', $row->id)->count();
            if($rekomendasi <= 0){
                return $row->value."<span uk-icon=''></span>";
            }
            else {
                return $row->value."<span uk-icon='icon: check; ratio: 0.7'></span>";
            }
        })
        ->addColumn('aksi', function($row){
            $id = $row->indikator->id;                    
            $button = '<a href="#" id="'.$id.'" onClick="loadRealisasi(this.id)" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #mainModal"><span uk-icon="info"></span></a>';
            return $button;             
        })
        ->rawColumns(['aksi','value'])
        ->toJson();
    }

    public function pengendalian() {
        $model = Realisasi::where('status','<','2')->with('indikator')->with('rekomendasi');
        
        return DataTables::of($model)
        ->addColumn('rekomendasi', function($row){
            if($row->rekomendasi == null){
                $row = '<div class="uk-inline">
                            <button class="uk-button uk-button-danger uk-button-small" type="button"><span uk-icon="info"></span></button>
                            <div class="uk-dropbar uk-dropbar-top" uk-drop="boundary: !.uk-navbar; flip: false">Belum terupload rekomendasi</div>
                        </div>';                        
                return $row;
            }
            else {
                $row = '<div class="uk-inline">
                            <button class="uk-button uk-button-danger uk-button-small" type="button"><span uk-icon="info"></span></button>
                            <div class="uk-dropbar uk-dropbar-top" uk-drop="boundary: !.uk-navbar; flip: false">'.$row->rekomendasi->rekomendasi.'</div>
                        </div>';                        
                return $row;
            }
        })
        ->addColumn('tindak_lanjur', function($row){
            return $row->rekomendasi->hasil_rekomendasi;
        })
        ->rawColumns(['rekomendasi'])
        ->toJson();
    }
}
