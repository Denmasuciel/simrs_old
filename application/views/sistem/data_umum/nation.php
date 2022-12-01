
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

function add_kapling()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('[name="nation_cd"]').val(<?php echo $maxnonation; ?>);
    $('.modal-title').text('Form Data Negara'); // Set Title to Bootstrap modal title
    
}

function edit_nation(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_umum/frmcomnation/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nation_cd"]').val(data.nation_cd);
            $('[name="nation_nm"]').val(data.nation_nm);
            $('[name="capital"]').val(data.capital);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Negara'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        //var tanggal   = $("#tanggal").val();
        var negara= $("#nation_nm").val();
        var kota   = $("#capital").val();
        /*if(tanggal.length==0){
            alert("Maaf, tanggal tidak boleh kosong");
            $('#tanggal').focus()
            return false;
        }*/
        if(negara.length==0){
            alert("Maaf, nama negara tidak boleh kosong");
            $('#nation_nm').focus()
            return false;
        }
        if(kota.length==0){
            alert("Maaf, Ibukota tidak boleh kosong");
            $('#kota').focus()
            return false;
        }

    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
    if(save_method == 'add') {
        url = "<?php echo site_url('sistem/data_umum/frmcomnation/ajax_add')?>";
    } else {
         url = "<?php echo site_url('sistem/data_umum/frmcomnation/ajax_update')?>";
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

function delete_nation(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_umum/frmcomnation/ajax_delete')?>/"+id,
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
        show_nation();
    });

function show_nation(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_umum/frmcomnation/ajax_list');?>",
                        "aoColumns": [
                            { "mData": "no" },
                            // { "mData": "nation_cd" },
                            { "mData": "nation_nm" },
                            { "mData": "capital" },
                            { "mData": "aksi" }
                                    ]
                                });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_nation();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_kapling()"><i class="fa fa-plus"></i> ADD</button>
                    <button id="fres" class="btn btn-info btn-xs" title="Reload Data" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload Data</button>
                        <hr/>
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div>

                    <div class="row">
                    <div class="col-xs-12">
                        <div class="table-header ">
                        Data Negara                                        
                        </div>
                    <div>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>

                                <th>No</th>
                                <!-- <th>Kode Negara</th> -->
                                <th>Negara</th>
                                <th>Ibu kota</th>
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
                <h3 class="modal-title">Form Negara</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="nation_cd"/>                        
                                                                            
                         <div class="form-group">
                            <label class="control-label col-md-3">Negara</label>
                                <div class="col-sm-9">
                           <input type="text" name="nation_nm" id="nation_nm" placeholder="nama negara" class="form-control">
                              </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-md-3">Ibukota</label>
                           <div class="col-md-9">
                                <input type="text" name="capital" id="capital" placeholder="Ibukota" class="form-control">
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
