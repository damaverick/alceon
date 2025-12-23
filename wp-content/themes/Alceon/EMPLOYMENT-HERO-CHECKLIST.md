# Employment Hero Jobs - Quick Setup Checklist

## ✅ Completed Setup Steps

The following files have been created and integrated:

### Configuration & API

- [x] `/inc/employment-hero-config.php` - API configuration
- [x] `/inc/employment-hero-api.php` - API helper class with demo data

### Templates

- [x] `/template-parts/section/employment-hero-jobs.php` - Jobs listing section
- [x] `/template-parts/section/job-card.php` - Job card component
- [x] `/template-job-detail.php` - Job detail page template

### Styling

- [x] `/src/sass/theme/modules/_jobs.scss` - Jobs styles
- [x] Updated `/src/sass/theme/_child_theme.scss` - Imported jobs styles

### JavaScript

- [x] `/js/jobs-filter.js` - AJAX filtering and pagination

### WordPress Integration

- [x] Updated `functions.php` - Added AJAX handlers and script enqueuing

---

## 🔧 Your To-Do List

### Immediate Actions

1. **Add Your Access Token**
   - [ ] Open `/inc/employment-hero-config.php`
   - [ ] Replace `'your_access_token_here'` with your actual token

2. **Compile SCSS**
   - [ ] Run `npm run build` or your build command
   - [ ] Verify CSS is compiled

3. **Test Demo Mode**
   - [ ] Add the jobs section to a page
   - [ ] Test location filters (All, Sydney, Melbourne, etc.)
   - [ ] Test pagination
   - [ ] Click "Find out more" to view job details

### When You Get Organization ID

4. **Enable Live API**
   - [ ] Update `EMPLOYMENT_HERO_ORG_ID` in `/inc/employment-hero-config.php`
   - [ ] Set `EMPLOYMENT_HERO_DEMO_MODE` to `false`
   - [ ] Test API connection
   - [ ] Verify real jobs load correctly

### Optional Customizations

5. **Adjust Content**
   - [ ] Update demo jobs data if needed
   - [ ] Modify location options
   - [ ] Customize email/apply process

6. **Styling Tweaks**
   - [ ] Adjust colors in `_jobs.scss`
   - [ ] Modify spacing/layout
   - [ ] Test responsive design

---

## 📝 Implementation Notes

### Adding Jobs to a Page

**Option 1: Direct Include**

```php
<?php get_template_part('template-parts/section/employment-hero-jobs'); ?>
```

**Option 2: ACF Flexible Content**
Add as a new layout in your flexible content fields

**Option 3: Shortcode (Create if needed)**

```php
// Add to functions.php
add_shortcode('employment_hero_jobs', function() {
    ob_start();
    get_template_part('template-parts/section/employment-hero-jobs');
    return ob_get_clean();
});

// Use in editor
[employment_hero_jobs]
```

### Current Demo Data Includes

- 8 sample jobs
- Locations: Sydney, Melbourne, Brisbane, Perth, Auckland
- Departments: Finance, Marketing, Technology, HR, Sales, Operations, Customer Service
- Full job descriptions with HTML formatting

---

## 🎨 Design Specs Implemented

- **Job Cards**: 50% width (2 columns on desktop)
- **Border**: #CCCCCC, 1px solid
- **Border Radius**: Top-right corner 50px
- **Padding**: 30px
- **Department**: rem(15), uppercase, $brightBlue color
- **Title**: H3 tag
- **Meta**: Location | Posted Date (separated by vertical bar)
- **Button**: "Find out more" with outline-primary style

- **Filter Tabs**: Same style as news category filters
  - Unselected: #e5ecf2 background
  - Selected: $brightBlue background with white text
  - Rounded pill shape

---

## 🐛 Common Issues & Solutions

**Jobs not appearing?**

- Check that files were compiled (`npm run build`)
- Verify template is being included on the page
- Check browser console for errors

**AJAX not working?**

- Clear browser cache
- Check Network tab for 404 errors
- Verify `jobsFilter` object exists in page source

**Styling looks wrong?**

- Recompile SCSS
- Check that `_jobs.scss` is imported
- Verify no CSS conflicts

---

## 📞 Need Help?

Refer to the main documentation: `EMPLOYMENT-HERO-README.md`
