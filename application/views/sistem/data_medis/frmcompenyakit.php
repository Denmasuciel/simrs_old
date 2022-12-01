<script type="text/javascript">
var url;
var save_method; //for save method string
var table;
   

function add_penyakit()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Penyakit'); // Set Title to Bootstrap modal title  
    document.getElementById("icd_cd").readOnly = false;
    
}

function edit_penyakit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcompenyakit/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="icd_cd"]').val(data.icd_cd);
            $('[name="icd_nm"]').val(data.icd_nm);
           
            $('#icd_tp').combogrid();
            if(data.standar_tp===null){
                $('#icd_tp').combogrid('setValue','');
            }else{
            $('#icd_tp').combogrid('setValue', data.icd_tp);
            };
           
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Tindakan'); // Set title to Bootstrap modal title
             document.getElementById("icd_cd").readOnly = true;
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var kode =$('#icd_cd').val();
        var nama =$('#icd_nm').val();         
        
        if(kode.length==0){
            alert("Maaf, Kode Tindakan tidak boleh kosong");
            $('#icd_cd').focus();
            return false;
        }
        if(nama.length==0){
            alert("Maaf, Nama Tindakan tidak boleh kosong");
           $('#icd_nm').focus();
            return false;
        }         

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcompenyakit/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcompenyakit/ajax_update')?>";
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

function delete_penyakit(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcompenyakit/ajax_delete')?>/"+id,
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
        show_penyakit();
    });

function show_penyakit(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcompenyakit/ajax_list');?>",
                        "aoColumns": [
                            { "mData": "icd_cd" },
                            { "mData": "icd_nm" },
                            { "mData": "code_nm" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_penyakit();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_penyakit()"><i class="fa fa-plus"></i> ADD</button>
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
                                <th width="15%">KODE PENYAKIT</th>
                                <th width="40%">NAMA PENYAKIT</th>
                               <th>STANDAR</th>  
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
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">                        
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Penyakit </label>
                           <div class="col-md-3">
                                <input type="text" name="icd_cd" id="icd_cd" placeholder=" " class="form-control text-uppercase">
                            </div>
                        </div>       

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penyakit</label>
                           <div class="col-md-9">
                                <input type="text" name="icd_nm" id="icd_nm" placeholder=" " class="form-control ">
                            </div>
                        </div>     

                        

                        <div class="form-group">
                            <label class="control-label col-md-3"> Standar </label>
                            <div class="col-md-5">
                            <input id="icd_tp" name="icd_tp" style="width:250px;height: 30px" class="form-control" type="text">
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
       

        // ambil data klinik
        $('#icd_tp').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcompenyakit/caristandar'); ?>',
        idField:'com_cd',
        textField:'code_nm',
        mode:'remote',
        fitColumns:true,
         columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'code_nm',title:'Standar',width:100}
                ]]
         });      

      //klik row function
    var table = $('#example').DataTable();
     
    $('#example tbody').on('click', 'tr', function () {
        // var data = table.row( this ).data();
        // alert( 'You clicked on '+data[4]+'\'s row' );

        var data = table.row( this ).mData();
alert( 'Clicked row id '+ data[0]);

        // var data = table.rows().data(); 
        // alert( 'The table has '+data.length+' records' );
    } );

        //double klik
    $('#example tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        alert( 'You clicked on '+data[1]+'\'s row' );
    } );


    });      
</script>

