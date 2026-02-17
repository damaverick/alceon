# PageSpeed Optimization Guide for Alceon

## ✅ Already Implemented (Code Changes)

### 1. Resource Hints Added

- Added **preconnect** for critical domains (fonts.gstatic.com, player.vimeo.com)
- Added **DNS prefetch** for external CDNs
- This reduces connection time to third-party resources

### 2. Non-Critical CSS Optimization

- Bootstrap Icons CSS marked for deferred loading
- AOS animation CSS marked as non-critical
- Fonts are being hosted locally by WP Rocket

---

## 🚀 WP Rocket Settings to Enable

### **File Optimization Tab**

#### CSS Files

- ✅ **Minify CSS files** - Already enabled
- ✅ **Combine CSS files** - Enable this
- ✅ **Optimize CSS delivery** - Enable (removes render-blocking CSS)
- ✅ **Remove Unused CSS** - Enable for maximum impact

#### JavaScript Files

- ✅ **Minify JavaScript files** - Already enabled
- ✅ **Combine JavaScript files** - Test this (may need to exclude some files if it breaks functionality)
- ✅ **Load JavaScript deferred** - Already enabled
- ✅ **Delay JavaScript execution** - Already enabled

**Add these to "Excluded JavaScript Files":**

```
/wp-includes/js/jquery/jquery.min.js
player.vimeo.com
gtag
gtm
```

---

### **Media Tab**

#### LazyLoad

- ✅ **Enable for images** - Should already be enabled
- ✅ **Enable for iframes and videos** - Enabled (but we excluded Vimeo above-fold)
- ✅ **Add missing image dimensions** - Already enabled

#### Images

- ✅ **Enable WebP compatibility** - Enable if not already
- Consider using a service like **Imagify** or **ShortPixel** to convert images to WebP

---

### **Preload Tab**

#### Preload Fonts

Add your critical font files if WP Rocket hasn't auto-detected them:

```
/wp-content/cache/fonts/...onest-...woff2
```

#### Preload Links

- ✅ **Activate** - Enable to prefetch links on hover

---

### **Advanced Rules Tab**

#### Never Cache URL(s)

Keep GTM and dynamic content out of cache if needed.

#### Never Cache Cookies

If you have logged-in user areas.

#### Cache Query String(s)

Only if you use tracking parameters (utm_source, etc.)

---

## 📦 Image Optimization

### Current Issues

1. **Large images** - Ensure all images are properly sized
2. **Missing WebP format** - Modern format reduces file size 25-35%

### Solutions

#### Option 1: Use WP Rocket + Imagify

1. Install **Imagify** plugin (same company as WP Rocket)
2. Bulk optimize all existing images
3. Enable WebP conversion
4. Set compression level to "Aggressive" for max savings

#### Option 2: Manual Optimization

1. Use **TinyPNG** or **Squoosh** before uploading
2. Export images at 80-85% quality
3. Use appropriate dimensions (don't upload 4000px images for 500px slots)

---

## 🎯 Third-Party Script Optimization

### Google Tag Manager (Already Present)

Your GTM is loading properly. Inside GTM:

1. Set tag firing to **"DOM Ready"** instead of **"Page View"** where possible
2. Use **Custom HTML tags with defer/async**
3. Audit tags - remove any you don't need

### Vimeo Videos

- ✅ First video loads immediately (hero)
- ✅ Second video lazy loads
- Consider using a **poster image** with play button for below-fold videos

---

## 🔧 Additional Code Optimizations

### 1. Reduce External Requests

Consider downloading and hosting locally:

- Bootstrap Icons (currently from CDN)
- AOS library (currently from unpkg.com)
- GSAP libraries (currently from cdnjs.cloudflare.com)

**To implement:**

```bash
# Download the files and place in your theme
/wp-content/themes/Alceon/js/vendor/aos.min.js
/wp-content/themes/Alceon/js/vendor/gsap.min.js
/wp-content/themes/Alceon/css/vendor/bootstrap-icons.min.css
```

Then update functions.php to use local versions instead of CDN.

### 2. Conditional Script Loading

Only load scripts where needed:

```php
// Example: Only load AOS on pages that use it
if (!is_page('contact')) {
    // Don't load AOS
}
```

---

## 📊 Expected PageSpeed Score Improvements

| Optimization                     | Potential Impact |
| -------------------------------- | ---------------- |
| Remove Unused CSS                | +5-15 points     |
| WebP Images                      | +5-10 points     |
| Defer Non-Critical CSS           | +5-10 points     |
| Optimize Third-Party Scripts     | +5-8 points      |
| Resource Hints (Already Done)    | +2-5 points      |
| Font Optimization (Already Done) | +3-5 points      |

**Realistic Target:** 85-95 on Mobile, 90-100 on Desktop

---

## 🧪 Testing Checklist

After implementing changes:

1. **Clear WP Rocket Cache**
   - Go to WP Rocket → Clear Cache
   - Clear "Clear and Preload Cache"

2. **Test Core Functionality**
   - Navigation menus work
   - Videos play (both above and below fold)
   - Forms submit
   - Animations trigger
   - Mobile menu functions

3. **Re-test PageSpeed**
   - Use PageSpeed Insights
   - Test both Mobile and Desktop
   - Test on multiple pages (home, content page, etc.)

4. **Check Browser Console**
   - Look for JavaScript errors
   - Verify no broken resources (404s)

---

## ⚠️ Common Issues & Fixes

### Issue: Combine CSS/JS Breaks Site

**Solution:** Exclude problematic files one by one in WP Rocket settings

### Issue: Scripts Load Out of Order

**Solution:** Check script dependencies in functions.php and adjust exclude list

### Issue: Images Don't Lazy Load

**Solution:** Ensure images don't have `loading="eager"` attribute

### Issue: Fonts Flash/Change (FOUT)

**Solution:** Add `font-display: swap` to font CSS (WP Rocket should handle this)

---

## 🎓 Priority Order (Quick Wins First)

1. ✅ **Enable "Remove Unused CSS"** in WP Rocket (Biggest impact)
2. ✅ **Optimize/Convert images to WebP** (Using Imagify)
3. ✅ **Enable "Combine CSS"** in WP Rocket
4. ⏳ **Audit Google Tag Manager** tags (Remove unused)
5. ⏳ **Host external libraries locally** (Bootstrap Icons, AOS, GSAP)
6. ⏳ **Implement conditional loading** for page-specific scripts

---

## 📞 Need Help?

If you see new errors or breaking functionality after these optimizations:

1. Clear cache and test again
2. Check browser console for specific errors
3. Temporarily disable one optimization at a time to identify the culprit
4. Adjust WP Rocket exclusions as needed

---

**Last Updated:** February 17, 2026
**Current WP Rocket Version:** 3.20.4
