
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Setting Point</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Point Reseller</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <form action=""  enctype="multipart/form-data" id="formInput" method="POST" class="form-horizontal" role="form">
                            <div class="card-body">
                                <input type="hidden" name="id" id="id" class="form-control"  />
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div>
                                            <label>Pembagi untuk mendapatkan 1 point</label>
                                            <input type="text" name="point" id="point" class="form-control"  required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <!-- <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal">Batal</button> -->
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $foot;?>
    


    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/moment/moment.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    
    <script>
        var form = document.getElementById("formInput");
        $(function () {
            showData();
        });
        function refreshData() {
            window.location.reload();
        };
        function resetform(){
            $('#id').val("");
            form.reset();
        };
        function showData(){
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>point/datadetail',
                dataType:'json',
                success: function(data) {
                    $.each(data.hasildata,function(i,v){
                        $('#id').val(v.idapp);
                        $('#point').val(v.val);
                    });
                }
            });
        }
        $(function () {
            $('#formInput').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>point/datasimpan",
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
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: data.pesan,
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                        resetform();
                        refreshData();
                    }   
                });
            });
        });
    </script>
</body>

</html>