<?php
use App\Http\Controllers\HasilPrediksiController;
use App\Http\Controllers\RiwayatPrediksiController;
use App\Http\Controllers\UserManage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\DataAyamController;
use App\Http\Controllers\DataPakanController;
use App\Http\Controllers\DataTelurController;
use App\Http\Controllers\RiwayatPendataanController;

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

Route::get('/', function () {
    return view('welcome');
});	

Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');

// Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');


// Route::get('/riwayat-scan', [RiwayatPrediksiController::class, 'showPredictions'])->name('riwayat.scan');


Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
// Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
	Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
	Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
	// Route::post('/user-profile', [ProfileController::class, 'changePassword'])->middleware('auth');
	// Route::post('/user-profile', [ProfileController::class, 'changePassword'])->middleware('auth')->name('user-profile');

});

# admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
	// Route::get('user-management', function () {
	// 	return view('pages.laravel-examples.user-management');
	// })->name('user-management');
	Route::get('/user-management', [UserManage::class, 'index'])->name('user-management');
	Route::put('/update-status/{id}', [UserManage::class, 'updateStatus'])->name('update.status');
	
	// Route::get('profile', function () {
		// 	return view('pages.profile');
		// })->name('user-profile');
		
});
	
	# user
Route::group(['middleware' => ['auth', 'checkRole:user']], function () {
	Route::get('scan', function () {
		return view('pages.user-pages.scan');
	})->name('scan');
	Route::post('/predict', [PredictionController::class, 'predict'])->name('predict');
	Route::get('/riwayat-scan', [RiwayatPrediksiController::class, 'index'])->name('riwayat-scan');
	// Route::get('/data-ayam', [DataAyamController::class, 'index'])->name('data-ayam');
	// Route::get('/data-pakan', [DataPakanController::class, 'index'])->name('data-pakan');
	// Route::get('/data-telur', [DataTelurController::class, 'index'])->name('data-telur');
	// Route::get('/riwayat-pendataan', [RiwayatPendataanController::class, 'index'])->name('riwayat-pendataan');
	// Route::resource('dataayam', DataAyamController::class);
	// Route::get('/data-ayam', [DataAyamController::class, 'index'])->name('dataayam.index');
	// Route::post('/data-ayam', [DataAyamController::class, 'store'])->name('dataayam.store');
	// Route::put('/data-ayam/{dataAyam}', [DataAyamController::class, 'update'])->name('dataayam.update');
	
});
	
	
	
	
	
	// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// 	Route::get('billing', function () {
// 		return view('pages.billing');
// 	})->name('billing');
// 	Route::get('tables', function () {
// 		return view('pages.tables');
// 	})->name('tables');
// 	Route::get('rtl', function () {
// 		return view('pages.rtl');
// 	})->name('rtl');
// 	Route::get('virtual-reality', function () {
// 		return view('pages.virtual-reality');
// 	})->name('virtual-reality');
// 	Route::get('notifications', function () {
// 		return view('pages.notifications');
// 	})->name('notifications');
// 	Route::get('scan', function () {
// 		return view('pages.user-pages.scan');
// 	})->name('scan');
// 	Route::post('/predict', [PredictionController::class, 'predict'])->name('predict');
// 	Route::get('/riwayat-scan', [RiwayatPrediksiController::class, 'index'])->name('riwayat-scan');
// 	Route::get('user-management', function () {
// 		return view('pages.laravel-examples.user-management');
// 	})->name('user-management');
// 	Route::get('user-profile', function () {
// 		return view('pages.laravel-examples.user-profile');
// 	})->name('user-profile');
// });


