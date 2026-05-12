<?php

namespace LaravelMcpDemo\MenuBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\View;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var array<int, array{label: string, slug: string, route_name: string, view: string, sort_order: int, parent_slug?: string}> $menuItems */
        $menuItems = [
            ['label' => 'Home', 'slug' => '/', 'route_name' => 'home', 'view' => 'home', 'sort_order' => 0],
            ['label' => 'Produkte', 'slug' => 'products', 'route_name' => 'products', 'view' => 'pages.dynamic', 'sort_order' => 10],
            ['label' => 'Leistungen', 'slug' => 'services', 'route_name' => 'services', 'view' => 'pages.dynamic', 'sort_order' => 20],
            ['label' => 'Lösungen', 'slug' => 'solutions', 'route_name' => 'solutions', 'view' => 'pages.dynamic', 'sort_order' => 30],
            ['label' => 'Branchen', 'slug' => 'industries', 'route_name' => 'industries', 'view' => 'pages.dynamic', 'sort_order' => 40],
            ['label' => 'Unternehmen', 'slug' => 'company', 'route_name' => 'company', 'view' => 'pages.dynamic', 'sort_order' => 50],
            ['label' => 'Ressourcen', 'slug' => 'resources', 'route_name' => 'resources', 'view' => 'pages.dynamic', 'sort_order' => 60],
            ['label' => 'Karriere', 'slug' => 'career', 'route_name' => 'career', 'view' => 'pages.dynamic', 'sort_order' => 70],
            ['label' => 'Support', 'slug' => 'support', 'route_name' => 'support', 'view' => 'pages.dynamic', 'sort_order' => 80],
            ['label' => 'Kontakt', 'slug' => 'contact', 'route_name' => 'contact', 'view' => 'pages.dynamic', 'sort_order' => 90],

            ['label' => 'Hardware', 'slug' => 'products/hardware', 'route_name' => 'products.hardware', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'products'],
            ['label' => 'Software', 'slug' => 'products/software', 'route_name' => 'products.software', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'products'],
            ['label' => 'Cloud', 'slug' => 'products/cloud', 'route_name' => 'products.cloud', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'products'],
            ['label' => 'Integrationen', 'slug' => 'products/integrations', 'route_name' => 'products.integrations', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'products'],
            ['label' => 'Lizenzen', 'slug' => 'products/licensing', 'route_name' => 'products.licensing', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'products'],
            ['label' => 'Marketplace', 'slug' => 'products/marketplace', 'route_name' => 'products.marketplace', 'view' => 'pages.dynamic', 'sort_order' => 50, 'parent_slug' => 'products'],

            ['label' => 'Beratung', 'slug' => 'services/consulting', 'route_name' => 'services.consulting', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'services'],
            ['label' => 'Implementierung', 'slug' => 'services/implementation', 'route_name' => 'services.implementation', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'services'],
            ['label' => 'Schulungen', 'slug' => 'services/training', 'route_name' => 'services.training', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'services'],
            ['label' => 'Managed Services', 'slug' => 'services/managed-services', 'route_name' => 'services.managed-services', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'services'],
            ['label' => 'Support-Pakete', 'slug' => 'services/support-plans', 'route_name' => 'services.support-plans', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'services'],
            ['label' => 'Audits', 'slug' => 'services/audits', 'route_name' => 'services.audits', 'view' => 'pages.dynamic', 'sort_order' => 50, 'parent_slug' => 'services'],

            ['label' => 'Automatisierung', 'slug' => 'solutions/automation', 'route_name' => 'solutions.automation', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'solutions'],
            ['label' => 'Analytics', 'slug' => 'solutions/analytics', 'route_name' => 'solutions.analytics', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'solutions'],
            ['label' => 'Sicherheit', 'slug' => 'solutions/security', 'route_name' => 'solutions.security', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'solutions'],
            ['label' => 'Zusammenarbeit', 'slug' => 'solutions/collaboration', 'route_name' => 'solutions.collaboration', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'solutions'],
            ['label' => 'E-Commerce', 'slug' => 'solutions/ecommerce', 'route_name' => 'solutions.ecommerce', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'solutions'],
            ['label' => 'Mobile Apps', 'slug' => 'solutions/mobile-apps', 'route_name' => 'solutions.mobile-apps', 'view' => 'pages.dynamic', 'sort_order' => 50, 'parent_slug' => 'solutions'],

            ['label' => 'Gesundheitswesen', 'slug' => 'industries/healthcare', 'route_name' => 'industries.healthcare', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'industries'],
            ['label' => 'Handel', 'slug' => 'industries/retail', 'route_name' => 'industries.retail', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'industries'],
            ['label' => 'Produktion', 'slug' => 'industries/manufacturing', 'route_name' => 'industries.manufacturing', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'industries'],
            ['label' => 'Bildung', 'slug' => 'industries/education', 'route_name' => 'industries.education', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'industries'],
            ['label' => 'Finanzen', 'slug' => 'industries/finance', 'route_name' => 'industries.finance', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'industries'],

            ['label' => 'Über uns', 'slug' => 'company/about', 'route_name' => 'company.about', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'company'],
            ['label' => 'Team', 'slug' => 'company/team', 'route_name' => 'company.team', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'company'],
            ['label' => 'Partner', 'slug' => 'company/partners', 'route_name' => 'company.partners', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'company'],
            ['label' => 'Presse', 'slug' => 'company/press', 'route_name' => 'company.press', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'company'],
            ['label' => 'Nachhaltigkeit', 'slug' => 'company/sustainability', 'route_name' => 'company.sustainability', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'company'],

            ['label' => 'Blog', 'slug' => 'resources/blog', 'route_name' => 'resources.blog', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'resources'],
            ['label' => 'Guides', 'slug' => 'resources/guides', 'route_name' => 'resources.guides', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'resources'],
            ['label' => 'Webinare', 'slug' => 'resources/webinars', 'route_name' => 'resources.webinars', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'resources'],
            ['label' => 'Case Studies', 'slug' => 'resources/case-studies', 'route_name' => 'resources.case-studies', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'resources'],
            ['label' => 'Dokumentation', 'slug' => 'resources/docs', 'route_name' => 'resources.docs', 'view' => 'pages.dynamic', 'sort_order' => 40, 'parent_slug' => 'resources'],

            ['label' => 'Jobs', 'slug' => 'career/jobs', 'route_name' => 'career.jobs', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'career'],
            ['label' => 'Benefits', 'slug' => 'career/benefits', 'route_name' => 'career.benefits', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'career'],
            ['label' => 'Studierende', 'slug' => 'career/students', 'route_name' => 'career.students', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'career'],

            ['label' => 'Hilfe-Center', 'slug' => 'support/help-center', 'route_name' => 'support.help-center', 'view' => 'pages.dynamic', 'sort_order' => 0, 'parent_slug' => 'support'],
            ['label' => 'Status', 'slug' => 'support/status', 'route_name' => 'support.status', 'view' => 'pages.dynamic', 'sort_order' => 10, 'parent_slug' => 'support'],
            ['label' => 'Support kontaktieren', 'slug' => 'support/contact-support', 'route_name' => 'support.contact-support', 'view' => 'pages.dynamic', 'sort_order' => 20, 'parent_slug' => 'support'],
            ['label' => 'Downloads', 'slug' => 'support/downloads', 'route_name' => 'support.downloads', 'view' => 'pages.dynamic', 'sort_order' => 30, 'parent_slug' => 'support'],
        ];

        /** @var array<string, MenuItem> $createdMenuItems */
        $createdMenuItems = [];

        foreach ($menuItems as $menuItem) {
            $parentSlug = $menuItem['parent_slug'] ?? null;

            $createdMenuItems[$menuItem['slug']] = MenuItem::query()->updateOrCreate(
                ['slug' => $menuItem['slug']],
                [
                    'parent_id' => $parentSlug === null ? null : $createdMenuItems[$parentSlug]->id,
                    'label' => $menuItem['label'],
                    'route_name' => $menuItem['route_name'],
                    'view' => View::exists($menuItem['view']) ? $menuItem['view'] : 'pages.dynamic',
                    'sort_order' => $menuItem['sort_order'],
                    'is_active' => true,
                ],
            );
        }
    }
}
