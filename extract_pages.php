<?php
/**
 * Extract HTML content from frontend blade files
 * This script reads blade files and extracts main content for Visual Builder
 * Run: php extract_pages.php
 */

$bladeFiles = [
    'treasury-home' => 'home',
    'about' => 'about',
    'divisions' => 'divisions',
    'team' => 'team',
    'annual-budget' => 'annual-budget',
    'estimates' => 'estimates',
    'audited-financial-statements' => 'audited-statements',
    'treasury-circulars' => 'treasury-circulars',
    'debt-overview' => 'debt-overview',
    'domestic-external-debt-reports' => 'debt-reports',
    'government-guarantees' => 'government-guarantees',
    'pension-services' => 'pension-services',
    'government-payroll-services' => 'government-payroll',
    'investment-services' => 'investment-services',
    'cash-collection' => 'cash-collection',
    'treasury-news' => 'treasury-news',
    'public-notices' => 'public-notices',
    'download' => 'download',
    'contact' => 'contact',
];

$outputDir = __DIR__ . '/database/seeders/pages_html';

// Create output directory if it doesn't exist
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
    echo "✓ Created directory: $outputDir\n";
}

foreach ($bladeFiles as $bladeName => $outputName) {
    $bladeFile = __DIR__ . "/resources/views/frontend/{$bladeName}.blade.php";
    $outputFile = "{$outputDir}/{$outputName}.html";

    if (!file_exists($bladeFile)) {
        echo "✗ Blade file not found: {$bladeName}.blade.php\n";
        continue;
    }

    // Read the blade file
    $content = file_get_contents($bladeFile);

    // Extract main content (body content without full HTML structure)
    // For treasury-home.blade.php which already uses @section('content')
    if ($bladeName === 'treasury-home') {
        // Extract everything after @section('content')
        preg_match('/@section\(\'content\'\)(.*?)@endsection/s', $content, $matches);
        if (!empty($matches[1])) {
            $sectionContent = $matches[1];

            // Remove HTML comments
            $sectionContent = preg_replace('/<!--.*?-->/s', '', $sectionContent);

            // Clean up blade directives - handle asset() calls
            $sectionContent = preg_replace('/\{\{\s*asset\([\'"]assets\/([^\'"]+)[\'"]\)\s*\}\}/', '/assets/$1', $sectionContent);
            $sectionContent = preg_replace('/\{\{\s*asset\([\'"]([^\'"]+)[\'"]\)\s*\}\}/', '/$1', $sectionContent);

            // Remove excessive whitespace
            $sectionContent = preg_replace('/\n\s*\n\s*\n/', "\n\n", $sectionContent);

            $extracted = trim($sectionContent);
        } else {
            $extracted = "<!-- Content extraction failed for {$bladeName} -->";
        }
    } else {
        // For full HTML files, extract body content
        preg_match('/<body[^>]*>(.*?)<\/body>/is', $content, $matches);

        if (!empty($matches[1])) {
            $bodyContent = $matches[1];

            // Remove mobile menu wrapper - need to match nested structure
            // First pass: remove the entire vs-menu-wrapper block
            $pos = strpos($bodyContent, '<div class="vs-menu-wrapper">');
            if ($pos !== false) {
                $endPos = strpos($bodyContent, '</div>', $pos);
                $depth = 1;
                $searchPos = $pos + strlen('<div class="vs-menu-wrapper">');

                while ($depth > 0 && $endPos !== false) {
                    $nextOpen = strpos($bodyContent, '<div', $searchPos);
                    $nextClose = strpos($bodyContent, '</div>', $searchPos);

                    if ($nextClose !== false && ($nextOpen === false || $nextClose < $nextOpen)) {
                        $depth--;
                        if ($depth == 0) {
                            $bodyContent = substr($bodyContent, 0, $pos) . substr($bodyContent, $nextClose + 6);
                            break;
                        }
                        $searchPos = $nextClose + 6;
                    } elseif ($nextOpen !== false) {
                        $depth++;
                        $searchPos = $nextOpen + 4;
                    } else {
                        break;
                    }
                }
            }

            // Remove header section
            $bodyContent = preg_replace('/<header.*?<\/header>/is', '', $bodyContent);

            // Remove footer section
            $bodyContent = preg_replace('/<footer.*?<\/footer>/is', '', $bodyContent);

            // Remove all script tags
            $bodyContent = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $bodyContent);

            // Remove all HTML comments
            $bodyContent = preg_replace('/<!--.*?-->/s', '', $bodyContent);

            // Clean up blade directives - handle asset() calls properly
            // First handle asset('assets/...') to avoid double /assets/assets/
            $bodyContent = preg_replace('/\{\{\s*asset\([\'"]assets\/([^\'"]+)[\'"]\)\s*\}\}/', '/assets/$1', $bodyContent);
            // Then handle asset('...') for other paths
            $bodyContent = preg_replace('/\{\{\s*asset\([\'"]([^\'"]+)[\'"]\)\s*\}\}/', '/$1', $bodyContent);

            // Remove excessive whitespace while preserving structure
            $bodyContent = preg_replace('/\n\s*\n\s*\n/', "\n\n", $bodyContent);

            $extracted = trim($bodyContent);
        } else {
            $extracted = "<!-- Content extraction failed for {$bladeName} -->";
        }
    }

    // Save to output file
    file_put_contents($outputFile, $extracted);

    $size = strlen($extracted);
    echo "✓ Extracted {$bladeName}.blade.php → {$outputName}.html ({$size} bytes)\n";
}

echo "\n✅ Extraction complete! Files saved to: {$outputDir}/\n";
echo "📝 Now you can run: php artisan db:seed --class=VisualBuilderPagesSeeder\n";
