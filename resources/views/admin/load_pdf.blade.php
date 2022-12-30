<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Dokumen Temuan dan Rekomendasi</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.17/dist/css/uikit.min.css" />
</head>
<body>    
    <table class="uk-table">
        <thead>
            <tr>                
                <th>Indikator</th>                
                <th>Realisasi</th>
                <th>Kendala</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($temuan_rekomendasis as $i)                
                <tr>                    
                    <td>{{ $i->indikator->indikator }}</td>
                    <td>{{ $i->value }}</td>                    
                    <td>{{ $i->alasan }}</td>
                    <td>{{ strip_tags($i->rekomendasi->rekomendasi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.17/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.17/dist/js/uikit-icons.min.js"></script>
</body>
</html>