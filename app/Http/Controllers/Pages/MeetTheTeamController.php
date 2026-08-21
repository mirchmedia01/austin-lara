<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MeetTheTeamController extends Controller
{
    public function __invoke(): View
    {
        $teamMembers = [
            [
                'name' => 'Iris Alvarez',
                'role' => 'Licensed Optician & Co-Owner',
                'photo' => 'images/uploads/2026/05/Iris-Alvarez.png',
                'quote' => "It's not an accessory — it's a necessity.",
                'bio' => [
                    'Iris started her optical career in 1995 right here on Austin Street in Forest Hills, under the mentorship of an optometrist who recognized her abilities and encouraged her to pursue private practice. From there, she went to a Park Avenue boutique serving an appointment-only clientele of New York socialites and Fortune 500 executives.',
                    'In 2004, she joined a high-end optometric practice in Brooklyn Heights after a competitive, months-long interview process. She spent nearly 13 years there, seeing 25 or more patients a day, five days a week. When she left, many of those patients followed her to Forest Hills.',
                    'She took over Austin Optics in 2016 with Mark. Since then, the practice has grown from around 2,500 patients a year to over 9,000. That growth came from referrals, not advertising.',
                    'Iris works exclusively with Crizal and Zeiss lenses and carries only handcrafted frames in 100% cotton acetate. Over the course of her career, she has personally served an estimated 179,000 patients.',
                ],
            ],
            [
                'name' => 'Mark Kimyagarov',
                'role' => 'Licensed Optician & Co-Owner',
                'photo' => 'images/uploads/2026/06/images.jpg',
                'bio' => [
                    'Mark has been a licensed optician for over 15 years and has been connected to Austin Optics for longer than that. He first worked at the practice in the early 2000s, left to pursue other ventures, and returned in 2016 as a co-owner with Iris.',
                    'He knows the practice, the neighborhood, and what Austin Optics could be with the right investment.',
                    'Mark handles eyewear fitting, lens crafting, and adjustments with the kind of precision that comes from doing it properly for a long time. He works closely with patients on contact lens fittings, hard-to-fit cases, and specialized prescriptions. If you have a complex prescription or have had trouble finding contacts that work, Mark is often the person who figures it out.',
                ],
            ],
            [
                'name' => 'Dr. Elina Shalamov',
                'role' => 'Licensed Optometrist',
                'photo' => 'images/uploads/2026/08/elina.png',
                'bio' => [
                    'Dr. Elina Shalamov is a Doctor of Optometry and a graduate of the Pennsylvania College of Optometry. She is dedicated to providing comprehensive and patient-centered eye care for patients of all ages.',
                    'Dr. Shalamov completed externships at the Northport VA Medical Center and Ophthalmic Consultants of Connecticut, where she worked alongside experienced Optometrists and Ophthalmologists. She gained extensive experience in the diagnosis and management of ocular disease, glaucoma, dry eye, pediatrics, low vision rehabilitation, and specialty contact lens fitting.',
                    'Dr. Shalamov is committed to providing the best care for patients by developing individualized treatment plans to preserve vision and promote lifelong ocular health.',
                ],
            ],
        ];

        return view('pages.about.meet-the-team', [
            'teamMembers' => $teamMembers,
            'seoTitle' => 'Meet Our Expert Optical Team | Skilled Vision Specialists',
            'seoDescription' => 'Meet the experienced Austin Optics team providing precision eyewear, advanced vision care, and personalized support in Forest Hills, Queens.',
        ]);
    }
}
