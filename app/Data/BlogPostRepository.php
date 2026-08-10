<?php

namespace App\Data;

/**
 * BlogPostRepository
 *
 * Single source of truth for all blog post metadata and content.
 * Each post maps directly to a source page from the original WordPress site.
 */
class BlogPostRepository
{
    /** @return array<int, array<string, mixed>> */
    public function allPosts(): array
    {
        return $this->posts();
    }

    public function findBySlug(string $slug): ?array
    {
        foreach ($this->posts() as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    /** @return array<int, array<string, mixed>> Recent posts for homepage/sidebar */
    public function recentPosts(int $limit = 6): array
    {
        return array_slice($this->posts(), 0, $limit);
    }

    private function posts(): array
    {
        $posts = [
            [
                'slug'        => 'premium-eyewear-brands-at-austin-optics-what-makes-silhouette-face-a-face-and-chopard-different',
                'title'       => 'Premium Eyewear Brands at Austin Optics: What Makes Silhouette, Face à Face, and Chopard Different',
                'excerpt'     => 'Not every optician carries Silhouette, Face à Face, or Chopard. Austin Optics does — and there are specific reasons for each choice.',
                'date'        => 'July 2026',
                'image'       => 'images/uploads/2026/07/Chopard.png',
                'image_alt'   => 'Chopard eyewear frames',
                'seo_title'   => 'Premium Eyewear Brands in Forest Hills | Austin Optics',
                'seo_desc'    => 'Discover what makes Silhouette, Face à Face, and Chopard eyewear different — and why Austin Optics in Forest Hills carries them exclusively.',
            ],
            [
                'slug'        => 'hard-to-fit-contact-lenses-in-forest-hills-why-some-patients-succeed-here-after-giving-up-elsewhere',
                'title'       => 'Hard-to-Fit Contact Lenses in Forest Hills: Why Some Patients Succeed Here After Giving Up Elsewhere',
                'excerpt'     => 'Keratoconus, high astigmatism, dry eye — if another optician told you contacts won\'t work, Austin Optics is worth a second opinion.',
                'date'        => 'June 2026',
                'image'       => 'images/uploads/2026/02/hard-to-fit-contacts.jpg',
                'image_alt'   => 'Contact lens fitting specialist',
                'seo_title'   => 'Hard-to-Fit Contact Lenses in Forest Hills | Austin Optics',
                'seo_desc'    => 'Austin Optics specializes in hard-to-fit contact lenses including scleral and RGP fittings for keratoconus and complex prescriptions in Forest Hills.',
            ],
            [
                'slug'        => 'the-truth-about-blue-light-glasses-what-they-do-and-dont-do',
                'title'       => 'The Truth About Blue Light Glasses: What They Do (And Don\'t Do)',
                'excerpt'     => 'Blue light glasses are everywhere. But the evidence behind them is more complicated than most optical shops let on.',
                'date'        => 'June 2026',
                'image'       => 'images/uploads/2026/05/eye-vision-care-1.jpg',
                'image_alt'   => 'Person wearing blue light glasses at computer',
                'seo_title'   => 'The Truth About Blue Light Glasses | Austin Optics Forest Hills',
                'seo_desc'    => 'What blue light glasses actually do — and don\'t do — for digital eye strain. An honest guide from Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'why-your-child-needs-an-eye-exam-before-school-starts-not-after',
                'title'       => 'Why Your Child Needs an Eye Exam Before School Starts (Not After)',
                'excerpt'     => 'Vision problems are one of the most common reasons kids underperform in school. An eye exam before September removes that variable entirely.',
                'date'        => 'June 2026',
                'image'       => 'images/uploads/2025/12/pediatric-eye-exams.png',
                'image_alt'   => 'Child getting an eye exam',
                'seo_title'   => 'Back-to-School Eye Exams in Forest Hills | Kids Vision Care',
                'seo_desc'    => 'Why scheduling your child\'s eye exam before school starts — not after — makes a measurable difference. Austin Optics, Forest Hills NY.',
            ],
            [
                'slug'        => 'summer-eye-protection-in-forest-hills-what-new-yorkers-need-to-know-before-hitting-the-beach',
                'title'       => 'Summer Eye Protection in Forest Hills: What New Yorkers Need to Know Before Hitting the Beach',
                'excerpt'     => 'UV damage to your eyes is cumulative and irreversible. Here\'s what to look for in sunglasses before summer.',
                'date'        => 'June 2026',
                'image'       => 'images/uploads/2026/06/Summer-Eye-Protection-in-Forest-Hills-What-New-Yorkers-Need-to-Know-Before-Hitting-the-Beach.png',
                'image_alt'   => 'Sunglasses for summer UV protection',
                'seo_title'   => 'Summer Eye Protection in Forest Hills | UV400 Sunglasses Guide',
                'seo_desc'    => 'UV protection for your eyes before summer hits. A practical guide from Austin Optics in Forest Hills for New Yorkers heading to the beach.',
            ],
            [
                'slug'        => 'the-best-fathers-day-gift-for-dads-who-need-and-deserve-great-eyewear',
                'title'       => 'The Best Father\'s Day Gift for Dads Who Need (and Deserve) Great Eyewear',
                'excerpt'     => 'If your dad wears glasses and hasn\'t updated his frames in years, this is the guide for you.',
                'date'        => 'June 2026',
                'image'       => 'images/uploads/2026/06/Fathers-day-Austin-optics-.jpg',
                'image_alt'   => 'Father\'s Day eyewear gift',
                'seo_title'   => 'Father\'s Day Eyewear Gift Guide | Austin Optics Forest Hills',
                'seo_desc'    => 'The best Father\'s Day gift for dads who wear glasses — a guide to premium eyewear from Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'how-to-protect-your-eyes-from-digital-strain-in-2026',
                'title'       => 'How to Protect Your Eyes from Digital Strain in 2026',
                'excerpt'     => 'Screen time has increased every year. So has computer vision syndrome. Here\'s what actually works.',
                'date'        => 'May 2026',
                'image'       => 'images/uploads/2026/06/protect-eyes.jpg',
                'image_alt'   => 'Person working at computer with proper eye protection',
                'seo_title'   => 'How to Protect Your Eyes from Digital Strain in 2026 | CVS Guide',
                'seo_desc'    => 'Practical, evidence-based strategies for protecting your eyes from digital strain in 2026. From Austin Optics, Forest Hills.',
            ],
            [
                'slug'        => 'how-to-choose-the-perfect-eyeglass-frames-for-your-face-shape',
                'title'       => 'How to Choose the Perfect Eyeglass Frames for Your Face Shape',
                'excerpt'     => 'The right frame for your face isn\'t just about style — it\'s about proportion, balance, and prescription optics.',
                'date'        => 'May 2026',
                'image'       => 'images/uploads/2026/05/perfact-glass-1024x683-1.jpg',
                'image_alt'   => 'Choosing eyeglass frames by face shape',
                'seo_title'   => 'How to Choose the Perfect Eyeglass Frames for Your Face',
                'seo_desc'    => 'A complete guide to choosing eyeglass frames by face shape from Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'how-to-choose-the-right-lenses-for-your-vision-and-lifestyle',
                'title'       => 'How to Choose the Right Lenses for Your Vision and Lifestyle',
                'excerpt'     => 'Progressive, high-index, photochromic, anti-reflective — the right lens depends on more than just your prescription.',
                'date'        => 'April 2026',
                'image'       => 'images/uploads/2022/10/high-performance-lenses.jpg',
                'image_alt'   => 'High performance prescription lenses',
                'seo_title'   => 'How to Choose the Right Lenses for Your Lifestyle',
                'seo_desc'    => 'A guide to prescription lens types from single vision to progressive, anti-reflective to photochromic. Austin Optics, Forest Hills.',
            ],
            [
                'slug'        => 'why-computer-vision-exams-are-essential',
                'title'       => 'Why Computer Vision Exams Are Essential for Screen Users',
                'excerpt'     => 'A standard eye exam doesn\'t check for digital eye strain. A computer vision exam does — and there\'s an important difference.',
                'date'        => 'March 2026',
                'image'       => 'images/uploads/2026/05/Computer-Vision.jpg',
                'image_alt'   => 'Computer vision exam at optician',
                'seo_title'   => 'Why Computer Vision Exams Matter for Screen Users',
                'seo_desc'    => 'Computer vision syndrome affects millions of screen users. A dedicated computer vision exam is the right first step.',
            ],
            [
                'slug'        => 'contact-lens-exam-vs-eye-exam-whats-the-difference',
                'title'       => 'Contact Lens Exam vs Eye Exam: What\'s the Difference?',
                'excerpt'     => 'Your glasses prescription doesn\'t automatically translate to contacts. Here\'s why a separate contact lens exam is required.',
                'date'        => 'December 2025',
                'image'       => 'images/uploads/2025/12/Contact-Lens-Exam-vs-Eye-Exam.jpg',
                'image_alt'   => 'Contact lens exam vs standard eye exam',
                'seo_title'   => 'Contact Lens Exam vs Eye Exam — Austin Optics Guide',
                'seo_desc'    => 'A contact lens exam is different from a regular eye exam. Learn what each includes and why you need both.',
            ],
            [
                'slug'        => 'contacts-vs-glasses-exam-austin-optics',
                'title'       => 'Contacts or Glasses: Which Eye Exam Do You Need This Holiday Season?',
                'excerpt'     => 'Planning to update your vision this season? Here\'s how to decide whether you need a glasses or contact lens exam — or both.',
                'date'        => 'December 2025',
                'image'       => 'images/uploads/2025/12/contacts-or-glasses.jpg',
                'image_alt'   => 'Choosing between contacts and glasses',
                'seo_title'   => 'Contacts vs Glasses Exam — Austin Optics Holiday Guide',
                'seo_desc'    => 'Contacts vs glasses — which exam do you need this holiday season? A practical guide from Austin Optics in Forest Hills.',
            ],
            [
                'slug'        => 'cost-of-contact-lens-exams-austin-optics-guide',
                'title'       => 'How Much Is a Contact Lens Exam? A Complete Cost Guide by Austin Optics',
                'excerpt'     => 'Contact lens exam costs vary. Here\'s what you\'ll typically pay — and what factors affect the price.',
                'date'        => 'October 2025',
                'image'       => 'images/uploads/2022/10/Contact-Lens-Exams.jpg',
                'image_alt'   => 'Contact lens exam cost guide',
                'seo_title'   => 'Cost of Contact Lens Exams — Austin Optics Guide',
                'seo_desc'    => 'How much does a contact lens exam cost? A complete cost breakdown from Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => '5-signs-your-eyeglass-prescription-is-wrong',
                'title'       => 'Headaches, Dizziness, and Blur: 5 Signs Your Eyeglass Prescription Is Wrong',
                'excerpt'     => 'An incorrect prescription doesn\'t always announce itself. These five signs suggest your current lenses aren\'t right.',
                'date'        => 'September 2025',
                'image'       => 'images/uploads/2026/05/eye-vision-care-new.jpg',
                'image_alt'   => 'Signs of wrong eyeglass prescription',
                'seo_title'   => '5 Signs Your Eyeglass Prescription Is Wrong | Forest Hills NY',
                'seo_desc'    => 'Headaches, blurry vision, dizziness after getting new glasses? These 5 signs suggest your prescription needs correcting.',
            ],
            [
                'slug'        => '9-signs-your-child-might-need-glasses',
                'title'       => '9 Signs Your Child Might Need Glasses',
                'excerpt'     => 'Kids don\'t always know their vision is blurry. These nine behavioral signs are worth paying attention to.',
                'date'        => 'September 2025',
                'image'       => 'images/uploads/2025/12/pediatric-eye-exams.png',
                'image_alt'   => 'Signs a child needs glasses',
                'seo_title'   => '9 Signs Your Child Needs Glasses | Forest Hills',
                'seo_desc'    => '9 signs your child might need glasses — from squinting to sitting too close to the TV. Austin Optics, Forest Hills.',
            ],
            [
                'slug'        => 'beyond-digital-fatigue-a-medical-guide-to-computer-vision',
                'title'       => 'Beyond Digital Fatigue: A Medical Guide to Computer Vision Syndrome (CVS)',
                'excerpt'     => 'Computer Vision Syndrome is a real clinical condition — not just tired eyes. Here\'s what the research says.',
                'date'        => 'August 2025',
                'image'       => 'images/uploads/2026/05/Computer-Vision.jpg',
                'image_alt'   => 'Computer Vision Syndrome medical guide',
                'seo_title'   => 'Computer Vision Syndrome NYC: A Medical Guide',
                'seo_desc'    => 'A medical guide to Computer Vision Syndrome (CVS) — causes, symptoms, and solutions from an optician in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'scleral-lenses-for-keratoconus-dry-eye',
                'title'       => 'Scleral Lenses: The Ultimate Solution for Keratoconus and Severe Dry Eye in Forest Hills, NY',
                'excerpt'     => 'Scleral lenses vault the cornea entirely, making them uniquely effective for keratoconus and severe dry eye.',
                'date'        => 'July 2025',
                'image'       => 'images/uploads/2026/02/hard-to-fit-contacts.jpg',
                'image_alt'   => 'Scleral lens fitting for keratoconus',
                'seo_title'   => 'Scleral Lenses for Keratoconus & Dry Eye in Forest Hills NY',
                'seo_desc'    => 'Scleral lenses for keratoconus and severe dry eye — a complete guide from Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'why-comprehensive-pediatric-eye-exams',
                'title'       => 'Why Comprehensive Pediatric Eye Exams Are Key to Your Child\'s Success',
                'excerpt'     => 'A vision screening at school is not the same as a comprehensive pediatric eye exam. Here\'s what parents need to know.',
                'date'        => 'June 2025',
                'image'       => 'images/uploads/2025/12/pediatric-eye-exams.png',
                'image_alt'   => 'Pediatric eye exam for children',
                'seo_title'   => 'Pediatric Eye Exams in NYC: Why Your Child\'s Vision Matters',
                'seo_desc'    => 'Comprehensive pediatric eye exams vs school screenings — what parents in Forest Hills need to know.',
            ],
            [
                'slug'        => 'why-a-contact-lens-exam-is-different-from-a-regular-eye-exam',
                'title'       => 'Why a Contact Lens Exam Is Different From a Regular Eye Exam',
                'excerpt'     => 'The measurements required to fit contact lenses properly go beyond what a standard glasses prescription covers.',
                'date'        => 'May 2025',
                'image'       => 'images/uploads/2022/10/Contact-Lens-Exams.jpg',
                'image_alt'   => 'Contact lens exam specialist',
                'seo_title'   => 'Contact Lens Exam vs. Eye Exam: What\'s the Difference?',
                'seo_desc'    => 'Why a contact lens exam is a separate service from a glasses prescription — and what happens during each.',
            ],
            [
                'slug'        => 'what-are-hard-to-fit-contacts-and-who-needs-them',
                'title'       => 'What Are Hard-to-Fit Contacts and Who Needs Them?',
                'excerpt'     => 'Standard soft lenses don\'t work for everyone. Hard-to-fit contacts exist for conditions where regular lenses fail.',
                'date'        => 'April 2025',
                'image'       => 'images/uploads/2026/02/hard-to-fit-contacts.jpg',
                'image_alt'   => 'Hard to fit contact lenses',
                'seo_title'   => 'Hard-to-Fit Contact Lenses: Who Needs Them?',
                'seo_desc'    => 'Who needs hard-to-fit contacts? Keratoconus, high astigmatism, post-LASIK eyes, and more — explained by Austin Optics.',
            ],
            [
                'slug'        => 'what-your-eyes-reveal',
                'title'       => 'What Your Eyes Reveal: A Guide to Your Comprehensive Vision Health Assessment',
                'excerpt'     => 'A thorough eye exam doesn\'t just check your vision — it can reveal systemic health conditions long before other symptoms appear.',
                'date'        => 'March 2025',
                'image'       => 'images/uploads/2023/02/Eye-Vision-Exams.jpg',
                'image_alt'   => 'Comprehensive eye health assessment',
                'seo_title'   => 'NYC Comprehensive Eye Health Exams: What Your Eyes Reveal',
                'seo_desc'    => 'A comprehensive eye exam can reveal much more than your prescription — from glaucoma to diabetes markers.',
            ],
            [
                'slug'        => 'why-you-need-an-eye-exam',
                'title'       => 'Why You Need an Eye Exam: The Critical Difference Between Drugstore Readers and Precision Prescription Glasses',
                'excerpt'     => 'Reading glasses from CVS aren\'t a substitute for a proper prescription — here\'s why that distinction matters.',
                'date'        => 'February 2025',
                'image'       => 'images/uploads/2026/05/quality-eye-care.jpg',
                'image_alt'   => 'Prescription glasses vs drugstore readers',
                'seo_title'   => 'Why Eye Exams Beat Drugstore Readers | Austin Optics NYC',
                'seo_desc'    => 'Why drugstore reading glasses are no substitute for a real eye exam and prescription lenses from a licensed optician.',
            ],
            [
                'slug'        => 'why-do-i-need-multifocal-lenses',
                'title'       => 'Why Do I Need Multifocal Lenses?',
                'excerpt'     => 'Presbyopia starts around 40 and it\'s not going away. Multifocal lenses are the practical solution.',
                'date'        => 'January 2025',
                'image'       => 'images/uploads/2022/10/high-performance-lenses.jpg',
                'image_alt'   => 'Multifocal progressive lenses',
                'seo_title'   => 'Why You Need Multifocal Lenses | Forest Hills Vision Care',
                'seo_desc'    => 'Why multifocal lenses become necessary as you age — and what the options are. Austin Optics, Forest Hills Queens.',
            ],
            [
                'slug'        => 'navigating-eye-care-in-nyc',
                'title'       => 'Navigating Eye Care in NYC: Your Expert Guide to the Most Common Eye Surgeries',
                'excerpt'     => 'LASIK, cataract surgery, glaucoma procedures — a guide to the most common eye surgeries in NYC and how to find the right surgeon.',
                'date'        => 'December 2024',
                'image'       => 'images/uploads/2026/05/advanced-optical-technology.jpg',
                'image_alt'   => 'NYC eye care and surgery guide',
                'seo_title'   => 'NYC Eye Surgery Guide: Expert Care & Co-Management',
                'seo_desc'    => 'A guide to navigating eye surgery in NYC — LASIK, cataracts, glaucoma — from Austin Optics in Forest Hills.',
            ],
            [
                'slug'        => 'hyperopia-affects-near-vision',
                'title'       => 'Why You Can\'t See Up Close: A Guide to Farsightedness (Hyperopia) and Treatment in Forest Hills, NY',
                'excerpt'     => 'Hyperopia is often misunderstood. Many people with farsightedness don\'t know they have it until it becomes a problem.',
                'date'        => 'November 2024',
                'image'       => 'images/uploads/2026/05/eye-vision-care-1.jpg',
                'image_alt'   => 'Farsightedness hyperopia treatment',
                'seo_title'   => 'Farsightedness Treatment in Forest Hills, NY | Guide',
                'seo_desc'    => 'A complete guide to farsightedness (hyperopia) — what it is, how it\'s diagnosed, and how it\'s treated in Forest Hills, NY.',
            ],
            [
                'slug'        => 'myopia-with-atropine-eye-drop',
                'title'       => 'Slowing Down Nearsightedness: The Role of Low-Dose Atropine Drops for Myopia Control in Children',
                'excerpt'     => 'Low-dose atropine eye drops are one of the most effective tools available for slowing myopia progression in children.',
                'date'        => 'October 2024',
                'image'       => 'images/uploads/2022/10/slowing-down-mearsightedness.jpg',
                'image_alt'   => 'Myopia control atropine eye drops',
                'seo_title'   => 'Low-Dose Atropine for Myopia Control in NYC | Guide for Parents',
                'seo_desc'    => 'How low-dose atropine drops slow myopia progression in children — a parent\'s guide from Austin Optics, Forest Hills.',
            ],
            [
                'slug'        => 'tips-to-protect-your-eyes-this-winter-austin-optics',
                'title'       => 'Tips to Protect Your Eyes This Winter — Austin Optics',
                'excerpt'     => 'Cold weather, dry indoor air, and UV reflection off snow all take a toll on your eyes. Here\'s how to protect them.',
                'date'        => 'October 2024',
                'image'       => 'images/uploads/2022/10/sunglass-protect-eyes.jpg',
                'image_alt'   => 'Winter eye protection tips',
                'seo_title'   => 'Winter Eye Care Tips: Prevent Dry Eyes & UV Damage',
                'seo_desc'    => 'How to protect your eyes in winter from dry air, UV reflection, and cold winds. Tips from Austin Optics, Forest Hills.',
            ],
            [
                'slug'        => 'top-10-tips-for-digital-eye-strain-relief',
                'title'       => 'Top 10 Tips For Digital Eye Strain Relief',
                'excerpt'     => 'Ten evidence-based strategies that actually reduce digital eye strain — not just temporary fixes.',
                'date'        => 'September 2024',
                'image'       => 'images/uploads/2026/05/Computer-Vision.jpg',
                'image_alt'   => 'Digital eye strain relief tips',
                'seo_title'   => 'Digital Eye Strain Relief: Top 10 Expert Tips | Austin Optics',
                'seo_desc'    => 'Ten practical tips to relieve digital eye strain from screen use. From Austin Optics in Forest Hills, Queens.',
            ],
            [
                'slug'        => 'top-tips-for-digital-eye-strain-relief',
                'title'       => 'Top Tips For Digital Eye Strain Relief',
                'excerpt'     => 'Practical, daily habits that reduce eye strain from computers, tablets, and phones.',
                'date'        => 'August 2024',
                'image'       => 'images/uploads/2026/05/Computer-Vision.jpg',
                'image_alt'   => 'Tips for digital eye strain',
                'seo_title'   => 'Top Tips for Digital Eye Strain Relief | Austin Optics NYC',
                'seo_desc'    => 'Reduce eye strain from screens with these practical, expert-backed tips from Austin Optics in Forest Hills.',
            ],
            [
                'slug'        => 'why-your-child-needs-a-comprehensive-vision-check',
                'title'       => 'Why Your Child Needs a Comprehensive Vision Check',
                'excerpt'     => 'A vision screening at the pediatrician\'s office checks about 5% of what a comprehensive eye exam covers. Here\'s the difference.',
                'date'        => 'July 2024',
                'image'       => 'images/uploads/2025/12/pediatric-eye-exams.png',
                'image_alt'   => 'Comprehensive child vision check',
                'seo_title'   => 'Comprehensive Child Vision Checks in Forest Hills, NY',
                'seo_desc'    => 'Why your child\'s vision check should be more than a school screening — a guide from Austin Optics in Forest Hills.',
            ],
            [
                'slug'        => 'the-pros-and-cons-of-contact-lenses',
                'title'       => 'The Pros and Cons of Contact Lenses',
                'excerpt'     => 'Contact lenses offer real advantages over glasses — but they also come with responsibilities. Here\'s an honest assessment.',
                'date'        => 'June 2024',
                'image'       => 'images/uploads/2025/12/contacts-or-glasses.jpg',
                'image_alt'   => 'Pros and cons of contact lenses',
                'seo_title'   => 'Pros & Cons of Contact Lenses | Forest Hills NY Eye Care',
                'seo_desc'    => 'A balanced look at the pros and cons of wearing contact lenses — from an optician with 30 years of experience.',
            ],
            [
                'slug'        => 'your-first-contact-lens-appointment-austin-optics',
                'title'       => 'Contact Lens Appointment: What to Expect at Austin Optics',
                'excerpt'     => 'First contact lens appointment? Here\'s exactly what happens — step by step — so you know what to expect.',
                'date'        => 'May 2024',
                'image'       => 'images/uploads/2022/10/Contact-Lens-Exams.jpg',
                'image_alt'   => 'First contact lens appointment',
                'seo_title'   => 'Your First Contact Lens Appointment — Austin Optics',
                'seo_desc'    => 'What to expect at your first contact lens appointment at Austin Optics in Forest Hills, Queens.',
            ],
        ];

        foreach ($posts as &$post) {
            $post['content'] = $this->loadContent($post['slug']);
        }

        return $posts;
    }

    /**
     * Load the full HTML body content for a post from its data file.
     */
    private function loadContent(string $slug): string
    {
        $path = app_path('Data/Posts/' . $slug . '.html');

        if (is_file($path)) {
            return (string) file_get_contents($path);
        }

        return '';
    }
}
