<script>
   //  Extra Modal For Add Setting Menus 
   
    $(document).ready(function(){

        $(document).on('submit', '#setting_menu_form', function(event){
            event.preventDefault();
            var cate = $('#name').val();
            var url = $('#url').val();
            if (cate != '' && url != '') {
                $.ajax({
                url:"<?php echo base_url() . 'setting/addmenusetting' ?>",
                    method: 'POST',
                    data: new FormData(this),
                    contentTye:false,
                    processData:false,
                    success:function(data)
                    {
                    alert(data);
                            $('#setting_menu_form')[0].reset();
                            $('#addSettingMenuModal').modal('hide');
                            dataTable.ajax.reload();
                    }
                });
            }else{
                alert("Put Data Name & Url");
            }
        });
    });
          
</script>