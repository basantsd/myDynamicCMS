/**
 * Visual Page Builder - Form Handling & Block Modals
 * Part 2: Dynamic form generation and block editing
 */

// Extend VisualPageBuilder with form handling methods
Object.assign(VisualPageBuilder.prototype, {
    /**
     * Open block form modal
     */
    async openBlockForm(blockTemplateId, existingBlockId = null) {
        const template = this.customBlockTemplates.find(t => t.id == blockTemplateId);
        if (!template) {
            console.error('Template not found');
            return;
        }

        this.currentEditingBlock = existingBlockId ? this.blocks.find(b => b.id == existingBlockId) : null;

        // Generate form based on schema
        const formHtml = this.generateBlockForm(template, this.currentEditingBlock);

        // Show modal
        this.showModal({
            title: `${existingBlockId ? 'Edit' : 'Add'} ${template.name}`,
            content: formHtml,
            size: 'xl',
            footer: `
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="visualPageBuilder.saveBlock(${blockTemplateId}, ${existingBlockId})">
                    ${existingBlockId ? 'Update' : 'Add'} Block
                </button>
            `
        });

        // Initialize form-specific components
        this.initializeFormComponents(template);
    }

    /**
     * Generate dynamic form based on block schema
     */
    generateBlockForm(template, existingBlock) {
        const schema = template.schema;
        const content = existingBlock?.content || template.default_values || {};

        let html = `
            <form id="block-form" class="block-form" data-template-id="${template.id}">
                <input type="hidden" name="custom_block_id" value="${template.id}">
                ${existingBlock ? `<input type="hidden" name="block_id" value="${existingBlock.id}">` : ''}

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Block Name (Optional)</label>
                        <input type="text" class="form-control" name="name" value="${existingBlock?.name || ''}" placeholder="e.g., Homepage Hero Section">
                    </div>
                </div>
        `;

        if (schema && schema.fields) {
            schema.fields.forEach(field => {
                html += this.generateFormField(field, content[field.name]);
            });
        }

        // Add specialized sections based on category
        switch (template.category) {
            case 'slider':
                html += this.generateSliderControls(content);
                break;
            case 'table':
                html += this.generateTableControls(content);
                break;
            case 'form':
                html += this.generateFormControls(content);
                break;
            case 'button':
                html += this.generateButtonControls(content);
                break;
        }

        html += '</form>';
        return html;
    }

    /**
     * Generate individual form field
     */
    generateFormField(field, value = null) {
        const fieldValue = value !== null && value !== undefined ? value : (field.default || '');
        const required = field.required ? 'required' : '';
        const fieldId = `field_${field.name}`;

        let html = '<div class="mb-3">';
        html += `<label for="${fieldId}" class="form-label">${field.label}${field.required ? ' <span class="text-danger">*</span>' : ''}</label>`;

        switch (field.type) {
            case 'text':
                html += `<input type="text" class="form-control" id="${fieldId}" name="${field.name}" value="${fieldValue}" ${required}>`;
                break;

            case 'textarea':
                html += `<textarea class="form-control" id="${fieldId}" name="${field.name}" rows="3" ${required}>${fieldValue}</textarea>`;
                break;

            case 'wysiwyg':
                html += `<textarea class="form-control wysiwyg-editor" id="${fieldId}" name="${field.name}" rows="5" ${required}>${fieldValue}</textarea>`;
                break;

            case 'image':
                html += `
                    <div class="image-upload-field">
                        <input type="file" class="form-control" id="${fieldId}" name="${field.name}" accept="image/*">
                        ${fieldValue ? `<div class="current-image mt-2"><img src="${fieldValue}" style="max-width: 200px;"><input type="hidden" name="${field.name}_current" value="${fieldValue}"></div>` : ''}
                    </div>
                `;
                break;

            case 'video':
                html += `<input type="url" class="form-control" id="${fieldId}" name="${field.name}" value="${fieldValue}" placeholder="https://..." ${required}>`;
                break;

            case 'color':
                html += `<input type="color" class="form-control form-control-color" id="${fieldId}" name="${field.name}" value="${fieldValue || '#000000'}" ${required}>`;
                break;

            case 'number':
                html += `<input type="number" class="form-control" id="${fieldId}" name="${field.name}" value="${fieldValue}" ${required}>`;
                break;

            case 'range':
                const min = field.min || 0;
                const max = field.max || 100;
                html += `
                    <div class="range-field">
                        <input type="range" class="form-range" id="${fieldId}" name="${field.name}" min="${min}" max="${max}" value="${fieldValue || min}">
                        <span class="range-value">${fieldValue || min}</span>
                    </div>
                `;
                break;

            case 'select':
                html += `<select class="form-select" id="${fieldId}" name="${field.name}" ${required}>`;
                if (field.options) {
                    field.options.forEach(option => {
                        const selected = fieldValue === option ? 'selected' : '';
                        html += `<option value="${option}" ${selected}>${option}</option>`;
                    });
                }
                html += '</select>';
                break;

            case 'toggle':
                const checked = fieldValue ? 'checked' : '';
                html += `
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="${fieldId}" name="${field.name}" ${checked}>
                    </div>
                `;
                break;

            case 'icon':
                html += `
                    <div class="icon-picker">
                        <input type="text" class="form-control" id="${fieldId}" name="${field.name}" value="${fieldValue}" placeholder="fa-star">
                        <button type="button" class="btn btn-outline-secondary" onclick="visualPageBuilder.openIconPicker('${fieldId}')">
                            <i class="fas ${fieldValue || 'fa-icons'}"></i> Choose Icon
                        </button>
                    </div>
                `;
                break;

            case 'button':
                html += this.generateButtonField(field, fieldValue);
                break;

            case 'repeater':
                html += this.generateRepeaterField(field, fieldValue);
                break;

            case 'table':
                html += this.generateTableField(field, fieldValue);
                break;
        }

        if (field.help) {
            html += `<small class="form-text text-muted">${field.help}</small>`;
        }

        html += '</div>';
        return html;
    }

    /**
     * Generate button configuration field
     */
    generateButtonField(field, value) {
        const buttonData = value || { text: '', url: '', style: 'primary' };

        return `
            <div class="button-field">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="${field.name}[text]" placeholder="Button Text" value="${buttonData.text || ''}">
                    </div>
                    <div class="col-md-4">
                        <input type="url" class="form-control" name="${field.name}[url]" placeholder="URL" value="${buttonData.url || ''}">
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="${field.name}[style]">
                            <option value="primary" ${buttonData.style === 'primary' ? 'selected' : ''}>Primary</option>
                            <option value="secondary" ${buttonData.style === 'secondary' ? 'selected' : ''}>Secondary</option>
                            <option value="outline" ${buttonData.style === 'outline' ? 'selected' : ''}>Outline</option>
                            <option value="success" ${buttonData.style === 'success' ? 'selected' : ''}>Success</option>
                            <option value="danger" ${buttonData.style === 'danger' ? 'selected' : ''}>Danger</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <select class="form-select" name="${field.name}[action_type]">
                            <option value="link" ${buttonData.action_type === 'link' ? 'selected' : ''}>Link</option>
                            <option value="download" ${buttonData.action_type === 'download' ? 'selected' : ''}>Download</option>
                            <option value="redirect" ${buttonData.action_type === 'redirect' ? 'selected' : ''}>Redirect</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="${field.name}[target]">
                            <option value="_self" ${buttonData.target === '_self' ? 'selected' : ''}>Same Tab</option>
                            <option value="_blank" ${buttonData.target === '_blank' ? 'selected' : ''}>New Tab</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Generate repeater field
     */
    generateRepeaterField(field, value) {
        const items = Array.isArray(value) ? value : [];

        let html = `
            <div class="repeater-field" data-field-name="${field.name}">
                <div class="repeater-items">
        `;

        items.forEach((item, index) => {
            html += this.generateRepeaterItem(field, item, index);
        });

        html += `
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm add-repeater-item" data-field-name="${field.name}">
                    <i class="fas fa-plus"></i> Add ${field.label}
                </button>
            </div>
        `;

        return html;
    }

    /**
     * Generate single repeater item
     */
    generateRepeaterItem(field, item, index) {
        let html = `
            <div class="repeater-item" data-index="${index}">
                <div class="repeater-item-header">
                    <span class="repeater-item-handle"><i class="fas fa-grip-vertical"></i></span>
                    <span class="repeater-item-title">${field.label} ${index + 1}</span>
                    <button type="button" class="btn btn-sm btn-danger remove-repeater-item">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="repeater-item-content">
        `;

        if (field.fields) {
            field.fields.forEach(subField => {
                const subValue = item[subField.name];
                html += this.generateFormField(
                    { ...subField, name: `${field.name}[${index}][${subField.name}]` },
                    subValue
                );
            });
        }

        html += `
                </div>
            </div>
        `;

        return html;
    }

    /**
     * Generate table field with CSV import
     */
    generateTableField(field, value) {
        const tableData = value || { headers: [], rows: [] };

        return `
            <div class="table-field">
                <div class="table-controls mb-2">
                    <button type="button" class="btn btn-sm btn-primary" onclick="visualPageBuilder.addTableColumn()">
                        <i class="fas fa-plus"></i> Add Column
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('csv-upload').click()">
                        <i class="fas fa-file-csv"></i> Import CSV
                    </button>
                    <input type="file" id="csv-upload" style="display:none" accept=".csv" onchange="visualPageBuilder.importCSV(this)">
                </div>

                <div id="table-editor" class="table-responsive">
                    <table class="table table-bordered editable-table">
                        <thead>
                            <tr>
                                ${tableData.headers.map((header, i) => `
                                    <th contenteditable="true" data-column="${i}">${header}</th>
                                `).join('')}
                            </tr>
                        </thead>
                        <tbody>
                            ${tableData.rows.map((row, rowIndex) => `
                                <tr data-row="${rowIndex}">
                                    ${row.map((cell, colIndex) => `
                                        <td contenteditable="true" data-row="${rowIndex}" data-col="${colIndex}">${cell}</td>
                                    `).join('')}
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="${field.name}" id="table-data" value='${JSON.stringify(tableData)}'>
            </div>
        `;
    }

    /**
     * Generate slider-specific controls
     */
    generateSliderControls(content) {
        return `
            <div class="slider-controls border-top pt-3 mt-3">
                <h6>Slider Settings</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Autoplay</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="autoplay" ${content.autoplay ? 'checked' : ''}>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slide Interval (seconds)</label>
                        <input type="number" class="form-control" name="interval" value="${content.interval || 5}" min="1" max="30">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Transition Effect</label>
                        <select class="form-select" name="transition">
                            <option value="slide" ${content.transition === 'slide' ? 'selected' : ''}>Slide</option>
                            <option value="fade" ${content.transition === 'fade' ? 'selected' : ''}>Fade</option>
                            <option value="zoom" ${content.transition === 'zoom' ? 'selected' : ''}>Zoom</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Navigation Style</label>
                        <select class="form-select" name="navigation_style">
                            <option value="arrows" ${content.navigation_style === 'arrows' ? 'selected' : ''}>Arrows</option>
                            <option value="dots" ${content.navigation_style === 'dots' ? 'selected' : ''}>Dots</option>
                            <option value="both" ${content.navigation_style === 'both' ? 'selected' : ''}>Both</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Generate table-specific controls
     */
    generateTableControls(content) {
        return `
            <div class="table-settings border-top pt-3 mt-3">
                <h6>Table Settings</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Table Style</label>
                        <select class="form-select" name="table_style">
                            <option value="default" ${content.table_style === 'default' ? 'selected' : ''}>Default</option>
                            <option value="striped" ${content.table_style === 'striped' ? 'selected' : ''}>Striped</option>
                            <option value="bordered" ${content.table_style === 'bordered' ? 'selected' : ''}>Bordered</option>
                            <option value="hover" ${content.table_style === 'hover' ? 'selected' : ''}>Hover</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Table Actions</label>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="visualPageBuilder.enableTableSorting()">
                                <i class="fas fa-sort"></i> Sortable
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="visualPageBuilder.exportTableAsCSV()">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    /**
     * Generate form-specific controls
     */
    generateFormControls(content) {
        return `
            <div class="form-settings border-top pt-3 mt-3">
                <h6>Form Settings</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Form Type</label>
                        <select class="form-select" name="form_type">
                            <option value="submission" ${content.form_type === 'submission' ? 'selected' : ''}>Submission</option>
                            <option value="calculation" ${content.form_type === 'calculation' ? 'selected' : ''}>Calculation</option>
                            <option value="action" ${content.form_type === 'action' ? 'selected' : ''}>Action</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Submit Button Text</label>
                        <input type="text" class="form-control" name="submit_button_text" value="${content.submit_button_text || 'Submit'}">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-info" onclick="visualPageBuilder.viewFormSubmissions()">
                        <i class="fas fa-list"></i> View Submissions
                    </button>
                </div>
            </div>
        `;
    }

    /**
     * Generate button-specific controls
     */
    generateButtonControls(content) {
        return `
            <div class="button-settings border-top pt-3 mt-3">
                <h6>Button Settings</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Button Alignment</label>
                        <select class="form-select" name="button_alignment">
                            <option value="left" ${content.button_alignment === 'left' ? 'selected' : ''}>Left</option>
                            <option value="center" ${content.button_alignment === 'center' ? 'selected' : ''}>Center</option>
                            <option value="right" ${content.button_alignment === 'right' ? 'selected' : ''}>Right</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Button Size</label>
                        <select class="form-select" name="button_size">
                            <option value="sm" ${content.button_size === 'sm' ? 'selected' : ''}>Small</option>
                            <option value="md" ${content.button_size === 'md' ? 'selected' : ''}>Medium</option>
                            <option value="lg" ${content.button_size === 'lg' ? 'selected' : ''}>Large</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
    },

    // Continued in CSS and helpers file...
});
