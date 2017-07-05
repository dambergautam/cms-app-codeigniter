<footer>
    <p>&COPY; Simple CMS 2017 </p>
</footer>

</div>


<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Select 2 -->
<script src="<?php echo base_url(); ?>assets/plugin/select2/select2.min.js" crossorigin="anonymous"></script>

<!-- Accordion menu -->
<script src="<?php echo base_url(); ?>assets/plugin/accordion_menu/js/index.js" crossorigin="anonymous"></script>

<!-- Delete alert -->
<script>
    function confirm_delete() {
        var job = confirm('Are you sure you want to delete it?');
        return job;
    }
</script>


<!-- Use tooltip function -->
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<!-- Get selected file name -->
<script>
    $(document).ready(function () {
        $("#upload input:file").change(function () {
            var fileName = $(this).val().replace(/.*(\/|\\)/, '');
            $("#selected_filename").html(fileName);
        });
    });

    //SELECT 2 
    $(".select2").select2();
</script>


<!-- Ck editor -->
<script>
    CKEDITOR.replace('editor_page_content', {
        height: 300,
        width: '100%',
        // Define the toolbar groups as it is a more accessible solution.
        toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"document","groups":["mode"]},
                {"name":"insert","groups":["insert"]},
                {"name":"styles","groups":["styles"]},
                {"name":"about","groups":["about"]}
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Flash,Iframe,Anchor,Specialchar,Save,NewPage,DocProps,Print,Preview'
});
</script>

</body>
</html>

