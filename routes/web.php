<?php

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PayPalController;
use App\Http\Controllers\Admin\AdminCardController;
use App\Http\Controllers\Admin\AdminCartController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Member\MemberCardController;
use App\Http\Controllers\Member\MemberCartController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminInvoiceConrtroller;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\Admin\AdminHeroSliderController;
use App\Http\Controllers\Admin\AdminMembershipController;
use App\Http\Controllers\Member\MemberInvoiceConrtroller;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Admin\AdminDesignationControlller;
use App\Http\Controllers\Admin\AdminDebutanteMembershipController;
use App\Http\Controllers\Member\MemberPaymentController;

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

// Route::get('/email', function () {
//     // return view('welcome');
//     return view('email.login_verification');
// });

Route::get('/',[SiteController::class,'home'])->name('home');
Route::get('/board-members',[SiteController::class,'boardMembers'])->name('board.members');
Route::get('/members',[SiteController::class,'members'])->name('members');
Route::get('/debutante-appliction',[SiteController::class,'debutanteApplication'])->name('debutante.application');
Route::post('/debutante-appliction/store',[SiteController::class,'debutanteApplicationStore'])->name('debutante.application.store');
Route::get('/member-appliction',[SiteController::class,'memberApplication'])->name('member.application');
Route::post('/member-appliction/store',[SiteController::class,'memberApplicationStore'])->name('member.application.store');
Route::get('/deceased-members',[SiteController::class,'deceasedMember'])->name('deceased.member');
Route::get('/debutante-program',[SiteController::class,'debutanteProgram'])->name('debutante.program');
Route::get('/about-us',[SiteController::class,'about'])->name('about');
Route::get('/contact-us',[SiteController::class,'contact'])->name('contact');
Route::post('/contact/store',[SiteController::class,'contactStore'])->name('contact.store');
Route::get('/gallery',[SiteController::class,'gallery'])->name('gallery');
Route::get('/Mens-Health-2025',[SiteController::class,'MensHealth2025'])->name('Mens-Health-2025');

Route::get('auth/event-calender', [SiteController::class, 'eventCalendar'])->name('event.calendar');
Route::get('event-calender', [SiteController::class, 'noAuthEventCalendar'])->name('noAuth.event.calendar');
Route::post('event_fullcalender_Ajax', [SiteController::class, 'event_fullcalenderAjax'])->name('event.calendar.ajax');

Route::post('web/password/request',[SiteController::class,'forgotPassword'])->name('web.password.request');
Route::post('web/otp/check',[SiteController::class,'checkOtp'])->name('web.otp.check');

// Pypal test route
Route::get('/test-paypal',[PayPalController::class,'test'])->name('test.paypal');
Route::post('paypal/payment',[PayPalController::class,'payment'])->name('paypal');
Route::get('paypal/success',[PayPalController::class,'success'])->name('paypal_success');
Route::get('paypal/cancel',[PayPalController::class,'cancel'])->name('paypal_cancel');

Auth::routes();

Route::group(['middleware' => 'isAdmin:1'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/blank', [DashboardController::class, 'blank'])->name('dashboard.blank');
    Route::get('/admin/contact', [AdminContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/admin/contact/view/{id?}', [AdminContactController::class, 'show'])->name('admin.contact.show');
    Route::get('/admin/contact/is_read', [AdminContactController::class, 'isAdminRead'])->name('admin.contact.isAdminRead');
    Route::delete('/admin/contact/destroy/{id?}', [AdminContactController::class, 'destroy'])->name('admin.contact.delete');

    Route::get('/admin/debutante', [AdminDebutanteMembershipController::class, 'index'])->name('admin.debutante.index');
    Route::get('/admin/debutante/view/{id?}', [AdminDebutanteMembershipController::class, 'show'])->name('admin.debutante.show');
    Route::get('/admin/debutante/edit/{id?}', [AdminDebutanteMembershipController::class, 'edit'])->name('admin.debutante.edit');
    Route::get('/admin/isApprove/{id?}', [AdminDebutanteMembershipController::class, 'isApprove'])->name('admin.debutante.is_approve');
    Route::delete('/admin/debutante/destroy/{id?}', [AdminDebutanteMembershipController::class, 'destroy'])->name('admin.debutante.delete');

    Route::get('/admin/member', [AdminMembershipController::class, 'index'])->name('admin.member.index');
    Route::get('/admin/member/create', [AdminMembershipController::class, 'create'])->name('admin.member.create');
    Route::post('/admin/member/store', [AdminMembershipController::class, 'store'])->name('admin.member.store');
    Route::get('/admin/member/view/{id?}', [AdminMembershipController::class, 'show'])->name('admin.member.show');
    Route::get('/admin/member/edit/{id?}', [AdminMembershipController::class, 'edit'])->name('admin.member.edit');
    Route::post('/admin/member/update/', [AdminMembershipController::class, 'update'])->name('admin.member.update');
    Route::get('/admin/member/isApprove/{id?}', [AdminMembershipController::class, 'isApprove'])->name('admin.member.is_approve');
    Route::delete('/admin/member/destroy/{id?}', [AdminMembershipController::class, 'destroy'])->name('admin.member.delete');

    Route::get('/admin/member-data', [AdminMemberController::class, 'index'])->name('admin.membersData.index');
    Route::get('/admin/member-data/create', [AdminMemberController::class, 'create'])->name('admin.membersData.create');
    Route::post('/admin/member-data/store', [AdminMemberController::class, 'store'])->name('admin.membersData.store');
    Route::get('/admin/member-data/view/{id?}', [AdminMemberController::class, 'show'])->name('admin.membersData.show');
    Route::get('/admin/member-data/edit/{id}', [AdminMemberController::class, 'edit'])->name('admin.membersData.edit');
    Route::post('/admin/member-data/update/{id}', [AdminMemberController::class, 'update'])->name('admin.membersData.update');
    Route::delete('/admin/member-data/destroy/{id}', [AdminMemberController::class, 'destroy'])->name('admin.membersData.delete');

    Route::get('/admin/designation', [AdminDesignationControlller::class, 'index'])->name('admin.designation.index');
    Route::get('/admin/designation/create', [AdminDesignationControlller::class, 'create'])->name('admin.designation.create');
    Route::get('/admin/role/approve', [AdminDesignationControlller::class, 'roleApprove'])->name('admin.role.approve');
    Route::post('/admin/designation/store', [AdminDesignationControlller::class, 'store'])->name('admin.designation.store');
    Route::get('/admin/designation/view/{id?}', [AdminDesignationControlller::class, 'show'])->name('admin.designation.show');
    Route::get('/admin/designation/edit/{id}', [AdminDesignationControlller::class, 'edit'])->name('admin.designation.edit');
    Route::post('/admin/designation/update/{id}', [AdminDesignationControlller::class, 'update'])->name('admin.designation.update');
    Route::delete('/admin/designation/destroy/{id}', [AdminDesignationControlller::class, 'destroy'])->name('admin.designation.delete');

    Route::get('/admin/gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/admin/gallery/create', [AdminGalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/admin/gallery/store', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/admin/gallery/view/{id?}', [AdminGalleryController::class, 'show'])->name('admin.gallery.show');
    Route::get('/admin/gallery/edit/{id}', [AdminGalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::post('/admin/gallery/update/{id}', [AdminGalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/admin/gallery/destroy/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.delete');

    Route::get('/admin/hero-slider', [AdminHeroSliderController::class, 'index'])->name('admin.hero_slider.index');
    Route::get('/admin/hero-slider/create', [AdminHeroSliderController::class, 'create'])->name('admin.hero_slider.create');
    Route::post('/admin/hero-slider/store', [AdminHeroSliderController::class, 'store'])->name('admin.hero_slider.store');
    Route::get('/admin/hero-slider/view/{id?}', [AdminHeroSliderController::class, 'show'])->name('admin.hero_slider.show');
    Route::get('/admin/hero-slider/edit/{id}', [AdminHeroSliderController::class, 'edit'])->name('admin.hero_slider.edit');
    Route::post('/admin/hero-slider/update/{id}', [AdminHeroSliderController::class, 'update'])->name('admin.hero_slider.update');
    Route::delete('/admin/hero-slider/destroy/{id}', [AdminHeroSliderController::class, 'destroy'])->name('admin.hero_slider.delete');

    Route::get('/admin/profile/index', [AdminProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/admin/profile/payment/{id?}', [AdminProfileController::class, 'payment'])->name('admin.profile.payment');
    Route::get('/admin/profile/individual/payment/{id?}', [AdminProfileController::class, 'individualPayment'])->name('admin.individual.profile.payment');
    Route::get('/admin/profile/reset', [AdminProfileController::class, 'reset'])->name('admin.profile.reset');
    // Route::post('/otp/password/request',[DealerController::class,'forgotPassword'])->name('dealer.password.request');
    Route::post('/admin/profile/reset/store', [AdminProfileController::class, 'resetStore'])->name('admin.profile.reset.store');

    Route::get('/admin/invoice/list/{id?}',[AdminInvoiceConrtroller::class,'allInvoice'])->name('admin.ownInvoice.list');
    Route::get('/admin/invoice/{id?}',[AdminInvoiceConrtroller::class,'index'])->name('admin.invoice.list');
    Route::get('/admin/invoice/pdf/{id?}',[AdminInvoiceConrtroller::class,'invoicePdf'])->name('admin.invoice.pdf');
    Route::get('/admin/invoice/change/{id?}',[AdminInvoiceConrtroller::class,'invoiceStatusChange'])->name('admin.invoice.invoiceStatusChange');
    Route::post('/admin/invoice/store',[AdminInvoiceConrtroller::class,'bulkInvoice'])->name('admin.invoice.store');
    Route::post('/admin/individual/invoice/store/{id?}',[AdminInvoiceConrtroller::class,'individualInvoice'])->name('admin.individual.invoice.store');
    Route::post('/admin/invoice/show',[AdminInvoiceConrtroller::class,'InvoiceShow'])->name('admin.invoice.show');
    Route::delete('/admin/invoice/destroy/{id}', [AdminInvoiceConrtroller::class, 'destroy'])->name('admin.invoice.delete');

    Route::post('/admin/invoice/new/store',[AdminInvoiceConrtroller::class,'invoiceNewStore'])->name('admin.invoice.new.store');
    Route::delete('/admin/invoice/new/delete/{id?}',[AdminInvoiceConrtroller::class,'invoiceNewDelete'])->name('admin.invoice.new.delete');

    Route::get('/admin/card/payment', [AdminCardController::class, 'index'])->name('admin.card.payment');
    Route::get('/admin/cart/item', [AdminCartController::class, 'getcartItem'])->name('admin.get.cart_item');
    Route::post('/admin/cart/delete-all',[AdminCartController::class,'deleteAllCartItem'])->name('admin.cart.deleteAll');
    Route::post('/admin/cart/delete',[AdminCartController::class,'deleteCartItem'])->name('admin.cart.data.delete');
    // Route::resource('admin/members',AdminMemberController::class)->names([
        //     'index' => 'admin.members.index',
        //     'create' => 'admin.members.create',
        //     'store' => 'admin.members.store',
        //     'show' => 'admin.members.show',
        //     'edit' => 'admin.members.edit',
        //     'update' => 'admin.members.update',
        //     'destroy' => 'admin.members.destroy',
        // ]);
    });

    Route::get('/payment/success',[PaymentController::class,'success_message'])->name('success');
    Route::get('/payment/fail',[PaymentController::class,'fail_message'])->name('fail');
    Route::post('/pay', [PaymentController::class,'pay'])->name('payment');


    Route::group(['middleware' => 'isAdmin:0'], function () {
        Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
        Route::get('/member/blank', [MemberDashboardController::class, 'blank'])->name('member.dashboard.blanc');

        Route::get('/member/profile', [MemberProfileController::class, 'index'])->name('member.profile.index');
        Route::get('/member/profile/create', [MemberProfileController::class, 'create'])->name('member.profile.create');
        Route::post('/member/profile/store', [MemberProfileController::class, 'store'])->name('member.profile.store');
        Route::get('/member/profile/view/{id?}', [MemberProfileController::class, 'show'])->name('member.profile.show');
        Route::get('/member/profile/edit/{id}', [MemberProfileController::class, 'edit'])->name('member.profile.edit');
        Route::post('/member/profile/update/{id}', [MemberProfileController::class, 'update'])->name('member.profile.update');
        Route::delete('/member/profile/destroy/{id}', [MemberProfileController::class, 'destroy'])->name('member.profile.delete');

        Route::get('/member/profile/payment/{id?}', [MemberProfileController::class, 'payment'])->name('member.profile.payment');
        Route::post('/member/pay', [MemberPaymentController::class,'pay'])->name('payment');
        Route::get('/member/payment/success',[MemberPaymentController::class,'success_message'])->name('member.success');
        Route::get('/member/payment/fail',[MemberPaymentController::class,'fail_message'])->name('member.fail');

        Route::get('/member/profile/reset', [MemberProfileController::class, 'reset'])->name('member.profile.reset');
        Route::post('/member/profile/reset/store', [MemberProfileController::class, 'resetStore'])->name('member.profile.reset.store');

        // cart item
        Route::get('/member/cart/item', [MemberCartController::class, 'getcartItem'])->name('member.get.cart_item');
        Route::post('/member/invoice/show',[MemberInvoiceConrtroller::class,'InvoiceShow'])->name('member.invoice.show');
        Route::post('/member/invoice/store',[MemberInvoiceConrtroller::class,'bulkInvoice'])->name('member.invoice.store');

        Route::post('/member/invoice/new/store',[MemberInvoiceConrtroller::class,'invoiceNewStore'])->name('member.invoice.new.store');
        Route::delete('/member/invoice/new/delete/{id?}',[MemberInvoiceConrtroller::class,'invoiceNewDelete'])->name('member.invoice.new.delete');
        Route::get('/member/invoice/list/{id?}',[MemberInvoiceConrtroller::class,'allInvoice'])->name('member.invoice.list');

        Route::get('/member/invoice/pdf/{id?}',[MemberInvoiceConrtroller::class,'invoicePdf'])->name('member.invoice.pdf');
        // card
        Route::get('/member/card/payment', [MemberCardController::class, 'index'])->name('member.card.payment');

        Route::post('/member/cart/delete-all',[MemberCartController::class,'deleteAllCartItem'])->name('member.cart.deleteAll');
        Route::post('/member/cart/delete',[MemberCartController::class,'deleteCartItem'])->name('member.cart.data.delete');


    });
