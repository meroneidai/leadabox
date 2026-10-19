<?php

return [

    'company' => [
        'name' => 'Leadabox',
        'legal_name' => 'Leadabox',
        'domain' => 'leadabox.com',
        'email' => 'support@leadabox.com',
        'phone' => '+46764103340',
        'phone_display' => '+46 76 410 33 40',
        'whatsapp' => '46764103340',
        'street' => 'Perstorpsvägen 191',
        'postal_code' => '123 64',
        'city' => 'Stockholm',
        'region' => 'Stockholm County',
        'country' => 'SE',
        'country_name' => 'Sweden',
        'founded' => '2019',
        'latitude' => 59.2583,
        'longitude' => 18.0897,
    ],

    'social' => [
        'linkedin' => 'https://www.linkedin.com/company/leadabox',
        'github' => 'https://github.com/leadabox',
    ],

    /*
     | Locale code => routing prefix. The default locale is served from the root.
     | The prefix is what appears in the URL, which is why it differs from the
     | ISO code for Swedish (se), Norwegian (no) and Danish (dk).
     */
    'locales' => [
        'en' => [
            'prefix' => null,
            'native' => 'English',
            'english' => 'English',
            'dir' => 'ltr',
            'hreflang' => 'en',
            'locale' => 'en_US',
            'region' => 'Global',
        ],
        'sv' => [
            'prefix' => 'se',
            'native' => 'Svenska',
            'english' => 'Swedish',
            'dir' => 'ltr',
            'hreflang' => 'sv-SE',
            'locale' => 'sv_SE',
            'region' => 'Sverige',
        ],
        'ar' => [
            'prefix' => 'ar',
            'native' => 'العربية',
            'english' => 'Arabic',
            'dir' => 'rtl',
            'hreflang' => 'ar',
            'locale' => 'ar_SA',
            'region' => 'الشرق الأوسط',
        ],
        'nb' => [
            'prefix' => 'no',
            'native' => 'Norsk',
            'english' => 'Norwegian',
            'dir' => 'ltr',
            'hreflang' => 'nb-NO',
            'locale' => 'nb_NO',
            'region' => 'Norge',
        ],
        'da' => [
            'prefix' => 'dk',
            'native' => 'Dansk',
            'english' => 'Danish',
            'dir' => 'ltr',
            'hreflang' => 'da-DK',
            'locale' => 'da_DK',
            'region' => 'Danmark',
        ],
    ],

    /*
     | Service pages. `key` maps to the translation group in lang/<locale>/site.php
     | under `services.<key>`, so copy stays translatable while structure stays here.
     */
    'services' => [
        'web-development' => [
            'icon' => 'code',
            'accent' => 'blue',
            'stack' => ['Laravel', 'PHP', 'Python', 'Node.js', 'Livewire', 'Tailwind CSS', 'Alpine.js', 'MySQL', 'PostgreSQL', 'Redis'],
            'capabilities' => ['cms', 'custom', 'ecommerce', 'integrations', 'performance', 'maintenance'],
        ],
        'web-design' => [
            'icon' => 'sparkles',
            'accent' => 'violet',
            'stack' => ['Figma', 'Design systems', 'Tailwind CSS', 'Elementor', 'Webflow', 'Accessibility (WCAG 2.2)'],
            'capabilities' => ['ux', 'ui', 'design-system', 'conversion', 'brand', 'prototyping'],
        ],
        'mobile-app-development' => [
            'icon' => 'device',
            'accent' => 'emerald',
            'stack' => ['React Native', 'Flutter', 'Swift', 'Kotlin', 'Expo', 'Firebase', 'REST & GraphQL APIs'],
            'capabilities' => ['ios', 'android', 'cross-platform', 'backend', 'store', 'push'],
        ],
        'ai-agents' => [
            'icon' => 'bot',
            'accent' => 'amber',
            'stack' => ['OpenAI', 'Anthropic Claude', 'Azure OpenAI', 'LangChain', 'Vector databases', 'RAG', 'n8n'],
            'capabilities' => ['support', 'sales', 'booking', 'marketing', 'internal', 'seo'],
        ],
        'ai-integration' => [
            'icon' => 'plug',
            'accent' => 'rose',
            'stack' => ['REST APIs', 'Webhooks', 'CRM connectors', 'ERP connectors', 'Zapier', 'Make', 'n8n', 'Queue workers'],
            'capabilities' => ['crm', 'erp', 'data', 'automation', 'security', 'observability'],
        ],
    ],

    /*
     | CMS & custom development platforms shown on the web development page.
     */
    'platforms' => [
        'wordpress' => ['name' => 'WordPress', 'accent' => 'blue'],
        'woocommerce' => ['name' => 'WooCommerce', 'accent' => 'violet'],
        'elementor' => ['name' => 'Elementor', 'accent' => 'rose'],
        'shopify' => ['name' => 'Shopify', 'accent' => 'emerald'],
        'magento' => ['name' => 'Adobe Commerce / Magento', 'accent' => 'amber'],
        'laravel' => ['name' => 'Laravel', 'accent' => 'rose'],
        'python' => ['name' => 'Python', 'accent' => 'blue'],
        'headless' => ['name' => 'Headless & API-first', 'accent' => 'emerald'],
    ],

    /*
     | AI agent types. Copy lives under `agents.<key>` in the lang files.
     */
    'agents' => [
        'customer-service' => ['icon' => 'headset', 'accent' => 'blue'],
        'sales' => ['icon' => 'trending', 'accent' => 'emerald'],
        'social-media' => ['icon' => 'share', 'accent' => 'violet'],
        'marketing' => ['icon' => 'megaphone', 'accent' => 'rose'],
        'campaign' => ['icon' => 'send', 'accent' => 'amber'],
        'email' => ['icon' => 'mail', 'accent' => 'blue'],
        'internal' => ['icon' => 'building', 'accent' => 'violet'],
        'booking-medical' => ['icon' => 'stethoscope', 'accent' => 'emerald'],
        'booking-smb' => ['icon' => 'calendar', 'accent' => 'amber'],
        'seo' => ['icon' => 'search', 'accent' => 'rose'],
    ],

    'products' => [
        'bitra-optimizer' => [
            'name' => 'Bitra Optimizer',
            'tagline_key' => 'products.bitra-optimizer.tagline',
            'accent' => 'blue',
            'category' => 'WordPress plugin',
            'url' => 'https://wordpress.org/plugins/bitra-optimizer/',
            'version' => '2.1.0',
            'has_pro' => true,
            'features' => ['compression', 'webp', 'storage', 'restore', 'queue', 'local'],
            'pro_features' => ['avif', 'cdn', 'bulk', 'priority', 'multisite', 'api'],
        ],
    ],

    'cases' => [
        'hakeem-care' => [
            'client' => 'Hakeem',
            'domains' => ['hakeem.care', 'hakeem.com.sa'],
            'url' => 'https://hakeem.care',
            'accent' => 'emerald',
            'year' => '2024',
            'services' => ['web-development', 'web-design', 'ai-agents'],
            'metrics' => [
                ['value' => '2.1s', 'key' => 'lcp'],
                ['value' => '+63%', 'key' => 'bookings'],
                ['value' => '4', 'key' => 'languages'],
                ['value' => '24/7', 'key' => 'coverage'],
            ],
        ],
    ],

    /*
     | Shown on the home page as the delivery process.
     */
    'process' => ['discover', 'design', 'build', 'launch', 'grow'],

];
