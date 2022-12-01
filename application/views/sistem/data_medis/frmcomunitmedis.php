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

function add_poliklinik()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Poliklinik'); // Set Title to Bootstrap modal title  
    document.getElementById("medunit_cd").readOnly = false;
}

function edit_poliklinik(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcomunitmedis/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="medunit_cd"]').val(data.medunit_cd);
            $('[name="medunit_nm"]').val(data.medunit_nm);
            $('[name="data_mapcd"]').val(data.data_mapcd);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Poliklinik'); // Set title to Bootstrap modal title
             document.getElementById("medunit_cd").readOnly = true;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var spesialis =$('#medunit_cd').val();
        var nama =$('#medunit_nm').val();
        var map =$('#data_mapcd').val();
             
        
        
        if(spesialis.length==0){
            alert("Maaf, Kode Poliklinik tidak boleh kosong");
            $('#medunit_cd').focus();
            return false;
        }
        if(nama.length==0){
            alert("Maaf, Nama Poliklinik tidak boleh kosong");
           $('#medunit_nm').focus();
            return false;
        }
         

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcomunitmedis/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcomunitmedis/ajax_update')?>";
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

function delete_poliklinik(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcomunitmedis/ajax_delete')?>/"+id,
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
        show_poliklinik();
    });

function show_poliklinik(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcomunitmedis/ajax_list');?>",
                        "aoColumns": [
                            // { "mData": "no" },
                            { "mData": "medunit_cd" },
                            { "mData": "medunit_nm" },
                            { "mData": "data_mapcd" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_poliklinik();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_poliklinik()"><i class="fa fa-plus"></i> ADD</button>
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
                                <th>Kode Poliklinik</th>
                                <th>Nama Poliklinik</th>
                                <th>Kode BPJS</th>  
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
                <h3 class="modal-title"> </h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">                        
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Poliklinik</label>
                           <div class="col-md-3">
                                <input type="text" name="medunit_cd" id="medunit_cd" placeholder=" " class="form-control text-uppercase">
                            </div>
                        </div>       

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Poliklinik</label>
                           <div class="col-md-9">
                                <input type="text" name="medunit_nm" id="medunit_nm" placeholder=" " class="form-control text-uppercase">
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
