<!-- all js codes here file -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
        <script src=" //cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
        <script src="<?php echo MEDIA_PATH; ?>js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
            $('#myTable').dataTable({
                "pageLength": 50
            });
            
            $(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});
        </script>  