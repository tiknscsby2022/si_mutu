@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">   
            <div class="uk-card-header uk-text-center">
                Realisasi
            </div>
            <div class="uk-card-body">
                <table id="mainTable" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>PIC</th>                           
                            <th>Aksi</th>
                            <th>Keterangan</th>                                                                                  
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="modal_data_realisasi" uk-modal>
        <div class="uk-modal-dialog">
            <div class="uk-modal-header uk-text-center">                
                <div id="title"></div>
            </div>
            <div class="uk-modal-body">
                <table id="modalTable" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>Indikator</th>
                            <th>Realisasi</th>                            
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mainTable').DataTable({
                lengthMenu: [4, 8],
                processing: true,
                serverSide: true,
                ajax: '{!! route("ssp_role") !!}',
                columns: [
                    {data: 'role', 'width': '20%'},                    
                    {data: 'aksi'},
                    {data: 'info', 'width': '65%'}                   
                ]           
            })
        })
    </script>
@endpush