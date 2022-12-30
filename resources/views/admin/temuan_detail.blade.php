 @extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">    
    <link rel="stylesheet" href="https://simditor.tower.im/assets/styles/simditor.css">
    <script type="text/javascript" src="https://simditor.tower.im/assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="https://simditor.tower.im/assets/scripts/mobilecheck.js"></script>
@endpush

 @section('content')
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">   
            <div class="uk-card-header uk-text-center">
                Temuan & Rekomendasi
            </div>            
            <div class="uk-card-body">
                <table class="display" id="mainTable" width="100%">
                    <thead>
                        <tr>
                            <th>Indikator</th>
                            <th>SN Dikti</th>
                            <th>Realisasi</th>                            
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="mainModal" class="uk-flex-top" uk-modal="bg-close: false">
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <div class="uk-modal-header uk-text-center"><div id="indikator" class="uk-text-uppercase"></div></div>
            <form action="{!! route('admin_temuan_store') !!}" class="uk-form-horizontal" method="post">
                <div class="uk-modal-body" uk-overflow-auto>
                    <div class="uk-margin">
                        <label for="Indikator" class="uk-form-label">SN Dikti: </label>
                        <div class="uk-form-controls">
                            <input id="sn_dikti" type="text" class="uk-input" disabled>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="realisasi" class="uk-form-label">Realisasi: </label>
                        <div class="uk-form-controls">
                            <input id="realisasi" type="text" class="uk-input" disabled>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="kendala" class="uk-form-label">Kendala: </label>
                        <div class="uk-form-controls">
                            <textarea id="kendala" class="uk-textarea" disabled></textarea>
                        </div>
                    </div>                    
                   <div class="uk-margin">
                        <div class="uk-width-1-1">
                        <input type="hidden" name="id_for_redirect" value="{{ $id }}">
                        <input type="hidden" name="pic_for_redirect" value="{{ $pic }}">
                        <input type="hidden" name="cek_realisasi" id="cek_realisasi">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_realisasi" name="id">
                            <textarea name="rekomendasi" class="uk-textarea" rows="5" id="editor" placeholder="Masukkan rekomendasi"></textarea>                   
                        </div> 
                   </div>                                                        
                </div>
                <div class="uk-modal-footer">                    
                    <a id="detail" href="#" class="uk-button uk-button-primary uk-text-right"> Detail</a>                                        
                    <button type="submit" class="uk-button uk-button-primary">Save</button>
                    <button onclick="destroyAjax()" class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>                    
                </div>
            </form>
        </div>
     </div>    
 @endsection

 @push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>    
    {{-- Simditor --}}
    <script src="https://simditor.tower.im/assets/scripts/module.js"></script>
    <script src="https://simditor.tower.im/assets/scripts/uploader.js"></script>
    <script src="https://simditor.tower.im/assets/scripts/hotkeys.js"></script>
    <script src="https://simditor.tower.im/assets/scripts/simditor.js"></script>    
    <script src="https://simditor.tower.im/assets/scripts/page-demo.js"></script>    
    <script>        
        $(document).ready(function(){
            $('#mainTable').DataTable({
                lengthMenu: [6,16],  
                processing: true,
                ServerSide: true,            
                ajax: '/ssp/temuan/{{ $pic }}/detail/{{ $id }}',
                columns:[
                    {data: 'indikator.indikator'},
                    {data: 'sn_dikti.value'},
                    {data: 'value'},
                    {data: 'aksi'}
                ]
            });                       
        })            

        function loadRealisasi(id){
            id = id;
            Realisasi(id);
        }

        function destroyAjax(){
            location.reload(true);
        }

        function Realisasi(id){               
            $.ajax({
                url: '/temuan/'+id,
                method: 'GET',        
                dataType: "json",                             
                success: function(data) {                                        
                    document.getElementById("indikator").textContent = data.indikator.indikator;
                    document.getElementById("sn_dikti").value = data.indikator.value;
                    document.getElementById("realisasi").value = data.realisasi.value;
                    document.getElementById("kendala").value = data.realisasi.alasan;
                    document.getElementById("id_realisasi").value = data.realisasi.id;
                    document.getElementById("editor").value = data.rekomendasi;    
                    document.getElementById("cek_realisasi").value = data.realisasi.id;  
                    document.getElementById("detail").href = '/realisasi/departemen/'+data.realisasi.id+'/show';
                                     
                    new Simditor({            
                        textarea: $('#editor'),                       
                        upload: false, 
                        toolbar: ['title', 'bold', 'italic', 'underline', 'fontScale', 'color', 'ol', 'ul', 'blockquote', 'table', 'indent', 'outdent', 'alignment']                
                    });        
                },
            });
        }       
    </script>
@endpush