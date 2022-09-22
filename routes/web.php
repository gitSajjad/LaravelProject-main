<?php


use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeCustomer;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\notify\SMSController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Market\StorController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\notify\EmailController;
use App\Http\Controllers\Admin\ticket\TicketController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DeliverController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\setting\SettingController;
use App\Http\Controllers\Admin\Ticket\PriorityController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Ticket\AdminTicketController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Admin\Market\PropertyValueController;
use App\Http\Controllers\Admin\Ticket\CategoryTicketController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Admin\Content\CommentController as CommentCommentController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Customer\Market\ProductController as MarketProductController;



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
///////////////////////////////////////////////////////



/*
|--------------------------------------------------------------------------
| Admin-panel
|--------------------------------------------------------------------------

*/


Route::prefix('admin')->group(function(){

    Route::get('/',[AdminPanelController::class,'index'])->name('admin.home');

    Route::prefix('market')->group(function(){

        //***************** category *********************
            Route::resource('marketCategory' ,CategoryController::class);
            Route::get('marketCategory/changeStatus/{marketCategory}',[CategoryController::class, 'changeStatus'])->name('marketCategory.changeStatus');



        //***************** Brand *********************
            Route::resource('brand' ,BrandController::class);
            Route::get('brand/changeStatus/{brand}',[BrandController::class, 'changeStatus'])->name('brand.changeStatus');


         //***************** Product *********************

         Route::prefix('product')->name('product.')->group(function()
         {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');

            Route::get('/color/{product}', [ProductColorController::class, 'index'])->name('color.index');
            Route::get('/color/{product}/create', [ProductColorController::class, 'create'])->name('color.create');
            Route::post('/color/{product}/store', [ProductColorController::class, 'store'])->name('color.store');
            Route::delete('/color/destroy/{product}/{color}', [ProductColorController::class, 'destroy'])->name('color.destroy');

            Route::get('/gallery/{product}', [GalleryController::class, 'index'])->name('gallery.index');
            Route::get('/gallery/{product}/create', [GalleryController::class, 'create'])->name('gallery.create');
            Route::post('/gallery/{product}/store', [GalleryController::class, 'store'])->name('gallery.store');
            // Route::get('/edit/{product}', [GalleryController::class, 'edit'])->name('gallery.edit');
            // Route::put('/update/{product}', [GalleryController::class, 'update'])->name('gallery.update');
            Route::delete('/gallery/destroy/{product}/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');


            //guarantee

            Route::get('/guarantee/{product}', [GuaranteeController::class, 'index'])->name('guarantee.index');
            Route::get('/guarantee/create/{product}', [GuaranteeController::class, 'create'])->name('guarantee.create');
            Route::post('/guarantee/store/{product}', [GuaranteeController::class, 'store'])->name('guarantee.store');
            Route::delete('/guarantee/destroy/{product}/{guarantee}', [GuaranteeController::class, 'destroy'])->name('guarantee.destroy');


         });

        //***************** Comment *********************
             Route::resource('comment' ,CommentController::class);


         //***************** Deliver *********************
         Route::resource('deliver' ,DeliverController::class);
         Route::get('deliver/changeStatus/{delivery}',[DeliverController::class, 'changeStatus'])->name('deliver.changeStatus');

         //***************** Property *********************

         Route::prefix('property')->name('property.')->group(function () {
            Route::get('/', [PropertyController::class, 'index'])->name('index');
            Route::get('/create', [PropertyController::class, 'create'])->name('create');
            Route::post('/store', [PropertyController::class, 'store'])->name('store');
            Route::get('/edit/{property}', [PropertyController::class, 'edit'])->name('edit');
            Route::put('/update/{property}', [PropertyController::class, 'update'])->name('update');
            Route::delete('/destroy/{property}', [PropertyController::class, 'destroy'])->name('destroy');

               //value
               Route::get('/value/{property}', [PropertyValueController::class, 'index'])->name('value.index');
               Route::get('/value/create/{property}', [PropertyValueController::class, 'create'])->name('value.create');
               Route::post('/value/store/{property}', [PropertyValueController::class, 'store'])->name('value.store');
               Route::get('/value/edit/{property}/{value}', [PropertyValueController::class, 'edit'])->name('value.edit');
               Route::put('/value/update/{property}/{value}', [PropertyValueController::class, 'update'])->name('value.update');
               Route::delete('/value/destroy/{property}/{value}', [PropertyValueController::class, 'destroy'])->name('value.destroy');
        });


        //***************** Stor *********************
        Route::prefix('store')->name('store.')->group(function () {
            Route::get('/', [StorController::class, 'index'])->name('index');
            Route::get('/add-to-store/{product}', [StorController::class, 'addToStore'])->name('add-to-store');
            Route::post('/store/{product}', [StorController::class, 'store'])->name('store');
            Route::get('/edit/{product}', [StorController::class, 'edit'])->name('edit');
            Route::put('/update/{product}', [StorController::class, 'update'])->name('update');
        });


         //***************** Discount *********************
         Route::prefix('discount')->name('admin.market.discount.')->group(function(){

            Route::get('/copan', [DiscountController::class, 'copen'])->name('copan');
            Route::get('/copan/create', [DiscountController::class, 'copanCreate'])->name('copan.create');
            Route::get('/common-discount',[ DiscountController::class, 'commonDiscount'])->name('commonDiscount');
            Route::post('/common-discount/store', [DiscountController::class, 'commonDiscountStore'])->name('commonDiscount.store');
            Route::get('/common-discount/edit/{commonDiscount}', [DiscountController::class, 'commonDiscountEdit'])->name('commonDiscount.edit');
            Route::put('/common-discount/update/{commonDiscount}', [DiscountController::class, 'commonDiscountUpdate'])->name('commonDiscount.update');
            Route::delete('/common-discount/destroy/{commonDiscount}', [DiscountController::class, 'commonDiscountDestroy'])->name('commonDiscount.destroy');
            Route::get('/common-discount/create',[ DiscountController::class, 'commonDiscountCreate'])->name('commonDiscount.create');
            Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('amazingSale');
            Route::get('/amazing-sale/create',[ DiscountController::class, 'amazingSaleCreate'])->name('amazingSale.create');
            Route::post('/amazing-sale/store', [DiscountController::class, 'amazingSaleStore'])->name('amazingSale.store');
            Route::get('/amazing-sale/edit/{amazingSale}', [DiscountController::class, 'amazingSaleEdit'])->name('amazingSale.edit');
            Route::put('/amazing-sale/update/{amazingSale}', [DiscountController::class, 'amazingSaleUpdate'])->name('amazingSale.update');
            Route::delete('/amazing-sale/destroy/{amazingSale}', [DiscountController::class, 'amazingSaleDestroy'])->name('amazingSale.destroy');
            Route::post('/copan/store', [DiscountController::class, 'copanStore'])->name('copan.store');
            Route::get('/copan/edit/{copan}', [DiscountController::class, 'copanEdit'])->name('copan.edit');
            Route::put('/copan/update/{copan}', [DiscountController::class, 'copanUpdate'])->name('copan.update');
            Route::delete('/copan/destroy/{copan}', [DiscountController::class, 'copanDestroy'])->name('copan.destroy');


         });



             //***************** Order *********************
             Route::prefix('order')->name('admin.market.order.')->group(function(){

                Route::get('/', [OrderController::class, 'all'])->name('all');
                Route::get('/new-order', [OrderController::class, 'newOrder'])->name('newOrder');
                Route::get('/sending',[ OrderController::class, 'sending'])->name('sending');
                Route::get('/unpaid',[ OrderController::class, 'unpaid'])->name('unpaid');
                Route::get('/canceled', [OrderController::class, 'canceled'])->name('canceled');
                Route::get('/returned', [OrderController::class, 'returned'])->name('returned');
                Route::get('/show/{order}', [OrderController::class, 'show'])->name('show');
                Route::get('/show/{order}/detail', [OrderController::class, 'detail'])->name('show.detail');
                Route::get('/change-send-status/{order}',[ OrderController::class, 'changeSendStatus'])->name('changeSendStatus');
                Route::get('/change-order-status/{order}',[ OrderController::class, 'changeOrderStatus'])->name('changeOrderStatus');
                Route::get('/cancel-order',[ OrderController::class, 'cancelOrder'])->name('cancelOrder');
                Route::delete('/destroy/{order}', [OrderController::class, 'destroy'])->name('destroy');

             });


                //***************** Payment *********************

        //payment
        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/online', [PaymentController::class, 'online'])->name('online');
            Route::get('/offline', [PaymentController::class, 'offline'])->name('offline');
            Route::get('/cash', [PaymentController::class, 'cash'])->name('cash');
            Route::get('/canceled/{payment}', [PaymentController::class, 'canceled'])->name('canceled');
            Route::get('/returned/{payment}', [PaymentController::class, 'returned'])->name('returned');
            Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('show');

        });




    });



    Route::prefix('content')->group(function(){



              //***************** category *********************
              Route::resource('category' ,ContentCategoryController::class);
              Route::get('postCategory/changeStatus/{postCategory}',[ContentCategoryController::class, 'changeStatus'])->name('category.changeStatus');


             //***************** Comment *********************
              Route::resource('comment' ,CommentCommentController::class);
              Route::get('comment/changeStatus/{comment}',[CommentCommentController::class, 'changeStatus'])->name('comment.changeStatus');
              Route::get('comment/approved/{comment}',[CommentCommentController::class, 'approved'])->name('comment.approved');



             //***************** FAQ *********************
             Route::resource('faq' ,FAQController::class);
             Route::get('faq/changeStatus/{faq}',[FAQController::class, 'changeStatus'])->name('faq.changeStatus');


             //***************** Menu *********************
             Route::resource('menu' ,MenuController::class);
             Route::get('menu/changeStatus/{menu}',[MenuController::class, 'changeStatus'])->name('menu.changeStatus');


               //***************** Page *********************
               Route::resource('page' ,PageController::class);
               Route::get('page/changeStatus/{page}',[PageController::class, 'changeStatus'])->name('page.changeStatus');



               //*********** Post ****************/

               Route::resource('post' ,PostController::class);
               Route::get('post/changeStatus/{post}',[PostController::class, 'changeStatus'])->name('post.changeStatus');

               //********* Banner ****************/

                 Route::resource('Banner' ,BannerController::class);
                 Route::get('Banner/changeStatus/{banner}',[BannerController::class, 'changeStatus'])->name('Banner.changeStatus');

    });


/////////********* User */
    Route::prefix('user')->group(function(){


        ////////admin-user/////////

            //admin-user
            Route::prefix('admin-user')->group(function(){
                Route::get('/', [AdminUserController::class, 'index'])->name('admin-user.index');
                Route::get('/create', [AdminUserController::class, 'create'])->name('admin-user.create');
                Route::post('/store', [AdminUserController::class, 'store'])->name('admin-user.store');
                Route::get('/edit/{admin}', [AdminUserController::class, 'edit'])->name('admin-user.edit');
                Route::put('/update/{admin}', [AdminUserController::class, 'update'])->name('admin-user.update');
                Route::delete('/destroy/{admin}', [AdminUserController::class, 'destroy'])->name('admin-user.destroy');
                Route::get('admin-user/activation/{user}',[AdminUserController::class, 'activation'])->name('admin-user.activation');
                Route::get('admin-user/changeStatus/{user}',[AdminUserController::class, 'changeStatus'])->name('admin-user.changeStatus');
    });





         ////////customer/////////

         Route::resource('customer' ,CustomerController::class);
         Route::get('customer/activation/{user}',[CustomerController::class, 'activation'])->name('customer.activation');
         Route::get('customer/changeStatus/{user}',[CustomerController::class, 'changeStatus'])->name('customer.changeStatus');




           ////////role/////////

           Route::resource('role' ,RoleController::class);
           Route::get('/permission-form/{role}', [RoleController::class, 'permissionForm'])->name('role.permission-form');
           Route::put('/permission-update/{role}', [RoleController::class, 'permissionUpdate'])->name('role.permission-update');


                ////////permission/////////

                Route::resource('permission' ,PermissionController::class);


    });




    //////////******** notify */

    Route::prefix('notify')->group(function(){


        //////////// Email
        Route::resource('email' , EmailController::class);
        Route::get('email/changeStatus/{email}',[EmailController::class, 'changeStatus'])->name('email.changeStatus');


         //email file
         Route::prefix('email-file')->group(function(){

            Route::get('/{email}', [EmailFileController::class, 'index'])->name('email-file.index');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('email-file.create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('email-file.store');
            Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('email-file.edit');
            Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('email-file.update');
            Route::delete('/destroy/{file}', [EmailFileController::class, 'destroy'])->name('email-file.destroy');
            Route::get('/changeStatus/{file}',[EmailFileController::class, 'changeStatus'])->name('email-file.changeStatus');

    });


        //////////////// SMS
        Route::resource('sms' , SMSController::class);
        Route::get('sms/changeStatus/{sms}',[SMSController::class, 'changeStatus'])->name('sms.changeStatus');





    });


    Route::prefix('ticket')->name('admin.ticket.')->group(function(){


        /////ticket////
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('newTickets');
        Route::get('/open-tickets', [TicketController::class, 'openTickets'])->name('openTickets');
        Route::get('/close-tickets', [TicketController::class, 'closeTickets'])->name('closeTickets');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('show');
        Route::post('/answer/{ticket}',[TicketController::class, 'answer'])->name('answer');
        Route::get('/changeStatus/{ticket}',[TicketController::class, 'changeStatus'])->name('changeStatus');


         //categoryTicket

         Route::prefix('categoryTicket')->group(function () {
            Route::get('/', [CategoryTicketController::class, 'index'])->name('categoryTicket.index');
            Route::get('/create', [CategoryTicketController::class, 'create'])->name('categoryTicket.create');
            Route::post('/store', [CategoryTicketController::class, 'store'])->name('categoryTicket.store');
            Route::get('/edit/{categoryTicket}', [CategoryTicketController::class, 'edit'])->name('categoryTicket.edit');
            Route::put('/update/{categoryTicket}', [CategoryTicketController::class, 'update'])->name('categoryTicket.update');
            Route::delete('/destroy/{categoryTicket}', [CategoryTicketController::class, 'destroy'])->name('categoryTicket.destroy');
            Route::get('/changeStatus/{categoryTicket}', [CategoryTicketController::class, 'changeStatus'])->name('categoryTicket.changeStatus');
        });



        Route::resource('/priority', PriorityController::class);
        Route::get('priority/changeStatus/{priority}',[PriorityController::class, 'changeStatus'])->name('priority.changeStatus');

/////adminTicket

        Route::get('/adminTicket', [AdminTicketController::class, 'index'])->name('adminTicket.index');
        Route::get('/set/{admin}', [AdminTicketController::class, 'set'])->name('set.set');



    });



    Route::prefix('setting')->group(function(){

               //////////// setting
               Route::resource('setting' , SettingController::class);

    });





});



//********AUTH*******/

Route::namespace('Auth')->group(function(){

    Route::get('login-register', [LoginRegisterController::class, 'loginRegisterForm'])->name('auth.customer.login-register-form');
    Route::middleware('throttle:customer-login-register-limiter')->post('/login-register', [LoginRegisterController::class, 'loginRegister'])->name('auth.customer.login-register');
    Route::get('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirmForm'])->name('auth.customer.login-confirm-form');
    Route::middleware('throttle:customer-login-confirm-limiter')->post('/login-confirm/{token}', [LoginRegisterController::class, 'loginConfirm'])->name('auth.customer.login-confirm');
    Route::middleware('throttle:customer-login-resend-otp-limiter')->get('/login-resend-otp/{token}', [LoginRegisterController::class, 'loginResendOtp'])->name('auth.customer.login-resend-otp');
    Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('auth.customer.logout');
});



///********HOMEEEE****************/


Route::get('/home',[HomeCustomer::class, 'home'])->name('customer.home');

Route::namespace('Market')->group(function () {

    Route::get('/product/{product:slug}', [MarketProductController::class, 'product'])->name('customer.market.product');
    Route::post('/add-comment/product/{product:slug}', [MarketProductController::class, 'addComment'])->name('customer.market.add-comment');

});









Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});
