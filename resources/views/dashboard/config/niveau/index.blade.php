@extends('dashboard.layouts.inc')
@section('title')
    DASHBOARD
@endsection
@section('title1')
    NIVEAUX
@endsection
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header bg-orange">
            <h2>
                Paramètres de configuration <small>Niveaux</small>
            </h2>
        </div>
        <div class="body">
            <button type="button" data-color="black" class="btn bg-black waves-effect waves-light" data-toggle="modal" data-target="#mdModal">BLACK</button>
        </div>
    </div>

    <div class="row clearfix" id="data">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <div class="body">
                    <div class="table-responsive">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 140px;">N°</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 233px;">Libelle</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Section</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Details</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>CP1</td>
                                        <td>Primaire</td>
                                        <td><a href="" class="btn btn-xs bg-primary"><span class="material-icons">visibility</span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn-sm bg-amber" id="reload"><i class="material-icons">loop</i></button>
                </div>

            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="mdModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-cyan">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Ajouter un niveau d'étude</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="msg_div" style="display: none">
                    <strong id="msg_success"></strong>
                </div>
                <form id="form_niv" method="POST" data-route="{{ route('niveaux.store') }}">
                    @csrf
                    <label for="email_address">Libellé du niveau</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="libelleNiv" class="form-control" placeholder="Entrer le libelle du niveau (CP1, Sixième ,2nd, etc...) ">
                        </div>
                        <span class="text-danger" id="error_libelle"></span>
                    </div>
                    <button type="submit" id="btn_submit" class="btn btn-primary m-t-15 waves-effect" disabled>Ajouter</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Retour</button>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {


        $('#cancel').on('click',function () {
            $('#data').show();
            $('#addClasse').hide();
        });

        function check_nom() {
            var nom = $('#libelleNiv').val();
            if (nom !== '' && nom.length >0) {
                console.log("correct");
                $('#error_libelle').hide();
                $('#btn_submit').removeAttr("disabled");
                return 1;
            } else {
                console.log("incorrecte");
                $('#error_libelle').show();
                $('#error_libelle').html("Ce champ est obligatoire, veuillez saisir le libellé du niveau");
                $('#btn_submit').attr("disabled","disabled");
                return 0;
            }
        }



        $('#libelleNiv').focusout(function () {
            check_nom();
        });

        $('#btn_submit').on('click',function () {
            check_nom();
        });

        $('#form_niv').submit(function (e) {
            e.preventDefault();
            //alert('classe ajoutée');
            var route = $(this).data('route');
            var form_data = $(this).serialize();
            console.log(form_data);

            $.ajax({
                type: "POST",
                url: route,
                data: form_data,
                dataType: "Json",
                success: function (response) {
                    if (response.success) {
                        $('#msg_success').append(response.success);
                        $('#msg_div').show();
                    }
                    document.getElementById("form_niv").reset();
                    setTimeout(function(){
                        $('#msg_div').hide();
                        $('#msg_success').hide();
                    },10000);
                }
            });
        });
    });
</script>

@endsection
