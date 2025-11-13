/**
 * Enhanced Dynamic Custom Blocks Loader for GrapesJS
 * Loads blocks from database with full template support, traits, and actions
 * Version: 2.0.0
 */

(function (editor) {
    if (!editor) {
        console.error('❌ GrapesJS editor not found!');
        return;
    }

    const blockManager = editor.BlockManager;
    const domComponents = editor.DomComponents;
    const commands = editor.Commands;

    console.log('🚀 Initializing Enhanced Dynamic Blocks Loader...');

    // Configuration
    const config = {
        apiEndpoint: '/admin/custom-blocks/list',
        uploadEndpoint: '/admin/upload',
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.content || '',
    };

    // Template engine for replacing placeholders
    const TemplateEngine = {
        render(template, data) {
            if (!template) return '';
            
            let result = template;
            
            // Simple {{variable}} replacement
            result = result.replace(/\{\{(\w+)\}\}/g, (match, key) => {
                return data[key] !== undefined ? data[key] : match;
            });

            // Handle {{#if condition}} blocks
            result = result.replace(/\{\{#if\s+(\w+)\}\}([\s\S]*?)\{\{\/if\}\}/g, (match, condition, content) => {
                return data[condition] ? content : '';
            });

            // Handle {{#each array}} loops
            result = result.replace(/\{\{#each\s+(\w+)\}\}([\s\S]*?)\{\{\/each\}\}/g, (match, arrayName, itemTemplate) => {
                const array = data[arrayName];
                if (!Array.isArray(array)) return '';
                
                return array.map((item, index) => {
                    let itemHtml = itemTemplate;
                    // Replace item properties
                    itemHtml = itemHtml.replace(/\{\{(\w+)\}\}/g, (m, key) => {
                        return item[key] !== undefined ? item[key] : m;
                    });
                    // Replace @index
                    itemHtml = itemHtml.replace(/\{\{@index\}\}/g, index);
                    // Replace @first
                    itemHtml = itemHtml.replace(/\{\{#if\s+@first\}\}(.*?)\{\{\/if\}\}/g, index === 0 ? '$1' : '');
                    return itemHtml;
                }).join('');
            });

            return result;
        }
    };

    // Fetch and load custom blocks
    fetch(config.apiEndpoint, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': config.csrfToken,
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success || !data.blocks) {
            console.error('❌ Failed to load custom blocks');
            return;
        }

        // Group blocks by category
        const categories = {};
        data.blocks.forEach(block => {
            if (!categories[block.category]) {
                categories[block.category] = [];
            }
            categories[block.category].push(block);
        });

        // Reset block manager categories
        blockManager.getCategories().reset();

        // Add categories with icons
        const categoryIcons = {
            'hero': '🎯',
            'slider': '🎢',
            'table': '📋',
            'form': '📝',
            'feature': '✨',
            'content': '📄',
            'footer': '🦶',
            'button': '🔘',
            'list': '📝'
        };

        Object.keys(categories).forEach(categoryKey => {
            const icon = categoryIcons[categoryKey] || '📦';
            blockManager.getCategories().add({
                id: categoryKey,
                label: `${icon} ${categoryKey.charAt(0).toUpperCase() + categoryKey.slice(1)}`,
                open: categoryKey === 'hero'
            });
        });

        // Load each block
        let loadedCount = 0;
        data.blocks.forEach(block => {
            try {
                loadCustomBlock(block);
                loadedCount++;
            } catch (error) {
                console.error(`❌ Error loading block "${block.name}":`, error);
            }
        });

        console.log(`✅ Successfully loaded ${loadedCount} custom blocks`);
        
        // Register custom commands for dynamic actions
        registerCustomCommands();
    })
    .catch(error => {
        console.error('❌ Error loading custom blocks:', error);
    });

    /**
     * Load a custom block into GrapesJS
     */
    function loadCustomBlock(blockData) {
        const blockId = `custom-block-${blockData.id}`;
        const category = blockData.category;

        // Create block label with icon and styling
        const label = createBlockLabel(blockData);

        // Merge default values with template
        const defaultValues = blockData.default_values || {};
        const htmlTemplate = blockData.html_template || generateFallbackTemplate(blockData);
        
        // Generate unique ID for this instance
        const instanceId = generateUniqueId();
        
        // Render template with default values and instance ID
        const renderedHtml = TemplateEngine.render(htmlTemplate, {
            ...defaultValues,
            block_id: instanceId
        });

        // Prepare complete content with styles and scripts
        const fullContent = assembleBlockContent(renderedHtml, blockData, instanceId);

        // Add block to GrapesJS
        blockManager.add(blockId, {
            label: label,
            category: category,
            content: fullContent,
            attributes: {
                title: blockData.description || blockData.name,
                class: 'gjs-block-custom',
                'data-block-id': blockData.id,
                'data-block-name': blockData.name
            },
        });

        // Define component type with traits and behaviors
        defineComponentType(blockId, blockData);

        // Track usage
        trackBlockUsage(blockData.id);
    }

    /**
     * Create styled block label
     */
    function createBlockLabel(blockData) {
        return `
            <div class="gjs-block-label" style="text-align: center; padding: 8px;">
                <div style="font-size: 28px; margin-bottom: 6px; color: ${blockData.color || '#667eea'};">
                    <i class="fas ${blockData.icon}"></i>
                </div>
                <div style="font-size: 11px; font-weight: 600; color: #333;">
                    ${blockData.name}
                </div>
                ${blockData.tags ? `
                    <div style="font-size: 9px; color: #999; margin-top: 4px;">
                        ${JSON.parse(blockData.tags).slice(0, 2).join(', ')}
                    </div>
                ` : ''}
            </div>
        `;
    }

    /**
     * Assemble complete block content with styles and scripts
     */
    function assembleBlockContent(html, blockData, instanceId) {
        let content = '';

        // Add CSS styles if provided
        if (blockData.css_styles) {
            content += `<style data-block-styles="${instanceId}">
${blockData.css_styles}
</style>`;
        }

        // Add HTML content
        content += html;

        // Add JavaScript if provided
        if (blockData.js_scripts) {
            const wrappedScript = wrapScript(blockData.js_scripts, instanceId);
            content += `<script data-block-script="${instanceId}">
${wrappedScript}
</script>`;
        }

        return content;
    }

    /**
     * Wrap JavaScript to execute after DOM is ready
     */
    function wrapScript(script, instanceId) {
        return `
(function() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        ${script}
    }
})();
`;
    }

    /**
     * Define component type with traits and behaviors
     */
    function defineComponentType(blockId, blockData) {
        const traits = generateTraits(blockData);
        const defaults = blockData.default_values || {};

        domComponents.addType(blockId, {
            model: {
                defaults: {
                    traits: traits,
                    draggable: true,
                    droppable: true,
                    removable: true,
                    copyable: true,
                    resizable: false,
                    editable: true,
                    attributes: {
                        'data-block-type': blockId,
                        'data-block-category': blockData.category
                    },
                    ...defaults
                },
                
                // Initialize component
                init() {
                    this.on('change:attributes', this.handleAttributeChange);
                    this.on('remove', this.handleRemove);
                },

                // Handle attribute changes
                handleAttributeChange() {
                    const attrs = this.getAttributes();
                    this.updateContent(attrs);
                },

                // Update content based on new attributes
                updateContent(attrs) {
                    const template = blockData.html_template;
                    if (!template) return;

                    const rendered = TemplateEngine.render(template, attrs);
                    this.components(rendered);
                },

                // Clean up on remove
                handleRemove() {
                    const instanceId = this.getAttributes()['data-instance-id'];
                    // Remove associated styles and scripts
                    document.querySelectorAll(`[data-block-styles="${instanceId}"], [data-block-script="${instanceId}"]`).forEach(el => el.remove());
                }
            },

            view: {
                // Custom view logic if needed
                onRender() {
                    // Execute any view-specific initialization
                }
            }
        });
    }

    /**
     * Generate traits from block configuration
     */
    function generateTraits(blockData) {
        const traits = [];
        const traitsConfig = blockData.traits_config ? JSON.parse(blockData.traits_config) : {};
        const configuredTraits = traitsConfig.traits || [];

        configuredTraits.forEach(trait => {
            const traitDef = {
                type: trait.type,
                label: trait.label,
                name: trait.name,
                changeProp: trait.changeProp || 0
            };

            // Add type-specific properties
            switch (trait.type) {
                case 'select':
                    traitDef.options = trait.options || [];
                    break;
                case 'number':
                    traitDef.min = trait.min;
                    traitDef.max = trait.max;
                    traitDef.step = trait.step || 1;
                    break;
                case 'checkbox':
                    traitDef.valueTrue = trait.valueTrue || true;
                    traitDef.valueFalse = trait.valueFalse || false;
                    break;
                case 'button':
                    traitDef.text = trait.text;
                    traitDef.full = true;
                    traitDef.command = trait.command;
                    break;
            }

            traits.push(traitDef);
        });

        // Add common traits
        traits.push({
            type: 'class_select',
            label: 'CSS Classes',
            name: 'class'
        });

        return traits;
    }

    /**
     * Register custom commands for block actions
     */
    function registerCustomCommands() {
        // Command: Add carousel slide
        commands.add('add-carousel-slide', {
            run(editor, sender, opts = {}) {
                const selected = editor.getSelected();
                if (!selected) return;

                const slidesContainer = selected.find('.carousel-inner')[0];
                const indicatorsContainer = selected.find('.carousel-indicators')[0];
                
                if (slidesContainer && indicatorsContainer) {
                    const slideIndex = slidesContainer.components().length;
                    
                    // Add new slide
                    slidesContainer.append(`
                        <div class="carousel-item" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 500px; display: flex; align-items: center;">
                            <div class="carousel-caption">
                                <h1>New Slide ${slideIndex + 1}</h1>
                                <h5>Subtitle</h5>
                                <p>Description</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>
                    `);

                    // Add indicator
                    indicatorsContainer.append(`
                        <button type="button" data-bs-slide-to="${slideIndex}"></button>
                    `);
                }
            }
        });

        // Command: Remove carousel slide
        commands.add('remove-carousel-slide', {
            run(editor, sender, opts = {}) {
                const selected = editor.getSelected();
                if (!selected) return;

                const slidesContainer = selected.find('.carousel-inner')[0];
                const indicatorsContainer = selected.find('.carousel-indicators')[0];
                
                if (slidesContainer && indicatorsContainer) {
                    const slides = slidesContainer.components();
                    const indicators = indicatorsContainer.components();
                    
                    if (slides.length > 1) {
                        slides.at(slides.length - 1).remove();
                        indicators.at(indicators.length - 1).remove();
                    }
                }
            }
        });

        // Command: Add table row
        commands.add('add-table-row', {
            run(editor, sender, opts = {}) {
                const selected = editor.getSelected();
                if (!selected) return;

                const tbody = selected.find('tbody')[0];
                if (tbody) {
                    tbody.append(`
                        <tr data-category="documents" data-year="2024" style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;">New Document</td>
                            <td style="padding: 15px;">Category</td>
                            <td style="padding: 15px;">2024</td>
                            <td style="padding: 15px; text-align: center;">0 KB</td>
                            <td style="padding: 15px; text-align: center;">
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fa fa-download"></i> Download
                                </a>
                            </td>
                        </tr>
                    `);
                }
            }
        });

        // Command: Remove table row
        commands.add('remove-table-row', {
            run(editor, sender, opts = {}) {
                const selected = editor.getSelected();
                if (!selected) return;

                const tbody = selected.find('tbody')[0];
                if (tbody) {
                    const rows = tbody.components();
                    if (rows.length > 1) {
                        rows.at(rows.length - 1).remove();
                    }
                }
            }
        });

        // Command: Add repeater item (generic)
        commands.add('add-repeater-item', {
            run(editor, sender, opts = {}) {
                const selected = editor.getSelected();
                const containerSelector = opts.container || '.repeater-container';
                const template = opts.template || '<div class="repeater-item">New Item</div>';
                
                const container = selected.find(containerSelector)[0];
                if (container) {
                    container.append(template);
                }
            }
        });
    }

    /**
     * Generate fallback template if none provided
     */
    function generateFallbackTemplate(blockData) {
        return `
            <section class="custom-block-section" style="padding: 60px 0;">
                <div class="container">
                    <div class="text-center">
                        <i class="fas ${blockData.icon}" style="font-size: 64px; color: ${blockData.color}; margin-bottom: 20px;"></i>
                        <h2>${blockData.name}</h2>
                        <p>${blockData.description || 'Custom block content'}</p>
                    </div>
                </div>
            </section>
        `;
    }

    /**
     * Generate unique ID for block instances
     */
    function generateUniqueId() {
        return `block-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
    }

    /**
     * Track block usage (send to API)
     */
    function trackBlockUsage(blockId) {
        // Optional: Send usage analytics to server
        fetch('/admin/custom-blocks/track-usage', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': config.csrfToken,
            },
            body: JSON.stringify({ block_id: blockId })
        }).catch(err => console.warn('Failed to track usage:', err));
    }

    // Add custom styling for blocks in the panel
    const style = document.createElement('style');
    style.textContent = `
        .gjs-block-custom {
            transition: all 0.3s ease;
        }
        .gjs-block-custom:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .gjs-block-label {
            line-height: 1.4;
        }
    `;
    document.head.appendChild(style);

})(window.editor);