<?php

use App\Models\Lead;
use App\Models\Note;
use App\Models\User;
use App\Models\Email;
use App\Models\Activity;
use App\Models\LeadType;
use App\Models\Transport;
use App\Models\LeadPipelineStage;
use Spatie\Permission\Models\Role;
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
Breadcrumbs::for('leads.edit', function (BreadcrumbTrail $trail, Lead $lead) {
    $trail->parent('leads.index');
    $trail->push($lead->title, route('leads.edit', $lead->id));
});

// Dashboard / Leads / [Lead Title]
Breadcrumbs::for('leads.view', function (BreadcrumbTrail $trail,Lead $lead) {
    $trail->parent('leads.index');
    $trail->push($lead->title, route('leads.view', $lead->id));
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

//Quotation
Breadcrumbs::for('quotations.index',function(BreadcrumbTrail $trail){
    $trail->parent('dashboard');
    $trail->push('Quotation', route('quotations.index'));
});
Breadcrumbs::for('quotations.create',function(BreadcrumbTrail $trail){
    $trail->parent('quotations.index');
    $trail->push('Create Quotation', route('quotations.create'));
});
Breadcrumbs::for('quotations.edit',function(BreadcrumbTrail $trail,$id){
    $trail->parent('quotations.index');
    $trail->push('Quotation Edit', route('quotations.edit',$id));
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
Breadcrumbs::for('settings.lead_types.edit', function (BreadcrumbTrail $trail,LeadType $lead_type) {
    $trail->parent('settings.lead_types.index');
    $trail->push('Edit Lead type', route('settings.lead_types.edit',$lead_type));
});

// Settings / Lead Pipeline Stage
Breadcrumbs::for('settings.lead_pipeline_stages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Lead Pipeline Stage', route('settings.lead_pipeline_stages.index'));
});

// Settings / Lead Pipeline Stages / Create Lead Pipeline Stage
Breadcrumbs::for('settings.lead_pipeline_stages.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.lead_pipeline_stages.index');
    $trail->push('Create Lead Pipeline Stage', route('settings.lead_pipeline_stages.create'));
});

// Settings / Lead Pipeline Stages / Edit Lead Pipeline Stage
Breadcrumbs::for('settings.lead_pipeline_stages.edit', function (BreadcrumbTrail $trail,LeadPipelineStage $lead_pipeline_stage) {
    $trail->parent('settings.lead_pipeline_stages.index');
    $trail->push('Edit Lead Pipeline Stage', route('settings.lead_pipeline_stages.edit',$lead_pipeline_stage));
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

// Settings / Transport
Breadcrumbs::for('settings.transports.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Transport', route('settings.transports.index'));
});

// Settings / Transport / Create Transport
Breadcrumbs::for('settings.transports.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.transports.index');
    $trail->push('Create Transport', route('settings.transports.create'));
});

// Settings / Transport / Edit Transport
Breadcrumbs::for('settings.transports.edit', function (BreadcrumbTrail $trail, Transport $transport) {
    $trail->parent('settings.transports.index');
    $trail->push('Edit Transport', route('settings.transports.edit',$transport));
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


// ----------------------------------------------------------------

// Settings / Roles
Breadcrumbs::for('settings.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Roles', route('settings.roles.index'));
});

// Settings / Roles / Create role
Breadcrumbs::for('settings.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.roles.index');
    $trail->push('Create Role', route('settings.roles.create'));
});

// Settings / Roles / Edit Role
Breadcrumbs::for('settings.roles.edit', function (BreadcrumbTrail $trail,Role $role) {
    $trail->parent('settings.roles.index');
    $trail->push('Edit Role', route('settings.roles.edit',$role));
});



// Settings / Users
Breadcrumbs::for('settings.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.index');
    $trail->push('Users', route('settings.users.index'));
});

// Settings / Users / Create User
Breadcrumbs::for('settings.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.users.index');
    $trail->push('Create user', route('settings.users.create'));
});

// Settings / Users / Edit User
Breadcrumbs::for('settings.users.edit', function (BreadcrumbTrail $trail,User $user) {
    $trail->parent('settings.users.index');
    $trail->push('Edit User', route('settings.users.edit',$user));
});

// Dashboard / Mails
Breadcrumbs::for('mails.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Mail', route('mails.index'));
});

// Dashboard / Mails  / Inbox
Breadcrumbs::for('mails.inbox', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Inbox', route('mails.inbox'));
});

// Dashboard / Mails /Compose
Breadcrumbs::for('mails.compose', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Compose Mail', route('mails.compose'));
});

// Dashboard / Mails  / Sent
Breadcrumbs::for('mails.sent', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Sent', route('mails.sent'));
});

// Dashboard / Mails  / Draft
Breadcrumbs::for('mails.draft', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Draft', route('mails.draft'));
});

// Dashboard / Mails  / Outbox
Breadcrumbs::for('mails.outbox', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Outbox', route('mails.outbox'));
});

// Dashboard / Mails  / Trash
Breadcrumbs::for('mails.trash', function (BreadcrumbTrail $trail) {
    $trail->parent('mails.index');
    $trail->push('Trash', route('mails.trash'));
});

//Dashboard / Mails / Draft / Edit
Breadcrumbs::for('mails.editdraft', function (BreadcrumbTrail $trail,$id) {
    $trail->parent('mails.draft');
    $trail->push('Edit Draft', route('mails.editdraft',$id));
});

// Dashboard / Profile / Edit Profile
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit',$user));
});

// Dashboard / Activities
Breadcrumbs::for('activities.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Activities', route('activities.index'));
});

// Dashboard / Activities / Create Activity
Breadcrumbs::for('activities.create', function (BreadcrumbTrail $trail) {
    $trail->parent('activities.index');
    $trail->push('Create Activity', route('activities.create'));
});

// Dashboard / Activities / Edit Activity
Breadcrumbs::for('activities.edit', function (BreadcrumbTrail $trail, Activity $activity) {
    $trail->parent('activities.index');
    $trail->push('Edit Activity', route('activities.edit',$activity));
});