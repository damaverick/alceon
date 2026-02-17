# Quick PageSpeed Fixes - Action Checklist

## ✅ DONE - Code Changes Applied

### functions.php Updates:

1. ✅ Added preconnect hints for critical domains (fonts, Vimeo)
2. ✅ Added DNS prefetch for external CDNs (jsdelivr, unpkg, cdnjs)
3. ✅ Marked Bootstrap Icons CSS as non-critical (deferred)
4. ✅ Marked AOS CSS as non-critical (deferred)
5. ✅ Added fetchpriority="high" to hero images (LCP boost)
6. ✅ Removed WordPress bloat (emojis, generator, RSD, etc.)
7. ✅ Disabled embed scripts (if not needed)

---

## 🔧 TO DO - WP Rocket Settings (5 minutes)

### Step 1: File Optimization

Go to **WP Rocket → File Optimization**

**CSS Files Section:**

- [x] Minify CSS files _(already enabled)_
- [ ] ✅ **Combine CSS files** - ENABLE THIS
- [ ] ✅ **Optimize CSS delivery** - ENABLE THIS
- [ ] ✅ **Remove Unused CSS** - ENABLE THIS ⭐ (Biggest impact!)

**JavaScript Files Section:**

- [x] Minify JavaScript _(already enabled)_
- [x] Load JavaScript deferred _(already enabled)_
- [x] Delay JavaScript execution _(already enabled)_

**Excluded JavaScript Files (add these lines):**

```
/wp-includes/js/jquery/jquery.min.js
gtag
gtm
```

### Step 2: Media

Go to **WP Rocket → Media**

**LazyLoad:**

- [x] Enable for images _(should be enabled)_
- [x] Enable for iframes and videos _(enabled)_

**Images:**

- [ ] ✅ **Enable WebP caching** - ENABLE THIS if available

### Step 3: Preload

Go to **WP Rocket → Preload**

**Preload Links:**

- [ ] ✅ **Activate link preloading** - ENABLE THIS

### Step 4: Clear Cache

**WP Rocket → Dashboard**

- [ ] ✅ Click **"Clear Cache"**
- [ ] ✅ Click **"Preload Cache"**

---

## 📦 OPTIONAL - Install Imagify (Recommended)

1. Install **Imagify** plugin (free tier: 25MB/month)
2. Go to **Imagify → Settings**
   - Set compression to **"Aggressive"**
   - Enable **"Create WebP versions"**
   - Enable **"Display images in WebP format"**
3. Click **"Bulk Optimization"**
4. Run optimization on all images

**Alternative:** Manually optimize images before upload using:

- [TinyPNG](https://tinypng.com)
- [Squoosh](https://squoosh.app)

---

## 📊 Testing After Changes

1. **Clear WP Rocket cache** (Settings → Clear Cache)
2. **Test website functionality:**
   - [ ] Navigation works
   - [ ] Videos play (hero + second video)
   - [ ] Forms submit
   - [ ] Mobile menu works
   - [ ] Animations trigger
3. **Run PageSpeed Insights:**
   - [PageSpeed Insights](https://pagespeed.web.dev/)
   - Test homepage URL
   - Check both Mobile and Desktop scores
4. **Check browser console** (F12) for errors

---

## 🎯 Expected Results

### Before:

- Mobile: ~60-75
- Desktop: ~75-85

### After These Changes:

- Mobile: ~75-90
- Desktop: ~85-95

### Additional Impact with Imagify:

- Mobile: +5-10 points
- Desktop: +5-10 points

---

## ⚠️ If Something Breaks

### Site Looks Broken?

1. Go to **WP Rocket → File Optimization**
2. Disable **"Combine CSS files"** temporarily
3. Clear cache and test again

### JavaScript Errors?

1. Go to **WP Rocket → File Optimization**
2. Add the specific script filename to **"Excluded JavaScript Files"**
3. Clear cache

### Videos Not Playing?

- Already handled - Vimeo is excluded from optimization

### Quick Fix Button:

**WP Rocket → Tools → Rollback** (if all else fails)

---

## 📈 Monitor Progress

**Tools to use:**

- [PageSpeed Insights](https://pagespeed.web.dev/)
- [GTmetrix](https://gtmetrix.com/)
- [WebPageTest](https://www.webpagetest.org/)

**Test these pages:**

- Homepage
- About page
- Blog/news listing page
- Sample blog post

---

## 🚀 Advanced Optimizations (Later)

Once core fixes are stable, consider:

1. **Host external libraries locally:**
   - Download Bootstrap Icons, AOS, GSAP
   - Place in theme `/js/vendor/` folder
   - Update functions.php to use local files

2. **Conditional script loading:**
   - Only load AOS on pages with animations
   - Only load specific scripts where needed

3. **Upgrade to better hosting:**
   - Consider managed WordPress hosting
   - Cloudflare CDN integration

4. **Database optimization:**
   - Use WP-Optimize plugin
   - Clean up revisions, drafts, spam

---

## ✅ Quick Win Priority

Do these in order for maximum impact with minimum effort:

1. ✅ **Enable "Remove Unused CSS"** (WP Rocket) - 2 min
2. ✅ **Enable "Optimize CSS delivery"** (WP Rocket) - 2 min
3. ✅ **Install + run Imagify** - 10 min
4. ✅ **Enable "Combine CSS"** (WP Rocket) - 2 min
5. ✅ **Test everything still works** - 5 min

**Total time: ~20 minutes**
**Expected improvement: 15-25 PageSpeed points**

---

Last updated: February 17, 2026
