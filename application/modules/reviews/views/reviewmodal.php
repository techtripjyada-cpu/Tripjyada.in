<!-- Review Modal -->
<div class="modal fade container custom-modal" id="rvwmdl" tabindex="-1" role="dialog" aria-labelledby="rvwmdl" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3" style="background: linear-gradient(107.2deg, rgb(150, 15, 15) 10.6%, rgb(247, 0, 0) 91.1%);">
            <div class="contact-form-header">
                <div class="row">
                    <div class="col-10">
                        <span style="color: white; font-size: 20px;font-weight:bold;line-height:1;">Leave us Feedback, Suggestion, or Complaints</span>
                    </div>
                    <div class="col-2 text-end">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="color: red; font-size: 30px; margin-right: 15px;">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            <form method="post" id="reviewsform" onsubmit="return false">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-icon">
                                <i class="far fa-user"></i>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-icon">
                                <i class="far fa-envelope"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-icon">
                                <i class="far fa-comment"></i>
                                <input type="text" class="form-control" name="title" placeholder="Review Title">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: white; display: block;">Ratings</label>
                            <div class="rating">
                                <input type="radio" name="stars" value="5" id="rating-5"><label for="rating-5"></label>
                                <input type="radio" name="stars" value="4" id="rating-4"><label for="rating-4"></label>
                                <input type="radio" name="stars" value="3" id="rating-3"><label for="rating-3"></label>
                                <input type="radio" name="stars" value="2" id="rating-2"><label for="rating-2"></label>
                                <input type="radio" name="stars" value="1" id="rating-1"><label for="rating-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-icon">
                                <i class="far fa-comments"></i>
                                <textarea class="form-control" name="desc" rows="3" placeholder="Write Your Experience"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image" class="form-label text-white">Add Image <small>(optional)</small></label>
                            <input type="file" name="img" class="form-control-file" style="color:white;" id="image">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div id="result"></div>
                        <button id="submitbtn" type="submit" class="theme-btn" style="background-color: #FBA707;">Submit<i class="far fa-paper-plane"></i></button>
                        <button onclick="$('#result').html('');" type="reset"  class="theme-btn" style="background-color: white; color: #A0A0A0;">Clear <i class="far fa-trash-alt"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 <script type="text/javascript">
    $(function() {
        $('#submitbtn').click(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData($('#reviewsform')[0]); // Create a FormData object with the form's data

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('reviews/review') ?>",
                data: formData,
                contentType: false, // Important for sending multipart/form-data
                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                beforeSend: function() {
                    $('#result').html('<p style="color:red">Please wait...</p>');
                },
                success: function(data) {
                    $('#result').empty();
                    if (data.err === 0) {
                        $('#result').html("<div class='alert alert-success'><p style='color:green'>Success! Thank you for your review! We appreciate your feedback and will use it to improve our services..</p></div>");
                        $("#reviewsform").trigger('reset');
                    } else {
                        $('#result').html("<div class='alert alert-danger'>" + data.msg + "</div>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error to the console
                    $('#result').html('<div class="alert alert-danger">An error occurred while posting your review. Please try again later.</div>');
                }
            });
        });
    });
 </script>