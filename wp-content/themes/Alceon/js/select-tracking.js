/**
 * Select Menu Tracking for GTM
 * Tracks user selections for "I am a..." and "I'm looking to..." dropdowns
 */

(function () {
  'use strict';

  console.log('Select Tracking Script Loaded');

  // Wait for DOM to be ready
  document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM Ready - Initializing Select Tracking');

    var categorySelect = document.getElementById('category');
    var lookupSelect = document.getElementById('lookup');
    var form = document.getElementById('header-select-form');

    console.log('Category Select Found:', categorySelect ? 'Yes' : 'No');
    console.log('Lookup Select Found:', lookupSelect ? 'Yes' : 'No');
    console.log('Form Found:', form ? 'Yes' : 'No');

    // Track Category (I am a...) selection
    if (categorySelect) {
      console.log('Adding change listener to category select');
      categorySelect.addEventListener('change', function () {
        var selectedText = this.options[this.selectedIndex].text;
        var selectedValue = this.value;

        console.log(
          '🎯 User Type Selected:',
          selectedText,
          '| Value:',
          selectedValue,
        );

        // Push to dataLayer for GTM
        if (typeof window.dataLayer !== 'undefined') {
          window.dataLayer.push({
            event: 'select_user_type',
            user_type: selectedText,
            user_type_value: selectedValue,
            select_location: 'homepage_header',
          });
          console.log('✅ Event pushed to dataLayer: select_user_type');
        } else {
          console.warn('⚠️ dataLayer not found - GTM may not be installed');
        }
      });
    } else {
      console.error('❌ Category select element not found!');
    }

    // Track Lookup (I'm looking to...) selection
    if (lookupSelect) {
      console.log('Adding change listener to lookup select');
      lookupSelect.addEventListener('change', function () {
        var selectedText = this.options[this.selectedIndex].text;
        var selectedUrl = this.value;

        console.log(
          '🎯 User Interest Selected:',
          selectedText,
          '| URL:',
          selectedUrl,
        );

        // Push to dataLayer for GTM
        if (typeof window.dataLayer !== 'undefined') {
          window.dataLayer.push({
            event: 'select_user_interest',
            user_interest: selectedText,
            destination_url: selectedUrl,
            select_location: 'homepage_header',
          });
          console.log('✅ Event pushed to dataLayer: select_user_interest');
        } else {
          console.warn('⚠️ dataLayer not found - GTM may not be installed');
        }
      });
    } else {
      console.error('❌ Lookup select element not found!');
    }

    // Track form submission (when Go button is clicked)
    if (form) {
      console.log('Adding submit listener to form');
      form.addEventListener('submit', function (e) {
        var categoryText = categorySelect
          ? categorySelect.options[categorySelect.selectedIndex].text
          : '';
        var lookupText = lookupSelect
          ? lookupSelect.options[lookupSelect.selectedIndex].text
          : '';
        var destinationUrl = lookupSelect ? lookupSelect.value : '';

        console.log('🎯 Form Submitted:', {
          userType: categoryText,
          userInterest: lookupText,
          destination: destinationUrl,
        });

        // Push to dataLayer for GTM
        if (typeof window.dataLayer !== 'undefined') {
          window.dataLayer.push({
            event: 'header_form_submit',
            user_type: categoryText,
            user_interest: lookupText,
            destination_url: destinationUrl,
            form_location: 'homepage_header',
          });
          console.log('✅ Event pushed to dataLayer: header_form_submit');
        } else {
          console.warn('⚠️ dataLayer not found - GTM may not be installed');
        }
      });
    } else {
      console.error('❌ Form element not found!');
    }
  });
})();
