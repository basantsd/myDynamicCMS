/**
 * Dynamic Blocks Loader for GrapesJS
 * Loads custom blocks from database API and registers them with GrapesJS
 *
 * Usage:
 * 1. Include this script after GrapesJS initialization
 * 2. Ensure window.editor is set to your GrapesJS editor instance
 * 3. Blocks will automatically load from /admin/custom-blocks/list
 */

(function() {
    'use strict';

    class DynamicBlocksLoader {
        constructor(editor) {
            this.editor = editor;
            this.blocks = [];
            this.apiEndpoint = '/admin/custom-blocks/list';
            this.debug = true; // Enable debug mode
            this.init();
        }

        /**
         * Initialize the loader
         */
        async init() {
            this.log('🚀 Dynamic Blocks Loader: Initializing...');
            this.log('Editor instance:', this.editor);

            try {
                await this.loadBlocks();
                this.registerBlocks();
                this.log(`✅ Dynamic Blocks Loader: Successfully loaded ${this.blocks.length} blocks`);

                // Show success notification
                this.showNotification(`Loaded ${this.blocks.length} custom blocks`, 'success');
            } catch (error) {
                console.error('❌ Dynamic Blocks Loader: Failed to initialize', error);
                this.showNotification('Failed to load custom blocks: ' + error.message, 'error');
            }
        }

        /**
         * Debug logging
         */
        log(...args) {
            if (this.debug) {
                console.log('[DynamicBlocks]', ...args);
            }
        }

        /**
         * Load blocks from API
         */
        async loadBlocks() {
            this.log('📡 Fetching blocks from:', this.apiEndpoint);

            try {
                const response = await fetch(this.apiEndpoint);

                this.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                this.log('API Response:', data);

                if (data.success && data.blocks) {
                    this.blocks = data.blocks;
                    this.log(`📦 Loaded ${this.blocks.length} custom blocks:`, this.blocks);
                } else {
                    console.warn('⚠️ No blocks returned from API or success=false');
                    this.log('API returned:', data);
                    this.blocks = [];
                }
            } catch (error) {
                console.error('Failed to fetch blocks from API:', error);
                throw error;
            }
        }

        /**
         * Show notification to user
         */
        showNotification(message, type = 'info') {
            // Try to use editor notification if available
            if (this.editor && this.editor.runCommand) {
                try {
                    this.editor.runCommand('core:canvas-clear'); // Dummy command to check if commands work
                } catch (e) {
                    // Editor commands may not be available yet
                }
            }

            // Fallback to console
            const emoji = type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️';
            console.log(`${emoji} ${message}`);

            // Try to show in UI if possible
            if (typeof window !== 'undefined' && window.alert) {
                // Don't actually alert, just log for now
                this.log('Notification:', message);
            }
        }

        /**
         * Register all blocks with GrapesJS
         */
        registerBlocks() {
            if (!this.editor || !this.editor.BlockManager) {
                console.error('❌ GrapesJS editor or BlockManager not available!');
                return;
            }

            const blockManager = this.editor.BlockManager;
            this.log('📝 Registering blocks with GrapesJS BlockManager...');

            let successCount = 0;
            let errorCount = 0;

            this.blocks.forEach(block => {
                try {
                    this.registerBlock(block);
                    successCount++;
                    this.log(`✓ Registered: ${block.name}`);
                } catch (error) {
                    errorCount++;
                    console.error(`✗ Failed to register block: ${block.name}`, error);
                }
            });

            this.log(`Registration complete: ${successCount} succeeded, ${errorCount} failed`);
        }

        /**
         * Register a single block with GrapesJS
         */
        registerBlock(block) {
            const blockManager = this.editor.BlockManager;

            // Create unique block ID
            const blockId = `custom-block-${block.id}`;

            this.log(`Registering block: ${blockId}`, block);

            // Prepare block content
            const blockContent = this.prepareBlockContent(block);

            // Create block configuration
            const blockConfig = {
                label: block.name || 'Untitled Block',
                category: {
                    id: block.category || 'custom',
                    label: this.getCategoryLabel(block.category),
                    open: true
                },
                attributes: {
                    class: 'gjs-block-custom',
                    title: block.description || block.name
                },
                content: blockContent,
                media: this.getBlockMedia(block),
            };

            this.log(`Block config for ${blockId}:`, blockConfig);

            // Register block in BlockManager
            blockManager.add(blockId, blockConfig);

            // Register custom component type if needed
            if (block.js_scripts || block.traits_config) {
                this.registerComponentType(block);
            }
        }

        /**
         * Get block media (icon/thumbnail)
         */
        getBlockMedia(block) {
            // If thumbnail exists, use it
            if (block.thumbnail) {
                return `<img src="${block.thumbnail}" alt="${block.name}" style="width:100%;height:100%;object-fit:cover;" />`;
            }

            // Otherwise use icon with color
            const color = block.color || '#3498db';
            const icon = block.icon || 'fa-cube';

            return `<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;background:${color}15;">
                <i class="fas ${icon}" style="font-size:32px;color:${color};"></i>
            </div>`;
        }

        /**
         * Prepare block content by rendering template with default values
         */
        prepareBlockContent(block) {
            let content = block.html_template || '<div>Block content</div>';

            // Apply default values to template
            if (block.default_values) {
                content = this.renderTemplate(content, block.default_values);
            }

            // Wrap content with styles if provided
            if (block.css_styles) {
                content = `
                    <style>
                        ${block.css_styles}
                    </style>
                    ${content}
                `;
            }

            // Add data attributes for identification
            const wrappedContent = `
                <div
                    class="custom-block-wrapper"
                    data-block-id="${block.id}"
                    data-block-name="${block.name}"
                    data-block-category="${block.category}"
                >
                    ${content}
                </div>
            `;

            return wrappedContent;
        }

        /**
         * Register custom component type with GrapesJS
         */
        registerComponentType(block) {
            const componentId = `custom-component-${block.id}`;

            this.editor.DomComponents.addType(componentId, {
                model: {
                    defaults: {
                        tagName: 'div',
                        attributes: {
                            'data-block-id': block.id,
                            'data-block-type': componentId
                        },
                        traits: this.buildTraits(block.traits_config),
                        script: block.js_scripts ? this.wrapScript(block.js_scripts) : null,
                    }
                }
            });
        }

        /**
         * Build GrapesJS traits from block configuration
         */
        buildTraits(traitsConfig) {
            if (!traitsConfig || !traitsConfig.traits) {
                return [];
            }

            return traitsConfig.traits.map(trait => ({
                type: trait.type || 'text',
                label: trait.label,
                name: trait.name,
                changeProp: trait.changeProp || 0,
                options: trait.options || null,
                min: trait.min || null,
                max: trait.max || null,
                step: trait.step || null,
            }));
        }

        /**
         * Wrap JavaScript in IIFE for safe execution
         */
        wrapScript(script) {
            return function() {
                try {
                    eval(script);
                } catch (error) {
                    console.error('Block script execution error:', error);
                }
            };
        }

        /**
         * Simple template rendering engine
         * Supports {{variable}}, {{#if condition}}, and {{#each array}}
         */
        renderTemplate(template, data) {
            let rendered = template;

            // Replace simple variables {{variable}}
            rendered = rendered.replace(/\{\{(\w+)\}\}/g, (match, key) => {
                return data[key] !== undefined ? data[key] : '';
            });

            // Handle conditionals {{#if variable}}...{{/if}}
            rendered = rendered.replace(/\{\{#if\s+(\w+)\}\}([\s\S]*?)\{\{\/if\}\}/g, (match, key, content) => {
                return data[key] ? content : '';
            });

            // Handle loops {{#each array}}...{{/each}}
            rendered = rendered.replace(/\{\{#each\s+(\w+)\}\}([\s\S]*?)\{\{\/each\}\}/g, (match, key, itemTemplate) => {
                const array = data[key];
                if (!Array.isArray(array)) return '';

                return array.map((item, index) => {
                    let itemHtml = itemTemplate;

                    // Replace item properties
                    Object.keys(item).forEach(prop => {
                        const regex = new RegExp(`\\{\\{${prop}\\}\\}`, 'g');
                        itemHtml = itemHtml.replace(regex, item[prop]);
                    });

                    // Replace @index
                    itemHtml = itemHtml.replace(/\{\{@index\}\}/g, index);

                    return itemHtml;
                }).join('');
            });

            return rendered;
        }

        /**
         * Get category label for display
         */
        getCategoryLabel(category) {
            const categoryMap = {
                'hero': 'Hero Sections',
                'content': 'Content Blocks',
                'media': 'Media',
                'slider': 'Sliders',
                'table': 'Tables',
                'form': 'Forms',
                'list': 'Lists',
                'button': 'Buttons & Actions',
                'feature': 'Features',
                'footer': 'Footers',
                'header': 'Headers',
            };

            return categoryMap[category] || category.charAt(0).toUpperCase() + category.slice(1);
        }

        /**
         * Get default icon SVG if no thumbnail provided
         */
        getDefaultIcon(iconClass, color) {
            // Return FontAwesome icon wrapped in SVG
            return `
                <svg viewBox="0 0 24 24" style="fill: ${color || '#3498db'};">
                    <text x="12" y="16" text-anchor="middle" style="font-family: 'Font Awesome 6 Free'; font-size: 14px;">
                        ${this.getFontAwesomeUnicode(iconClass)}
                    </text>
                </svg>
            `;
        }

        /**
         * Get FontAwesome unicode for common icons
         */
        getFontAwesomeUnicode(iconClass) {
            // Map of common FA icons to unicode
            const iconMap = {
                'fa-cube': '&#xf1b2;',
                'fa-image': '&#xf03e;',
                'fa-images': '&#xf302;',
                'fa-table': '&#xf0ce;',
                'fa-list': '&#xf03a;',
                'fa-envelope': '&#xf0e0;',
                'fa-star': '&#xf005;',
                'fa-heart': '&#xf004;',
                'fa-user': '&#xf007;',
                'fa-users': '&#xf0c0;',
            };

            return iconMap[iconClass] || '&#xf1b2;'; // Default to cube
        }

        /**
         * Track block usage via API
         */
        async trackBlockUsage(blockId) {
            // Get page ID from URL or data attribute
            const pageId = this.getPageId();

            try {
                await fetch('/admin/custom-blocks/track-usage', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken(),
                    },
                    body: JSON.stringify({
                        block_id: blockId,
                        page_id: pageId,
                    })
                });
            } catch (error) {
                console.warn('Failed to track block usage:', error);
            }
        }

        /**
         * Get page ID from URL or meta tag
         */
        getPageId() {
            // Try to get from URL
            const urlMatch = window.location.pathname.match(/\/pages\/(\d+)/);
            if (urlMatch) return parseInt(urlMatch[1]);

            // Try to get from meta tag
            const metaTag = document.querySelector('meta[name="page-id"]');
            if (metaTag) return parseInt(metaTag.content);

            return null;
        }

        /**
         * Get CSRF token
         */
        getCsrfToken() {
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            return tokenMeta ? tokenMeta.content : '';
        }

        /**
         * Reload blocks (useful for refreshing after block updates)
         */
        async reload() {
            console.log('🔄 Reloading dynamic blocks...');
            await this.loadBlocks();
            this.registerBlocks();
        }
    }

    // Auto-initialize when editor is available
    let initAttempts = 0;
    const maxAttempts = 20; // Try for 10 seconds (20 * 500ms)

    function initDynamicBlocks() {
        initAttempts++;

        if (window.editor) {
            console.log('🎨 GrapesJS editor detected, loading dynamic blocks...');
            console.log('Editor object:', window.editor);
            window.dynamicBlocksLoader = new DynamicBlocksLoader(window.editor);
        } else {
            if (initAttempts < maxAttempts) {
                console.log(`⏳ Waiting for GrapesJS editor... (attempt ${initAttempts}/${maxAttempts})`);
                // Retry after a short delay
                setTimeout(initDynamicBlocks, 500);
            } else {
                console.error('❌ GrapesJS editor not found after ' + maxAttempts + ' attempts');
                console.error('Make sure you have: window.editor = grapesjs.init({ ... });');
                console.error('You can manually initialize with: new DynamicBlocksLoader(yourEditor);');
            }
        }
    }

    // Start initialization when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDynamicBlocks);
    } else {
        initDynamicBlocks();
    }

    // Export for manual initialization if needed
    window.DynamicBlocksLoader = DynamicBlocksLoader;
})();
