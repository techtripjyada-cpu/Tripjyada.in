<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override']       = 'home/error';

// ---- Simple pages ----
$route['search']        = 'home/search';
$route['about']         = 'about/index';
$route['terms-and-conditions'] = 'terms_conditions/terms_conditions/index';
$route['contact']       = 'contacts/index';
$route['contacts']      = 'contacts/index';
$route['bhutan-landing-page']  = 'contacts/landing_page';
$route['bhutan-landing-page/submit'] = 'contacts/landing_submit';
$route['sikkim-darjeeling-tour-package']  = 'contacts/sdt_landing_page';
$route['sikkim-darjeeling-tour-package/submit'] = 'contacts/sdt_landing_submit';
// Permanent redirects from the old URL and a briefly-tested misspelling.
$route['sdt-landing-page']  = 'contacts/sdt_landing_page_moved';
$route['sikkiim-darjeeling-tour-package'] = 'contacts/sdt_landing_page_moved';
$route['blog']          = 'blog/view';
$route['blogs']         = 'blog/view';
$route['photo-gallery'] = 'gallery/photo_gallery';
$route['video-gallery'] = 'gallery/video_gallery';
$route['payment/create-order']  = 'payments/payments/create_order';
$route['payment/apply-coupon']  = 'payments/payments/apply_coupon';
$route['payment/verify']        = 'payments/payments/verify';
$route['payment/webhook']       = 'payments/payments/webhook';
$route['chatbot/reply']        = 'chatbot/chatbot/reply';

// ---- Auth (WhatsApp OTP login) ----
$route['auth/send-otp']                         = 'auth/auth/send_otp';
$route['auth/verify-otp']                       = 'auth/auth/verify_otp';
$route['logout']                                = 'auth/auth/logout';

// ---- User dashboard ----
$route['user']                                  = 'user/user/dashboard';
$route['user/profile']                          = 'user/user/profile';
$route['user/update-profile']                   = 'user/user/update_profile';
$route['user/bookings']                         = 'user/user/bookings';
$route['user/my-trips']                         = 'user/user/my_trips';
$route['user/cancellation']                     = 'user/user/cancellation';
$route['user/batch-change']                     = 'user/user/batch_change';
$route['user/payment-options']                  = 'user/user/payment_options';
$route['user/terms']                            = 'user/user/terms';
$route['user/invoice/(:num)']                   = 'user/user/invoice/$1';

// ---- Admin panel ----
$route['admin']                                 = 'admin/admin/index';
$route['admin/login']                           = 'admin/admin/login';
$route['admin/logout']                          = 'admin/admin/logout';
$route['admin/payments']                        = 'admin/admin/payments';
$route['admin/payment-detail/(:num)']           = 'admin/admin/payment_detail/$1';
$route['admin/refund/(:num)']                   = 'admin/admin/refund/$1';
$route['admin/update-status/(:num)']            = 'admin/admin/update_status/$1';
$route['admin/users']                           = 'admin/admin/users';
$route['admin/user-detail/(:num)']              = 'admin/admin/user_detail/$1';
$route['admin/cancellations']                   = 'admin/admin/cancellations';
$route['admin/update-cancellation/(:num)']      = 'admin/admin/update_cancellation/$1';
$route['admin/batch-changes']                   = 'admin/admin/batch_changes';
$route['admin/update-batch-change/(:num)']      = 'admin/admin/update_batch_change/$1';
$route['admin/cardpage']                        = 'admin/admin/cardpage';
$route['admin/cardpage-save-tab']               = 'admin/admin/cardpage_save_tab';
$route['admin/cardpage-delete-tab/(:num)']      = 'admin/admin/cardpage_delete_tab/$1';
$route['admin/cardpage-save-desc']              = 'admin/admin/cardpage_save_desc';

// ---- Tour package listing ----
// /tour-package              → all packages
// /tour-package/group-tour   → filtered by category
// Note: uses module/controller/method form so MX_Router locate() finds Packages.php correctly
$route['tour-package']          = 'packages/packages/index';
$route['tour-package/(:any)']   = 'packages/packages/index/$1';

// ---- Tour package detail pages ----
$route['group-tour/(:any)']     = 'packages/packages/detail/group-tour/$1';
$route['family-tour/(:any)']    = 'packages/packages/detail/family-tour/$1';
$route['honeymoon-tour/(:any)'] = 'packages/packages/detail/honeymoon-tour/$1';
$route['luxury-tour/(:any)']    = 'packages/packages/detail/luxury-tour/$1';
$route['package/(:any)']        = 'packages/packages/detail/package/$1';
// Catch-all for any dynamically created category (e.g. adventure-tour/package-slug)
$route['([a-z][a-z0-9-]+)-tour/(:any)'] = 'packages/packages/detail/$1-tour/$2';

// ---- Catch-all error ----
$route['(:any).htm'] = 'home/error';

$route['translate_uri_dashes'] = TRUE;
