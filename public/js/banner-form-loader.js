/**
 * Banner and Form Loader for Page Builder
 * Loads banners and forms from database and adds them to GrapesJS
 */

(function() {
    'use strict';

    window.BannerFormLoader = {
        editor: null,

        /**
         * Initialize the loader
         */
        init: function(editor) {
            this.editor = editor;
            this.loadBanners();
            this.loadForms();
            this.setupFormSubmissionHandler();
        },

        /**
         * Load banners from database and add to block manager
         */
        loadBanners: async function() {
            try {
                const response = await fetch('/admin/banners/list', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load banners');
                }

                const data = await response.json();

                if (data.success && data.banners) {
                    console.log(`✅ Loaded ${data.banners.length} banners`);

                    data.banners.forEach(banner => {
                        this.addBannerBlock(banner);
                    });
                }
            } catch (error) {
                console.error('Error loading banners:', error);
            }
        },

        /**
         * Add a banner as a GrapesJS block
         */
        addBannerBlock: function(banner) {
            const blockId = `banner-${banner.id}`;

            // Get icon based on banner type
            const icons = {
                'hero': '🎯',
                'promotional': '🎉',
                'image': '🖼️',
                'video': '🎥',
                'slider': '🎢'
            };
            const icon = icons[banner.banner_type] || '🎯';

            this.editor.BlockManager.add(blockId, {
                label: `${icon} ${banner.name}`,
                category: '🎯 Banners',
                content: banner.html,
                media: `<div style="padding: 10px; text-align: center;">
                    <div style="font-size: 24px;">${icon}</div>
                    <div style="font-size: 10px; margin-top: 5px;">${banner.banner_type}</div>
                </div>`,
                attributes: {
                    title: `${banner.title} - ${banner.banner_type} banner`,
                    'data-banner-id': banner.id
                }
            });
        },

        /**
         * Load forms from database and add to block manager
         */
        loadForms: async function() {
            try {
                const response = await fetch('/admin/forms/list', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load forms');
                }

                const data = await response.json();

                if (data.success && data.forms) {
                    console.log(`✅ Loaded ${data.forms.length} forms`);

                    data.forms.forEach(form => {
                        this.addFormBlock(form);
                    });
                }
            } catch (error) {
                console.error('Error loading forms:', error);
            }
        },

        /**
         * Add a form as a GrapesJS block
         */
        addFormBlock: function(form) {
            const blockId = `form-${form.id}`;

            // Get icon based on form type
            const icons = {
                'submission': '📝',
                'calculation': '🧮',
                'action': '⚡'
            };
            const icon = icons[form.form_type] || '📝';

            this.editor.BlockManager.add(blockId, {
                label: `${icon} ${form.name}`,
                category: '📝 Forms',
                content: form.html,
                media: `<div style="padding: 10px; text-align: center;">
                    <div style="font-size: 24px;">${icon}</div>
                    <div style="font-size: 10px; margin-top: 5px;">${form.form_type}</div>
                </div>`,
                attributes: {
                    title: `${form.title} - ${form.form_type} form`,
                    'data-form-id': form.id
                }
            });
        },

        /**
         * Setup form submission handler for frontend
         */
        setupFormSubmissionHandler: function() {
            // This will be added to the saved page's HTML
            const handlerScript = `
<script>
(function() {
    'use strict';

    // Handle all form submissions on the page
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form[data-form-id]');

        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                handleFormSubmit(form);
            });

            // Setup calculation forms
            if (form.dataset.formType === 'calculation') {
                setupCalculationForm(form);
            }
        });
    });

    function handleFormSubmit(form) {
        const formId = form.dataset.formId;
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        const resultDiv = document.getElementById(form.id + '-result');

        // Disable submit button
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';
        }

        // Clear previous messages
        if (resultDiv) {
            resultDiv.style.display = 'none';
            resultDiv.innerHTML = '';
        }

        // Submit via AJAX
        fetch('/api/forms/submit', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            if (resultDiv) {
                resultDiv.style.display = 'block';

                if (data.success) {
                    resultDiv.innerHTML = '<div class="alert alert-success">' +
                        (data.message || 'Form submitted successfully!') +
                    '</div>';

                    // Reset form
                    form.reset();

                    // Redirect if specified
                    if (data.redirect) {
                        setTimeout(function() {
                            window.location.href = data.redirect;
                        }, 2000);
                    }
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-danger">' +
                        (data.message || 'An error occurred. Please try again.') +
                    '</div>';
                }
            }
        })
        .catch(error => {
            console.error('Form submission error:', error);
            if (resultDiv) {
                resultDiv.style.display = 'block';
                resultDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
            }
        })
        .finally(() => {
            // Re-enable submit button
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = submitBtn.getAttribute('data-original-text') || 'Submit';
            }
        });
    }

    function setupCalculationForm(form) {
        const calculationFields = form.querySelectorAll('.calculation-field');

        calculationFields.forEach(function(field) {
            field.addEventListener('input', function() {
                // Calculation logic is already in the form's inline script
                // This is just to trigger any additional logic if needed
            });
        });
    }
})();
</script>
            `;

            // Store this script to be added when saving the page
            if (typeof window.formHandlerScript === 'undefined') {
                window.formHandlerScript = handlerScript;
            }
        }
    };

    console.log('✅ Banner & Form Loader initialized');
})();
