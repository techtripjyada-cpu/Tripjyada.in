<?php
$package = [
    'name'       => 'Bhutan 5 Nights 6 Days Tour Package',
    'duration'   => '5 Nights / 6 Days',
    'num_days'   => 6,
    'num_nights' => 5,
    'type'       => 'Group Tour',
    'best_seller'=> true,
    'image'      => 'assets/images/product/2.jpg',
    'meta_title' => 'Bhutan 5 Nights 6 Days Tour Package | TripJyada',
    'meta_desc'  => 'Book our Bhutan 5 Nights 6 Days tour package for Indian nationals. Thimphu, Punakha & Paro covered. Season & off-season pricing available.',
    'urgency'    => '🔥 Peak Season Slots Filling Fast! Secure your Bhutan permits and early-bird pricing today.',
    'wa_msg'     => 'Hello TripJyada, I am interested in the Bhutan 5 Nights 6 Days Tour Package. Please share more details.',
    'p_id'       => 'bhutan-5n6d',
    'slug'       => 'bhutan-5-nights-6-days',
    'category_slug' => 'group-tour',

    /* -----------------------------------------------------------
       PRICING — season-based, PAX-bracket per person (all-inclusive)
       Season   : 1 Sep – 10 Jan  (18 % effective rate)
       Off-Season: 1 Jul – 31 Aug  (10 % effective rate)
    ----------------------------------------------------------- */
    'pricing' => [
        'num_days'  => 6,
        'num_nights'=> 5,
        'season' => [
            'label'     => 'Peak Season (1 Sep – 10 Jan)',
            'date_note' => 'Travel dates: 1 Sep to 10 Jan',
            'pax'       => [
                '2'  => 29999,
                '4'  => 21399,
                '6'  => 17399,
                '8'  => 18999,
                '10' => 16999,
                '12' => 15599,
            ],
        ],
        'offseason' => [
            'label'     => 'Off Season (1 Jul – 31 Aug)',
            'date_note' => 'Travel dates: 1 Jul to 31 Aug',
            'pax'       => [
                '2'  => 27999,
                '4'  => 19999,
                '6'  => 16899,
                '8'  => 17799,
                '10' => 15799,
                '12' => 14599,
            ],
        ],
    ],

    'overview' => "Experience the magic of Bhutan in six perfectly paced days. This 5-night, 6-day itinerary is designed for Indian travellers who want to see the essential highlights of the Last Himalayan Kingdom — Tiger's Nest, Punakha Dzong, Dochula Pass, and the vibrant capital Thimphu — without feeling rushed.\n\nStarting from Phuentsholing, your journey threads through alpine valleys, centuries-old monasteries, and royal fortresses (dzongs). Every transfer is private, every hotel hand-picked, and every guide locally certified — so all you have to do is show up and soak it in.\n\nPlease note: These rates are exclusive to Indian nationals. A Sustainable Development Fee (SDF) of ₹1,200 per adult per night is payable separately as mandated by the Royal Government of Bhutan.",

    'highlights' => [
        'Tiger\'s Nest Viewpoint: Stand below the iconic Taktsang Monastery clinging to a 3,000-ft cliff face.',
        'Dochula Pass (10,200 ft): 108 white stupas framed by snow-capped Himalayan peaks on clear days.',
        'Punakha Dzong: Bhutan\'s most stunning fortress at the confluence of two rivers.',
        'Thimphu Sightseeing: Buddha Dordenma, Memorial Chorten & the only handmade traffic policeman.',
        'Private Vehicle & Licensed Guide throughout the entire tour.',
        'Hassle-Free Permits: We handle all border entry, permits & SDF documentation.',
    ],

    'inclusions' => [
        '5 nights accommodation in handpicked hotels (twin/double sharing).',
        'Daily breakfast and dinner at the hotel.',
        'Private air-conditioned vehicle for all transfers & sightseeing.',
        'English/Hindi-speaking licensed Bhutanese guide for the full tour.',
        'Complete handling of entry permits and driver allowances.',
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
            'title' => 'Arrival — Bagdogra / NJP to Phuentsholing (Gateway to Bhutan)',
            'desc'  => 'Our driver meets you at Bagdogra Airport (IXB) or NJP Railway Station and transfers you to Phuentsholing, Bhutan\'s bustling border town. Check into your hotel and take a leisurely stroll through the clean market streets — your first glimpse of Bhutanese culture and architecture. Overnight in Phuentsholing.',
            'stay'  => 'Phuentsholing',
            'meals' => 'Dinner',
        ],
        [
            'day'   => 'Day 2',
            'title' => 'Phuentsholing → Thimphu — Into the Clouds',
            'desc'  => 'After completing permit formalities (handled by our team), begin the spectacular mountain drive to Thimphu. En route, stop at the roaring Wankha Waterfalls and enjoy panoramic views of the Chukha Dam. Arrive in Thimphu — the world\'s only capital without a traffic light. Evening at leisure to explore the local market. Overnight in Thimphu.',
            'stay'  => 'Thimphu',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 3',
            'title' => 'Thimphu Full-Day Sightseeing',
            'desc'  => 'Explore the capital at a comfortable pace. Visit the towering Buddha Dordenma statue overlooking the valley, spin prayer wheels at the Memorial Chorten, meet the mythical Takin at the national reserve, and tour the grand Tashichhodzong (seat of government). End the afternoon with a walk through Thimphu\'s vibrant weekend market. Overnight in Thimphu.',
            'stay'  => 'Thimphu',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 4',
            'title' => 'Thimphu → Punakha via Dochula Pass (10,200 ft)',
            'desc'  => 'Drive to Punakha, Bhutan\'s historic winter capital, via the breathtaking Dochula Pass where 108 white stupas stand against a backdrop of the high Himalayas. Descend into the warm subtropical valley and visit the majestic Punakha Dzong — Bhutan\'s most beautiful fortress, perched at the confluence of two rushing rivers. Short walk over the suspension bridge. Overnight in Punakha.',
            'stay'  => 'Punakha',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 5',
            'title' => 'Punakha → Paro via Chimi Lhakhang',
            'desc'  => 'Start with a peaceful walk through rice paddies to Chimi Lhakhang, the Fertility Temple blessed by the Divine Madman. Drive to Paro valley — visit Kyichu Lhakhang (one of Bhutan\'s oldest temples) and the National Museum of Bhutan housed in Ta Dzong. Evening stroll through Paro\'s charming town. Overnight in Paro.',
            'stay'  => 'Paro',
            'meals' => 'Breakfast & Dinner',
        ],
        [
            'day'   => 'Day 6',
            'title' => 'Tiger\'s Nest Viewpoint & Departure — Paro to Phuentsholing / Bagdogra',
            'desc'  => 'After breakfast, visit the iconic Tiger\'s Nest Viewpoint for the best photo opportunity of Taktsang Monastery clinging to a sheer 3,000-ft cliff. Then drive back through the mountains to Phuentsholing for your onward journey. Our driver drops you at Bagdogra Airport or NJP Railway Station. Tour ends with lifelong memories of the Land of the Thunder Dragon.',
            'stay'  => 'Departure',
            'meals' => 'Breakfast',
        ],
    ],

    'faqs' => [
        [
            'q' => 'Do Indian nationals need a visa for Bhutan?',
            'a' => 'No visa is required. Indian citizens travel on an entry permit (passport or voter ID accepted). We handle the permit process entirely as part of your package.',
        ],
        [
            'q' => 'What is the Sustainable Development Fee (SDF)?',
            'a' => 'The SDF is a government-mandated daily fee of ₹1,200 per adult per night (Indians). Children under 5 travel free; ages 6–12 pay half. It is NOT included in the package price and is paid separately.',
        ],
        [
            'q' => 'Are these prices only for Indian nationals?',
            'a' => 'Yes. These rates are exclusively for Indian passport holders who pay the lower SDF rate. Foreign nationals are subject to different SDF and pricing structures.',
        ],
        [
            'q' => 'When is the best time to visit Bhutan?',
            'a' => 'Our Peak Season rates (Sep–Jan) cover the most popular travel windows: post-monsoon autumn clarity and winter calm. Off-Season (Jul–Aug) is lush and green with fewer crowds and lower prices.',
        ],
        [
            'q' => 'What is the minimum group size for booking?',
            'a' => 'Minimum 2 persons. Our pricing is structured in brackets of 2, 4, 6, 8, 10, and 12 persons — the more people in your group, the lower the per-person cost.',
        ],
        [
            'q' => 'Can the itinerary be customised?',
            'a' => 'Absolutely. This is a suggested itinerary. You can swap hotels, add an extra day, or request specific activities. Contact us and we will tailor the trip for you.',
        ],
    ],
];
