<script type="text/javascript">
var url;
var save_method; //for save method string
var table;

$(document).ready(function() {  
$('.date-picker').datepicker({
autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
});     

function add_spesialis()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Spesialis'); // Set Title to Bootstrap modal title  
    document.getElementById("spesialis_cd").readOnly = false;
}

function edit_spesialis(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcomspesialis/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="spesialis_cd"]').val(data.spesialis_cd);
            $('[name="spesialis_nm"]').val(data.spesialis_nm);
            $('[name="data_mapcd"]').val(data.data_mapcd);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Spesialis'); // Set title to Bootstrap modal title
             document.getElementById("spesialis_cd").readOnly = true;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var spesialis =$('#spesialis_cd').val();
        var nama =$('#spesialis_nm').val();
        var map =$('#data_mapcd').val();
             
        
        
        if(spesialis.length==0){
            alert("Maaf, Kode Spesialis tidak boleh kosong");
            $('#spesialis_cd').focus();
            return false;
        }
        if(nama.length==0){
            alert("Maaf, Nama spesialis Mulai tidak boleh kosong");
           $('#spesialis_nm').focus();
            return false;
        }
         

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcomspesialis/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcomspesialis/ajax_update')?>";
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

function delete_spesialis(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcomspesialis/ajax_delete')?>/"+id,
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
        show_spesialis();
    });

function show_spesialis(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcomspesialis/ajax_list');?>",
                        "aoColumns": [
                            // { "mData": "no" },
                            { "mData": "spesialis_cd" },
                            { "mData": "spesialis_nm" },
                            { "mData": "data_mapcd" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_spesialis();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_spesialis()"><i class="fa fa-plus"></i> ADD</button>
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
                                <th>KODE SPESIALIS</th>
                                <th>NAMA SPESIALIS</th>
                                <th>KODE BPJS</th>  
                                <th>AKSI</th>                                
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
                <h3 class="modal-title">Form Spesialis</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">                        
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Spesialis</label>
                           <div class="col-md-3">
                                <input type="text" name="spesialis_cd" id="spesialis_cd" placeholder=" " class="form-control text-uppercase">
                            </div>
                        </div>       

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Spesialis</label>
                           <div class="col-md-9">
                                <input type="text" name="spesialis_nm" id="spesialis_nm" placeholder=" " class="form-control text-uppercase">
                            </div>
                        </div>     

                        <div class="form-group">
                            <label class="control-label col-md-3">Kode BPJS</label>
                           <div class="col-md-3">
                                <input type="text" name="data_mapcd" id="data_mapcd" placeholder=" " class="form-control">
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
