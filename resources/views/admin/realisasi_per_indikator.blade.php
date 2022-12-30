@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">Realisasi</div>
            <div class="uk-card-body">
                <form action="{!! route('admin_realisasi_update', ['id' => $indikator->realisasi->id]) !!}" method="post">
                    <fieldset class="uk-fieldset">
                        @csrf()           
                        @method('PUT')             
                        <div class="uk-grid-small" uk-grid>                            
                            <div class="uk-width-1-2@s">
                                <label class="uk-form-label" for="Indikator">Indikator</label>
                                <input value="{{ $indikator->indikator }}" type="text" class="uk-input" disabled>
                            </div>
                            <div class="uk-width-1-2@s">
                                <label class="uk-form-label" for="SN Dikti">SN Dikti</label>
                                <input value="{{ $indikator->value }}" type="text" class="uk-input" disabled>
                            </div>
                        </div>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-3-4@s">
                                <label class="uk-form-label" for="Indikator">Realisasi</label>
                                <input name="realisasi" value="{{ $realisasi->value  }}" type="text" class="uk-input">                                
                            </div>
                            <div class="uk-width-1-4@s">
                                <label for="Kesesuaian" class="uk-form-label">Kesesuaian</label>
                                <select name="tingkatan" class="uk-select">
                                    <option value="0" @if($realisasi->status == 0) selected @endif)>Tidak memenuhi standar</option>
                                    <option value="1" @if($realisasi->status == 1) selected @endif)>Hampir memenuhi standar</option>
                                    <option value="2" @if($realisasi->status == 2) selected @endif)>Telah memenuhi standar</option>
                                    <option value="3" @if($realisasi->status == 3) selected @endif)>Telah melebihi standar</option>
                                </select>
                            </div>
                            <div class="uk-widht-1-1@s">
                                <input type="hidden" name="id_redirect" value="{{ $indikator->id }}">
                                <textarea name="alasan" cols="130" rows="5" class="uk-textarea">{{ $realisasi->alasan }}</textarea>
                            </div>
                            <div class="uk-width-1-1@s">
                                <button type="submit" class="uk-button uk-button-primary uk-button-small">simpan</button>
                                <a href="#" class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #uploadFileModal">upload file</a>
                            </div>                                                     
                            <div class="uk-width-1-1@s">                                
                                <table id="mainTable" class="display" width="100%">
                                    <thead>
                                        <tr>   
                                            <th>File</th>                                                                                     
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>                                    
                                </table>
                            </div>                            
                        </div>
                    </div>                        
                </fieldset>
            </form>
        </div>
    </div>
    

    <div id="uploadFileModal" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Tambah File Baru
            </div>            
            <div class="uk-modal-body">
                <form action="{!! route('admin_file_store', ['id'=>  $indikator->realisasi->id]) !!}" method="post" enctype="multipart/form-data" class="uk-form-horizontal">
                    {{ csrf_field() }}     
                    <input type="hidden" name="id" value="{{ $indikator->id }}">               
                    <div class="uk-margin">
                        <label for="nama" class="uk-form-label">Nama file</label>
                        <div class="uk-form-controls">                            
                            <input type="text" name="nama" class="uk-input">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="upload" class="uk-form-label">Upload file</label>
                        <div class="uk-form-controls">                            
                            <input type="file" name="file">
                        </div>
                    </div>                              
                    <div class="uk-modal-footer uk-text-right">                
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                        <button class="uk-button uk-button-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mainTable').DataTable({                                      
                scrollY: '180px',
                scrollCollapse: true,
                paging: false,
                processing: true,
                ServerSide: true,
                ajax: '{!! route("ssp_file", ["id" => $indikator->realisasi->id]) !!}',    
                columns: [
                    {data: 'nama', value: 'nama', 'width':'80%'},
                    {data: 'action', value: 'action'}                        
                ]           
            });
        })
    </script>
@endpush