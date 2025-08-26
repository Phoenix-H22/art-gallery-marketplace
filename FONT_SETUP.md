# Typewriter Regular Font Setup

This project has been configured to use the Typewriter Regular font throughout the entire application. Here's what has been done and what you need to do to complete the setup.

## What's Been Changed

1. **Main CSS File**: Updated `public/assets/css/style.css` to include:

    - `@font-face` declaration for Typewriter Regular
    - Changed all font-family declarations to use 'Typewriter Regular', monospace

2. **All Blade Templates**: Updated font-family declarations in:

    - `resources/views/auth/login.blade.php`
    - `resources/views/auth/register.blade.php`
    - `resources/views/pages/paintings.blade.php`
    - `resources/views/pages/search-results.blade.php`
    - `resources/views/pages/profile.blade.php`
    - `resources/views/pages/product-detail.blade.php`
    - `resources/views/pages/product-details.old.blade.php`

3. **Font Directory**: Created `public/assets/fonts/` directory for font files

## What You Need to Do

### Step 1: Add Font Files

Place the following Typewriter Regular font files in the `public/assets/fonts/` directory:

-   `Typewriter-Regular.woff2` (recommended - best compression)
-   `Typewriter-Regular.woff` (fallback for older browsers)
-   `Typewriter-Regular.ttf` (fallback for very old browsers)

### Step 2: Font File Sources

You can obtain Typewriter Regular font files from:

-   Google Fonts (if available)
-   Adobe Fonts
-   Font websites like FontSquirrel, DaFont, or 1001 Fonts
-   Purchase from font foundries

### Step 3: Verify Setup

After adding the font files, the font will automatically load throughout your application. The CSS includes:

-   `font-display: swap` for better loading performance
-   Multiple format fallbacks for browser compatibility
-   Monospace fallback for better typography

## Font Implementation Details

The font is implemented with the following CSS:

```css
@font-face {
    font-family: "Typewriter Regular";
    src: url("../fonts/Typewriter-Regular.woff2") format("woff2"), url("../fonts/Typewriter-Regular.woff")
            format("woff"),
        url("../fonts/Typewriter-Regular.ttf") format("truetype");
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}
```

All elements now use:

```css
font-family: "Typewriter Regular", monospace;
```

## Browser Support

-   Modern browsers will use WOFF2 format (best compression)
-   Older browsers will fall back to WOFF or TTF
-   Very old browsers will use the monospace fallback

## Testing

To test that the font is working correctly:

1. Add the font files to the `public/assets/fonts/` directory
2. Clear your browser cache
3. Refresh the application
4. Check that all text is displaying in Typewriter Regular font

## Troubleshooting

If the font doesn't load:

1. Verify font files are in the correct directory
2. Check browser developer tools for 404 errors
3. Ensure font file names match exactly (case-sensitive)
4. Clear browser cache and refresh
