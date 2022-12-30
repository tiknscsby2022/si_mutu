 @extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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
                            <th>Departemen</th>
                            <th>Tidak Memenuhi</th>
                            <th>Hampir Memenuhi</th>
                            <th>Telah Memenuhi</th>
                            <th>Melebihi Standar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
 @endsection

 @push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#mainTable').DataTable({
                lengthMenu: [6,16],  
                processing: true,
                ServerSide: true,
                ajax: '{!! route('ssp_temuan') !!}',
                columns: [                    
                    {data: 'role'},
                    {data: 'lv1', className: 'dt-body-center'},
                    {data: 'lv2', className: 'dt-body-center'},
                    {data: 'lv3', className: 'dt-body-center'},
                    {data: 'lv4', className: 'dt-body-center'},
                ]
            });            
        })    
    </script>
@endpush