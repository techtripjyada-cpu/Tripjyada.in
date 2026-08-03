<div class="modal fade" id="qteModal" tabindex="-1" role="dialog" aria-labelledby="qteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Left: image panel -->
            <div class="qm-image">
                <div class="qm-image-overlay">
                    <span class="qm-image-tag">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Get Your Quote
                    </span>
                    <h3>Plan Your Next<br>Dream Trip</h3>
                    <p>Tell us where you want to go — we'll handle everything else.</p>
                </div>
            </div>

            <!-- Right: form panel -->
            <div class="qm-body">
                <button type="button" class="qm-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24"
                        stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Success screen (hidden by default) -->
                <div id="qm-success">
                    <div class="qm-success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="#f97316">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h4 class="qm-success-title">Thank You!</h4>
                    <p class="qm-success-text">Your request has been submitted successfully.</p>
                    <p class="qm-success-text-gap">Our team will get back to you within <strong class="qm-success-highlight">24 hours</strong>.</p>
                    <div class="qm-close-btn-wrap">
                        <button type="button" class="qm-btn-submit" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

                <!-- Form screen -->
                <div id="qm-form-wrap">
                    <p class="qm-title" id="qteModalLabel">Plan Your Next Trip</p>

                    <form id="quotemodal" onsubmit="return false">

                        <!-- First Name + Last Name -->
                        <div class="qm-row">
                            <div>
                                <input type="text" class="qm-input" name="name" placeholder="First Name *">
                            </div>
                            <div>
                                <input type="text" class="qm-input" name="lastname" placeholder="Last Name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="qm-field-wrap">
                            <input type="email" class="qm-input" name="email" placeholder="Email">
                        </div>

                        <!-- Phone -->
                        <div class="qm-field-wrap">
                            <div class="qm-phone-wrap">
                                <div class="qm-country-picker" id="qmCountryPicker">
                                    <button type="button" class="qm-country-btn" id="qmCountryBtn" aria-haspopup="listbox" aria-expanded="false">
                                        <span id="qmSelectedFlag">🇮🇳</span>
                                        <span id="qmSelectedCode">+91</span>
                                        <svg class="qm-country-chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <ul class="qm-country-list" id="qmCountryList" role="listbox">
                                        <li data-code="+91"  data-flag="🇮🇳" class="selected">🇮🇳 India +91</li>
                                        <li data-code="+880" data-flag="🇧🇩">🇧🇩 Bangladesh +880</li>
                                        <li data-code="+977" data-flag="🇳🇵">🇳🇵 Nepal +977</li>
                                        <li data-code="+975" data-flag="🇧🇹">🇧🇹 Bhutan +975</li>
                                        <li data-code="+94"  data-flag="🇱🇰">🇱🇰 Sri Lanka +94</li>
                                        <li data-code="+1"   data-flag="🇺🇸">🇺🇸 USA / Canada +1</li>
                                        <li data-code="+44"  data-flag="🇬🇧">🇬🇧 UK +44</li>
                                        <li data-code="+61"  data-flag="🇦🇺">🇦🇺 Australia +61</li>
                                        <li data-code="+971" data-flag="🇦🇪">🇦🇪 UAE +971</li>
                                        <li data-code="+65"  data-flag="🇸🇬">🇸🇬 Singapore +65</li>
                                        <li data-code="+60"  data-flag="🇲🇾">🇲🇾 Malaysia +60</li>
                                        <li data-code="+66"  data-flag="🇹🇭">🇹🇭 Thailand +66</li>
                                        <li data-code="+49"  data-flag="🇩🇪">🇩🇪 Germany +49</li>
                                        <li data-code="+33"  data-flag="🇫🇷">🇫🇷 France +33</li>
                                        <li data-code="+81"  data-flag="🇯🇵">🇯🇵 Japan +81</li>
                                        <li data-code="+86"  data-flag="🇨🇳">🇨🇳 China +86</li>
                                    </ul>
                                    <input type="hidden" name="countrycode" id="qmCountryCode" value="+91">
                                </div>
                                <input type="tel" class="qm-input" name="phone" placeholder="Mobile number">
                            </div>
                        </div>

                        <!-- Travelling From -->
                        <div class="qm-float">
                            <span class="qm-float-label">Where are you travelling from?</span>
                            <input type="text" class="qm-input" name="mfrom" placeholder=" ">
                        </div>

                        <!-- Where to go -->
                        <div class="qm-float">
                            <span class="qm-float-label">Where do you want to go?</span>
                            <input type="text" class="qm-input" name="mto" placeholder=" ">
                        </div>

                        <!-- Message -->
                        <div class="qm-field-wrap">
                            <textarea class="qm-input" name="message" rows="2"
                                placeholder="Travel dates, group size, budget…"></textarea>
                        </div>

                        <!-- Marketing consent -->
                        <div class="qm-check-wrap">
                            <label class="qm-check-label">
                                <input type="checkbox" name="marketing" class="qm-check" checked>
                                <span>Keep me updated with offers, trips, and travel inspiration via email, SMS, and WhatsApp</span>
                            </label>
                        </div>

                        <div id="resultquotemodal"></div>

                        <button id="submitbquotemodal" type="submit" class="qm-btn-submit">
                            Let's Plan My Trip
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            /* Reset success/form state every time the modal opens */
            $('#qteModal').on('show.bs.modal', function(e) {
                $('#qm-success').hide();
                $('#qm-form-wrap').show();
                $('#quotemodal')[0].reset();
                $('#resultquotemodal').empty();
                /* Pre-fill tour name if opened via Book Now button */
                var tourName = $(e.relatedTarget).data('tour');
                if (tourName) {
                    $('[name="mto"]').val(tourName);
                }
            });

            $('#submitbquotemodal').click(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('contacts/booking') ?>",
                    data: $("#quotemodal").serialize(),
                    beforeSend: function() {
                        $('#submitbquotemodal').prop('disabled', true);
                        $('#resultquotemodal').html('<p style="color:#f97316;font-size:13px;margin:6px 0 0">Please wait...</p>');
                    },
                    success: function(data) {
                        $('#submitbquotemodal').prop('disabled', false);
                        $('#resultquotemodal').empty();
                        if (data.trim() == '1') {
                            $('#qm-form-wrap').fadeOut(250, function() {
                                $('#qm-success').fadeIn(300);
                            });
                            try {
                                gtag('event', 'conversion', {'send_to': 'AW-16778879117/JlJPCPjgvOwZEI3B5cA-'});
                            } catch(e) {}
                        } else {
                            $('#resultquotemodal').html(data);
                        }
                    },
                    error: function() {
                        $('#submitbquotemodal').prop('disabled', false);
                        $('#resultquotemodal').html('<div class="alert alert-danger" style="margin:6px 0 0;padding:8px 12px;font-size:13px">Something went wrong. Please try again.</div>');
                    }
                });
            });

            /* Country code picker */
            var $btn  = $('#qmCountryBtn');
            var $list = $('#qmCountryList');

            $btn.on('click', function(e) {
                e.stopPropagation();
                var open = $list.hasClass('open');
                $list.toggleClass('open', !open);
                $btn.attr('aria-expanded', String(!open));
            });

            $list.on('click', 'li', function() {
                var code = $(this).data('code');
                var flag = $(this).data('flag');
                $('#qmSelectedFlag').text(flag);
                $('#qmSelectedCode').text(code);
                $('#qmCountryCode').val(code);
                $list.find('li').removeClass('selected');
                $(this).addClass('selected');
                $list.removeClass('open');
                $btn.attr('aria-expanded', 'false');
            });

            /* Close when clicking outside */
            $(document).on('click.qmPicker', function() {
                $list.removeClass('open');
                $btn.attr('aria-expanded', 'false');
            });

            /* Reset picker when modal closes */
            $('#qteModal').on('hidden.bs.modal', function() {
                $('#qmSelectedFlag').text('🇮🇳');
                $('#qmSelectedCode').text('+91');
                $('#qmCountryCode').val('+91');
                $list.find('li').removeClass('selected');
                $list.find('li').first().addClass('selected');
            });
        });
    </script>