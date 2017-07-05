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
        width: 850,
    });
</script>

<!-- Load sub-category -->
<script>

    $("#page_category").on('change', function () {

        $.ajax({

            url: "<?php echo base_url(); ?>index.php/docs/ajaxRetrive",

            // The data to send (will be converted to a query string)
            data: {
                id: $(this).val()
            },

            type: "POST",

            // The type of data we expect back
            dataType: "json",
        })

                // Code to run if the request succeeds (is done);
                .done(function (json) {
                    select = $("#page_sub_category");
                    $('#page_sub_category').find('option').remove().end();

                    $('#page_sub_category').append($('<option>').text('-- Select Sub-Category --').attr('value', '').attr('disabled', 'true').attr('selected', 'true'));
                    $(json).each(function (i, obj) {
                        $('#page_sub_category').append($('<option>').text(obj.subcategory_title).attr('value', obj.id));
                    });
                })

                // Code to run if the request fails; the raw request and
                .fail(function (xhr, status, errorThrown) {
                    alert("Sorry, there was a problem!");
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                })

                // Code to run regardless of success or failure;
                .always(function (xhr, status) {
                    //alert("The request is complete!");
                });

    });

</script>

</body>
</html>

