<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\SceanceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//---------------------------------- ACCUEIL ----------------------------------//
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

//---------------------------------- PROFIL ----------------------------------//
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//---------------------------------- ADMINISTRATEUR ----------------------------------//
Route::get('/administrateur', function () {
    return view('administrateur');
})->middleware(['auth:sanctum', 'verified','role:administrateur'])->name('administrateur.accueil');

//---------------------------------- COACH ----------------------------------//
Route::get('/coach', function () {
    return view('coach');
})->middleware(['auth:sanctum', 'verified','role:coach'])->name('coach.accueil');

//---------------------------------- CHALLENGER ----------------------------------//
Route::get('/challenger', function () {
    return view('challenger');
})->middleware(['auth:sanctum', 'verified','role:challenger'])->name('challenger.accueil');




//---------------------------------- ADMINISTRATEUR ACCESS ----------------------------------//
Route::middleware(['auth:sanctum','role:administrateur'])->prefix("/administrateur")->group(function(){
    //----- CRUD CATEGORY -----//
        Route::resource('categories', CategoryController::class);

    //----- CRUD ROLE -----//
        Route::resource('roles', RoleController::class);

    //----- CRUD PERMISSION -----//
        Route::resource('permissions', PermissionController::class);

    //----- CRUD PRODUCT -----//
        Route::resource('produits', ProduitController::class);

    //----- MANAGE USER ROLE & PERMISSION -----//
        //role <<----- permission
            Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        //permission <<----- role
            Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
            Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
        // -----crud user -> role & permission -----//
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
            Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
            Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
            Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
        //coach assign challengers
            Route::get('/users/{user}/coaching/coach', [UserController::class, 'updateChallengersForm'])->name('users.updateChallengersForm');
            Route::post('/users/{user}/coaching/coach/challengers', [UserController::class, 'updateChallengers'])->name('users.updateChallengers');
        //challenger assign coachs
            Route::get('/users/{user}/coaching/challenger', [UserController::class, 'updateCoachesForm'])->name('users.updateCoachesForm');
            Route::post('/users/{user}/coaching/challenger/coaches', [UserController::class, 'updateCoaches'])->name('users.updateCoaches');

        //coacher un challenger
            Route::get('/users/{user}/coach/sceance', [UserController::class, 'assignSceanceCoachChallengerForm'])->name('users.assignSceanceCoachChallengerForm');
            Route::post('/users/{user}/coach/sceance/valid', [UserController::class, 'assignSceanceCoachChallenger'])->name('users.assignSceanceCoachChallenger');
        //challenger get sceance
            Route::get('/users/{user}/challenger/sceance', [UserController::class, 'assignSceanceChallengerCoachForm'])->name('users.assignSceanceChallengerCoachForm');
            Route::post('/users/{user}/challenger/sceance/valid', [UserController::class, 'assignSceanceChallengerCoach'])->name('users.assignSceanceChallengerCoach');

});


//---------------------------------- COACH ACCESS ----------------------------------//
Route::middleware(['auth:sanctum','role:coach'])->name('coach.')->prefix("/coach")->group(
    function(){
    //----- CRUD PRODUCT -----//
        Route::resource('trainings', TrainingController::class);

    //----- COACHES -----//
        Route::get('challengers', [UserController::class, 'myChallengers'])->name('challengers.index');

    //----- Sceances -----//
        Route::resource('sceances', SceanceController::class);
        Route::post('sceances/{sceance}/addTrainings', [SceanceController::class, 'addTrainings'])->name('addTrainings');
        Route::put('sceances/{sceance}/updateTrainings', [SceanceController::class, 'updateTrainings'])->name('updateTrainings');
        Route::get('/sceances/{sceance}/editTrainings', [SceanceController::class, 'editTrainings'])->name('editTrainings');
        Route::get('/sceances/{sceance}/showToDelete', [SceanceController::class, 'showToDelete'])->name('showToDelete');
        Route::delete('/sceances/{sceance}/deleteTraining/{training}/{id}', [SceanceController::class, 'deleteTraining'])->name('deleteTraining');
        
});

//---------------------------------- CHALLENGER ACCESS ----------------------------------//
Route::middleware(['auth:sanctum','role:challenger'])->name('challenger.')->prefix("/challenger")->group(function(){
    //----- LIST & SHOW PRODUCT -----//
        Route::get('produits', [ProduitController::class, 'listProduct'])->name('listProduct');
        Route::get('produits/{produit}', [ProduitController::class, 'showProduct'])->name('showProduct');
        
    //----- LIST & CATEGORY CATEGORY -----//
        Route::get('/produits', [ProduitController::class, 'listProduct'])->name('listProduct');
        Route::get('/produits/{produit}', [ProduitController::class, 'showProduct'])->name('showProduct');


    //----- PRODUCT COMMENT -----//
        Route::post('produits/{produit}/commenter', [AdviceController::class, 'store'])->name('commenter');
        Route::delete('produits/{produit}/commenter/{id}/delete', [AdviceController::class, 'destroy'])->name('supprcommenter');
        Route::get('produits/{produit}/commenter/{id}/edit', [AdviceController::class, 'edit'])->name('editcommenter');
        Route::put('produits/{produit}/commenter/{id}', [AdviceController::class, 'update'])->name('updatecommenter');

    //----- CHALLENGERS -----//
        Route::get('coachs', [UserController::class, 'myCoachs'])->name('coachs.index');

});

require __DIR__.'/auth.php';
