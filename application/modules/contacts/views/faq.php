<div class="contact-form">
    
    <form method="post" id="faqform" onsubmit="return false">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="far fa-user-tie"></i>
                        <input type="text" class="form-control" name="name" placeholder="Your Name" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" class="form-control" name="phone" placeholder="Mobile Number">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-icon">
                <i class="far fa-comment-lines"></i>
                <textarea name="question" cols="30" rows="5" class="form-control"
                    placeholder="Write Your questions" ></textarea>
            </div>
        </div>
            <div id="resultfaq"></div>
        <button id="submitbfaq" type="submit" class="theme-btn" style="background-color:#FBA707;">Submit <i class="far fa-paper-plane"></i></button>
        <button onclick="$('#resultfaq').html('');"  type="reset" class="theme-btn" style="background-color:white;color:#A0A0A0;">Clear <i class="far fa-trash-alt"></i></button>
    </form>
</div>
<script type="text/javascript">
    $(function() {
        $('#submitbfaq').click(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('contacts/faq') ?>",
                data: $("#faqform").serialize(),
                beforeSend: function() {
                    $('#resultfaq').html('<p style="color:red">Please wait...</p>');
                },
                success: function(data) {
                    $('#resultfaq').empty();
                    if (data == '1') {
                        data = "<div class='alert alert-success'><p style='color:green;'>Thank you for your question! Our team will get back to you shortly with the information you need.</p></div>";
                        $("#faqform").trigger('reset');
                    }
                    $('#resultfaq').html(data);
                }
            });
        });
    });
</script>