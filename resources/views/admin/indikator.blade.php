@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')    
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">
                Penetapan
                <span class="uk-text-buttom">{{ $standar->standar }}</span>
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
            </div>
            <div class="uk-card-body">
                <table id="" class="display" style="width=100%">
                    <thead>
                        <tr>
                            <th>Indikator</th>
                            <th>Value</th>                            
                            <th>PIC</th>                            
                            <th>Aksi</th>
                        </tr>                                                                 
                    <tbody>
                        @foreach($standar->indikator as $i)                       
                            <tr>
                                <td>{{ $i->indikator }}</td>
                                <td>{{ $i->value }}</td>
                                <td>{{ $i->pic }}</td>
                                <td>
                                    <a href="#edit_indikator" class="uk-button uk-button-primary uk-button-small edit" data-id="{{ $i->id }}" uk-toggle><span uk-icon="file-edit"></span></a>
                                    <a href="{{ route('admin_penetapan_indikator_destroy', ['id' => $i->id]) }}" class="uk-button uk-button-danger uk-button-small"><span uk-icon="trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>    
                <a href="#add_new_indikator" class="uk-button uk-button-primary" uk-toggle>Indikator Baru</a>            
                <a href="#cek_status_standar" class="uk-button uk-button-primary" uk-toggle>Cek Standar</a>            
            </div>            
        </div>
    </div>

    <!-- 
        =========================================================================================
        ======================================= MODAL ===========================================
        ========================================================================================= 
                                                                                                -->
        <div id="add_new_indikator" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Tambah Indikator Baru
            </div>
            <form action="{{ route('admin_penetapan_indikator_store', ['id' => $standar->id]) }}" method="post" class="uk-form-horizontal" enctype="multipart/form-data">
            <div class="uk-modal-body">                
                    {{ csrf_field() }}
                    <div class="uk-margin">
                        <label for="Nama Indikator" class="uk-form-label">Indikator</label>
                        <div class="uk-form-controls">
                            <input type="text" name="indikator" class="uk-input" placeholder="Masukkan indikator ...">
                        </div>
                    </div>          
                    <div class="uk-margin">
                        <label for="ketetapan" class="uk-form-label">Ketetapan</label>
                        <div class="uk-form-controls">
                            <input type="text" name="ketetapan" class="uk-input" placeholder="Masukkan ketetapan ...">
                        </div>
                    </div>                    
                    <div class="uk-margin">
                        <label for="ketetapan" class="uk-form-label">PIC</label>
                        <div class="uk-form-controls">  
                            <ul class="uk-list uk-list-collapse">
                            @foreach($pics as $pic)
                                <!--li--><label for="role {{ $pic }}"><input type="checkbox" class="uk-checkbox" name="pic[]" value={{ $pic }}> {{ $pic }}</label><!--/li-->
                            @endforeach
                            </ul>                                                      
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
        
        <div id="edit_indikator" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Edit Indikator
            </div>
            <form id="formIndikator" class="uk-form-horizontal">
            <div class="uk-modal-body">                
                    {{ csrf_field() }}
                    {{ method_field('put') }}     
                    <input type="hidden" name="id" value="{{ $id }}">          
                    <div class="uk-margin">
                        <label for="Nama Indikator" class="uk-form-label">Indikator</label>
                        <div class="uk-form-controls">
                            <input type="text" id="inputIndikator" name="indikator" class="uk-input" placeholder="Masukkan indikator ...">
                        </div>
                    </div>          
                    <div class="uk-margin">
                        <label for="ketetapan" class="uk-form-label">Ketetapan</label>
                        <div class="uk-form-controls">
                            <input type="text" id="inputKetetapan" name="ketetapan" class="uk-input" placeholder="Masukkan ketetapan ...">
                        </div>
                    </div>  
                    <div class="uk-margin">
                        <label for="ketetapan" class="uk-form-label">PIC</label>
                        <div class="uk-form-controls">                                                                                                                                                                                                                   
                            <input type="text" id="inputPIC" name="old_pic[]" class="uk-input" disabled>                         
                                @foreach($pics as $pic)
                                    <input type="checkbox" name="pic[]" class="uk-checkbox" value="{{ $pic }}"><label> {{ $pic }}</label>
                                @endforeach                            
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

        <div id="cek_status_standar" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header">
                Status standar
            </div>
            <form action="/penetapan/standar/{{ $standar->id }}/update" method="POST" class="uk-form-horizontal" enctype="multipart/form-data">
            <div class="uk-modal-body">                
                {{ csrf_field() }}
                @method('PUT')
                <div class="uk-margin">
                    <label for="Nama Standar" class="uk-form-label">Standar</label>
                    <div class="uk-form-controls">
                        <input type="text" name="standar" class="uk-input" value="{{ $standar->standar }}" placeholder="Masukkan nama baru ...">
                    </div>
                </div>
                <div class="uk-margin">
                    <label for="File Standar" class="uk-form-label">File Standar</label>
                    <div class="uk-form-controls">                          
                    {{-- Ini ada di folder storage/app/public/document --}}
                    {{-- tapi nulisnya ngga pake app/public langsung ke document --}}                                                                                    
                    <input type="button" value="Cek File" class="uk-button uk-button-primary" onclick="parent.open('{{ asset('storage/'.$standar->file_tautan) }}')">
                        <div uk-form-custom="target: true">                                                                
                            <input name="file_tautan" type="file" aria-label="Custom controls">
                            <input class="uk-input uk-form-width-medium" type="text" placeholder="Update File" aria-label="Custom controls" disabled>
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

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function (){
            $('table.display').DataTable();
            $('.edit').on('click', function() {
                var id = $(this).attr('data-id');                
                loadIndikator(id);
            });            
        });    

        function loadIndikator(id){               
            $.ajax({
                url: '/penetapan/indikator/'+id+'/edit',
                method: 'GET',        
                dataType: "json",                             
                success: function(data) {                                        
                    document.getElementById("inputIndikator").value = data.indikator;
                    document.getElementById("inputKetetapan").value = data.value;
                    document.getElementById("inputPIC").value = data.pic;   
                    let form = document.getElementById("formIndikator");
                    form.action = "/penetapan/indikator/"+data.id+"/update";
                    form.method = 'post';
                },
            });
        }

        
    </script>
@endpush