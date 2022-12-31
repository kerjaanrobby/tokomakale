
<!-- HEAD -->
<?php echo $head;?>
<!-- SIDE BAR -->
<?php echo $menu;?>
<!-- CONTENT -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Syarat & Ketentuan</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Syarat & Ketentuan</a></li>
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
                                    <div>
                                        <label>Syarat dan Ketentuan</label>
                                        <textarea class="textarea_editor form-control" rows="15" name="text" id="text"  placeholder="Enter text ..."></textarea>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $foot;?>
    

    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <!-- start - This is for export functionality only -->
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
    <!-- end - This is for export functionality only -->

    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/moment/moment.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/theme/dist/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    
    <script>
        $(document).ready(function() {
          $('#text').wysihtml5();
        });

        var form = document.getElementById("formInput");
        $(function () {
            showData();
        });
        function resetform(){
            $('#id').val("");
            // $("#imgfitur").attr('src','<?php echo base_url();?>assets/image/imgdef.jpeg');
            form.reset();
        };
        function showData(){
            $.ajax({
                type: "POST",
                url: '<?php  echo base_url(); ?>tos/datadetail',
                dataType:'json',
                success: function(data) {
                    $.each(data.hasildata,function(i,v){
                        $('#id').val(v.idtos);
                        // console.log(v.reseller);
                        var editorObj = $("#text").data('wysihtml5');
                        var editor = editorObj.editor;
                        editor.setValue(v.text);
                    },
                    );
                }
            });
        }
        $(function () {
            $('#formInput').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php  echo base_url(); ?>tos/datasimpan",
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
                        showData();
                    }   
                });
            });
        });
    </script>
</body>

</html>