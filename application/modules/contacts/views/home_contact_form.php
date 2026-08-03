<form action="#" class="contact-form" id="quoteform" onsubmit="return false">
    <div class="row grid-gap">
        <div class="col-sm-6 col-12">
            <div class="field">
                <label for="name" class="heading text-20 fw-500">Full Name</label>
                <input type="text" class="text text-16" id="name" name="name" placeholder="Your name">
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="field">
                <label for="phone" class="heading text-20 fw-500">Phone</label>
                <input type="text" class="text text-16" id="phone" name="phone" placeholder="Phone number">
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="field">
                <label for="email" class="heading text-20 fw-500">Email</label>
                <input type="email" class="text text-16" id="email" name="email" placeholder="Email address">
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="field">
                <label for="subject" class="heading text-20 fw-500">Subject</label>
                <input type="text" class="text text-16" id="subject" name="subject" placeholder="Subject">
            </div>
        </div>
        <div class="col-12">
            <div class="field">
                <label for="message" class="heading text-20 fw-500">Message</label>
                <textarea class="text text-16" rows="3" name="message" id="message"
                    placeholder="Type your message"></textarea>
            </div>
        </div>
    </div>
    <div id="resultquotefrom"></div>
    <button type="submit" id="homeQuoteForm" class="button button--primary">Send Message</button>
</form>


<script type="text/javascript">
    $(function() {
        $('#homeQuoteForm').click(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('contacts/contact') ?>",
                data: $("#quoteform").serialize(),
                beforeSend: function() {
                    $('#resultquotefrom').html('<p style="color:red">Please wait...</p>');
                },
                success: function(data) {
                    $('#resultquotefrom').empty();
                    if (data.trim() == '1') {
                        $('#quoteform')[0].reset();
                        $('#resultquotefrom').html("<div class='alert alert-success'><p style='color:green;'>Thank you! Your message has been submitted. We'll respond soon.</p></div>");
                    } else {
                        $('#resultquotefrom').html(data);
                    }
                },
                error: function() {
                    $('#resultquotefrom').html("<div class='alert alert-danger'>Something went wrong. Please try again.</div>");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    (function () {
        var hideTimer;
        var el = document.getElementById('resultquotefrom');
        if (!el) return;
        new MutationObserver(function () {
            if (el.innerHTML.trim() === '') return;
            clearTimeout(hideTimer);
            hideTimer = setTimeout(function () {
                $(el).fadeOut(400, function () { $(this).empty().show(); });
            }, 3000);
        }).observe(el, { childList: true });
    })();
</script>