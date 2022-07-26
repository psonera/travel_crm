<?php

use App\Models\Lead;
use App\Models\LeadManager;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
     $trail->push('Dashboard', route('dashboard'));
});

// Dashboard / Leads
Breadcrumbs::for('leads.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Leads', route('leads.index'));
});

// Dashboard / Leads / Create Lead
Breadcrumbs::for('leads.create', function (BreadcrumbTrail $trail) {
    $trail->parent('leads.index');
    $trail->push('Create Lead', route('leads.create'));
});

// Dashboard / Leads / Edit Lead
Breadcrumbs::for('leads.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('leads.index');
    $trail->push('Edit Lead', route('leads.edit'));
});

// Dashboard / Leads / [Lead Title]
Breadcrumbs::for('leads.show', function (BreadcrumbTrail $trail, Lead $lead) {
    $trail->parent('leads.index');
    $trail->push($lead->title, route('leads.show', $lead->id));
});

// Dashboard / Products
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Products', route('products.index'));
});

// Dashboard / Products / Create Product
Breadcrumbs::for('products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('products.index');
    $trail->push('Create Product', route('products.create'));
});

// Dashboard / Products / Edit Product
Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('products.index');
    $trail->push('Edit Product', route('products.edit'));
});

// Dashboard / Products / [Product Title]
Breadcrumbs::for('products.view', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products.index');
    $trail->push($product->name, route('products.view'), $product->id);
});

// Dashboard / Lead Manager
Breadcrumbs::for('lead_managers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Lead Manager', route('lead_managers.index'));
});

// Dashboard / Lead Manager / Create Lead Manager
Breadcrumbs::for('lead_managers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('lead_managers.index');
    $trail->push('Create Lead Manager', route('lead_managers.create'));
});

// Dashboard / Lead Manager / Edit Lead Manager
Breadcrumbs::for('lead_managers.edit', function (BreadcrumbTrail $trail, $lead_managers) {
    $trail->parent('lead_managers.index');
    $trail->push('Edit Lead Manager', route('lead_managers.edit', ['id' => $lead_managers]));
});