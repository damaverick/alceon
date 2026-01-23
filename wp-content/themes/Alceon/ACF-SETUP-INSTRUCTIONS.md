# ACF Field Setup Instructions for Page Builder

## Overview

This document covers new flexible content layouts and enhancements to existing layouts.

---

## IMPORTANT: Custom Anchor ID for All Layouts

**Add this field to EVERY flexible content layout** to enable custom anchor links:

### Anchor ID Field (Universal)

- **Field Name:** `anchor_id`
- **Field Label:** Anchor ID
- **Field Type:** Text
- **Required:** No
- **Instructions:** Custom anchor ID for linking (e.g., "careers", "about-us"). Leave empty for auto-generated ID.
- **Placeholder:** e.g., careers

**Where to Add:**

1. Navigate to: **Custom Fields → flexible_content field group**
2. For **EACH layout** in your flexible content
3. Add this field at the **layout level** (first field in each layout)

This allows you to create stable anchor links like `#careers` or `#about-us` that won't change.

---

## Enhanced Existing Layout: Section Image Text

The existing **Section Image Text** layout (`section_image_text`) can be enhanced with additional optional fields to provide more flexibility.

### Where to Add These Fields:

1. Navigate to: **Custom Fields → flexible_content field group**
2. Find the **Section Image Text** layout
3. Add these fields at the layout level (NOT inside the `image_text_row` repeater)

### New Optional Field:

#### 1. Column Width Ratio

- **Field Name:** `column_width_ratio`
- **Field Label:** Column Width Ratio
- **Field Type:** Select
- **Choices:**
  ```
  default : Default (7/5 - Image Larger)
  equal : Equal (6/6)
  text_larger : Text Larger (5/7)
  ```
- **Default Value:** `default`
- **Allow Null:** No
- **Instructions:** Choose how to split the columns between image and text

#### 2. Order Override

- **Field Name:** `order_override`
- **Field Label:** Image/Text Order
- **Field Type:** Select
- **Choices:**
  ```
  default : Alternating (Default)
  image_left : Image Left (All Rows)
  text_left : Text Left (All Rows)
  ```
- **Default Value:** `default`
- **Allow Null:** No
- **Instructions:** Control the order of image and text. Default alternates per row.

_Note: Font sizes can be customized with CSS overrides as needed._

---

## New Flexible Content Layouts

---

## 1. Actions Section Layout

**Layout Name:** `action_items`  
**Layout Label:** Actions Section

### Fields to Add:

1. **actions_heading**
   - Field Type: WYSIWYG Editor
   - Field Label: Heading
   - Required: No
2. **actions_text**
   - Field Type: WYSIWYG Editor
   - Field Label: Text Content
   - Required: No
3. **action_items** (Repeater)
   - Field Type: Repeater
   - Field Label: Action Items
   - Layout: Block
   - Button Label: Add Action Item

   **Sub-fields for action_items repeater:**

   a. **action_title**
   - Field Type: Text
   - Field Label: Action Title
   - Required: Yes

   b. **action_url**
   - Field Type: URL
   - Field Label: Action URL
   - Required: No

   c. **action_button_text**
   - Field Type: Text
   - Field Label: Button Text
   - Required: No

---

## 2. Logos Section Layout

**Layout Name:** `logos_section`  
**Layout Label:** Logos Section

### Fields to Add:

1. **logos_heading**
   - Field Type: Text
   - Field Label: Heading
   - Default Value: Community
2. **logos_text**
   - Field Type: WYSIWYG Editor
   - Field Label: Text Content
   - Required: No
3. **logo_items** (Repeater)
   - Field Type: Repeater
   - Field Label: Logo Items
   - Layout: Block
   - Button Label: Add Logo

   **Sub-fields for logo_items repeater:**

   a. **logo_name**
   - Field Type: Text
   - Field Label: Logo Name
   - Required: No

   b. **logo_item**
   - Field Type: Image
   - Field Label: Logo
   - Return Format: Array
   - Required: No

   c. **logo_url**
   - Field Type: URL
   - Field Label: Website URL
   - Required: No

---

## Steps to Add in WordPress Dashboard:

1. Go to **Custom Fields** in WordPress admin
2. Find your **Flexible Content** field group (likely attached to Page Builder template)
3. Click **Edit** on the flexible_content field
4. Click **Add Layout** for each of the three layouts above
5. Set the **Layout Name** exactly as specified (e.g., `how_we_work`)
6. Set the **Layout Label** as shown
7. Add all the fields listed for each layout
8. For repeater fields, make sure to add the sub-fields inside the repeater
9. **Save** the field group

---

## Converting the About Us Page:

After adding these ACF layouts:

1. Edit the About Us page in WordPress
2. Change the Page Template from "About Us" to "Page Builder"
3. Add the flexible content modules in this order:
   - Heading & Text (for intro section)
   - Image Carousel with Modal (if needed)
   - How We Work
   - Actions Section (action_items)
   - Logos Section (logos_section)
4. Fill in the content for each module
5. Update the page

---

## Notes:

- All three template files have been created in `/template-parts/section/`
  - how-we-work.php
  - actions.php
  - logos.php
- The page builder has been updated to recognize these new layouts
- Each section supports anchor IDs for deep linking
- The old `template-about-us.php` can be deprecated once you've migrated the content
