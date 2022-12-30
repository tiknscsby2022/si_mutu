@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')       
    <div class="uk-width-expand@s">    
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">Penetapan</div>
            @if($errors->any())
                <div class="uk-overlay uk-overlay-default uk-position-top-right">
                    <div class="uk-alert-warning" uk-alert>          
                        <a class="uk-alert-close" uk-close></a>                             
                        @foreach ($errors->all() as $error)
                            <div class="uk-text-meta">{{ $error }}</div>
                        @endforeach
                    </div>
                </div>                
            @endif
            <div class="uk-card-body">
                <table id="tableAspek" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Aspek</th>                           
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>                         
                </table>
                <a href="#add_new_aspek" onClick="" class="uk-button uk-button-primary" uk-toggle>Aspek Baru</a>
                <a href="#add_new_standar" class="uk-button uk-button-primary" uk-toggle>Standar Baru</a>                                
            </div>            
        </div>
    </div>

    <!-- 
        =========================================================================================
        ======================================= MODAL ===========================================
        ========================================================================================= 
                                                                                                -->
    <div id="add_new_aspek" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Tambah Aspek Baru
            </div>
            <form action="{{ route('admin_penetapan_aspek_store') }}" method="post" class="uk-form-horizontal">
            <div class="uk-modal-body">                
                    {{ csrf_field() }}
                    <div class="uk-margin">
                        <label for="Nama Aspek" class="uk-form-label">Aspek Baru </label>
                        <div class="uk-form-controls">
                            <input type="text" name="aspek" class="uk-input" placeholder="Masukkan aspek baru ...">
                        </div>
                    </div>                
            </div>
            <div class="uk-modal-footer uk-text-right">                
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
    
    <div id="add_new_standar" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Tambah Standar Baru
            </div>
            <form action="{{ route('admin_penetapan_standar_store') }}" method="post" class="uk-form-horizontal" enctype="multipart/form-data">
            <div class="uk-modal-body">                
                {{ csrf_field() }}
                <div class="uk-margin">
                    <label for="Nama Standar" class="uk-form-label">Standar Baru </label>
                    <div class="uk-form-controls">
                        <input type="text" name="standar" class="uk-input" placeholder="Masukkan standar baru ...">
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="Aspek" class="uk-form-label">Aspek</label>
                    <div class="uk-form-controls">
                        <select name="id_aspek" class="uk-select">
                            @foreach($aspek as $i)
                                <option value="{{ $i->id }}">{{ $i->aspek }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                
                <div class="uk-margin">
                    <label for="file" class="uk-form-label">File pendukung</label>
                    <div class="uk-form-controls">
                        <div uk-form-custom="target: true">
                            <input type="file" name="file_tautan" aria-label="Custom controls">
                            <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" aria-label="Custom controls" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="submit">Save</button>
            </div>
            </form>
        </div>
        
    </div>

    <div id="edit_aspek" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Edit aspek yang dipilih
            </div>
            <form method="POST" id="form_edit_aspek">
                {{ csrf_field() }}
                @method('PUT')
                <div class="uk-modal-body">
                    <div class="uk-margin">
                        <label for="Nama Standar" class="uk-form-label">Aspek</label>
                        <div class="uk-form-controls">
                            <input type="text" name="standar" class="uk-input" id="standar" placeholder="Edit aspek ...">
                        </div>
                    </div>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div id="show_standar" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Standar yang termasuk
            </div>
            <form method="POST">                
                <div class="uk-modal-body">   
                    <table class="display" id="tableStandar" style="width:100%">
                        <thead>
                            <tr>
                                <th>Standar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>                 
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    {{-- <button class="uk-button uk-button-primary" type="submit">Update</button> --}}
                </div>
            </form>
        </div>
    </div>    
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tableAspek').DataTable({
                processing: true,
                ServerSide: true,
                ajax: '{!! route("ssp_aspek") !!}',
                columns: [
                    {data: 'aspek', name: 'aspek'},
                    {data: 'standars', name: 'standars.id',
                          render: function(data, type){
                                let count = data.length;
                                return "Terdeteksi : "+ count + " standar";
                          }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });     

            $('.edit').on('click', function(){
                var id = $(this).attr('data-id');                
                tampilDataAspek(id);                
            });                                 
        });    

        function show(clicked_id) {   
            var id = clicked_id;
            $('#tableStandar').DataTable().destroy();
            tampilDataStandar(id);
        }  

        function tampilDataAspek(id) {
            $.ajax({
                url: "/penetapan/aspek/"+id+"/update",
                    type: 'GET',                          
                    dataType: "json",
                    success: function (data) {                         
                        $('#form_edit_aspek').attr('action', '/penetapan/aspek/'+id+'/edit');                    
                        $('#standar').val(data['aspek']);                       
                    },                    
            });            
        }

        function tampilDataStandar(id) {            
            $('#tableStandar').DataTable({                                     
                processing: true,
                ServerSide: true,
                ajax: '/ssp/standar/'+id,  
                columns:[
                    {data: 'standar', name: 'standar'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]                     
            });
        }
        
    </script>
@endpush