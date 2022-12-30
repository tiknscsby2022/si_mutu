@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="uk-width-expand@s">    
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">Pengendalian</div>
            <div class="uk-card-body">
                <form action="#" class="uk-form-horizontal">                    
                    <div class="uk-card uk-card-default uk-card-body uk-margin">                        
                        <div class="uk-form-control">
                            <div class="uk-inline">
                                <a class="uk-button uk-button-primary" href="{!! route('admin_pengendalian_get_pdf_show') !!}" target="_blank">
                                    Temuan dan Rekomendasi                                                                                                
                                </a>
                                <div uk-drop>Klik untuk mengunduh file Temuan dan Rekomendasi</div>  
                            </div>
                            <a class="uk-button uk-button-primary" uk-toggle="target: #myModal">
                                File Pendukung                                                                                               
                            </a>                            
                        </div>
                    </div>
                    <ul uk-tab>
                        <li><a href="#">Rapat Tinjauan Manajemen</a></li>
                        <li><a href="#">Rencana Tindak Lanjut</a></li>
                    </ul>
                    <ul class="uk-switcher uk-margin">
                        <li>
                            <table class="display" id="mainTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>File</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Undangan</td>
                                        <td><a href="{{ route('admin_pengendalian_media_show', ['media'=>'Undangan']) }}"><span class="uk-icon-button" uk-icon="folder"></span><span class="uk-badge">@if($undangan == '') 0 @else {{$undangan->count()}} @endif</span></a></td>                                    
                                    </tr>                
                                    <tr>
                                        <td>Daftar Hadir</td>
                                        <td><a href="{{ route('admin_pengendalian_media_show', ['media'=>'Daftar Hadir']) }}"><span class="uk-icon-button" uk-icon="folder"></span><span class="uk-badge">@if($absensi == '') 0 @else {{$absensi->count()}} @endif</span></a></td> 
                                    </tr>               
                                    <tr>
                                        <td>Notulensi Rapat</td>
                                        <td><a href="{{ route('admin_pengendalian_media_show', ['media'=>'Notulensi Rapat']) }}"><span class="uk-icon-button" uk-icon="folder"></span><span class="uk-badge">@if($notulen == '') 0 @else {{$notulen->count()}} @endif</span></a></td> 
                                    </tr> 
                                    <tr>
                                        <td>Dokumentasi</td>
                                        <td><a href="{{ route('admin_pengendalian_media_show', ['media'=>'Dokumentasi']) }}"><span class="uk-icon-button" uk-icon="folder"></span><span class="uk-badge">@if($dokumentasi == '') 0 @else {{$dokumentasi->count()}} @endif</span></a></td> 
                                    </tr>                                
                                </tbody>
                            </table>
                        </li>
                        <li>
                            <table class="display">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dokumen RTL</td>
                                        <td><a href="{{ route('admin_pengendalian_media_show', ['media'=>'Dokumen RTL']) }}"><span class="uk-icon-button" uk-icon="folder"></span><span class="uk-badge">{{ $dokumentasi->count() }}</span></a></td> 
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                    </ul>                                
                </form>                
            </div>
        </div>
    </div>

    <div id="myModal" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <form action="{!! route('admin_pengendalian_store') !!}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="uk-modal-header">
                    <h4 class="uk-modal-title uk-text-center">Tambah item</h4>
                </div>
                <div class="uk-modal-body">
                   <div class="uk-margin">
                    <label for="Jenis File" name="file" class="uk-form-label">Dokumen</label>
                    <div class="uk-form-control">
                        <select name="jenis_dokumen" class="uk-select">
                            <option value="" selected disabled></option>
                            <option value="Undangan">Undangan</option>
                            <option value="Daftar Hadir">Daftar Hadir</option>
                            <option value="Notulensi Rapat">Notulensi Rapat</option>
                            <option value="Dokumentasi">Dokumentasi Rapat</option>
                            <option value="Dokumen RTL">Dokumen RTL</option>
                        </select> 
                    </div>
                   </div>                   
                    <div class="uk-margin">
                        <label for="File" class="uk-form-label">Upload File</label>
                        <div class="uk-form-control js-upload uk-placeholder uk-text-center">
                            <span uk-icon="icon: cloud-upload"></span>
                            <span class="uk-text-middle">Drop file atau</span>
                            <div uk-form-custom>
                                <input type="file" name="file[]" multiple>
                                <span class="uk-link">buka file</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer">
                    <button type="submit" class="uk-button uk-button-primary">submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>   
    <script>
        $(document).ready(function(){
            $('table.display').DataTable({
                paging: false,
                info: false,
                searching: false
            });
        })        
    </script>
@endpush