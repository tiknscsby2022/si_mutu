@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')    
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">
                Realisasi
                <span class="uk-text-buttom">Departemen {{ $name }}</span>
            </div>
            <div class="uk-card-body">
                <table id="mainTable" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Indikator</th>                                                     
                            <th>SN Dikti</th>                                                     
                            <th>Realisasi</th>
                            <th>Info</th>                                                     
                            <th>Aksi</th>                                                     
                        </tr> 
                    </thead>                                                                                    
                </table>              
            </div>            
        </div>
    </div>

    <div id="add_new_realisasi" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Tambah Realisasi
            </div>            
            <div class="uk-modal-body">
                <form enctype="multipart/form-data" class="uk-form-horizontal" id="formRealisasi">
                    {{ csrf_field() }}
                    <input type="hidden" name="pic" value="{{ $name }}">
                    <div class="uk-margin">
                        <label for="Nama Indikator" class="uk-form-label">Indikator</label>
                        <div class="uk-form-controls">
                            <input type="text" id="inputIndikator" name="indikator" class="uk-input uk-form-width-medium" disabled>
                            <input type="text" id="inputValue" class="uk-input uk-width-1-3" disabled>
                        </div>
                    </div>          
                    <div class="uk-margin">
                        <label for="Realisasi" class="uk-form-label">Realisasi</label>
                        <div class="uk-form-controls">
                            <input type="text" name="realisasi" class="uk-input" placeholder="Masukkan realisasi ..." required>
                        </div>
                    </div>  
                    <div class="uk-margin">
                        <label for="Realisasi" class="uk-form-label">Kendala</label>
                        <div class="uk-form-controls">
                            <input type="text" name="alasan" class="uk-input" placeholder="Jika tidak memenuhi standar ...">
                        </div>
                    </div>                        
                    <div class="uk-margin">
                        <label for="Kesesuaian" class="uk-form-label">Realisasi sesuai ketetapan</label>
                        <div class="uk-form-controls">                            
                            <input name="kesesuaian" id="range" class="uk-range uk-width-1-1" type="range" min="0" max="3" step="1" oninput="getKesesuaian(this.value)" onchange="getKesesuaian(this.value)" required>
                            <p class="uk-width-1-1"><span class="uk-badge" id="rangeValue">Prakiraan</span></p>
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
        $(document).ready(function(){
            $('#mainTable').DataTable({                                
                processing: true,
                ServerSide: true,
                ajax: '{!! route("ssp_realisasi", ["name" => $name]) !!}',
                columns:[        
                    {data: 'indikator', name: 'indikator'},  
                    {data: 'value', name: 'value'},      
                    {data: 'realisasi.0.value', name: 'realisasi'},                         
                    {data: 'keterangan', name: 'keterangan'},
                    {data: 'action', name: 'action'}
                ]                          
            });
        })

        function getKesesuaian(newVal){
            var status = '';
            if (newVal == 0){
                status = 'Tidak memenuhi standar';
                document.getElementById('rangeValue').innerHTML = status;
                document.getElementById('rangeValue').className = 'uk-badge uk-label-danger';

            }
            else if (newVal == 1){
                status = 'Hampir memenuhi standar';
                document.getElementById('rangeValue').innerHTML = status;
                document.getElementById('rangeValue').className = 'uk-badge uk-label-warning';
            }
            else if (newVal == 2){
                status = 'Telah memenuhi standar';
                document.getElementById('rangeValue').innerHTML = status;
                document.getElementById('rangeValue').className = 'uk-badge uk-label-success';
            }
            else {
                status = 'Telah melebihi standar';
                document.getElementById('rangeValue').innerHTML = status;
                document.getElementById('rangeValue').className = 'uk-badge uk-label-primary';
            }                 
        }

        function addRealisasi(clicked_id){
            id = clicked_id;
            $.ajax({
                url: '/realisasi/'+id+'/get_relasi',
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    document.getElementById('inputIndikator').value = data.indikator;
                    document.getElementById('inputValue').value = data.value;
                    let form = document.getElementById("formRealisasi");
                    form.action = "/realisasi/"+data.id+"/store";
                    form.method = 'post';
                }
            });
        }
    </script>    
@endpush