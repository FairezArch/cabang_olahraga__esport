<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\RegisterMember;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\BranchSportController;
use App\Http\Controllers\HeaderFormController;
use App\Http\Controllers\UsersNoMember;
use App\Http\Controllers\ResponsesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InfoClubController;

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
// Route::get('/',[FrontendController::class,'index']);
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/tologin',[LoginController::class,'login'])->name('tologin');

Route::get('register',[RegisterMember::class,'index'])->name('register.member');
Route::post('register/add',[RegisterMember::class,'add'])->name('register.add');

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class,'logout'])->name('logout');
    
    Route::group(['middleware' => ['permission:dashboards']], function(){
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
        Route::get('dashboard/event/{slug}',[DashboardController::class,'eventview']);
        Route::get('dashboard/game/{slug}',[DashboardController::class,'gameview']);
        Route::get('dashboard/award/{slug}',[DashboardController::class,'awardview']);
        Route::get('dashboard/joinClub/{slug}',[DashboardController::class,'joinclub']);
        Route::post('dashboard/joinClub/{slug}/insert',[DashboardController::class,'joinclubInsert']);
        Route::post('dashboard/event/{slug}/joinevent',[DashboardController::class,'joinevent']);
    });
    
    Route::group(['middleware' => 'role:superadmin'], function(){
        Route::group(['middleware' => ['permission:admins-list|admins-create|admins-edit|admins-delete']], function(){
            Route::get('admins',[UsersController::class,'index'])->name('admins');
            Route::get('admins/add',[UsersController::class,'create'])->name('admins.add');
            Route::post('admins/insert',[UsersController::class,'store'])->name('admins.insert');
            Route::get('admins/{id}/edit',[UsersController::class,'show'])->name('admins.show');
            Route::put('admins/{id}/update',[UsersController::class,'update'])->name('admins.update');
            Route::get('admins/{id}/delete',[UsersController::class,'destroy'])->name('admins.delete');
        });

        Route::group(['middleware' => ['permission:roles-list|roles-create|roles-edit|roles-delete']], function(){
            Route::get('roles',[RolesController::class,'index'])->name('roles');
            Route::get('roles/add',[RolesController::class,'create'])->name('roles.add');
            Route::post('roles/insert',[RolesController::class,'store'])->name('roles.insert');
            Route::get('roles/{id}/edit',[RolesController::class,'show'])->name('roles.show');
            Route::put('roles/{id}/update',[RolesController::class,'update'])->name('roles.update');
            Route::get('roles/{id}/delete',[RolesController::class,'destroy'])->name('roles.delete');
        });
    });

    Route::group(['middleware' => ['permission:events-list|events-create|events-edit|events-delete']], function(){
        Route::get('events/{id}/participation',[EventsController::class,'participation'])->name('events.participation');
        Route::resource('events',EventsController::class);
    });

    Route::group(['middleware' => ['permission:news-list|news-create|news-edit|news-delete']], function(){
        Route::resource('news',NewsController::class);
    });

    Route::group(['middleware' => ['permission:games-list|games-create|games-edit|games-delete']], function(){
        Route::get('games',[GamesController::class,'index'])->name('games');
        Route::get('games/add',[GamesController::class,'create'])->name('games.add');
        Route::post('games/insert',[GamesController::class,'store'])->name('games.insert');
        Route::get('games/{id}/edit',[GamesController::class,'show'])->name('games.show');
        Route::put('games/{id}/update',[GamesController::class,'update'])->name('games.update');
        Route::get('games/{id}/delete',[GamesController::class,'destroy'])->name('games.delete');
    });

    Route::group(['middleware' => ['permission:clubs-edit|atlet-list|atlet-create|atlet-edit|atlet-delete']], function(){
        Route::get('clubs/{club_id}/members/mail',[MembersController::class,'mail']);
        Route::post('clubs/{club_id}/members/mailsend',[MembersController::class,'sendmail']);
        
        Route::get('clubs/{club_id}/members/select',[MembersController::class,'selectmember']);
        Route::post('clubs/{club_id}/members/selectadd',[MembersController::class,'directjoin']);

        Route::get('clubs/{club_id}/atlet/request',[MembersController::class,'requestmember']);
        Route::post('clubs/{club_id}/atlet/request/approve/{id}',[MembersController::class,'requestmemberapprove']);
        Route::post('clubs/{club_id}/atlet/request/delete/{id}',[MembersController::class,'requestmemberdelete']);

        Route::get('clubs/{club_id}/atlet',[MembersController::class,'index']);
        Route::get('clubs/{club_id}/atlet/create',[MembersController::class,'create']);
        Route::post('clubs/{club_id}/atlet/store',[MembersController::class,'store']);
        Route::get('clubs/{club_id}/atlet/edit/{id}',[MembersController::class,'edit']);
        Route::put('clubs/{club_id}/atlet/update/{id}',[MembersController::class,'update']);
        Route::delete('clubs/{club_id}/atlet/delete/{id}',[MembersController::class,'destroy']);

        
    });

    Route::group(['middleware' => ['permission:clubs-edit|teams-list|teams-create|teams-edit|teams-delete']], function(){
        Route::get('clubs/{club_id}/teams',[TeamsController::class,'index']);
        Route::get('clubs/{club_id}/teams/create',[TeamsController::class,'create']);
        Route::post('clubs/{club_id}/teams/store',[TeamsController::class,'store']);
        Route::get('clubs/{club_id}/teams/edit/{id}',[TeamsController::class,'edit']);
        Route::put('clubs/{club_id}/teams/update/{id}',[TeamsController::class,'update']);
        Route::delete('clubs/{club_id}/teams/delete/{id}',[TeamsController::class,'destroy']);
    });

    Route::group(['middleware' => ['permission:clubs-list|clubs-create|clubs-edit|clubs-delete']], function(){
        Route::get('clubs/{id}/participation',[ClubsController::class,'participation'])->name('clubs.participation');
        Route::resource('clubs',ClubsController::class);
    });

    Route::group(['middleware' => ['permission:awards-list|awards-create|awards-edit|awards-delete']], function(){
        Route::resource('awards',AwardsController::class);
    });


    Route::group(['middleware' => ['permission:organizations-event-list|organizations-event-create|organizations-event-edit|organizations-event-delete']], function(){
        Route::get('organizations/{idorg}/event',[OrganizationsController::class,'eventindex']);
        Route::get('organizations/{idorg}/event/create',[OrganizationsController::class,'eventcreate']);
        Route::get('organizations/{idorg}/event/edit/{id}',[OrganizationsController::class,'eventedit']);
        Route::post('organizations/{idorg}/event/store',[OrganizationsController::class,'eventstore']);
        Route::put('organizations/{idorg}/event/update/{id}',[OrganizationsController::class,'eventupdate']);
        Route::delete('organizations/{idorg}/event/delete/{id}',[OrganizationsController::class,'eventdestroy']);
    });

    Route::group(['middleware' => ['permission:organizations-list|organizations-create|organizations-edit|organizations-delete']], function(){
        Route::get('clubs/{club_id}/organizations',[OrganizationsController::class,'index']);
        Route::get('clubs/{club_id}/organizations/create',[OrganizationsController::class,'create']);
        Route::post('clubs/{club_id}/organizations/store',[OrganizationsController::class,'store']);
        Route::get('clubs/{club_id}/organizations/edit/{id}',[OrganizationsController::class,'edit']);
        Route::put('clubs/{club_id}/organizations/update/{id}',[OrganizationsController::class,'update']);
        Route::delete('clubs/{club_id}/organizations/delete/{id}',[OrganizationsController::class,'destroy']);
    });

    Route::get('profile',[ProfilesController::class,'index'])->name('profile.show');
    Route::put('profile/{id}/update',[ProfilesController::class,'update'])->name('profile.update');
    Route::resource('responses',ResponsesController::class);
    Route::group(['middleware' => 'role:superadmin'], function(){
        Route::resource('branchs',BranchSportController::class);
    });
    Route::get('infoclub',[InfoClubController::class,'index']);
    Route::resource('forms',HeaderFormController::class);
    // Route::group(['middleware' => ['permission:users-list|users-create|users-edit|users-delete']], function(){
    //     Route::resource('users',UsersNoMember::class);
    // });
});
