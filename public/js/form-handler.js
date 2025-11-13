/**
 * Universal Form Handler for Dynamic CMS
 * Handles all form submissions and sends them to the Form Submission API
 */

(function() {
    'use strict';

    /**
     * Initialize form handlers on page load
     */
    document.addEventListener('DOMContentLoaded', function() {
        initializeForms();
    });

    /**
     * Initialize all forms with data-form-type attribute
     */
    function initializeForms() {
        const forms = document.querySelectorAll('[data-form-type]');

        forms.forEach(form => {
            form.addEventListener('submit', handleFormSubmit);
        });

        console.log(`Initialized ${forms.length} form(s)`);
    }

    /**
     * Handle form submission
     */
    async function handleFormSubmit(e) {
        e.preventDefault();

        const form = e.target;
        const formType = form.dataset.formType || 'submission';
        const formName = form.dataset.formName || 'contact_form';
        const pageId = form.dataset.pageId || null;
        const submitButton = form.querySelector('[type="submit"]');
        const originalButtonText = submitButton ? submitButton.innerHTML : '';

        // Disable submit button
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        }

        // Clear previous errors
        clearFormErrors(form);

        // Collect form data
        const formData = new FormData(form);
        const formDataObject = {};

        formData.forEach((value, key) => {
            // Handle checkboxes and multiple values
            if (formDataObject[key]) {
                if (Array.isArray(formDataObject[key])) {
                    formDataObject[key].push(value);
                } else {
                    formDataObject[key] = [formDataObject[key], value];
                }
            } else {
                formDataObject[key] = value;
            }
        });

        // Prepare submission data
        const submissionData = {
            page_id: pageId,
            page_section_id: form.dataset.sectionId || null,
            form_name: formName,
            form_type: formType,
            form_data: formDataObject
        };

        try {
            const response = await fetch('/api/form-submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(submissionData)
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // Success handling
                handleFormSuccess(form, result);

                // Reset form
                form.reset();
            } else {
                // Error handling
                handleFormError(form, result);
            }
        } catch (error) {
            console.error('Form submission error:', error);
            showFormMessage(form, 'An error occurred while submitting the form. Please try again.', 'error');
        } finally {
            // Re-enable submit button
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
            }
        }
    }

    /**
     * Handle successful form submission
     */
    function handleFormSuccess(form, result) {
        // Show success message
        let message = 'Form submitted successfully!';

        // If there's a calculated result, show it
        if (result.calculated_result && Object.keys(result.calculated_result).length > 0) {
            message += '<br><strong>Result:</strong> ' + JSON.stringify(result.calculated_result);
        }

        showFormMessage(form, message, 'success');

        // Trigger custom event for additional handling
        form.dispatchEvent(new CustomEvent('formSubmitSuccess', {
            detail: result
        }));
    }

    /**
     * Handle form submission error
     */
    function handleFormError(form, result) {
        if (result.errors) {
            // Display field-specific errors
            Object.keys(result.errors).forEach(field => {
                const fieldElement = form.querySelector(`[name="${field}"]`);
                if (fieldElement) {
                    fieldElement.classList.add('is-invalid');

                    // Create or update error message
                    let errorDiv = fieldElement.parentElement.querySelector('.invalid-feedback');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        fieldElement.parentElement.appendChild(errorDiv);
                    }
                    errorDiv.textContent = result.errors[field][0];
                }
            });

            showFormMessage(form, 'Please fix the errors and try again.', 'error');
        } else {
            showFormMessage(form, result.message || 'Form submission failed. Please try again.', 'error');
        }
    }

    /**
     * Show form message (success or error)
     */
    function showFormMessage(form, message, type) {
        // Remove existing message
        const existingMessage = form.querySelector('.form-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
        messageDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Insert message at the beginning of the form
        form.insertBefore(messageDiv, form.firstChild);

        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (messageDiv.parentElement) {
                messageDiv.remove();
            }
        }, 5000);

        // Scroll to message
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    /**
     * Clear form errors
     */
    function clearFormErrors(form) {
        // Remove invalid classes
        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });

        // Remove error messages
        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });

        // Remove form message
        const message = form.querySelector('.form-message');
        if (message) {
            message.remove();
        }
    }

    // Make functions globally accessible if needed
    window.FormHandler = {
        initialize: initializeForms,
        submit: handleFormSubmit
    };

})();
