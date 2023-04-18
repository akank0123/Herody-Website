<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManagerController as Manager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('privacy-policy',function(){
    return view('privacy-policy');
})->name('privacy-policy');
Route::get('user/email-verified/{id}','User\DashboardController@email_verified');
// Admin
Route::get('admin','Admin\HomeController@index')->name('admin');
Route::post('admin','Admin\HomeController@login')->name('admin');

Route::get('admin/managers', [Manager::class, 'index'])->name('admin.managers');
Route::post('admin/manager/create',[Manager::class, 'create'])->name('admin.manager.create'); 
Route::post('admin/manager/delete',[Manager::class, 'delete'])->name('admin.manager.delete'); 

Route::middleware(['Admin.Auth'])->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
   
     Route::get('bforms','HomeController@bformv')->name('bforms');
     Route::post('bform/delete','HomeController@delete')->name('bform.delete');
  
Route::get('create','EmployerController@create')->name('employer.create');
    Route::post('create','EmployerController@store')->name('employer.create');
    // Dashboard
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    Route::get('change-password','HomeController@changePassword')->name('changePassword');
    Route::post('change-password','HomeController@PasswordUpdate')->name('changePassword');
    Route::post('logout','HomeController@logout')->name('logout');

    // Campaigns
    Route::get('campaigns','MissionController@index')->name('missions');
    Route::get('campaign/create','MissionController@creater')->name('mission.create');
    Route::post('campaign/create','MissionController@create')->name('mission.create');
    Route::post('campaign/editform','MissionController@editform')->name('mission.editform');
    Route::put('campaign/updateform/{id}','MissionController@updateform')->name('mission.updateform');
    Route::post('storeForm','MissionController@storeForm')->name('mission.storeForm');
    Route::post('campaign/delete','MissionController@delete')->name('mission.delete');
    Route::get('campaign/applications/{id}','MissionController@applications')->name('mission.applications');
    Route::get('campaign/applications/accept/{id}','MissionController@accept')->name('mission.accept');
    Route::get('campaign/applications/reject/{id}','MissionController@reject')->name('mission.reject');
    Route::get('campaign/response/{id}','MissionController@response')->name('mission.response');
    Route::post('campaign/response/accept','MissionController@acceptResp')->name('mission.acceptResp');
    Route::post('campaign/response/reject','MissionController@rejectResp')->name('mission.rejectResp');
    Route::post('campaign/make-mobile', 'MissionController@makeMobile')->name('mission.make-mobile');
    Route::post('campaign/undo-mobile', 'MissionController@undoMobile')->name('mission.undo-mobile');

    //Gig
    Route::get('gig', 'CampaignController@ShowAllCampaign')->name('campaign.all');
    Route::get('pending-gig', 'CampaignController@pendings')->name('campaign.pendings');
    Route::get('gig-log', 'CampaignController@ShowCampaignLog')->name('campaign.log');
    Route::get('create-gig', 'CampaignController@CreateCampaign')->name('campaign.create');
    Route::post('create-gig', 'CampaignController@StoreCampaign')->name('store.campaign');
    Route::get('approve-gig/{id}','CampaignController@approveCampaign')->name('campaignp.approve');
    Route::get('reject-gig/{id}','CampaignController@rejectCampaign')->name('campaignp.reject');

    Route::post('gig-delete', 'CampaignController@DeleteCampaign')->name('campaign.delete');
    Route::get('gig-applications/{id}', 'CampaignController@Campaignapp')->name('campaign.app');
    Route::get('gig-applications/{jid}/approve/{uid}', 'CampaignController@Campaignapprove')->name('campaign.approve');
    Route::get('gig-applications/{jid}/reject/{uid}', 'CampaignController@Campaignreject')->name('campaign.reject');
    Route::get('gig-proofs/{jid}/view/{uid}','CampaignController@viewproof')->name('campaign.viewproof');
    Route::get('gig-proofs/{jid}/view/{uid}/accept','CampaignController@acceptproof')->name('campaign.acceptproof');
    Route::get('gig-proofs/{jid}/view/{uid}/reject','CampaignController@rejectproof')->name('campaign.rejectproof');
    Route::post('gig/make-mobile', 'CampaignController@makeMobile')->name('campaign.make-mobile');
    Route::post('gig/undo-mobile', 'CampaignController@undoMobile')->name('campaign.undo-mobile');

    //campaign category
    Route::resource('campaign_category', 'CampaignCategoryController');

    //Projects
    Route::get('pending-project', 'JobController@pending')->name('job.pending');
    Route::get('all-project', 'JobController@all')->name('job.all');
    Route::post('approve-project', 'JobController@approve')->name('job.approve');
    Route::post('delete-project', 'JobController@delete')->name('job.delete');
    Route::post('project/make-mobile', 'JobController@makeMobile')->name('job.make-mobile');
    Route::post('project/undo-mobile', 'JobController@undoMobile')->name('job.undo-mobile');

    //member manage
    Route::get('member', 'MemberManageController@ShowAllMember')->name('member.all');
    Route::get('pending-regs', 'MemberManageController@pending')->name('member.pending');
    Route::get('pending-regs/approve/{id}', 'MemberManageController@approve')->name('member.approve');
    Route::get('pending-regs/reject/{id}', 'MemberManageController@reject')->name('member.reject');
    Route::get('member/{id}', 'MemberManageController@ShowMemberDetails')->name('member.details');
    Route::post('member-update', 'MemberManageController@MemberUpdate')->name('member.update');

    Route::get('withdraw-report/{id}', 'MemberManageController@WithdrawReport')->name('member.withdraw_report');
    Route::get('campaign-report/{id}', 'MemberManageController@CampaignReport')->name('member.campaign_report');
    Route::get('project-report/{id}', 'MemberManageController@projectReport')->name('member.project_report');
    Route::get('gig-report/{id}', 'MemberManageController@gigReport')->name('member.gig_report');
    Route::get('member/export/excel', 'MemberManageController@excel_export')->name('member.export');
    Route::get('member/export/referrals', 'MemberManageController@excel_referrals')->name('member.export.referrals');

    //Withdraw methods
    Route::get('withdraw', 'WithdrawController@index')->name('withdraw.index');
    Route::post('withdraw/store', 'WithdrawController@store')->name('withdraw.store');
    Route::put('withdraw/update/{id}', 'WithdrawController@update')->name('withdraw.update');
    Route::delete('withdraw/destroy', 'WithdrawController@destroy')->name('withdraw.destroy');

    Route::get('withdraw-request', 'DashboardController@ShowWithdrawRequest')->name('show.withdraw.request');
    Route::get('withdraw-log', 'DashboardController@ShowWithdrawLog')->name('show.withdraw.log');
    Route::post('withdraw-approve', 'DashboardController@WithdrawApproved')->name('withdraw.approve');
    Route::post('withdraw-reject', 'DashboardController@WithdrawReject')->name('withdraw.reject');

    // Excel Exports
    Route::get('project/export','JobController@export_excel')->name('project.export');
    Route::get('gig/export','CampaignController@export_excel')->name('gig.export');
    Route::get('gig/export/apps/{id}','CampaignController@export_apps')->name('gig.apps.export');
    Route::get('campaign/export','MissionController@export_excel')->name('campaign.export');
    Route::get('campaign/export/apps/{id}','MissionController@export_apps')->name('campaign.apps.export');
    Route::get('withdraw/export','WithdrawController@export_excel')->name('withdraw.export');

    // Employers
    Route::get('employers','EmployerController@index')->name('employers');
    Route::post('employer/login','EmployerController@login')->name('employer.login');

    // Telecallings
    Route::get('telecallings','TelecallingController@index')->name('telecallings');
    Route::get('telecallings/create','TelecallingController@create')->name('telecalling.create');
    Route::post('telecallings/create','TelecallingController@createPost')->name('telecalling.create');
    Route::post('telecallings/delete','TelecallingController@delete')->name('telecalling.delete');
    Route::get('telecalling/applications/{id}','TelecallingController@applications')->name('telecalling.applications');
    Route::post('telecalling/distribute','TelecallingController@distribute')->name('telecalling.distribute');
    Route::post('telecalling/application/select','TelecallingController@select')->name('telecalling.select');
    Route::post('telecalling/application/reject','TelecallingController@reject')->name('telecalling.reject');
    Route::get('telecalling/application/view-data/{tid}/{uid}','TelecallingController@viewData')->name('telecalling.viewdata');
    Route::get('telecalling/application/view-feedback/{id}','TelecallingController@feedback')->name('telecalling.feedback');
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('bform/','BformController@bform')->name('bform');
Route::post('bform/','BformController@update')->name('bform.update');
    
    

Route::get('/digital', function () {
    return view('digital');
});
Route::get('/digital',function(){
    return view('digital');
})->name('digital');
Route::get('/gigworkers',function(){
    return view('gigworkers');
})->name('gigworkers');

Route::get('/businesses',function(){
    return view('businesses');
})->name('businesses');

Route::get('/home', 'HomeController@index')->name('home');

// Non-authenticated Employer
Route::get('for-businesses','Employer\HomeController@to_register')->name('employer.for-businesses');
Route::post('for-businesses','Employer\HomeController@register')->name('employer.register');
Route::get('business/login','Employer\HomeController@to_login')->name('employer.login');
Route::get('employer/verify-email','Employer\HomeController@resendemail')->name('employer.verify.email')->middleware(['employerAuth']);
Route::post('employer/verify-email','Employer\HomeController@brand')->name('employer.verify.emailr')->middleware(['employerAuth']);
Route::get('employer/brand','Employer\DashboardController@brand')->name('employer.brand')->middleware(['employerAuth','empEmail']);
Route::post('employer/brand','Employer\DashboardController@savecompany')->name('employer.save.company')->middleware(['employerAuth','empEmail']);
Route::post('business/login','Employer\HomeController@login')->name('employer.login');
Route::get('employer/logout','Employer\HomeController@logout')->name('employer.logout')->middleware(['employerAuth']);

// Truecaller
Route::post('truecaller','TrueCallerController@login')->name('truecaller.login');

//World Controller
Route::post('/getstates','WorldController@states')->name('world.states');
Route::post('getcities','WorldController@cities')->name('world.cities');

// Employer
Route::middleware(['employerAuth','empEmail','BrandCheck'])->namespace('Employer')->prefix('employer')->name('employer.')->group(function(){
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    Route::get('profile','DashboardController@profile')->name('profile');
    Route::post('profile','DashboardController@update_profile')->name('profile');
    Route::post('profile-image','DashboardController@upload_profile_image')->name('profile_image.update');
    Route::get('change-pass','DashboardController@change_passr')->name('changepass');
    Route::post('change-pass','DashboardController@change_pass')->name('changepass');
    
    Route::get('projects','JobController@manage')->name('job.manage');
    Route::get('projects/post','JobController@postr')->name('job.post');
    Route::post('projects/post','JobController@post')->name('job.post');
    Route::post('projects/post/benefits','JobController@postbene')->name('job.benefits');
    Route::get('projects/post/confirmation','JobController@confirmation')->name('job.confirmation');
    Route::get('project/edit/{id}','JobController@editr')->name('job.edit');
    Route::post('project/edit/{id}','JobController@edit')->name('job.edit');
    Route::get('project/delete/{id}','JobController@delete')->name('job.delete');
    Route::get('project/applications/{id}','JobController@applications')->name('job.applications');
    Route::get('project/applications/{id}/shortlisteds','JobController@shortlisteds')->name('job.shortlisteds');
    Route::get('project/applications/{id}/shortlist/{uid}','JobController@shortlist')->name('job.shortlist');
    Route::post('project/applications/shortlistall','JobController@shortlistall')->name('job.shortlistall');
    Route::get('project/applications/{id}/reject/{uid}','JobController@reject')->name('job.reject');
    Route::post('project/applications/rejectall','JobController@rejectall')->name('job.rejectall');
    Route::get('project/applications/{id}/select/{uid}','JobController@select')->name('job.select');
    Route::post('project/applications/selectall','JobController@selectall')->name('job.selectall');
    Route::get('project/applications/{id}/selecteds','JobController@selecteds')->name('job.selecteds');
    Route::get('project/applications/{jid}/{uid}/issue_certificate','JobController@issue_certificate')->name('job.issue_certificate');
    Route::post('project/applications/{jid}/payout','JobController@payout')->name('job.payout');
    Route::get('project/applications/{jid}/{uid}/proofs','JobController@proofs')->name('job.proofs');
    Route::get('project/{id}/download-proofs','JobController@export_excel')->name('job.eproof');
    Route::get('project/applications/{jid}/{uid}/answers','JobController@answers')->name('job.answers');
    Route::get('project/{id}/exportapps','JobController@exportapps')->name('job.exportapps');
    Route::get('project/{id}/exportsl','JobController@exportsl')->name('job.exportsl');

    Route::get('gigs','GigController@manage')->name('campaign.manage');
    Route::get('gigs/create','GigController@creater')->name('campaign.create');
    Route::post('gigs/create','GigController@create')->name('campaign.create');
     Route::get('gigs/edit','GigController@editer')->name('campaign.editer');
    Route::post('gigs/edit','GigController@edit')->name('campaign.edit');
    Route::get('gig/{id}/applications','GigController@applications')->name('gig.applications');
    Route::post('gig/delete','GigController@delete')->name('gig.delete');
    Route::get('gig/{jid}/applications/{uid}/approve','GigController@approveApp')->name('campaign.approve');
    Route::get('gig/{jid}/applications/{uid}/reject','GigController@rejectApp')->name('campaign.reject');
    Route::get('gig/{jid}/applications/{uid}/view-proof','GigController@viewproof')->name('campaign.viewproof');
    Route::get('gig/{jid}/applications/{uid}/view-proof/accept','GigController@acceptproof')->name('campaign.acceptproof');
    Route::get('gig/{jid}/applications/{uid}/view-proof/reject','GigController@rejectproof')->name('campaign.rejectproof');
    Route::get('gig/{id}/download-proofs','GigController@export_excel')->name('campaign.eproof');
    Route::get('gig/{id}/edit','GigController@edit')->name('gig.edit');
    Route::post('gig/{id}/editp','GigController@editp')->name('gig.editp');
    Route::get('gig/{id}/exportapps','GigController@exportapps')->name('gig.exportapps');
    
    // Campaigns
    Route::get('campaigns','CampaignController@index')->name('missions');
    Route::post('campaign/delete','CampaignController@delete')->name('mission.delete');
    Route::get('campaign/applications/{id}','CampaignController@applications')->name('mission.applications');
    Route::get('campaign/applications/accept/{id}','CampaignController@accept')->name('mission.accept');
    Route::get('campaign/applications/reject/{id}','CampaignController@reject')->name('mission.reject');
    Route::get('campaign/response/{id}','CampaignController@response')->name('mission.response');
    Route::post('campaign/response/accept','CampaignController@acceptResp')->name('mission.acceptResp');
    Route::post('campaign/response/reject','CampaignController@rejectResp')->name('mission.rejectResp');
});
Route::get('employer/email-not-verified',function(){
    return view('employer.pages.text_email_verify');
})->name('employer.email.verify');

// Project
Route::get('projects','ProjectController@list')->name('projects');
Route::get('project/{id}','ProjectController@details')->name('job.details');
Route::post('project/apply','ProjectController@apply')->name('job.apply');
Route::post('project/location','ProjectController@loc')->name('job.location');
Route::post('project/category','ProjectController@cat')->name('job.cat');
Route::post('project/proof','ProjectController@proofs')->name('job.proof');

// Gigs
Route::get('gigs','GigController@list')->name('gigs');
Route::get('gig/details/{id}','GigController@details')->name('campaign.details');
Route::post('gig/details/apply','GigController@apply')->name('campaign.apply');
Route::get('gigs/cat/{id}','GigController@cats')->name('campaign.cat');

// Gig proofs
Route::post('gig/proof/fb','GigController@prooffb')->name('campaign.prooffb');
Route::post('gig/proof/wa','GigController@proofwa')->name('campaign.proofwa');
Route::post('gig/proof/insta','GigController@proofinsta')->name('campaign.proofinsta');
Route::post('gig/proof/yt','GigController@proofyt')->name('campaign.proofyt');
Route::post('gig/proof/instap','GigController@proofinstap')->name('campaign.proofinstap');
Route::post('gig/proof/os','GigController@proofos')->name('campaign.proofos');
Route::post('gig/proof/ar','GigController@proofar')->name('campaign.proofar');
Route::post('gig/proof/ls','GigController@proofls')->name('campaign.proofls');

// Applicant View
Route::get('users/{id}','JobController@selecteds')->name('applicant.view');
Route::get('users/{id}/print','JobController@selecteds')->name('print.view');

// Campaigns
Route::get('campaigns','CampaignController@list')->name('campaigns');
Route::get('campaign/details/{id}','CampaignController@details')->name('mission.details');
Route::post('campaign/apply','CampaignController@apply')->name('mission.apply')->middleware(['auth','verified']);
Route::post('campaign/submit-response','CampaignController@responser')->name('campaign.responser')->middleware(['auth','verified']);
Route::get('campaign/submit-responsea/{id}/{uid}','CampaignController@responsera')->name('campaign.responsera');
Route::post('campaign/submit/{id}/{cid}','CampaignController@response')->name('campaign.response')->middleware(['auth','verified']);


// Users
Route::get('user/mobile-not-verified','User\DashboardController@mobileNotVerified')->name('user.mobile-not-ver')->middleware(['auth','verified']);
Route::get('user/verify-mobile','User\DashboardController@verifyMobiler')->name('user.verify-mobile')->middleware(['auth','verified']);
Route::post('user/verify-mobile','User\DashboardController@verifyMobile')->name('user.verify-mobilep')->middleware(['auth','verified']);
Route::middleware(['auth'])->namespace('User')->prefix('user')->name('user.')->group(function(){
    Route::get('app-download','DashboardController@download')->name('download_app');
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');
    Route::get('resume','DashboardController@resume')->name('resume');
    Route::post('edu-update','DashboardController@eduUpdate')->name('edu-update');
    Route::post('exp-update','DashboardController@expUpdate')->name('exp-update');
    Route::post('proj-update','DashboardController@projUpdate')->name('proj-update');
    Route::post('skill-update','DashboardController@skillUpdate')->name('skill-update');
    Route::post('hobby-update','DashboardController@hobbyUpdate')->name('hobby-update');
    Route::post('ach-update','DashboardController@achUpdate')->name('ach-update');
    Route::post('social-update','DashboardController@socialUpdate')->name('social-update');
    Route::get('edu-delete/{id}','DashboardController@eduDelete')->name('edu-delete');
    Route::get('exp-delete/{id}','DashboardController@expDelete')->name('exp-delete');
    Route::get('proj-delete/{id}','DashboardController@projDelete')->name('proj-delete');
    Route::get('skill-delete/{id}','DashboardController@skillDelete')->name('skill-delete');
    Route::get('profile','DashboardController@profile')->name('profile');
    Route::post('profile','DashboardController@updateProfile')->name('profile');
    Route::get('change-pass','DashboardController@changepwr')->name('changePassword');
    Route::post('change-pass','DashboardController@updatePassword')->name('changePassword');

    // Withdraw
    Route::get('withdraw','DashboardController@ShowWithdrawMethod')->name('withdraw');
    Route::get('withdraw-log', 'DashboardController@ShowWithdrawLog')->name('show_withdraw_log');
    Route::post('withdraw-preview', 'DashboardController@WithdrawPreview')->name('withdraw_preview');
    Route::post('withdraw-confirm', 'DashboardController@WithdrawConfirm')->name('withdraw_confirm');
    Route::get('logout','DashboardController@logout')->name('logout');

    Route::get('projects','DashboardController@projects')->name('projects.show');

    Route::get('gigs','DashboardController@gigs')->name('gigs.show');

    Route::get('campaigns','DashboardController@campaigns')->name('campaigns.show');
});

//User View
Route::post('acc_details',"RazorpayController@create_contact");
Route::get('users/{id}','ApplicantController@index')->name('applicant.view');
Route::get('users/{id}/print-resume','ApplicantController@printv')->name('print.view');
Route::get('users/{id}/print-pdf','ApplicantController@print')->name('print.pdf');

//Certificate Controller
Route::get('certificate/{jid}/user/{uid}/view','ApplicantController@printc')->name('certificate.print');


//Manager Routes
Route::get('manager/users/export/excel','Admin\MemberManageController@excel_export')->name('manager.member.export');
Route::get('manager/users/export/excel/ref','Admin\MemberManageController@excel_referrals')->name('manager.member.export.referrals');
Route::get('manager/login','Manager\HomeController@loginr')->name('manager.loginr');
Route::post('manager/login','Manager\HomeController@login')->name('manager.login');
Route::middleware(['Manager'])->prefix('manager')->name('manager.')->namespace('Manager')->group(function(){
    Route::get('dashboard','MainController@dashboard')->name('dashboard');
    Route::get('pending-projects','MainController@pendingjobs')->name('pendingjobs');
    Route::get('all-projects','MainController@jobAll')->name('jobs.all');
    Route::post('pending-projects/approve','MainController@jobApprove')->name('job.approve');
    Route::post('pending-projects/reject','MainController@jobReject')->name('job.delete');
    Route::get('pending-gigs','MainController@pendingGigs')->name('gigs.pending');
    Route::get('all-gigs','MainController@allGigs')->name('gigs.all');
    Route::get('create-gigs','MainController@createGig')->name('gigs.create');
    Route::post('create-gigs','MainController@storeGig')->name('gig.create');
    Route::get('approve-campaign/{id}','MainController@approveCampaign')->name('campaign.approve');
    Route::get('reject-campaign/{id}','MainController@rejectCampaign')->name('campaign.reject');
    // Campaigns
    Route::get('campaigns','CampaignController@index')->name('missions');
    Route::get('campaign/create','CampaignController@creater')->name('mission.create');
    Route::post('campaign/create','CampaignController@create')->name('mission.create');
    Route::post('storeForm','CampaignController@storeForm')->name('mission.storeForm');
    Route::post('campaign/delete','CampaignController@delete')->name('mission.delete');
    Route::get('campaign/applications/{id}','CampaignController@applications')->name('mission.applications');
    Route::get('campaign/applications/accept/{id}','CampaignController@accept')->name('mission.accept');
    Route::get('campaign/applications/reject/{id}','CampaignController@reject')->name('mission.reject');
    Route::get('campaign/response/{id}','CampaignController@response')->name('mission.response');
    Route::post('campaign/response/accept','CampaignController@acceptResp')->name('mission.acceptResp');
    Route::post('campaign/response/reject','CampaignController@rejectResp')->name('mission.rejectResp');

    // Employers
    Route::get('employers','EmployerController@index')->name('employers');
    Route::post('employer/login','EmployerController@login')->name('employer.login');

    // Telecallings
    Route::get('telecallings','TelecallingController@index')->name('telecallings');
    Route::get('telecallings/create','TelecallingController@create')->name('telecalling.create');
    Route::post('telecallings/create','TelecallingController@createPost')->name('telecalling.create');
    Route::post('telecallings/delete','TelecallingController@delete')->name('telecalling.delete');
    Route::get('telecalling/applications/{id}','TelecallingController@applications')->name('telecalling.applications');
    Route::post('telecalling/distribute','TelecallingController@distribute')->name('telecalling.distribute');
    Route::post('telecalling/application/select','TelecallingController@select')->name('telecalling.select');
    Route::post('telecalling/application/reject','TelecallingController@reject')->name('telecalling.reject');
    Route::get('telecalling/application/view-data/{tid}/{uid}','TelecallingController@viewData')->name('telecalling.viewdata');
    Route::get('telecalling/application/view-feedback/{id}','TelecallingController@feedback')->name('telecalling.feedback');

    
    Route::get('logout','HomeController@logout')->name('logout');
});

// TEST
// Route::get('test','TestController@test');
Route::get('/acc_details',"RazorpayController@create_contact");
Route::post('/acc_details',"RazorpayController@add_contact");
Route::get('/givereward/{id}/{amt}',"RazorpayController@givereward");

