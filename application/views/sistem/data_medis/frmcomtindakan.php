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

function add_tindakan()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Tindakan'); // Set Title to Bootstrap modal title  
    document.getElementById("treatment_cd").readOnly = false;
    
}

function edit_tindakan(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcomtindakan/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="treatment_cd"]').val(data.treatment_cd);
            $('[name="treatment_nm"]').val(data.treatment_nm);
            $('#treatment_tp').combogrid();
            if(data.treatment_tp===null){
                $('#treatment_tp').combogrid('setValue','');
            }else{
            $('#treatment_tp').combogrid('setValue', data.treatment_tp);
            };
             $('#standar_tp').combogrid();
            if(data.standar_tp===null){
                $('#standar_tp').combogrid('setValue','');
            }else{
            $('#standar_tp').combogrid('setValue', data.standar_tp);
            };
            $('#default_cd').combogrid();
            if(data.default_cd===null){
                $('#default_cd').combogrid('setValue','');
            }else{
            $('#default_cd').combogrid('setValue', data.default_cd);
            };
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Tindakan'); // Set title to Bootstrap modal title
             document.getElementById("treatment_cd").readOnly = true;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var kode =$('#treatment_cd').val();
        var nama =$('#treatment_nm').val();         
        
        if(kode.length==0){
            alert("Maaf, Kode Tindakan tidak boleh kosong");
            $('#treatment_cd').focus();
            return false;
        }
        if(nama.length==0){
            alert("Maaf, Nama Tindakan tidak boleh kosong");
           $('#treatment_nm').focus();
            return false;
        }         

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcomtindakan/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcomtindakan/ajax_update')?>";
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

function delete_tindakan(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcomtindakan/ajax_delete')?>/"+id,
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
        show_tindakan();
    });

function show_tindakan(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcomtindakan/ajax_list');?>",
                        "aoColumns": [
                            { "mData": "treatment_cd" },
                            { "mData": "treatment_nm" },
                            { "mData": "treatment_tp" },
                            { "mData": "standar_tp" },
                            { "mData": "default_cd" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_tindakan();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_tindakan()"><i class="fa fa-plus"></i> ADD</button>
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
                                <th width="15%">KODE TINDAKAN</th>
                                <th width="40%">NAMA TINDAKAN</th>
                                <th>JENIS </th>
                                <th>STANDAR</th>  
                                <th>UNIT</th>  
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
                            <label class="control-label col-md-3">Kode Tindakan </label>
                           <div class="col-md-3">
                                <input type="text" name="treatment_cd" id="treatment_cd" placeholder=" " class="form-control text-uppercase">
                            </div>
                        </div>       

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Tindakan</label>
                           <div class="col-md-9">
                                <input type="text" name="treatment_nm" id="treatment_nm" placeholder=" " class="form-control ">
                            </div>
                        </div>     

                        <div class="form-group">
                            <label class="control-label col-md-3"> Jenis </label>
                            <div class="col-md-5">
                              <input id="treatment_tp" name="treatment_tp" style="width:250px;height: 30px" class="form-control" type="text">
                              </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> Standar </label>
                            <div class="col-md-5">
                            <input id="standar_tp" name="standar_tp" style="width:250px;height: 30px" class="form-control" type="text">
                              </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Unit</label>
                           <div class="col-md-3">
                                <input type="text" name="default_cd" id="default_cd" style="width:250px;height: 30px" class="form-control">
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

<script type="text/javascript">
    $(document).ready(function () {
        // ambil data dokter
        $('#treatment_tp').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcomtindakan/carijenis'); ?>',
        idField:'com_cd',
        textField:'code_nm',
        mode:'remote',
        fitColumns:true,
        columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'code_nm',title:'Jenis',width:100}
                ]]
         });  
    
       

        // ambil data klinik
        $('#standar_tp').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcomtindakan/caristandar'); ?>',
        idField:'com_cd',
        textField:'code_nm',
        mode:'remote',
        fitColumns:true,
         columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'code_nm',title:'Standar',width:100}
                ]]
         });      

        $('#default_cd').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcomtindakan/cariklinik'); ?>',
        idField:'medunit_cd',
        textField:'medunit_nm',
        mode:'remote',
        fitColumns:true,
         columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'medunit_nm',title:'Standar',width:100}
                ]]
         });      


    });      
</script>