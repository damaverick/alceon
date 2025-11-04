<?php

/**
 * Select Drop Down Component
 *
 * This file contains the HTML, CSS, and JS for the
 * custom-styled dependent dropdown menus.
 */
?>



<form class="select-container mt-5 d-none d-lg-flex">

    <div class="select-wrapper">
        <label for="category" class="visually-hidden">I am a...</label>
        <select id="category" class="custom-select" required>
            <option value="" disabled selected>I am a...</option>
            <option value="institutional">Institutional Investor</option>
            <option value="advisor">Advisor</option>
            <option value="consultant">Consultant</option>
            <option value="individual">Individual</option>
            <option value="family">Family Office</option>
        </select>
    </div>

    <div class="select-wrapper">
        <label for="lookup" class="visually-hidden">I'm looking to...</label>
        <select id="lookup" class="custom-select" required>
            <option value="" disabled selected>I’m looking to...</option>
        </select>
    </div>

    <button id="go-button" class="go-button" type="submit">Go</button>

</form>
<script>
    const options = {
        institutional: [{
                label: 'Learn more about Alceon',
                url: 'about.html'
            },
            {
                label: 'Explore investment options',
                url: 'your-capital.html'
            },
            {
                label: 'Learn how Alceon partners with institutions like yours',
                url: 'institutions.html',
            },
            {
                label: 'Invest in Real Estate',
                url: 'real-estate.html'
            },
            {
                label: 'Invest in Private Equity',
                url: 'private-equity.html'
            },
            {
                label: 'Invest in Credit',
                url: 'credit.html'
            },
            {
                label: 'Invest in Special situations',
                url: 'special-situations.html',
            },
        ],
        advisor: [{
                label: 'Learn more about Alceon',
                url: 'about.html'
            },
            {
                label: 'Explore investment options',
                url: 'your-capital.html'
            },
            {
                label: 'Learn how Alceon partners with advisors like you',
                url: 'advisors.html',
            },
            {
                label: 'Invest in Real Estate',
                url: 'real-estate.html'
            },
            {
                label: 'Invest in Private Equity',
                url: 'private-equity.html'
            },
            {
                label: 'Invest in Credit',
                url: 'credit.html'
            },
            {
                label: 'Invest in Special situations',
                url: 'special-situations.html',
            },
        ],
        consultant: [{
                label: 'Learn more about Alceon',
                url: 'about.html'
            },
            {
                label: 'Explore investment options',
                url: 'your-capital.html'
            },
            {
                label: 'Learn how Alceon partners with consultants like you',
                url: 'advisors.html',
            },
            {
                label: 'Invest in Real Estate',
                url: 'real-estate.html'
            },
            {
                label: 'Invest in Private Equity',
                url: 'private-equity.html'
            },
            {
                label: 'Invest in Credit',
                url: 'credit.html'
            },
            {
                label: 'Invest in Special situations',
                url: 'special-situations.html',
            },
        ],
        individual: [{
                label: 'Learn more about Alceon',
                url: 'about.html'
            },
            {
                label: 'Explore investment options',
                url: 'your-capital.html'
            },
            {
                label: 'Learn how Alceon partners with individuals like you',
                url: 'individuals.html',
            },
            {
                label: 'Invest in Real Estate',
                url: 'real-estate.html'
            },
            {
                label: 'Invest in Private Equity',
                url: 'private-equity.html'
            },
            {
                label: 'Invest in Credit',
                url: 'credit.html'
            },
            {
                label: 'Invest in Special situations',
                url: 'special-situations.html',
            },
        ],
        family: [{
            label: 'Learn more about Alceon',
            url: 'about.html'
        }],
    };

    const categorySelect = document.getElementById('category');
    const lookupSelect = document.getElementById('lookup');
    const goButton = document.getElementById('go-button'); // <-- Get the button

    categorySelect.addEventListener('change', function() {
        const selected = this.value;

        // Clear previous options
        lookupSelect.innerHTML = '';

        // Add the placeholder
        const placeholder = document.createElement('option');
        placeholder.value = ""; // Empty value
        placeholder.textContent = "I’m looking to...";
        placeholder.disabled = true;
        placeholder.selected = true;
        lookupSelect.appendChild(placeholder);

        // Enable the select and disable the Go button
        lookupSelect.disabled = false;
        goButton.disabled = true;

        if (!selected) return;

        options[selected].forEach((item) => {
            const opt = document.createElement('option');
            opt.value = item.url;
            opt.textContent = item.label;
            lookupSelect.appendChild(opt);
        });
    });

    // NEW LOGIC: Enable Go button when a valid choice is made
    lookupSelect.addEventListener('change', function() {
        if (this.value) {
            goButton.disabled = false; // Enable the button
        } else {
            goButton.disabled = true; // Disable if they re-select the placeholder
        }
    });

    // NEW LOGIC: Make the Go button redirect
    goButton.addEventListener('click', function(e) {
        e.preventDefault(); // Stop the form from submitting

        const url = lookupSelect.value;

        if (url) {
            // Use WordPress's home_url function to build a safe, absolute URL
            window.location.href = '<?php echo esc_url(home_url('/')); ?>' + url;
        }
    });

    // Disable the second select and Go button on page load
    document.addEventListener('DOMContentLoaded', () => {
        lookupSelect.disabled = true;
        goButton.disabled = true;
    });
</script>