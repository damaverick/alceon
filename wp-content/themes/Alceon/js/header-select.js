// /wp-content/themes/Alceon/js/header-select.js
(function () {
  'use strict';

  if (typeof HeaderSelectData === 'undefined') return;

  function onReady(fn) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', fn);
    } else {
      fn();
    }
  }

  onReady(function () {
    var containers = document.querySelectorAll('form.select-container'); // <— scope per form

    if (!containers.length) return;

    var menu2 = HeaderSelectData.menu2 || [];
    var placeholders = HeaderSelectData.placeholders || {};
    var homeUrl = (HeaderSelectData.homeUrl || '').replace(/\/+$/, '') + '/';

    containers.forEach(function (container) {
      // IMPORTANT: query inside the container even though the children have IDs
      var categorySelect = container.querySelector('#category');
      var lookupSelect = container.querySelector('#lookup');
      var goButton = container.querySelector('#go-button');

      if (!categorySelect || !lookupSelect || !goButton) return;

      function resetLookup() {
        lookupSelect.innerHTML = '';
        var ph = document.createElement('option');
        ph.value = '';
        ph.textContent = placeholders.menu2 || "I'm looking to...";
        ph.disabled = true;
        ph.selected = true;
        lookupSelect.appendChild(ph);
        lookupSelect.disabled = true;
        goButton.disabled = true;
      }

      function populate(idx) {
        resetLookup();
        if (
          !(idx >= 0) ||
          !Array.isArray(menu2[idx]) ||
          menu2[idx].length === 0
        )
          return;

        lookupSelect.disabled = false;
        menu2[idx].forEach(function (item) {
          if (!item || !item.label || !item.url) return;
          var opt = document.createElement('option');
          opt.value = item.url;
          opt.textContent = item.label;
          lookupSelect.appendChild(opt);
        });
      }

      // initial
      resetLookup();

      function onCategoryChange() {
        // Get the data-index attribute instead of the value
        var selectedOption =
          categorySelect.options[categorySelect.selectedIndex];
        var idx = selectedOption
          ? parseInt(selectedOption.getAttribute('data-index'), 10)
          : NaN;

        if (Number.isNaN(idx)) {
          resetLookup();
          return;
        }
        populate(idx);
      }

      categorySelect.addEventListener('change', onCategoryChange);
      categorySelect.addEventListener('input', onCategoryChange);

      lookupSelect.addEventListener('change', function () {
        goButton.disabled = !lookupSelect.value;
      });

      container.addEventListener('submit', function (e) {
        e.preventDefault();
        var url = lookupSelect.value;
        if (!url) return;
        var isAbsolute = /^(?:[a-z]+:)?\/\//i.test(url) || url.startsWith('/');
        var target = isAbsolute ? url : homeUrl + url.replace(/^\/+/, '');
        window.location.href = target;
      });
    });
  });
})();
