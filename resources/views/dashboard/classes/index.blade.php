@extends('dashboard.layouts.inc')
@section('title')
    DASHBOARD
@endsection
@section('title1')
    GESTION DES CLASSES
@endsection
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header bg-orange">
            <h2>
                Gestion classes <small>Liste des classes</small>
            </h2>
            <ul class="header-dropdown m-r--5">

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="body">
            <button id="btn_addClasse" class="btn btn-sm bg-amber"><span class="material-icons"></span>Ajouter classe</button>
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
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 233px;">Libellé</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Niveau</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Section</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 104px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>6eme A</td>
                                        <td>Sixième</td>
                                        <td>College</td>
                                        <td></td>
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

    <div class="row clearfix" id="addClasse" style="display: none">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h4 class="text-center">Ajouter une nouvelle classe</h4>
                </div>
                <div class="body">

                    <button class="btn btn-sm bg-amber" id="cancel"><i class="material-icons">cancel</i>Retour</button>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="mdModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-cyan">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Ajouter une nouvelle classe</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="msg_div" style="display: none">
                    <strong id="msg_success"></strong>
                </div>
                <form id="form_classe" method="POST" data-route="{{ route('classes.store') }}">
                    @csrf
                    <label for="email_address">Libelle de la classe</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="libelle" class="form-control" placeholder="Entrer le libellé de la classe">
                        </div>
                    </div>
                    <label for="password">Niveau</label>
                    <div class="form-group">
                        <select name="niveau_id" id="niveau_id" class="form-control">
                            <option value="">Sixième</option>
                            <option value="">Cinquième</option>
                            <option value="">Quatrième</option>
                            <option value="">Troisième</option>
                        </select>
                    </div>


                    <button type="submit" id="btn_submit" class="btn btn-primary m-t-15 waves-effect">Ajouter</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#reload').on('click',function () {
            setInterval(function () {
            $('#data').load().fadeIn("slow");
            console.log("load page");
            },1000);
        });

        $('#btn_addClasse').on('click',function () {
            $('#data').hide();
            $('#addClasse').show();
        });
        $('#cancel').on('click',function () {
            $('#data').show();
            $('#addClasse').hide();
        });

        $('#btn_submit').on('click',function () {

        });

        $('#form_classe').submit(function (e) {
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
                        $('#msg_div').show();
                        $('#msg_success').append(response.success);
                    }
                    document.getElementById("form_classe").reset();
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
