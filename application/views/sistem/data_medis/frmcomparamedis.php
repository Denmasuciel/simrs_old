<script type="text/javascript">
var url;
var save_method; //for save method string
var table;


function add_paramedis()
{
    save_method = 'add';
    var a ='<?php echo $maxnoparamedis; ?>';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('[name="paramedis_cd"]').val(a);
    $('.modal-title').text('Form Data Perawat'); // Set Title to Bootstrap modal title  
    document.getElementById("paramedis_cd").readOnly = true;

}

function edit_paramedis(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcomparamedis/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="paramedis_cd"]').val(data.paramedis_cd);
            $('[name="paramedis_nm"]').val(data.paramedis_nm);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Perawat'); // Set title to Bootstrap modal title
             document.getElementById("paramedis_cd").readOnly = true;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var perawat =$('#paramedis_cd').val();
        var nama =$('#paramedis_nm').val();
         
        
        if(perawat.length==0){
            alert("Maaf, Kode Perawat tidak boleh kosong");
            $('#paramedis_cd').focus();
            return false;
        }
        if(nama.length==0){
            alert("Maaf, Nama Perawat tidak boleh kosong");
           $('#paramedis_nm').focus();
            return false;
        }
         

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcomparamedis/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcomparamedis/ajax_update')?>";
        }
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
        if(data.status) //if success close modal and reload ajax table
        {
            $('#modal_form').modal('hide');
            $.messager.show({
                title: 'INFO',
                msg: 'Sukses simpan data',
                timeout:2000,
                showType:'slide',
                style:{
                    left:'',
                    right:0,
                    bottom:''
                }
            });
            reload_table();
        }
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        //alert('Error adding / update data');
        $.messager.show({
            title: 'ERROR',
            msg: 'gagal simpan data',
            timeout:2000,
            showType:'slide',
            style:{
                left:'',
                right:0,
                bottom:''
            }
        });         
        $('#btnSave').text('save'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        $('#modal_form').modal('hide');
        reload_table();
        }
        });
}

function delete_paramedis(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcomparamedis/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $.messager.show({
                            title: 'Info',
                            msg: 'Data berhasil dihapus',
                            timeout:2000,
                            showType:'slide',
                            style:{
                    left:'',
                    right:0,
                    bottom:''
                }
                        });
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
             $.messager.show({
                            title: 'ERROR',
                            msg: 'gagal hapus data',
                            timeout:2000,
                            showType:'slide',
                            style:{
                    left:'',
                    right:0,
                    bottom:''
                }
                        });
            reload_table();
            }
        });

    }
}

$(document).ready(function() {
        show_paramedis();
    });

function show_paramedis(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcomparamedis/ajax_list');?>",
                        "aoColumns": [
                            // { "mData": "no" },
                            { "mData": "paramedis_cd" },
                            { "mData": "paramedis_nm" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_paramedis();
}
</script>


<!-- /.page-header -->


<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_paramedis()"><i class="fa fa-plus"></i> ADD</button>
                    <button id="fres" class="btn btn-info btn-xs" title="Reload Data" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload Data</button>
                        <hr/>
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div>

                    <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header ">
                        <?php echo $data_table;?>                                        
                        </div>
                    <div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode Perawat</th>
                                <th>Nama Perawat</th>
                                <th>Aksi</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        
                    </table>
                </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Perawat</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">                        
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Perawat</label>
                           <div class="col-md-3">
                                <input type="text" name="paramedis_cd" id="paramedis_cd" placeholder=" " class="form-control text-uppercase">
                               </div>
                        </div>       

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Perawat</label>
                           <div class="col-md-9">
                                <input type="text" name="paramedis_nm" id="paramedis_nm" placeholder=" " class="form-control">
                            </div>
                        </div>     

                          
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onClick="save()" class="btn btn-white btn-default btn-round"><i class="ace-icon fa fa-floppy-o red"></i>Save</button>
                <button type="button" class="btn btn-white btn-default btn-round" data-dismiss="modal"><i class="ace-icon fa fa-times red2"></i>Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!-- <?php echo $maxnoparamedis;?> -->