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

function add_jadwal()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    // $('[name="seq_no"]').val(<?php echo $maxjadwal; ?>);
    $('.modal-title').text('Form Jadwal Dokter'); // Set Title to Bootstrap modal title  
    $('#dr_cd').combogrid('clear');
    $('#medunit_cd').combogrid('clear');
    $('#day_tp').combogrid('clear');
    $('#dr_cd').next().find('input').focus(); 
    // document.getElementById("note").readOnly = false;
    
}

function edit_jadwal(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sistem/data_medis/frmcomjadwal/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="seq_no"]').val(data.seq_no);
           
            $('#dr_cd').combogrid();
            $('#medunit_cd').combogrid();
            $('#day_tp').combogrid();

            $('#dr_cd').combogrid('setValue', data.dr_cd);
            $('#medunit_cd').combogrid('setValue', data.medunit_cd);
            $('#day_tp').combogrid('setValue', data.day_tp);
            
// $('#medunit_cd').next().find('input').val(data.medunit_cd);
            // $('[name="medunit_cd"]').val(data.medunit_cd);
    // $('#day_tp').next().find('input').val(data.day_tp);
            $('#time_start').next().find('input').val((data.time_start).substr(11,19));
            $('#time_end').next().find('input').val((data.time_end).substr(11,19));
            $('[name="note"]').val(data.note);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Jadwal Dokter'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from server');
        }
    });
}

function save()
{
        var dokter =$('#dr_cd').next().find('input').val();
        var klinik =$('#medunit_cd').next().find('input').val();
        var hari =$('#day_tp').next().find('input').val();
        var awal =$('#time_start').next().find('input').val();
        var akhir =$('#time_end').next().find('input').val();
             
        if(dokter==''){
            alert("Maaf, Dokter tidak boleh kosong");
            $('#dr_cd').next().find('input').focus();
            // $('#nip2').next().find('input').val('');
            return false;
        }
        if(klinik==''){
            alert("Maaf, Klinik tidak boleh kosong");
           $('#medunit_cd').next().find('input').focus();
            return false;
        }

        if(hari==''){
            alert("Maaf, Hari tidak boleh kosong");
            $('#day_tp').next().find('input').focus();
            return false;
        }
        if(awal==''){
            alert("Maaf, Jam Mulai tidak boleh kosong");
           $('#time_start').next().find('input').focus();
            return false;
        }
         if(akhir==''){
            alert("Maaf, Jam Selesai tidak boleh kosong");
           $('#time_end').next().find('input').focus();
            return false;
        }

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 

        if(save_method == 'add') {
            url = "<?php echo site_url('sistem/data_medis/frmcomjadwal/ajax_add')?>";
        } else {
            url = "<?php echo site_url('sistem/data_medis/frmcomjadwal/ajax_update')?>";
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

function delete_jadwal(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('sistem/data_medis/frmcomjadwal/ajax_delete')?>/"+id,
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
        show_jadwal();
    });

function show_jadwal(){
     $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollCollapse": true,
                        "sAjaxSource"   : "<?php echo site_url('sistem/data_medis/frmcomjadwal/ajax_list');?>",
                        "aoColumns": [
                            // { "mData": "no" },
                            { "mData": "medunit_nm" },
                            { "mData": "day_nm" },
                            { "mData": "waktu" },
                            { "mData": "dr_nm" },
                            { "mData": "aksi" }
                                    ]
                            });
}
function reload_table()
{
$('#example').dataTable().fnDestroy();
show_jadwal();
}
</script>


<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="clearfix">
                    <button id="addRole" class="btn btn-success btn-xs" title="Tambah Role Baru" onclick="add_jadwal()"><i class="fa fa-plus"></i> ADD</button>
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
                                <!-- <th>No</th> -->
                                <th>Unit</th>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Dokter</th>  
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
                <h3 class="modal-title">Form Jadwal Dokter</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="seq_no"/>                        
                       
                        <div class="form-group">
                            <label class="control-label col-md-3"> Dokter </label>
                            <div class="col-md-5">
                               <input id="dr_cd" name="dr_cd" style="width:250px;height: 30px" class="form-control" type="text">
                              </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> Poliklinik </label>
                            <div class="col-md-5">
                               <input id="medunit_cd" name="medunit_cd" style="width:250px;height: 30px" class="form-control" type="text">
                              </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> Hari </label>
                            <div class="col-md-5">
                               <input id="day_tp" name="day_tp" style="width:100px;height: 30px" class="form-control" type="text">
                              </div>
                        </div>

                         <div class="form-group">
                            <label class="control-label col-md-3"> Jam Mulai </label>
                            <div class="col-md-5">
                                 <input class="easyui-timespinner" required="required" data-options="min:'08:00',showSeconds:true" value="08:00" id="time_start" name="time_start" labelPosition="top"  style="width:100px;height: 30px">

                                   <!--  <div class="input-group bootstrap-timepicker">
                                        <input id="time_start" name="time_start" type="text" class="form-control" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o bigger-110"></i>
                                        </span>
                                    </div> -->

                             </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> Jam Selesai </label>
                            <div class="col-md-5">
                               <input class="easyui-timespinner" required="required" data-options="min:'08:00',showSeconds:true" value="08:00" id="time_end" name="time_end" labelPosition="top"  style="width:100px;height: 30px">
 
                             </div>
                        </div>

                        
                         <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                           <div class="col-md-9">
                                <input type="text" name="note" id="note" placeholder=" " class="form-control">
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
        $('#dr_cd').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcomjadwal/caridokter'); ?>',
        idField:'dr_cd',
        textField:'dr_nm',
        mode:'remote',
        fitColumns:true,
        columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'dr_nm',title:'Dokter',width:100}
                ]]
         });  
    
        // $('#dr_cd').combogrid({
        //     onSelect:function(rowIndex, rowData){
        //     $('#dr_cd').val(rowData.dr_nm);
        //     }
        // });  

        // ambil data klinik
        $('#medunit_cd').combogrid({
        panelWidth:250,
        url: '<?php echo site_url('sistem/data_medis/frmcomjadwal/cariklinik'); ?>',
        idField:'medunit_cd',
        textField:'medunit_nm',
        mode:'remote',
        fitColumns:true,
        columns:[[
                    // {field:'dr_cd',title:'NIP',width:150},
                    {field:'medunit_nm',title:'Klinik',width:100}
                ]]
         });      

        // ambil data hari
        $('#day_tp').combogrid({
        panelWidth:100,
        url: '<?php echo site_url('sistem/data_medis/frmcomjadwal/carihari'); ?>',
        idField:'com_cd',
        textField:'code_nm',
        mode:'remote',
        fitColumns:true,
        columns:[[
                    // {field:'com_cd',title:'NIP',width:150},
                    {field:'code_nm',title:'Hari',width:70}
                ]]
         });      
              
        // $('#time_start').timepicker({
        //     minuteStep: 1,
        //     showSeconds: true,
        //     showMeridian: false,
        //     disableFocus: true,
        //     icons: {
        //         up: 'fa fa-chevron-up',
        //         down: 'fa fa-chevron-down'
        //     }
        // }).on('focus', function() {
        //     $('#time_start').timepicker('showWidget');
        // }).next().on(ace.click_event, function(){
        //     $(this).prev().focus();
        // });

        // $('#time_end').timepicker({
        //     minuteStep: 1,
        //     showSeconds: true,
        //     showMeridian: false,
        //     disableFocus: true,
        //     icons: {
        //         up: 'fa fa-chevron-up',
        //         down: 'fa fa-chevron-down'
        //     }
        // }).on('focus', function() {
        //     $('#time_end').timepicker('showWidget');
        // }).next().on(ace.click_event, function(){
        //     $(this).prev().focus();
        // });


    }); //akhir document ready

    // Format Tanggal 
    function myformatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
     return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }

    function myparser(s){
        if (!s) return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var d = parseInt(ss[2],10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
            return new Date(y,m-1,d);
        } else {
            return new Date();
        }
    }
    
</script>

   
<!-- <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
    <div style="margin-bottom:20px">
        <input class="easyui-timespinner" required="required" data-options="min:'08:00',showSeconds:true" value="08:00" id="aa" labelPosition="top"  style="width:100px;height: 30px">
    </div>
    <div style="margin-bottom:20px">
        <input class="easyui-timespinner" label="End Time:" labelPosition="top" value="14:45" style="width:100%;">
    </div>
</div>
 -->