@extends('app')

@push('css')
    <link rel="stylesheet" href="https:cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header uk-text-center">Peningkatan</div>
            <div class="uk-card-body">                
                <form action="#" class="uk-form-horizontal uk-margin-large">
                    <div class="uk-margin">
                        <label for="show indikator" class="uk-form-label">Indikator yang dapat ditingkatkan :</label>
                        <div class="uk-form-controls">
                            <label for="jumlah indikator" class="uk-form-label">{{ $realisasi->count() }} indikator dari {{ $all_indikator }} yang ada</label>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="show indikator" class="uk-form-label">Peningkatan dari tahun sebelumnya :</label>
                        <div class="uk-form-controls">
                            <label for="jumlah indikator" class="uk-form-label">NaN %</label>
                        </div>
                    </div>                   
                </form>                                                            
                <table class="display" id="mainTable">
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($realisasi as $i)
                            <tr>
                                <td>{{ $i->indikator->indikator }}</td>
                                @if($i->peningkatan->file)
                                    <td><a href="{{ asset('storage/'. $i->peningkatan->file) }}" class="uk-button uk-button-primary uk-button-small"><span uk-icon="file-text"></span></a></td>
                                @else
                                    <td><a href="#" data-id="{{ $i->id }}" class="uk-button uk-button-primary uk-button-small get" uk-toggle="target: #mainModal"><span uk-icon="file-text"></span></a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>{{--
                <div class="uk-margin">                    
                    <button class="uk-button uk-button-primary uk-form-small" uk-toggle="target: #mainModal">Tambah file pendukung</button>
                </div>  
            </div>--}}
        </div>
    </div>

    <div id="mainModal" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-margin-auto-vertical">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header uk-text-center">Tambah File pendukung</div>            
            <form action="{{ route('admin_peningkatan_store') }}" class="uk-form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_indikator" id="id_indikator">
                <div class="uk-modal-body">
                    <div class="uk-margin">
                        <label for="Nama File" class="uk-form-label">Nama File</label>
                        <div class="uk-form-controls">
                            <input type="text" name="nama_file" class="uk-input">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label for="Nama File" class="uk-form-label">Input file</label>
                        <div class="uk-form-controls">
                            <div uk-form-custom>
                                <input type="file" name="file[]" aria-label="Custom controls" multiple>
                                <span uk-icon="cloud-upload"></span> Upload
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button type="submit" class="uk-button uk-button-primary uk-button-small">Submit</button>
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
            $('table#mainTable').DataTable();
            $('a.get').on('click', function() {
                var id = $(this).attr('data-id');                
                document.getElementById('id_indikator').value = id;
            });  
        })        
    </script>
@endpush