<?php

namespace App\Support;

use RuntimeException;

/**
 * Serves the original WordPress HTML/CSS/JS for 100% visual + content parity.
 *
 * Each page's markup lives in resources/wp/{page}.html as captured from the
 * original austinoptics.com download. This helper extracts the <head>,
 * <header>, <main>, <footer> and the trailing <script> block for each page,
 * rewriting every root-relative URL so the Laravel routes resolve them.
 */
class WpContent
{
    private static ?self $instance = null;

    /** @var array<string, string> raw source files loaded once per request */
    private array $sources = [];

    /** @var array<int, string> WordPress object id => Laravel route */
    private array $pageRoutes = [
        40 => '/about-us',
        42 => '/meet-the-team',
        44 => '/awards',
        51 => '/contact-lens-exams',
        53 => '/eye-vision-exams',
        55 => '/hard-to-fit-contact',
        57 => '/sunglasses',
        59 => '/computer-vision',
        61 => '/lenses',
        99 => '/insurances',
        101 => '/frame-selection',
        103 => '/best-of-boro',
        105 => '/blog',
        107 => '/contact-us',
        12529 => '/services',
        13006 => '/',
        // blog posts
        2337 => '/hyperopia-affects-near-vision',
        2338 => '/myopia-with-atropine-eye-drop',
        2339 => '/scleral-lenses-for-keratoconus-dry-eye',
        2340 => '/why-do-i-need-multifocal-lenses',
        2341 => '/9-signs-your-child-might-need-glasses',
        2342 => '/why-your-child-needs-a-comprehensive-vision-check',
        2343 => '/5-signs-your-eyeglass-prescription-is-wrong',
        2344 => '/the-pros-and-cons-of-contact-lenses',
        10237 => '/contact-lens-exam-vs-eye-exam-whats-the-difference',
        10285 => '/cost-of-contact-lens-exams-austin-optics-guide',
        10292 => '/your-first-contact-lens-appointment-austin-optics',
        10296 => '/contacts-vs-glasses-exam-austin-optics',
        10389 => '/why-you-need-an-eye-exam',
        10394 => '/top-tips-for-digital-eye-strain-relief',
        10400 => '/navigating-eye-care-in-nyc',
        10403 => '/top-10-tips-for-digital-eye-strain-relief',
        10406 => '/what-your-eyes-reveal',
        10409 => '/why-comprehensive-pediatric-eye-exams',
        10414 => '/beyond-digital-fatigue-a-medical-guide-to-computer-vision',
        10419 => '/tips-to-protect-your-eyes-this-winter-austin-optics',
        10733 => '/why-a-contact-lens-exam-is-different-from-a-regular-eye-exam',
        10745 => '/what-are-hard-to-fit-contacts-and-who-needs-them',
        10750 => '/why-computer-vision-exams-are-essential',
        10755 => '/how-to-choose-the-right-lenses-for-your-vision-and-lifestyle',
        10770 => '/how-to-choose-the-perfect-eyeglass-frames-for-your-face-shape',
        12991 => '/how-to-protect-your-eyes-from-digital-strain-in-2026',
        12996 => '/the-best-fathers-day-gift-for-dads-who-need-and-deserve-great-eyewear',
        13002 => '/summer-eye-protection-in-forest-hills-what-new-yorkers-need-to-know-before-hitting-the-beach',
        13119 => '/why-your-child-needs-an-eye-exam-before-school-starts-not-after',
        13125 => '/the-truth-about-blue-light-glasses-what-they-do-and-dont-do',
        13131 => '/hard-to-fit-contact-lenses-in-forest-hills-why-some-patients-succeed-here-after-giving-up-elsewhere',
        13137 => '/premium-eyewear-brands-at-austin-optics-what-makes-silhouette-face-a-face-and-chopard-different',
    ];

    public static function instance(): self
    {
        return self::$instance ??= new self;
    }

    public function head(string $page, ?string $seoTitle = null, ?string $seoDescription = null, ?string $ogImage = null): string
    {
        $raw = $this->extract($this->source($page), '<head>', '</head>');
        $inner = substr($raw, strlen('<head>'), -strlen('</head>'));

        return $this->finalizeHead($this->rewrite($inner), $seoTitle, $seoDescription, $ogImage);
    }

    public function bodyClass(string $page): string
    {
        $html = $this->source($page);

        if (preg_match('/<body([^>]*)>/', $html, $m) && preg_match('/class="([^"]*)"/', $m[1], $c)) {
            return $c[1];
        }

        return 'wp-singular page-template-default';
    }

    public function header(string $page): string
    {
        return $this->rewrite($this->extract($this->source($page), '<header', '</header>'));
    }

    public function main(string $page): string
    {
        return $this->rewrite($this->extract($this->source($page), '<main', '</main>'));
    }

    public function footer(string $page): string
    {
        return $this->rewrite($this->extract($this->source($page), '<footer', '</footer>'));
    }

    public function scripts(string $page): string
    {
        $html = $this->source($page);

        $s = strpos($html, '</footer>');
        if ($s === false) {
            $s = strpos($html, '</main>');
            if ($s === false) {
                return '';
            }
        } else {
            $s += strlen('</footer>');
        }

        $e = strpos($html, '</body>', $s);
        if ($e === false) {
            return '';
        }

        return $this->rewrite(substr($html, $s, $e - $s));
    }

    /**
     * Split the static blog listing into the fragments that surround the post
     * grid so the Blade view can render every repository post card inside the
     * original Elementor posts widget.
     *
     * The captured page contains a second, duplicate posts widget that repeats
     * the first six entries; it is dropped so no post is ever shown twice.
     *
     * @return array{before: string, after: string}
     */
    public function blogMainParts(): array
    {
        $html = $this->rewrite($this->extract($this->source('blog'), '<main', '</main>'));

        $widget = strpos($html, '<div class="elementor-element elementor-element-7158036');
        if ($widget === false) {
            throw new RuntimeException('Cannot locate blog posts widget in source.');
        }

        $grid = strpos($html, '<div class="elementor-posts-container', $widget);
        if ($grid === false) {
            throw new RuntimeException('Cannot locate blog posts grid in source.');
        }

        $before = substr($html, 0, strpos($html, '>', $grid) + 1);

        // Include the grid's own closing tag (the position just after it would
        // discard it, leaving the container unclosed).
        $gridClose = $this->divEnd($html, $grid) - strlen('</div>');

        $duplicate = strpos($html, '<div class="elementor-element elementor-element-1b4f467');

        $after = $duplicate === false
            ? substr($html, $gridClose)
            : substr($html, $gridClose, $duplicate - $gridClose).substr($html, $this->divEnd($html, $duplicate));

        return ['before' => $before, 'after' => $after];
    }

    /**
     * Return the position just after the </div> that closes the <div> whose
     * opening tag starts at $openPos, honouring nested div elements.
     */
    private function divEnd(string $html, int $openPos): int
    {
        $length = strlen($html);
        $pos = strpos($html, '>', $openPos);
        if ($pos === false) {
            throw new RuntimeException('Malformed opening <div> tag in source.');
        }

        $pos++;
        $depth = 1;

        while ($pos < $length) {
            $open = strpos($html, '<div', $pos);
            $close = strpos($html, '</div>', $pos);

            if ($close === false) {
                throw new RuntimeException('Unbalanced <div> tags in source.');
            }

            if ($open !== false && $open < $close) {
                $depth++;
                $pos = strpos($html, '>', $open);
                if ($pos === false) {
                    throw new RuntimeException('Malformed opening <div> tag in source.');
                }
                $pos++;
            } else {
                $depth--;
                $pos = $close + strlen('</div>');

                if ($depth === 0) {
                    return $pos;
                }
            }
        }

        throw new RuntimeException('Unbalanced <div> tags in source.');
    }

    /**
     * Resolve a repository image path (images/uploads/...) to the copied
     * wp-content media root used by the static WordPress assets.
     */
    public function postImage(string $image): string
    {
        return str_replace('/images/uploads/', '/wp-content/uploads/', $this->toLocal($image));
    }

    /**
     * Rewrite a blog post body (stored in app/Data/Posts) to the wp-content
     * media root so image references match the copied WordPress assets.
     */
    public function postContent(string $html): string
    {
        $html = $this->rewrite($html);

        return str_replace('/images/uploads/', '/wp-content/uploads/', $html);
    }

    private function source(string $page): string
    {
        if (! isset($this->sources[$page])) {
            $path = resource_path('wp/'.basename($page).'.html');

            if (! is_file($path)) {
                throw new RuntimeException('Missing WordPress page source: '.$path);
            }

            $this->sources[$page] = (string) file_get_contents($path);
        }

        return $this->sources[$page];
    }

    private function extract(string $html, string $start, string $end): string
    {
        $s = strpos($html, $start);
        if ($s === false) {
            throw new RuntimeException('Cannot find "'.$start.'" in source.');
        }

        $e = strpos($html, $end, $s + strlen($start));
        if ($e === false) {
            throw new RuntimeException('Cannot find "'.$end.'" in source.');
        }

        return substr($html, $s, $e + strlen($end) - $s);
    }

    private function rewrite(string $html): string
    {
        $html = preg_replace('#(?:https?:)?//(?:www\.)?austinoptics\.com/#i', '/', $html);

        $html = preg_replace_callback(
            '/(\b(?:href|src)=")([^"]*)(")/',
            fn ($m) => $m[1].$this->toLocal($m[2]).$m[3],
            $html
        );

        $html = preg_replace_callback(
            "/(\b(?:href|src)=')([^']*)(')/",
            fn ($m) => $m[1].$this->toLocal($m[2]).$m[3],
            $html
        );

        $html = preg_replace_callback(
            '/srcset="([^"]*)"/',
            fn ($m) => 'srcset="'.$this->rewriteSrcset($m[1]).'"',
            $html
        );

        $html = preg_replace_callback(
            '/url\((["\']?)([^"\')]+)\1\)/',
            fn ($m) => 'url('.$m[1].$this->toLocalUrl($m[2]).$m[1].')',
            $html
        );

        return $html;
    }

    private function rewriteSrcset(string $value): string
    {
        return implode(', ', array_map(function (string $candidate): string {
            $candidate = trim($candidate);
            if ($candidate === '') {
                return '';
            }

            if (preg_match('/^(\S+)(\s+\d+[whx]?)(.*)$/', $candidate, $m)) {
                return $this->toLocal($m[1]).$m[2].$m[3];
            }

            return $this->toLocal($candidate);
        }, explode(',', $value)));
    }

    private function toLocal(string $path): string
    {
        $path = trim($path);

        if ($path === '' || $path[0] === '#') {
            return $path;
        }

        if (preg_match('#^(?:[a-z]+:)?//#i', $path)) {
            if (preg_match('#^https?://(?:www\.)?austinoptics\.com/#i', $path)) {
                $path = preg_replace('#^https?://(?:www\.)?austinoptics\.com/#i', '', $path);
            } else {
                return $path;
            }
        } elseif (preg_match('#^[a-z][a-z0-9+.\-]*:#i', $path)) {
            return $path;
        }

        while (str_starts_with($path, '../')) {
            $path = substr($path, 3);
        }

        if ($path === 'index.html' || $path === '') {
            return '/';
        }

        if (! str_starts_with($path, 'index.html')) {
            $path = preg_replace('#@[^/]*$#', '', $path);
        }

        if (preg_match('#^index\.html(\#[^/]*)?$#', $path, $m)) {
            return '/'.($m[1] ?? '');
        }

        if (preg_match('#^index\.html@p=(\d+)(?:\.html)?(\#[^/]*)?$#', $path, $m)) {
            $route = $this->pageRoutes[$m[1]] ?? '/';

            return $route.($m[2] ?? '');
        }

        if (str_starts_with($path, 'tag/') || str_starts_with($path, 'category/')) {
            return '/blog';
        }

        if (str_starts_with($path, 'wp-')) {
            return '/'.$path;
        }

        if (str_starts_with($path, 'service/')) {
            return '/'.preg_replace('#/index\.html$#', '', substr($path, strlen('service/')));
        }

        if (preg_match('#^(.*?)/index\.html$#', $path, $m)) {
            return '/'.$m[1];
        }

        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        return '/'.ltrim($path, '/');
    }

    private function toLocalUrl(string $path): string
    {
        $path = trim($path);

        if ($path === '' || $path[0] === '#' || str_starts_with($path, 'data:')) {
            return $path;
        }

        if (preg_match('#^https?://#i', $path)) {
            if (preg_match('#^https?://(?:www\.)?austinoptics\.com/#i', $path)) {
                $path = preg_replace('#^https?://(?:www\.)?austinoptics\.com/#i', '', $path);
            } else {
                return $path;
            }
        }

        while (str_starts_with($path, '../')) {
            $path = substr($path, 3);
        }

        $path = preg_replace('#@[^/]*$#', '', $path);

        if (str_starts_with($path, 'wp-')) {
            return '/'.$path;
        }

        if (str_starts_with($path, '/')) {
            return $path;
        }

        return '/wp-content/uploads/'.ltrim($path, '/');
    }

    private function finalizeHead(string $head, ?string $seoTitle, ?string $seoDescription, ?string $ogImage): string
    {
        $url = request()->url();

        $head = preg_replace(
            '#<link rel="canonical" href="[^"]*" ?/>#',
            '<link rel="canonical" href="'.e($url).'" />',
            $head,
            1
        );

        $head = preg_replace(
            '#<meta property="og:url" content="[^"]*" ?/>#',
            '<meta property="og:url" content="'.e($url).'" />',
            $head,
            1
        );

        if ($seoTitle !== null) {
            $head = preg_replace(
                '#<title>[^<]*</title>#',
                '<title>'.e($seoTitle).'</title>',
                $head,
                1
            );
            $head = preg_replace(
                '#<meta property="og:title" content="[^"]*" ?/>#',
                '<meta property="og:title" content="'.e($seoTitle).'" />',
                $head,
                1
            );
        }

        if ($seoDescription !== null) {
            $head = preg_replace(
                '#<meta name="description" content="[^"]*" ?/>#',
                '<meta name="description" content="'.e($seoDescription).'" />',
                $head,
                1
            );
            $head = preg_replace(
                '#<meta property="og:description" content="[^"]*" ?/>#',
                '<meta property="og:description" content="'.e($seoDescription).'" />',
                $head,
                1
            );
        }

        if ($ogImage !== null) {
            $image = str_replace('/images/uploads/', '/wp-content/uploads/', $this->toLocal($ogImage));

            $head = preg_replace(
                '#<meta property="og:image" content="[^"]*" ?/>#',
                '<meta property="og:image" content="'.$image.'" />',
                $head,
                1
            );
        }

        return $head;
    }
}
