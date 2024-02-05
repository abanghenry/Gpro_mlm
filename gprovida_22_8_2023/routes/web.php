<?php


use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BitCoinController;
use App\Http\Controllers\DeloymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MLMController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockistController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPinController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\PinController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\TransactionController;

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

    Route::get('/', function () {
        return view('frontend.home')->with(['pageTitle'=>'Home']);
    });

    Route::get('/about', function () {
        return view('frontend.about')->with(['pageTitle'=>'About']);
    });
    Route::get('/faq', function () {
        return view('frontend.faq')->with(['pageTitle'=>'FAQ']);
    });
    Route::get('/contact', function () {
        return view('frontend.contact')->with(['pageTitle'=>'Contact']);
    });
    Route::get('/shop', function () {
        return view('frontend.shop')->with(['pageTitle'=>'Shop']);
    });

    Route::post('/contact_form', [HomeController::class, 'contactform']); // ajax submit contact form

    Route::get('/members/lookup/{args}', [UsersController::class, 'search']); // get sponsor
    require __DIR__ . '/auth.php';


    // logged in client 'ensure.activation'
    Route::group(['middleware' => ['auth']], function () { //, 'verified'
        Route::get('/inactivelock', [HomeController::class, 'inactivelock']);

        Route::post('/genealogy/changeToEpin', [MLMController::class, 'changeUserToEpin']);


        Route::get('/welcomepack', [HomeController::class, 'welcomepack']);
        Route::post('/welcomepack/product', [HomeController::class, 'welcomepackOrderProductDetails'])->name('welcomepack.product');
        Route::get('/welcomepack/product/{name}', [HomeController::class, 'welcomepackshowProduct'])->name('welcomepack.product.show');
        Route::post('/welcomepack/cart', [HomeController::class, 'welcomepackStoreCart'])->name('welcomepack.save');
        Route::get('/welcomepack/cart', [HomeController::class, 'welcomepackShowCart']);
        Route::post('/welcomepack/store', [HomeController::class, 'welcomepackStoreOrder'])->name('welcomepack.store');
        Route::delete('/welcomepack/delete', [HomeController::class, 'welcomepackDeleteItemFromCart'])->name('welcomepack.delete');


        Route::get('/upgradepack', [UpgradeController::class, 'upgradepack']);
        Route::post('/upgradepack/product', [UpgradeController::class, 'upgradepackOrderProductDetails'])->name('upgradepack.product');
        Route::get('/upgradepack/product/{name}', [UpgradeController::class, 'upgradepackshowProduct'])->name('upgradepack.product.show');
        Route::post('/upgradepack/cart', [UpgradeController::class, 'upgradepackStoreCart'])->name('upgradepack.save');
        Route::get('/upgradepack/cart', [UpgradeController::class, 'upgradepackShowCart']);
        Route::post('/upgradepack/store', [UpgradeController::class, 'upgradepackStoreOrder'])->name('upgradepack.store');
        Route::delete('/upgradepack/delete', [UpgradeController::class, 'upgradepackDeleteItemFromCart'])->name('upgradepack.delete');




    });


    Route::group(['middleware' => ['auth',  'ensure.activation', 'ensure.upgrade.activation']], function () {
             //'verified',
            // Route::get('/testmail', [HomeController::class, 'testmail']);
            // Route::get('/testjob', [HomeController::class, 'testjob']);
            // Route::get('/testbinary', [HomeController::class, 'testbinary']);
            // Route::get('/teststockist', [HomeController::class, 'teststockist']);
        //Route::get('/testjobs', [HomeController::class, 'testjobs']);
        

        Route::get('/home', [HomeController::class, 'dashboard'])->name('home');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/stockist/{id}', [StockistController::class, 'dashboard'])->name('stockist.dashboard');
        Route::get('/stockisttx/{id}', [StockistController::class, 'transactionView'])->name('transaction.view');
        Route::post('/stockisttx/shipped', [StockistController::class, 'shipOrder'])->name('transaction.ship');

        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile-edit');
        Route::get('/profile/changepass', [UserController::class, 'changePassword'])->name('change-password');
        Route::post('/profile/changepass', [UserController::class, 'updatePassword'])->name('update-password');

        Route::get('/genealogy', [MLMController::class, 'genealogy'])->name('genealogy');
        Route::get('/genealogy/view/{id}', [MLMController::class, 'view'])->name('genealogy.view');
        Route::get('/genealogy/create', [MLMController::class, 'addTeamMember'])->name('genealogy.create');
        Route::post('/genealogy/store', [MLMController::class, 'storeTeamMember'])->name('genealogy.store');

        Route::get('/upgrade', [MLMController::class, 'upgrade'])->name('upgrade');
        Route::post('/upgrade', [MLMController::class, 'upgradeStore'])->name('upgradeStore');

        Route::get('/referral', [MLMController::class, 'referral'])->name('referral');

        Route::get('/payment/', [MLMController::class, 'payment'])->name('payment');
        Route::get('/bonusreferral', [MLMController::class, 'bonusreferral'])->name('bonusreferral');
        Route::get('/bonusproduct', [MLMController::class, 'bonusproduct'])->name('bonusproduct');
        Route::get('/bonusbinary', [MLMController::class, 'bonusbinary'])->name('bonusbinary');

        Route::get('/order', [OrderController::class, 'order'])->name('order');
        Route::post('/order/product', [OrderController::class, 'orderProductDetails'])->name('order.product');
        Route::get('/order/product/{name}', [OrderController::class, 'show'])->name('order.product.show');
        Route::post('/order/cart', [OrderController::class, 'storeCart'])->name('order.save');
        Route::get('/order/cart', [OrderController::class, 'showCart']);
        Route::post('/order/store', [OrderController::class, 'storeOrder'])->name('order.store');
        Route::delete('/order/delete', [OrderController::class, 'deleteItemFromCart'])->name('order.delete');
        Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order-history');
        Route::get('/order/history/{id}', [OrderController::class, 'orderHistoryShow']);

        Route::get('/pin', [UserPinController::class, 'index'])->name('pin');
        Route::get('/pin/used', [UserPinController::class, 'UsedPin'])->name('pin-used');
        Route::get('/pin/request', [UserPinController::class, 'RequestPin'])->name('pin-request');
        Route::post('/pin/request', [UserPinController::class, 'StoreRequestPin'])->name('pin-request-store');
        Route::get('/pin/report/rx', [UserPinController::class, 'PinReportRx'])->name('pin-report-rx');

        Route::get('/bank', [BankController::class, 'bank'])->name('bank-account');
        Route::post('/bank', [BankController::class, 'bankStore'])->name('bank-store');
        Route::put('/bank', [BankController::class, 'bankUpdate'])->name('bank-update');
        Route::get('/bitcoin', [BitCoinController::class, 'bitcoin'])->name('bitcoin-wallet');
        Route::post('/bitcoin', [BitCoinController::class, 'bitcoinStore']);
        Route::put('/bitcoin', [BitCoinController::class, 'bitcoinUpdate']);

        Route::resource('/testimonial', TestimonialController::class);
        Route::resource('/support', SupportController::class);
        Route::get('/notification', [NotificationController::class, 'index'])->name('notification');

    });




    // Routes for Admin login and authentication
    Route::get('admin/login', [LoginController::class, 'getLoginPage'])->name('admin_login');
    Route::post('admin/login/submit', [LoginController::class, 'authenticateAdmin'])->name('admin_login_submit');
    Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin_logout');

    Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'admin'],
        function () {
            Route::get('/', [AdminController::class, 'dashboard']);
            Route::get('/dashboard', [AdminController::class, 'dashboard']);
            Route::get('/index', [AdminController::class, 'dashboard']);
            Route::get('/index.php', [AdminController::class, 'dashboard']);

            Route::resource('/setting', SettingController::class);
            Route::resource('/currency', CurrencyController::class);
            Route::resource('/country', CountryController::class);
            Route::resource('/package', PackageController::class);
            Route::resource('/award', AwardController::class);

            // product
            Route::resource('/product', ProductController::class);
            Route::resource('/category', ProductCategoryController::class);
            Route::resource('/tag', TagController::class);
            Route::resource('/review', ProductReviewController::class);

            // inventory
            Route::resource('/store', StoreController::class);
            Route::get('/members/lookup/{args}', [UsersController::class, 'search']);

            Route::get('/inventory/purchase', [InventoryController::class, 'purchase']);
            Route::post('/inventory/purchase/', [InventoryController::class, 'purchaseStore']);
            Route::delete('/inventory/purchase/{id}', [InventoryController::class, 'purchaseDestroy']);

            Route::get('/inventory/supplier', [InventoryController::class, 'supplier']);
            Route::post('/inventory/supplier/', [InventoryController::class, 'supplierStore']);
            Route::get('/inventory/supplier/{id}/edit', [InventoryController::class, 'supplierEdit']);
            Route::put('/inventory/supplier/{id}', [InventoryController::class, 'supplierUpdate']);
            Route::delete('/inventory/supplier/{id}', [InventoryController::class, 'supplierDestroy']);

            Route::get('/inventory/transfer', [InventoryController::class, 'transfer']);
            //pin management
            Route::resource('/pin', PinController::class);
            Route::resource('/pinrequest', PinRequestController::class);


            Route::get('/members', [UsersController::class, 'getMembers'])->name('members');
            Route::get('/members/{id}', [UsersController::class, 'show'])->name('members.view');
            Route::delete('/members/{id}', [UsersController::class, 'destroy']);
            Route::post('/members/{id}/activate', [UsersController::class, 'activate']);
            Route::post('/members/{id}/impersonate', [UsersController::class, 'impersonate']);
            Route::post('/members/{id}/fundwallet', [UsersController::class, 'fundwallet']);
            Route::post('/members/{id}/updateemail', [UsersController::class, 'updateEmail']);

            Route::get('/transaction', [TransactionController::class, 'index']);
            Route::get('/transaction/{id}', [TransactionController::class, 'show']);
            Route::post('/transaction/{id}', [TransactionController::class, 'update']);

            Route::resource('/banks', \App\Http\Controllers\Admin\BankController::class);
            Route::resource('/bitcoin', \App\Http\Controllers\Admin\BitcoinController::class);
            Route::resource('/complaint', \App\Http\Controllers\Admin\ComplaintController::class);
            Route::resource('/testimonial', \App\Http\Controllers\Admin\TestimonialController::class);
            Route::resource('/notification', \App\Http\Controllers\Admin\NotificationController::class);

            Route::get('/bonus/referral', [BonusController::class, 'referral']);
            Route::get('/bonus/binary', [BonusController::class, 'binary']);
            Route::get('/bonus/directrepurchase', [BonusController::class, 'directrepurchase']);


            Route::get('/payment', [\App\Http\Controllers\Admin\PaymentController::class, 'payment']);
            Route::get('/payment/referral', [\App\Http\Controllers\Admin\PaymentController::class, 'referral']);
            Route::get('/payment/binary', [\App\Http\Controllers\Admin\PaymentController::class, 'binary']);
            Route::get('/payment/award', [\App\Http\Controllers\Admin\PaymentController::class, 'award']);
            Route::get('/payment/loyalty', [\App\Http\Controllers\Admin\PaymentController::class, 'loyalty']);
            Route::get('/payment/directrepurchase', [\App\Http\Controllers\Admin\PaymentController::class, 'directrepurchase']);
            Route::get('/payment/global', [\App\Http\Controllers\Admin\PaymentController::class, 'globalSales']);
            Route::get('/payment/stockist', [\App\Http\Controllers\Admin\PaymentController::class, 'stockist']);
            Route::get('/payment/referral_stockist', [\App\Http\Controllers\Admin\PaymentController::class, 'referralStockist']);
            Route::get('/payment/special', [\App\Http\Controllers\Admin\PaymentController::class, 'special']);

            Route::get('/payment/paid', [\App\Http\Controllers\Admin\PaymentController::class, 'paidEarning']);

            Route::post('/payment', [\App\Http\Controllers\Admin\PaymentController::class, 'processPayment']);


            //Route::get('/members', [AdminController::class, 'members']);

            Route::get('/calendar', function () {
                return view('admin/calendar');
            });





            Route::get('/clear-cache', function() {
                $exitCode = Artisan::call('config:clear');
                $exitCode = Artisan::call('cache:clear');
                $exitCode = Artisan::call('config:cache');
                return 'DONE'; //Return anything
            });
            Route::get('/restart-queue', function() {
                $exitCode = Artisan::call('queue:restart');
                return 'queue:restart: '.$exitCode; //Return anything
            });


        });
