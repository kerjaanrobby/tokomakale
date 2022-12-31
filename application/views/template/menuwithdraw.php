                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/akun" role="tab">Top Up Saldo</a> </li>
                                <!-- <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>home/widthdraw" role="tab">Tarik Saldo</a> </li> -->
                                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>home/setakun" role="tab">Setting Akun</a> </li>
                            </ul>

                            <?php foreach($akun as $a){?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="card text-black bg-warning">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-black">Saldo kamu</h4>
                                            </div>
                                            <div class="card-body">
                                                <h1 class="card-title"><b>Rp <?php echo number_format($a->saldo);?></b></h1>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Tarik Saldo
                                            </div>
                                            <div class="card-body">
                                                <form class="form-horizontal form-material" method="post" id="formtarik">
                                                    <input type="hidden" placeholder="" name="iduser" id="iduser" value="<?php echo $a->iduser;?>" class="form-control form-control-line" required>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Nominal Saldo</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="" name="nominaltarik" id="nominaltarik" class="form-control form-control-line" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Nomor Rekening</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="" name="norek" id="norek" class="form-control form-control-line" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-12">Bank</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" placeholder=""  name="bank" id="bank" class="form-control form-control-line" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="col-md-12">Atas Nama</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" placeholder=""  name="atasnama" id="atasnama" class="form-control form-control-line" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success" id="brnTarik">Tarik Saldo</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><br>
                                        <div class="card">
                                            <div class="card-header">
                                                Riwayat Tarik Saldo
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="tabletarik" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>Bank</th>
                                                                <th>Nomor Rekening</th>
                                                                <th>Nominal</th>
                                                                <th>Status</th>
                                                                <th class="text-center"><i class="fa fa-cog"></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <!-- $(function() {
              
                $('#formtarik').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?php  echo base_url(); ?>user/tarikproses",
                        type: "POST",
                        data:  new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        dataType:'json', 
                        success: function(data){
                            if(data.hasil==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: data.pesan,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function(){
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: data.pesan,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function(){
                                    window.location.reload();
                                });
                            }
                        }   
                    });
                });
                
                $("#nominaltarik").on('input', function(){
                    var nominal = this.value;
                    var saldo = <?php echo $a->saldo;?>;
                    if(nominal>saldo)
                    {
                        document.getElementById("brnTarik").disabled=true;
                    }else{

                        document.getElementById("brnTarik").disabled=false;
                    }
                });

            });
            $(function () {
                showData();
                showDataTarik();
                
            });
            
            function showDataTarik(){
                alert("ass");
                var iduser = $("#idusers").val();
                if ($.fn.DataTable.isDataTable('#tabletarik') ) {
                    table.DataTable().destroy();
                }
                dttable = table.DataTable({
                responsive: true,
                retrieve: true,
                paging: true,
                scrollX: true,
                processing: true, //Feature control the processing indicator.
                serverSide: true, //Feature control DataTables' server-side processing mode.
                order: [],
                ajax: {
                    url: "<?php echo site_url('user/datatarik')?>",
                    type: "POST",
                    data:{iduser:iduser},
                },
                "columnDefs": [{
                "targets": [ 0 ], //first column / numbering column
                "orderable": true, //set not orderable
                },],
                });
            } -->