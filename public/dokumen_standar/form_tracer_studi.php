<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracer Studi | Politeknik NSC Surabaya</title>
    
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/css/uikit.min.css" />

</head>
<body>
    
    <div id="cek-nim" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Cek NIM </h2>
                <form action="<?= base_url('pendaftaran/tracer-study/get-nim');?>" methode="post">
                    <div class="uk-margin">
                        <input name='nim' class="uk-input" type="text" placeholder="Masukkan NIM . . .">
                    </div>
                </form>
            <p class="uk-text-right">
                <button class="uk-button uk-button-primary" type="button">cek</button>
            </p>
        </div>
    </div>
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.10/dist/js/uikit-icons.min.js"></script>
    
    
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        $(window).on('load', function() {
            UIkit.modal('#cek-nim').show();
        });
    </script>
    
    
</body>
</html>