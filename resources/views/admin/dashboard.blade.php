@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')    
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">DASHBOARD</div>            
            <div class="uk-card-body">                                
                <table class="display" id="mainTable">
                    <thead>
                        <tr>
                            <td>Nama dokumen</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($file as $i)
                            <tr>
                                <td>{{$i->name}}</td>
                                <td>
                                    <a href="{{ asset('storage/'.$i->file) }}" class="uk-button uk-button-primary uk-button-small"><span uk-icon="info"></span></a>                                    
                                </td>                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="uk-button uk-button-primary uk-button-small" uk-toggle="target: #mainModal">Upload</button>
            </div>
        </div>
    </div>
    <div id="mainModal" class="uk-flex-top" uk-modal>        
       <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-body">
                <form action="{{ route('admin_beranda_store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="uk-margin">
                        <label for="name" class="uk-lable">Nama File</label>
                        <div class="uk-form-controls">
                            <input type="text" name="name" class="uk-input">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="name" class="uk-lable">File</label>
                        <div class="uk-form-controls">
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <button class="uk-button uk-button-primary">Simpan</button>
                    </div>
                </form>
            </div>
       </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table#mainTable').DataTable();
        })
    </script>
@endpush