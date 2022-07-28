<?php

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
Breadcrumbs::for('leads.show', function (BreadcrumbTrail $trail, $lead) {
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
Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products.index');
    $trail->push('Edit Product', route('products.edit',$product));
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
Breadcrumbs::for('lead_managers.edit', function (BreadcrumbTrail $trail, $lead_manager) {
    $trail->parent('lead_managers.index');
    $trail->push('Edit Lead Manager', route('lead_managers.edit',$lead_manager));
});


// All the breadcrumbs in settings section 
// Dashboard / Settings
Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', route('settings.index'));
});



// Settings / Lead Source
Breadcrumbs::for('settings.lead_sources.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Lead Source', route('settings.lead_sources.index'));
});

// Settings / Lead Sources / Create Lead Source
Breadcrumbs::for('settings.lead_sources.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.lead_sources.index');
    $trail->push('Create Lead Source', route('settings.lead_sources.create'));
});

// Settings / Lead Sources / Edit Lead Source
Breadcrumbs::for('settings.lead_sources.edit', function (BreadcrumbTrail $trail, $lead_source) {
    $trail->parent('settings.lead_sources.index');
    $trail->push('Edit Lead Source', route('settings.lead_sources.edit',$lead_source));
});



// Settings / Lead Pipeline
Breadcrumbs::for('settings.lead_pipelines.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Lead Pipeline', route('settings.lead_pipelines.index'));
});

// Settings / Lead Pipelines / Create Lead Pipeline
Breadcrumbs::for('settings.lead_pipelines.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.lead_pipelines.index');
    $trail->push('Create Lead Pipeline', route('settings.lead_pipelines.create'));
});

// Settings / Lead Pipelines / Edit Lead Pipeline
Breadcrumbs::for('settings.lead_pipelines.edit', function (BreadcrumbTrail $trail, $lead_pipeline) {
    $trail->parent('settings.lead_pipelines.index');
    $trail->push('Edit Lead Pipeline', route('settings.lead_pipelines.edit',$lead_pipeline));
});



// Settings / Lead type
Breadcrumbs::for('settings.lead_types.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Lead type', route('settings.lead_types.index'));
});

// Settings / Lead types / Create Lead type
Breadcrumbs::for('settings.lead_types.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.lead_types.index');
    $trail->push('Create Lead type', route('settings.lead_types.create'));
});

// Settings / Lead types / Edit Lead type
Breadcrumbs::for('settings.lead_types.edit', function (BreadcrumbTrail $trail, $lead_type) {
    $trail->parent('settings.lead_types.index');
    $trail->push('Edit Lead type', route('settings.lead_types.edit',$lead_type));
});



// Settings / Email Templates
Breadcrumbs::for('settings.email_templates.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Email Templates', route('settings.email_templates.index'));
});

// Settings / Email Templates / Create Email Templates
Breadcrumbs::for('settings.email_templates.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.email_templates.index');
    $trail->push('Create Email Templates', route('settings.email_templates.create'));
});

// Settings / Email Templates / Edit Email Template
Breadcrumbs::for('settings.email_templates.edit', function (BreadcrumbTrail $trail, $email_template) {
    $trail->parent('settings.email_templates.index');
    $trail->push('Edit Email Templates', route('settings.email_templates.edit',$email_template));
});



// Settings / Trip
Breadcrumbs::for('settings.trips.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Trip', route('settings.trips.index'));
});

// Settings / Trips / Create Trip
Breadcrumbs::for('settings.trips.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.trips.index');
    $trail->push('Create Trip', route('settings.trips.create'));
});

// Settings / Trips / Edit Trip
Breadcrumbs::for('settings.trips.edit', function (BreadcrumbTrail $trail, $trips) {
    $trail->parent('settings.trips.index');
    $trail->push('Edit Trip', route('settings.trips.edit',$trips));
});



// Settings / Trip Type
Breadcrumbs::for('settings.trip_types.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Trip Type', route('settings.trip_types.index'));
});

// Settings / Trip type / Create Trip type
Breadcrumbs::for('settings.trip_types.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.trip_types.index');
    $trail->push('Create Trip Type', route('settings.trip_types.create'));
});

// Settings / Trip type / Edit trip Type
Breadcrumbs::for('settings.trip_types.edit', function (BreadcrumbTrail $trail, $trip_type) {
    $trail->parent('settings.trip_types.index');
    $trail->push('Edit Trip Type', route('settings.trip_types.edit',$trip_type));
});



// Settings / Accomodations
Breadcrumbs::for('settings.accomodations.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Accomodations', route('settings.accomodations.index'));
});

// Settings / Accomodations / Create Accomodation
Breadcrumbs::for('settings.accomodations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.accomodations.index');
    $trail->push('Create Accomodation', route('settings.accomodations.create'));
});

// Settings / Accomodations / Edit Accomodation
Breadcrumbs::for('settings.accomodations.edit', function (BreadcrumbTrail $trail, $accomodation) {
    $trail->parent('settings.accomodations.index');
    $trail->push('Edit Accomodation', route('settings.accomodations.edit',$accomodation));
});

