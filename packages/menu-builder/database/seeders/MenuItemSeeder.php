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
        /** @var array<int, array{label: string, slug: string, view: string, sort_order: int, parent_slug?: string}> $menuItems */
        $menuItems = [
            ['label' => 'Home', 'slug' => '/', 'view' => 'home', 'sort_order' => 0],
            ['label' => 'Produkte', 'slug' => 'products', 'view' => 'pages.products', 'sort_order' => 10],
            ['label' => 'Leistungen', 'slug' => 'services', 'view' => 'pages.services', 'sort_order' => 20],
            ['label' => 'Lösungen', 'slug' => 'solutions', 'view' => 'pages.solutions', 'sort_order' => 30],
            ['label' => 'Branchen', 'slug' => 'industries', 'view' => 'pages.industries', 'sort_order' => 40],
            ['label' => 'Unternehmen', 'slug' => 'company', 'view' => 'pages.company', 'sort_order' => 50],
            ['label' => 'Ressourcen', 'slug' => 'resources', 'view' => 'pages.resources', 'sort_order' => 60],
            ['label' => 'Karriere', 'slug' => 'career', 'view' => 'pages.career', 'sort_order' => 70],
            ['label' => 'Support', 'slug' => 'support', 'view' => 'pages.support', 'sort_order' => 80],
            ['label' => 'Kontakt', 'slug' => 'contact', 'view' => 'pages.contact', 'sort_order' => 90],

            ['label' => 'Hardware', 'slug' => 'products/hardware', 'view' => 'pages.products.hardware', 'sort_order' => 0, 'parent_slug' => 'products'],
            ['label' => 'Software', 'slug' => 'products/software', 'view' => 'pages.products.software', 'sort_order' => 10, 'parent_slug' => 'products'],
            ['label' => 'Cloud', 'slug' => 'products/cloud', 'view' => 'pages.products.cloud', 'sort_order' => 20, 'parent_slug' => 'products'],
            ['label' => 'Integrationen', 'slug' => 'products/integrations', 'view' => 'pages.products.integrations', 'sort_order' => 30, 'parent_slug' => 'products'],
            ['label' => 'Lizenzen', 'slug' => 'products/licensing', 'view' => 'pages.products.licensing', 'sort_order' => 40, 'parent_slug' => 'products'],
            ['label' => 'Marketplace', 'slug' => 'products/marketplace', 'view' => 'pages.products.marketplace', 'sort_order' => 50, 'parent_slug' => 'products'],

            ['label' => 'Beratung', 'slug' => 'services/consulting', 'view' => 'pages.services.consulting', 'sort_order' => 0, 'parent_slug' => 'services'],
            ['label' => 'Implementierung', 'slug' => 'services/implementation', 'view' => 'pages.services.implementation', 'sort_order' => 10, 'parent_slug' => 'services'],
            ['label' => 'Schulungen', 'slug' => 'services/training', 'view' => 'pages.services.training', 'sort_order' => 20, 'parent_slug' => 'services'],
            ['label' => 'Managed Services', 'slug' => 'services/managed-services', 'view' => 'pages.services.managed-services', 'sort_order' => 30, 'parent_slug' => 'services'],
            ['label' => 'Support-Pakete', 'slug' => 'services/support-plans', 'view' => 'pages.services.support-plans', 'sort_order' => 40, 'parent_slug' => 'services'],
            ['label' => 'Audits', 'slug' => 'services/audits', 'view' => 'pages.services.audits', 'sort_order' => 50, 'parent_slug' => 'services'],

            ['label' => 'Automatisierung', 'slug' => 'solutions/automation', 'view' => 'pages.solutions.automation', 'sort_order' => 0, 'parent_slug' => 'solutions'],
            ['label' => 'Analytics', 'slug' => 'solutions/analytics', 'view' => 'pages.solutions.analytics', 'sort_order' => 10, 'parent_slug' => 'solutions'],
            ['label' => 'Sicherheit', 'slug' => 'solutions/security', 'view' => 'pages.solutions.security', 'sort_order' => 20, 'parent_slug' => 'solutions'],
            ['label' => 'Zusammenarbeit', 'slug' => 'solutions/collaboration', 'view' => 'pages.solutions.collaboration', 'sort_order' => 30, 'parent_slug' => 'solutions'],
            ['label' => 'E-Commerce', 'slug' => 'solutions/ecommerce', 'view' => 'pages.solutions.ecommerce', 'sort_order' => 40, 'parent_slug' => 'solutions'],
            ['label' => 'Mobile Apps', 'slug' => 'solutions/mobile-apps', 'view' => 'pages.solutions.mobile-apps', 'sort_order' => 50, 'parent_slug' => 'solutions'],

            ['label' => 'Gesundheitswesen', 'slug' => 'industries/healthcare', 'view' => 'pages.industries.healthcare', 'sort_order' => 0, 'parent_slug' => 'industries'],
            ['label' => 'Handel', 'slug' => 'industries/retail', 'view' => 'pages.industries.retail', 'sort_order' => 10, 'parent_slug' => 'industries'],
            ['label' => 'Produktion', 'slug' => 'industries/manufacturing', 'view' => 'pages.industries.manufacturing', 'sort_order' => 20, 'parent_slug' => 'industries'],
            ['label' => 'Bildung', 'slug' => 'industries/education', 'view' => 'pages.industries.education', 'sort_order' => 30, 'parent_slug' => 'industries'],
            ['label' => 'Finanzen', 'slug' => 'industries/finance', 'view' => 'pages.industries.finance', 'sort_order' => 40, 'parent_slug' => 'industries'],

            ['label' => 'Über uns', 'slug' => 'company/about', 'view' => 'pages.company.about', 'sort_order' => 0, 'parent_slug' => 'company'],
            ['label' => 'Team', 'slug' => 'company/team', 'view' => 'pages.company.team', 'sort_order' => 10, 'parent_slug' => 'company'],
            ['label' => 'Partner', 'slug' => 'company/partners', 'view' => 'pages.company.partners', 'sort_order' => 20, 'parent_slug' => 'company'],
            ['label' => 'Presse', 'slug' => 'company/press', 'view' => 'pages.company.press', 'sort_order' => 30, 'parent_slug' => 'company'],
            ['label' => 'Nachhaltigkeit', 'slug' => 'company/sustainability', 'view' => 'pages.company.sustainability', 'sort_order' => 40, 'parent_slug' => 'company'],

            ['label' => 'Blog', 'slug' => 'resources/blog', 'view' => 'pages.resources.blog', 'sort_order' => 0, 'parent_slug' => 'resources'],
            ['label' => 'Guides', 'slug' => 'resources/guides', 'view' => 'pages.resources.guides', 'sort_order' => 10, 'parent_slug' => 'resources'],
            ['label' => 'Webinare', 'slug' => 'resources/webinars', 'view' => 'pages.resources.webinars', 'sort_order' => 20, 'parent_slug' => 'resources'],
            ['label' => 'Case Studies', 'slug' => 'resources/case-studies', 'view' => 'pages.resources.case-studies', 'sort_order' => 30, 'parent_slug' => 'resources'],
            ['label' => 'Dokumentation', 'slug' => 'resources/docs', 'view' => 'pages.resources.docs', 'sort_order' => 40, 'parent_slug' => 'resources'],

            ['label' => 'Jobs', 'slug' => 'career/jobs', 'view' => 'pages.career.jobs', 'sort_order' => 0, 'parent_slug' => 'career'],
            ['label' => 'Benefits', 'slug' => 'career/benefits', 'view' => 'pages.career.benefits', 'sort_order' => 10, 'parent_slug' => 'career'],
            ['label' => 'Studierende', 'slug' => 'career/students', 'view' => 'pages.career.students', 'sort_order' => 20, 'parent_slug' => 'career'],

            ['label' => 'Hilfe-Center', 'slug' => 'support/help-center', 'view' => 'pages.support.help-center', 'sort_order' => 0, 'parent_slug' => 'support'],
            ['label' => 'Status', 'slug' => 'support/status', 'view' => 'pages.support.status', 'sort_order' => 10, 'parent_slug' => 'support'],
            ['label' => 'Support kontaktieren', 'slug' => 'support/contact-support', 'view' => 'pages.support.contact-support', 'sort_order' => 20, 'parent_slug' => 'support'],
            ['label' => 'Downloads', 'slug' => 'support/downloads', 'view' => 'pages.support.downloads', 'sort_order' => 30, 'parent_slug' => 'support'],
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
                    'view' => View::exists($menuItem['view']) ? $menuItem['view'] : 'pages.dynamic',
                    'sort_order' => $menuItem['sort_order'],
                    'is_active' => true,
                ],
            );
        }
    }
}
