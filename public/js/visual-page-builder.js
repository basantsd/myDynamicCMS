/**
 * Visual Page Builder with Dynamic Custom Blocks
 * Handles block management, drag & drop, forms, tables, sliders, etc.
 */

class VisualPageBuilder {
    constructor(pageId) {
        this.pageId = pageId;
        this.blocks = [];
        this.customBlockTemplates = [];
        this.currentEditingBlock = null;
        this.init();
    }

    async init() {
        await this.loadCustomBlockTemplates();
        await this.loadPageBlocks();
        this.initializeEventListeners();
        this.makeSortable();
    }

    /**
     * Load all available custom block templates
     */
    async loadCustomBlockTemplates() {
        try {
            const response = await fetch('/admin/custom-blocks/list?active=true');
            const data = await response.json();
            if (data.success) {
                this.customBlockTemplates = data.blocks;
                this.renderBlockPicker();
            }
        } catch (error) {
            console.error('Error loading block templates:', error);
        }
    }

    /**
     * Load existing blocks for this page
     */
    async loadPageBlocks() {
        try {
            const response = await fetch(`/admin/pages/${this.pageId}/sections`);
            const data = await response.json();
            if (data.success) {
                this.blocks = data.sections;
                this.renderBlocks();
            }
        } catch (error) {
            console.error('Error loading page blocks:', error);
        }
    }

    /**
     * Render block picker panel
     */
    renderBlockPicker() {
        const pickerContainer = document.getElementById('block-picker');
        if (!pickerContainer) return;

        // Group blocks by category
        const groupedBlocks = this.groupBlocksByCategory();

        let html = '<div class="block-picker-categories">';

        Object.keys(groupedBlocks).forEach(category => {
            html += `
                <div class="block-category">
                    <h5 class="category-title">${category}</h5>
                    <div class="block-templates-grid">
            `;

            groupedBlocks[category].forEach(block => {
                html += `
                    <div class="block-template" data-block-id="${block.id}" style="border-left: 4px solid ${block.color}">
                        <div class="block-icon">
                            <i class="fas ${block.icon}" style="color: ${block.color}"></i>
                        </div>
                        <div class="block-info">
                            <span class="block-name">${block.name}</span>
                            <small class="block-description">${block.description || ''}</small>
                            ${block.usage_count > 0 ? `<span class="badge bg-secondary">${block.usage_count} uses</span>` : ''}
                        </div>
                        <button class="btn btn-sm btn-primary add-block-btn" data-block-id="${block.id}">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                `;
            });

            html += `
                    </div>
                </div>
            `;
        });

        html += '</div>';
        pickerContainer.innerHTML = html;

        // Add click handlers
        document.querySelectorAll('.add-block-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const blockId = btn.getAttribute('data-block-id');
                this.openBlockForm(blockId);
            });
        });
    }

    /**
     * Group blocks by category
     */
    groupBlocksByCategory() {
        const grouped = {};
        this.customBlockTemplates.forEach(block => {
            const category = block.category_name || block.category || 'Other';
            if (!grouped[category]) {
                grouped[category] = [];
            }
            grouped[category].push(block);
        });
        return grouped;
    }

    /**
     * Render blocks in the page builder
     */
    renderBlocks() {
        const blocksContainer = document.getElementById('page-blocks-container');
        if (!blocksContainer) return;

        if (this.blocks.length === 0) {
            blocksContainer.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-cube fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No blocks added yet. Select a block from the left panel to get started.</p>
                </div>
            `;
            return;
        }

        let html = '';
        this.blocks.forEach((block, index) => {
            const customBlock = this.customBlockTemplates.find(t => t.id === block.custom_block_id);
            const blockColor = customBlock?.color || '#3498db';
            const blockIcon = customBlock?.icon || 'fa-cube';

            html += `
                <div class="page-block" data-block-id="${block.id}" data-order="${index}">
                    <div class="block-header" style="background: linear-gradient(135deg, ${blockColor}15, ${blockColor}05);">
                        <div class="block-drag-handle">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        <div class="block-title">
                            <i class="fas ${blockIcon}" style="color: ${blockColor}"></i>
                            <span>${block.name || customBlock?.name || 'Untitled Block'}</span>
                            <span class="badge" style="background-color: ${blockColor}20; color: ${blockColor}">
                                ${customBlock?.category || 'Block'}
                            </span>
                        </div>
                        <div class="block-actions">
                            <button class="btn btn-sm btn-outline-primary edit-block-btn" data-block-id="${block.id}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-outline-secondary duplicate-block-btn" data-block-id="${block.id}">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger delete-block-btn" data-block-id="${block.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-preview">
                        ${this.renderBlockPreview(block, customBlock)}
                    </div>
                    <div class="block-hover-actions">
                        <button class="btn btn-primary btn-sm add-block-above" data-index="${index}">
                            <i class="fas fa-plus"></i> Add Block Above
                        </button>
                    </div>
                </div>
            `;
        });

        blocksContainer.innerHTML = html;

        // Add event listeners
        this.attachBlockEventListeners();
    }

    /**
     * Render block preview based on type
     */
    renderBlockPreview(block, customBlock) {
        const content = block.content || {};

        // Different previews based on block category
        if (customBlock) {
            switch (customBlock.category) {
                case 'slider':
                    return this.renderSliderPreview(content);
                case 'table':
                    return this.renderTablePreview(content);
                case 'form':
                    return this.renderFormPreview(content);
                case 'button':
                    return this.renderButtonPreview(content);
                case 'list':
                    return this.renderListPreview(content);
                default:
                    return this.renderGenericPreview(content);
            }
        }

        return this.renderGenericPreview(content);
    }

    /**
     * Render slider preview
     */
    renderSliderPreview(content) {
        if (!content.slides || content.slides.length === 0) {
            return '<p class="text-muted">No slides added</p>';
        }

        return `
            <div class="slider-preview">
                <div class="badge bg-info">${content.slides.length} Slides</div>
                <div class="slides-thumbnails">
                    ${content.slides.slice(0, 3).map((slide, i) => `
                        <div class="slide-thumb">
                            ${slide.image ? `<img src="${slide.image}" alt="Slide ${i+1}">` : `<div class="slide-placeholder">${i+1}</div>`}
                        </div>
                    `).join('')}
                    ${content.slides.length > 3 ? `<div class="more-slides">+${content.slides.length - 3}</div>` : ''}
                </div>
                ${content.autoplay ? '<span class="badge bg-success"><i class="fas fa-play"></i> Autoplay</span>' : ''}
            </div>
        `;
    }

    /**
     * Render table preview
     */
    renderTablePreview(content) {
        if (!content.table_data) {
            return '<p class="text-muted">No table data</p>';
        }

        const { headers, rows } = content.table_data;

        return `
            <div class="table-preview">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                ${headers.map(h => `<th>${h}</th>`).join('')}
                            </tr>
                        </thead>
                        <tbody>
                            ${rows.slice(0, 3).map(row => `
                                <tr>
                                    ${row.map(cell => `<td>${cell}</td>`).join('')}
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
                <div class="text-muted small">${rows.length} rows × ${headers.length} columns</div>
            </div>
        `;
    }

    /**
     * Render form preview
     */
    renderFormPreview(content) {
        if (!content.form_fields || content.form_fields.length === 0) {
            return '<p class="text-muted">No form fields</p>';
        }

        return `
            <div class="form-preview">
                <strong>${content.form_title || 'Form'}</strong>
                <div class="form-fields-list">
                    ${content.form_fields.map(field => `
                        <div class="form-field-preview">
                            <i class="fas fa-${this.getFieldIcon(field.type)}"></i>
                            <span>${field.label}</span>
                            ${field.required ? '<span class="badge bg-danger">Required</span>' : ''}
                        </div>
                    `).join('')}
                </div>
                ${content.form_type ? `<span class="badge bg-primary">${content.form_type}</span>` : ''}
            </div>
        `;
    }

    /**
     * Render button preview
     */
    renderButtonPreview(content) {
        const buttons = content.buttons || [content];

        return `
            <div class="button-preview">
                ${Array.isArray(buttons) ? buttons.map(btn => `
                    <button class="btn btn-${btn.style || 'primary'} btn-sm">
                        ${btn.text || 'Button'}
                        ${btn.action_type === 'download' ? '<i class="fas fa-download"></i>' : ''}
                        ${btn.action_type === 'redirect' ? '<i class="fas fa-external-link-alt"></i>' : ''}
                    </button>
                `).join(' ') : ''}
            </div>
        `;
    }

    /**
     * Render list preview
     */
    renderListPreview(content) {
        const items = content.items || [];

        return `
            <div class="list-preview">
                <ul class="list-unstyled">
                    ${items.slice(0, 5).map(item => `
                        <li>
                            ${item.icon ? `<i class="fas ${item.icon}"></i>` : '•'}
                            ${item.text || item.title}
                        </li>
                    `).join('')}
                </ul>
                ${items.length > 5 ? `<small class="text-muted">...and ${items.length - 5} more items</small>` : ''}
            </div>
        `;
    }

    /**
     * Render generic content preview
     */
    renderGenericPreview(content) {
        let html = '<div class="generic-preview">';

        if (content.heading) {
            html += `<h5>${content.heading}</h5>`;
        }
        if (content.subheading) {
            html += `<p class="text-muted">${content.subheading}</p>`;
        }
        if (content.description) {
            html += `<p>${content.description.substring(0, 100)}${content.description.length > 100 ? '...' : ''}</p>`;
        }
        if (content.background_image) {
            html += `<div class="preview-image"><img src="${content.background_image}" alt="Background"></div>`;
        }

        html += '</div>';
        return html;
    }

    /**
     * Get icon for form field type
     */
    getFieldIcon(type) {
        const icons = {
            text: 'font',
            email: 'envelope',
            tel: 'phone',
            textarea: 'align-left',
            select: 'caret-down',
            checkbox: 'check-square',
            radio: 'dot-circle',
            file: 'file-upload'
        };
        return icons[type] || 'input';
    }

    /**
     * Attach event listeners to block elements
     */
    attachBlockEventListeners() {
        // Edit block
        document.querySelectorAll('.edit-block-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const blockId = btn.getAttribute('data-block-id');
                this.editBlock(blockId);
            });
        });

        // Duplicate block
        document.querySelectorAll('.duplicate-block-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const blockId = btn.getAttribute('data-block-id');
                this.duplicateBlock(blockId);
            });
        });

        // Delete block
        document.querySelectorAll('.delete-block-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const blockId = btn.getAttribute('data-block-id');
                this.deleteBlock(blockId);
            });
        });

        // Add block above
        document.querySelectorAll('.add-block-above').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const index = parseInt(btn.getAttribute('data-index'));
                this.showBlockPicker(index);
            });
        });
    }

    /**
     * Make blocks sortable with drag & drop
     */
    makeSortable() {
        const container = document.getElementById('page-blocks-container');
        if (!container) return;

        new Sortable(container, {
            animation: 150,
            handle: '.block-drag-handle',
            ghostClass: 'block-ghost',
            onEnd: (evt) => {
                this.updateBlockOrder();
            }
        });
    }

    /**
     * Update block order after drag & drop
     */
    async updateBlockOrder() {
        const blockElements = document.querySelectorAll('.page-block');
        const blockIds = Array.from(blockElements).map(el => el.getAttribute('data-block-id'));

        try {
            const response = await fetch('/admin/page-sections/reorder', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ sections: blockIds })
            });

            if (!response.ok) {
                throw new Error('Failed to update order');
            }

            this.showNotification('Block order updated', 'success');
        } catch (error) {
            console.error('Error updating order:', error);
            this.showNotification('Failed to update order', 'error');
        }
    }

    /**
     * Initialize event listeners
     */
    initializeEventListeners() {
        // Search blocks
        const searchInput = document.getElementById('block-search');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.filterBlocks(e.target.value);
            });
        }

        // Category filter
        const categoryFilter = document.getElementById('category-filter');
        if (categoryFilter) {
            categoryFilter.addEventListener('change', (e) => {
                this.filterBlocksByCategory(e.target.value);
            });
        }
    }

    // Continued in Part 2...
}

// Export for global use
window.VisualPageBuilder = VisualPageBuilder;
