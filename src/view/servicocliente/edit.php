<?php
//Conexão
include_once '../../model/db_connect.php';
//Header
include_once '../../view/includes/header.php';

    if(isset($_GET['user'])) {
        $idusuario = $_GET['user'];
    }

    if(isset($_GET['id'])) {
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM SERVICOCLIENTE WHERE IDSERVICOCLIENTE = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>
<link type="text/css" rel="stylesheet" href="stylecard.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="display: flex; justify-content: center; width: auto;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Serviço Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="../../model/dao/servicocliente/update.php" method="POST" id="quickForm">
                        <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                        <input type="hidden" name="idcliente" value="<?php echo $dados['IDCLIENTE']; ?>">
                        <input type="hidden" name="id" value="<?php echo $dados['IDSERVICOCLIENTE']; ?>">

                            <div class="form-group">
                                <label for="serviceclientlist">Selecione o Sistema: </label>
                                <select class="form-control custom-select" name="serviceclientlist">
                                    <?php
                                        $sql="SELECT * FROM SERVICO";
                                        $res=mysqli_query($connect, $sql);
                                        $idsistema = $dados['IDSERVICO'];
                                        while ($posicao=mysqli_fetch_row($res)):
                                            $vnome=$posicao[1];
                                            $vid=$posicao[0];   
                                            $selected = ($vid == $idsistema) ? "selected='selected'" : "";
                                            echo "<option value='$vid'$selected>$vnome</option>";
                                        endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estadolist">Estado: </label>
                                <select class="form-control custom-select" name="estadolist">
                                    <option value="Ativo" <?=($dados['ESTADO'] == 'ATIVO')?'selected':''?> >Ativo</option>
                                    <option value="Inativo" <?=($dados['ESTADO'] == 'INATIVO')?'selected':''?> >Inativo</option>
                                </select>
                            </div>  
                            <div class="row">
                                <div class="col-12">
                                    <a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>" class="btn btn-secondary">Voltar</a>
                                    <a href="../servicoclienteview/view.php?user=<?php echo $idusuario; ?>&id=<?php echo $id; ?>" class="btn btn-info">Ver Serviço</a>
                                    <input type="submit" value="Salvar" class="btn btn-success float-right" name="btn-editar-servicocliente">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
<!-- jquery-validation -->
<script src="../../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#quickForm').validate({
        rules: {
            servicelist: {
                required: true
            },
        
        },
        messages: {
            servicelist: {
                required: "O campo Sistema é obrigatório!",

            },      
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
<?php
//Footer
include_once '../../view/includes/footer.php';
?>