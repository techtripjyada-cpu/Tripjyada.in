<?php
$package = [
    'name'       => 'Bhutan 6 Nights 7 Days Tour Package',
    'duration'   => '6 Nights / 7 Days',
    'num_days'   => 7,
    'num_nights' => 6,
    'type'       => 'Group Tour',
    'best_seller'=> false,
    'image'      => 'assets/images/product/2.jpg',
    'meta_title' => 'Bhutan 6 Nights 7 Days Tour Package | TripJyada',
    'meta_desc'  => 'Book our Bhutan 6 Nights 7 Days tour package for Indian nationals. An extended Bhutan experience covering Thimphu, Punakha, Paro & more.',
    'urgency'    => '✨ Extended Itinerary — More Time, More Bhutan. Limited Peak Season Slots Available!',
    'wa_msg'     => 'Hello TripJyada, I am interested in the Bhutan 6 Nights 7 Days Tour Package. Please share more details.',
    'p_id'       => 'bhutan-6n7d',
    'slug'       => 'bhutan-6-nights-7-days',
    'category_slug' => 'group-tour',

    /* -----------------------------------------------------------
       PRICING — season-based, PAX-bracket per person (all-inclusive)
       Season   : 1 Sep – 10 Jan  (18 % effective rate)
       Off-Season: 1 Jul – 31 Aug  (10 % effective rate)
    ----------------------------------------------------------- */
    'pricing' => [
        'num_days'  => 7,
        'num_nights'=> 6,
        'season' => [
            'label'     => 'Peak Season (1 Sep – 10 Jan)',
            'date_note' => 'Travel dates: 1 Sep to 10 Jan',
            'pax'       => [
                '2'  => 34499,
                '4'  => 24599,
                '6'  => 20999,
                '8'  => 21899,
                '10' => 19599,
                '12' => 17999,
            ],
        ],
        'offseason' => [
            'label'     => 'Off Season (1 Jul – 31 Aug)',
            'date_note' => 'Travel dates: 1 Jul to 31 Aug',
            'pax'       => [
                '2'  => 32199,
                '4'  => 22999,
                '6'  => 19499,
                '8'  => 20399,
                '10' => 18299,
                '12' => 16999,
            ],
        ],
    ],

    'overview' => "Seven days is the sweet spot for a meaningful Bhutan experience — enough time to slow down, actually look around, and feel the rhythm of the country rather than just check off the sights. This 6-night, 7-day itinerary for Indian travellers takes you from the border town of Phuentsholing all the way through Thimphu, Punakha, and Paro, with an unhurried day in each valley.\n\nYou will stand on Dochula Pass watching 108 stupas disappear into the morning mist, walk across a swaying suspension bridge to Punakha Dzong, and climb above the treeline to the Tiger's Nest Monastery viewpoint. Every night is in a handpicked hotel, every transfer is private, and your licensed Bhutanese guide handles everything in between.\n\nPlease note: These rates are exclusively for Indian nationals. A Sustainable Development Fee (SDF) of ₹1,200 per adult per night is payable separately as mandated by the Royal Government of Bhutan.",

    'highlights' => [
        'Tiger\'s Nest Monastery (Taktsang): The defining image of Bhutan — a monastery locked to a sheer cliff 900 m above the valley floor.',
        'Dochula Pass (10,200 ft): 108 memorial stupas with panoramic views of the Himalayan range on clear days.',
        'Punakha Dzong: Often called the most beautiful building in Bhutan, sitting between two turquoise rivers.',
        'Chele La Pass: Bhutan\'s highest motorable road at 3,988 m — prayer flags, pine forests & Himalayan views.',
        'Paro Valley: Ancient Kyichu Temple, the National Museum & a full scenic day to explore.',
        'Full Private Tour: Dedicated vehicle + certified English/Hindi guide throughout.',
    ],

    'inclusions' => [
        '6 nights accommodation in handpicked hotels (twin/double sharing).',
        'Daily breakfast and dinner at the hotel.',
        'Private air-conditioned vehicle for all transfers & sightseeing.',
        'English/Hindi-speaking licensed Bhutanese guide for the full tour.',
        'Complete handling of border entry permits and driver allowances.',
        'Parking & toll charges throughout the tour.',
    ],

    'exclusions' => [
        'Airfare or train tickets to Bagdogra / NJP Railway Station.',
        'Bhutan Sustainable Development Fee (SDF) of ₹1,200 per adult per night — payable separately.',
        'Entry tickets to monuments, museums & Tiger\'s Nest climb fee.',
        'Personal expenses: laundry, beverages, tips, phone calls.',
        'Travel insurance and any optional adventure activities.',
        'Lunch (available at local restaurants on your own).',
    ],

    'itinerary' => [
        [
            'day'   => 'Day 1',
            'title' => 'Arrival — Bagdogra / NJP to Phuentsholing',
            'desc'  => 'Your driver meets you at Bagdogra Airport or NJP Railway Station and transfers you to Phuentsholing, the lively Indo-Bhutan border town. Check in and take an evening walk through the market lanes — your introduction to Bhutan\'s distinct atmosphere. Overnight in Phuentsholing.',
            'stay'  => 'Phuentsholing',
            'meals' => 'Dinner',
        ],
        [
            'day'   => 'Day 2',
            'title' => 'Phuentsholing → Thimphu — Through the Mountains',
            'desc'  => 'Our team handles all permit formalities in the morning while you enjoy breakfast. Then begin the memorable mountain drive to Thimphu — past roaring Wankha Waterfalls and the impressive Chukha Dam gorge. Arrive in Thimphu by afternoon. Settle in and take an evening stroll through the capital\'s streets. Overnight in Thimphu.',
            'stay'  => 'Thimphu',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 3',
            'title' => 'Thimphu Sightseeing — Temples, Stupas & the Capital',
            'desc'  => 'A full day to explore Thimphu at a relaxed pace. Visit the giant Buddha Dordenma statue, the Memorial Chorten (a constant hub of local prayer activity), the Takin Reserve (home to Bhutan\'s national animal), and the grand Tashichhodzong — the seat of Bhutan\'s government. Afternoon at the Simply Bhutan Museum. Overnight in Thimphu.',
            'stay'  => 'Thimphu',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 4',
            'title' => 'Thimphu → Punakha via Dochula Pass (10,200 ft)',
            'desc'  => 'Head east over the spectacular Dochula Pass where 108 white chortens crown a ridge above the clouds. On clear mornings the entire Himalayan range is visible. Descend into the lush, warm Punakha valley. Visit the riverside Punakha Dzong and cross the swinging suspension bridge. Afternoon at leisure by the river. Overnight in Punakha.',
            'stay'  => 'Punakha',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 5',
            'title' => 'Punakha → Paro via Chimi Lhakhang & Rice Paddies',
            'desc'  => 'A gentle morning walk through rice paddies leads to Chimi Lhakhang, the famous fertility temple of the Divine Madman. Then drive to the picturesque Paro valley. Check in and visit the ancient Kyichu Lhakhang — one of Bhutan\'s earliest temples, built in the 7th century. Evening in Paro town. Overnight in Paro.',
            'stay'  => 'Paro',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 6',
            'title' => 'Chele La Pass & Tiger\'s Nest Monastery View',
            'desc'  => 'Drive up to Chele La Pass (3,988 m) — Bhutan\'s highest motorable road — through dense forests of blue pine and rhododendron. On a clear day, Mt. Jomolhari rises sharp against the sky. After returning to Paro, visit the Tiger\'s Nest Viewpoint for the unmissable view of Taktsang Monastery perched on a cliff 900 m above the valley. Overnight in Paro.',
            'stay'  => 'Paro',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 7',
            'title' => 'Paro → Phuentsholing → Bagdogra / NJP — Departure',
            'desc'  => 'Last morning in Bhutan. Visit the Paro Airport Viewpoint to watch mountain landings, then cross the Nyameyzam bridge and stop for a final look at the Paro valley. Drive back through the mountains to Phuentsholing and onward to Bagdogra Airport or NJP Station. Tour ends with memories of the happiest country in the world.',
            'stay'  => 'Departure',
            'meals' => 'Breakfast',
        ],
    ],

    'faqs' => [
        [
            'q' => 'Do Indian nationals need a visa for Bhutan?',
            'a' => 'No. Indian citizens travel on a Government of Bhutan entry permit. A valid passport or voter ID card is sufficient. We manage the entire permit process for you.',
        ],
        [
            'q' => 'What is the SDF and is it included in the price?',
            'a' => 'The Sustainable Development Fee (SDF) is ₹1,200 per adult per night as mandated by the Bhutanese government. It is NOT included in the per-person package price and is collected separately. Children under 5 travel free; ages 6–12 pay half.',
        ],
        [
            'q' => 'Are these rates only for Indian nationals?',
            'a' => 'Yes. The pricing shown is exclusively for Indian passport holders, who are eligible for the lower SDF rate. International travellers have different pricing.',
        ],
        [
            'q' => 'How does the PAX-based pricing work?',
            'a' => 'Our pricing is structured by group size (2, 4, 6, 8, 10, 12 persons). The larger your group, the lower the per-person cost because fixed costs (cab, guide) are split across more people. Minimum booking is 2 persons.',
        ],
        [
            'q' => 'What is the difference between Peak Season and Off-Season rates?',
            'a' => 'Peak Season (1 Sep – 10 Jan) covers the most popular travel months with higher demand and rates. Off-Season (1 Jul – 31 Aug) is the monsoon/post-monsoon period with lush scenery, fewer crowds, and lower prices.',
        ],
        [
            'q' => 'Can I upgrade hotels or customise this itinerary?',
            'a' => 'Absolutely. This is a standard outline. We can upgrade to deluxe or boutique properties, add an extra day, include adventure activities, or adjust any part of the itinerary. Contact us on WhatsApp or through the booking form.',
        ],
    ],
];
