
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/buttons/css/buttons.dataTables.min.css"> 
    
    

    <script src="<?php echo base_url(); ?>assets/buttons/dataTables.buttons.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/buttons/buttons.print.min.js"></script>



<script type="text/javascript">
    var url;
    var save_method; //for save method string
    var table;

   
    $(document).ready(function() {
        // show_jadwal();
        // $('#example').DataTable();
        view_pasien();
    });

   

    function reload_table() {
        // $('#example').dataTable().fnDestroy();
        // show_jadwal();
    }

function kosongkan_dt() {
        $('#example').dataTable().fnDestroy();
        $('#example').dataTable();
    }

    function view_pasien(){
                        $('#example').dataTable().fnDestroy();
                    
                        $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollX" :        true,
                        "scrollCollapse": true,
                        "bServerside":true,
                        "sAjaxSource"   : "<?php echo site_url('operasional/frmtrxpasien/ajax_list_100');?>" ,
                        "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                                        oSettings.jqXHR = $.ajax( {
                                        "dataType": "json",
                                        "type": "POST",
                                        "url": sSource,
                                        // "data": string,
                                        "success": fnCallback
                                        } );
                        },
                        "aoColumns": [
                                        { "mData": "pasien_cd" },
                                        { "mData": "no_rm" },
                                        { "mData": "pasien_nm" }
                                     ]
                                        } );        
                };

                function view_pasien2(){
                        var filter = $('#txt_filter').val();
                         if(filter.length < 3){
                        // alert("Maaf, Silahkan ketik no rm atau nama minimal 3 huruf");
                         $('#txt_filter').focus();
                         // return false;
                         view_pasien();
                          }else{
                        $('#example').dataTable().fnDestroy();
                        var txt_cari        = $("#txt_filter").val();
                         var string  = "txt_cari="+txt_cari;

                        $('#example').DataTable( {
                        "bProcessing"   : true,
                        "scrollY"       :  350,
                        "scrollX" :        true,
                        "scrollCollapse": true,
                        "bServerside":true,
                        "sAjaxSource"   : "<?php echo site_url('operasional/frmtrxpasien/ajax_list');?>" ,
                        "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                                        oSettings.jqXHR = $.ajax( {
                                        "dataType": "json",
                                        "type": "POST",
                                        "url": sSource,
                                        "data": string,
                                        "success": fnCallback
                                        } );
                        },
                        "aoColumns": [
                                        { "mData": "pasien_cd" },
                                        { "mData": "no_rm" },
                                        { "mData": "pasien_nm" }
                                     ]
                                        } );
                          };

                                
                };

</script>


<!-- /.page-header -->

<div class="row">
     <div class="col-xs-12">     
        <div class="form-group ">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">Pasien</label>
            <div class="col-xs-12 col-sm-3">
                <div class="input-group">
        <input name="txt_filter" id="txt_filter" placeholder="ketik no rm atau nama" onkeyup="view_pasien2()"  class="col-xs-3 input-sm form-control " type="text" />
        
                </div>
            </div>

           

                    <div class=" col-xs-12 col-sm-reset inline"> 
                        <button class="btn btn-sm btn-info btn-round" id="lihat1" onClick="view_pasien()"><i class="glyphicon glyphicon-zoom-out"></i> Tampilkan</button>
                        
                    </div>

                    
                </div>
            </div>
            <div class="col-xs-12">                                
                <p>
                    <div class="table-header">
                        Data Pasien                                    
                    </div>
                    <table id="example" class="table table-striped table-bordered table-hover" width="100%"  >
                        <thead>
                            <tr>
                                <th class="text-center" >Kode </th>
                                <th class="text-center">No RM</th>
                                <th class="text-center">Nama</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        </tbody>            
                    </table>
                </p>
            </div>
        </div>                           
    </div><!-- akhir by bidang -->

<!-- <div class="row">
<div class="col-xs-12 col-sm-5">
<div class="control-group">
<label class="control-label bolder blue">Checkbox</label>

<div class="checkbox">
<label>
<input name="chk" id="chk" type="checkbox" class="ace" onclick="coba();" />
<span class="lbl"> choice 1</span>
</label>
</div>
</div>
<div class="form-group">
<label for="form-field-username">Username</label>

<div>
<input type="text" id="aa" name="aa" placeholder="" value=" " />
</div>
</div>

</div>
</div>

<script type="text/javascript">
function coba(){
var checkBox = document.getElementById("chk");
if (checkBox.checked == true){
document.getElementById("aa").readOnly= true;
} else {
document.getElementById("aa").readOnly = false;
}
}
</script> -->