<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogPostController;
use App\Http\Controllers\LegacyRedirectController;
use App\Http\Middleware\ForceTrailingSlash;
use App\Http\Controllers\Pages\AboutUsController;
use App\Http\Controllers\Pages\AwardsController;
use App\Http\Controllers\Pages\BestOfBoroController;
use App\Http\Controllers\Pages\ContactUsController;
use App\Http\Controllers\Pages\FrameSelectionController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\InsurancesController;
use App\Http\Controllers\Pages\MeetTheTeamController;
use App\Http\Controllers\Pages\Services\ComputerVisionController;
use App\Http\Controllers\Pages\Services\ContactLensExamsController;
use App\Http\Controllers\Pages\Services\EyeVisionExamsController;
use App\Http\Controllers\Pages\Services\HardToFitContactController;
use App\Http\Controllers\Pages\Services\LensesController;
use App\Http\Controllers\Pages\Services\SunglassesController;
use App\Http\Controllers\Pages\ServicesController;
use App\Http\Controllers\Pages\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Austin Optics Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', HomeController::class)->name('home');

// About
Route::get('/about-us/', AboutUsController::class)->name('about-us');
Route::get('/meet-the-team/', MeetTheTeamController::class)->name('meet-the-team');
Route::get('/awards/', AwardsController::class)->name('awards');
Route::get('/best-of-boro/', BestOfBoroController::class)->name('best-of-boro');

// Services index
Route::get('/services/', ServicesController::class)->name('services');

// Individual service pages
Route::get('/contact-lens-exams/', ContactLensExamsController::class)->name('contact-lens-exams');
Route::get('/eye-vision-exams/', EyeVisionExamsController::class)->name('eye-vision-exams');
Route::get('/hard-to-fit-contact/', HardToFitContactController::class)->name('hard-to-fit-contact');
Route::get('/sunglasses/', SunglassesController::class)->name('sunglasses');
Route::get('/computer-vision/', ComputerVisionController::class)->name('computer-vision');
Route::get('/lenses/', LensesController::class)->name('lenses');

// Other pages
Route::get('/insurances/', InsurancesController::class)->name('insurances');
Route::get('/frame-selection/', FrameSelectionController::class)->name('frame-selection');
Route::get('/contact-us/', [ContactUsController::class, 'show'])->name('contact-us');

// Blog
Route::get('/blog/', [BlogController::class, 'index'])->name('blog');

// Legacy WordPress URLs (tag, category, author, old /service/, removed post)
// -> 301 to the current equivalent URL. Mapping lives in config/redirects.php.
Route::get('/service/{slug}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/tag/{slug}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/tag/{slug}/page/{page}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/category/{slug}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/category/{slug}/page/{page}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/author/{slug}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/author/{slug}/page/{page}', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);
Route::get('/childrens-and-adult-eye-exams-when-and-why-you-need-them', LegacyRedirectController::class)->withoutMiddleware(ForceTrailingSlash::class);

Route::get('/{slug}/', [BlogPostController::class, 'show'])->name('blog.post')
    ->where('slug', '[a-z0-9\-]+');

// SEO
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
