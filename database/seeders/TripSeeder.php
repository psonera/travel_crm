<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'title'=> 'KEDARKANTHA THRILL',
                'description'=>'Kedarkantha is a mountain peak of the Himalayas in Uttarakhand, India. 
                Its elevation is 12,500 ft. The trip commences from Dehradun, from where you drive to the small, but pretty village of Sankri. 
                The climb to the peak of Kedarkantha starts from a small village called as Sankri. 
                There is a lake called Juda-ka-talab, the locals say that once upon a time Lord Shiva meditated at Kedarkantha. 
                Its name implies so from the droplet fallen from Shiva’s hair to form this lake named as Juda-ka-talab. 
                There are a total of 13 peaks of the Himalayan range visible from the Kedarkantha peak. 
                The experience of the summit climb is very special and stays with you for a long time.',
                'location'=>'Kedarkantha Base Camp, Singtur Range, Uttarakhand, India',
                'start_date'=>'1/7/2022',
                'end_date'=>'7/7/2022',
                'batch_size'=>'35',
                'price'=>'7699',
                'trip_type_id' => '1'
            ],
            [
                'title'=> 'MANALI - KASOL THRILL BLAZERS WAY',
                'description'=>'Manali when someone says this word to us the pictures that comes to our mind is  the beautiful snow-capped view of mountains, breezy and sparkling river , magical snowfall and more thing which we have either seen in some movies or in pictures but it is always said that something are meant to be experienced same is the case with Manali you may get to know about Manali, it’s places , it’s food, culture, atmosphere but when you actually visit it gives entirely unforgettable memories for the life time ,we  mean how can be seeing the snow fall on the screen and touching the white pure snow with your hands be compared it’s completely different things, complete different experience which you shouldn’t afford to avoid. Although the word Manali is itself is sufficient enough to attract someone to visit there are other attractions also which can definitely compel anyone towards the magnetic beauty of Manali like spiritually beautiful temple of hadimba, Extremely colorful and full of choices that no shopper can resist- mall road (Manali market) & of course how can we forget about heavenly beautiful beauty of Solang valley Which almost every individual desires to witness. When we talk about Kasol we can say this place is all about serenity and peace actually when it comes to Kasol what anyone can definitely expect is soothing and reposing experience in the rejuvenating beauty of nature .we know Kasol is actually famous for different things & stuff but we want to let you guys know at the same time Kasol has equipped  itself in such an well mannered that is sufficient enough to help anyone to forget about their stress Relax & rejuvenate himself/herself .As we said earlier the beauty of Kasol is sufficient enough to attract anyone towards it but still if someone wish to list down some of the main attractions of it then we can say that kasol possessed itself with the third highest gurudwara of the world, full of mystery – malana village and needles to mention the beauty of Kasol market And of course if someone is visiting Kasol & is not seeing the cultivation of hash then certainly that person is going to regret about it later & we wish that you don’t be that person that’s why we have provided the trek of magic valley which as the name suggests gives the magical experience of trekking & is enable you to witness that aspect of Kasol which is famous in word wide that is farming of hash.',
                'location'=>'Manali, Himachal Pradesh, India',
                'start_date'=>'1/7/2022',
                'end_date'=>'10/7/2022',
                'batch_size'=>'35',
                'price'=>'13299',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'SRINAGAR - SONAMARG - GULMARG - PAHALGAM',
                'description'=>'If there is heaven on the earth, it is Kashmir only. Embellished with oodles of natural marvels, Kashmir is a land of beauty and elegance. Renowned for its natural exquisiteness, Kashmir is among the best retreats for travellers. It soothes their eyes with the delighting vistas of the Dal Lake, Mughal Gardens, meadow of flowers and snowy landscape. It is difficult to describe the beauty of this northernmost state in words. One can only feel it and fall in love with it.',
                'location'=>'Jammu & Kashmir',
                'start_date'=>'1/7/2022',
                'end_date'=>'7/7/2022',
                'batch_size'=>'35',
                'price'=>'9999',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'MAJESTIC MANALI - HONEYMOON SPECIAL',
                'description'=>'Get ready for a holiday amidst the scenic landscapes replete with snow-clad mountains, meadows of pine, and cascading waters offering spectacular views and a chance to cherish natural beauty at its best. This honeymoon tour package is one of the most relaxing and enjoyable Himachal honeymoon packages. This tour takes care of relaxation, romance, sightseeing, and a little adventure.',
                'location'=>'Manali, Himachal Pradesh, India',
                'start_date'=>'1/7/2022',
                'end_date'=>'7/7/2022',
                'batch_size'=>'24',
                'price'=>'17999',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'KASHMIR GREAT LAKES TREK',
                'description'=>'The most popular trek in Kashmir, Kashmir Great Lakes Trek is one of the Top Treks in India. The stellar beauty of five alpine lakes lapped in the dreamscape of Kashmir. The trail of this Himalayan Trekking leads you through five alpine lakes, each as beautiful as the other. What’s more interesting is that you get to see these lakes just as they are being fed by the snow-clad mountains. Every day brings a new meadow to explore. The trek to the Kashmir Great Lakes Trek will provide to the trekkers a perfect flavour of all hues of terrain- innumerable meadows, snow clad glaciers and pinnacles, passes, rocky barren lands, struggling streams. The trail to the Great Lakes is worth trekking.',
                'location'=>'Jammu & Kashmir',
                'start_date'=>'1/7/2022',
                'end_date'=>'9/7/2022',
                'batch_size'=>'35',
                'price'=>'15499',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'SRINAGAR - GULMARG - SONAMARG - KARGIL',
                'description'=>'If there is heaven on the earth, it is Kashmir only. Embellished with oodles of natural marvels, Kashmir is a land of beauty and elegance. Renowned for its natural exquisiteness, Kashmir is among the best retreats for travellers. It soothes their eyes with the delighting vistas of the Dal Lake, Mughal Gardens, meadow of flowers and snowy landscape. It is difficult to describe the beauty of this northernmost state in words. One can only feel it and fall in love with it.',
                'location'=>'Jammu & Kashmir',
                'start_date'=>'1/7/2022',
                'end_date'=>'6/7/2022',
                'batch_size'=>'35',
                'price'=>'10999',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'KHEERGANGA TREK',
                'description'=>'‘Kheerganga’ as the name suggest is The Ganga River, White as a Kheer. The name Kheerganga came due to the milky waters of the river flowing in all its vastness and its streams flowing into Parvati valley from all sides of the mountain. Kheerganga’s panoramic skies and vast greenery are a much-needed delight to the trekker’s eyes. It is a holy place with a hot water spring, a small temple of Lord Shiva and a bathing tank.',
                'location'=>'Khir Ganga, Himachal Pradesh, India',
                'start_date'=>'1/7/2022',
                'end_date'=>'2/7/2022',
                'batch_size'=>'30',
                'price'=>'1499',
                'trip_type_id' => '1'

            ],
            [
                'title'=> 'रोमांचक RATANMAHAL',
                'description'=>'Rathanmahal - This sanctuary harbours maximum population of sloth bears in the entire state, which is the star attraction in the wilds of Ratanmahals. The sanctuary falls in the Dahod district of Central Gujarat and is located very close to the tribal towns, Baria of Dahod district and Chhota Udepur of Vadodara district. This area was declared as a wildlife sanctuary in March 1982. The sanctuary falls on the border of Gujarat with Madhya Pradesh. The actual habitat of the Sloth bear, therefore, extends into Madhya Pradesh. The pristine beauty of forests in this small tract with rugged topography gives the feel of a hill station to wildlife enthusiasts. ',
                'location'=>'Ratanmahal Sloth Bear Sanctuary, Kanjeta, Gujarat, India',
                'start_date'=>'1/7/2022',
                'end_date'=>'1/7/2022',
                'batch_size'=>'30',
                'price'=>'899',
                'trip_type_id' => '1'

            ],
          
            
        ])->each(function($trip){
            
            $trip = Trip::create([
                'title' => $trip['title'],
                'description' => $trip['description'],
                'location' => $trip['location'],
                'start_date' => $trip['start_date'],
                'end_date' => $trip['end_date'],
                'batch_size' => $trip['batch_size'],
                'price' => $trip['price'],
                'trip_type_id' => $trip['trip_type_id'],
            ]);
        });
    }
}
