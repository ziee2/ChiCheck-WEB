<?php
use App\Http\Controllers\HasilPrediksiController;
use App\Http\Controllers\RiwayatPrediksiController;
use App\Http\Controllers\UserManage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\DataAyamController;
use App\Http\Controllers\DataPakanController;
use App\Http\Controllers\DataTelurController;

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
Route::get('/sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
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
	
	Route::get('/profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
	Route::get('/user-profile', [ProfileController::class, 'viewedit'])->name('user-profile');
	// Route::get('/user-profile', [ProfileController::class, 'viewprofile'])->middleware('auth')->name('user-profile');
	// Route::get('user-profile', function () {
	// 	return view('pages.laravel-examples.user-profile');
	// })->name('user-profile');
	Route::put('/user-profile', [ProfileController::class, 'update'])->middleware('auth')->name('user-profile.update');
	// Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
	Route::post('/user-profile', [ProfileController::class, 'changePassword'])->name('user-profile.changePassword');
	// Route::post('/user-profile', [ProfileController::class, 'changePassword'])->middleware('auth')->name('user-profile.changePassword');
	// Route::post('user-profile/change-password', [ProfileController::class, 'changePassword'])->name('user-profile.change-password');

	Route::get('/get-kabupatens/{provinsi_id}', [ProfileController::class, 'getKabupatens'])->name('get.kabupatens');
	Route::get('/get-kecamatans/{kabupaten_id}', [ProfileController::class, 'getKecamatans'])->name('get.kecamatans');
	Route::get('/get-desas/{kecamatan_id}', [ProfileController::class, 'getDesas'])->name('get.desas');
	
});

# admin
Route::group(['middleware' => ['auth', 'checkRole:Admin']], function () {
	Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
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
Route::group(['middleware' => ['auth', 'checkRole:Owner']], function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
			// Route::get('data-ayam', function () {
				// 	return view('pages.user-pages.data-ayam');
				// })->name('data-ayam');
		// Route::get('/data-ayam', [DataAyamController::class, 'index'])->name('dataAyam.index');	
		// Route::post('/data-ayam', [DataAyamController::class, 'store'])->name('dataAyam.store');
		// Route::put('/data-ayam/{dataAyam}', [DataAyamController::class, 'update'])->name('dataAyam.update');
	Route::get('/data-ayam', [DataAyamController::class, 'index'])->name('data-ayam');
	// Route::post('/data-ayam/{id}/tambah-stok', [DataAyamController::class, 'tambahStok'])->name('data-ayam.tambah-stok');
	Route::put('/data-ayam/{id}/update', [DataAyamController::class, 'update'])->name('data-ayam.update');
	// Route::delete('/data-ayam/{id}/hapus', [DataAyamController::class, 'hapusStok'])->name('data-ayam.hapus-stok');
	Route::post('/data-ayam/tambah-kandang', [DataAyamController::class, 'tambahKandang'])->name('data-ayam.tambah-kandang');
	
	Route::get('/data-pakan', [DataPakanController::class, 'index'])->name('data-pakan');
	// Route::post('/data-pakan/{id}/tambah-stok', [DataPakanController::class, 'tambahStok'])->name('data-pakan.tambah-stok');
	Route::put('/data-pakan/{id}/update', [DataPakanController::class, 'update'])->name('data-pakan.update');
	// Route::delete('/data-pakan/{id}/hapus', [DataPakanController::class, 'hapusStok'])->name('data-pakan.hapus-stok');
	Route::post('/data-pakan/tambah-pakan', [DataPakanController::class, 'tambahpakan'])->name('data-pakan.tambah-pakan');
	
	Route::get('/data-telur', [DataTelurController::class, 'index'])->name('data-telur');
	// Route::post('/data-telur/{id}/tambah-stok', [DataTelurController::class, 'tambahStok'])->name('data-telur.tambah-stok');
	Route::put('/data-telur/{id}/update', [DataTelurController::class, 'update'])->name('data-telur.update');
	// Route::delete('/data-telur/{id}/hapus', [DataTelurController::class, 'hapusStok'])->name('data-telur.hapus-stok');
	Route::post('/data-telur/tambah-telur', [DataTelurController::class, 'tambahtelur'])->name('data-telur.tambah-telur');
	
	
	
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


