<?php

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

// Route::get('/', function () {
// 	return view('welcome');
// });

Route::get('/', 'WelcomeController@index')->name('welcome');

	Auth::routes();
	
/* User routes */
Route::group(['namespace' => 'User'], function () {
	/* User auth routes */
	Route::group(['middleware' => 'auth:web'], function () {
		Route::group(['prefix' => 'order'], function () {
			Route::get('/assigned', 'AssignedOrderController@index')->name('user.assigned.index');
			Route::get('/assigned/{order}', ['as' => 'user.assigned.show', 'uses' => 'AssignedOrderController@show']);
			Route::get('/inprogress', 'InprogressOrderController@index')->name('user.inprogress.index');
			Route::get('/inprogress/{order}', ['as' => 'user.inprogress.show', 'uses' => 'InprogressOrderController@show']);
			Route::get('/inediting', 'IneditingOrderController@index')->name('user.inediting.index');
			Route::get('/inediting/{order}', ['as' => 'user.inediting.show', 'uses' => 'IneditingOrderController@show']);
			Route::get('/ineditingu/{order}', ['as' => 'user.inediting-unpicked.show', 'uses' => 'IneditingOrderController@show']);
			Route::get('/completed', ['as' => 'user.completed.index', 'uses' => 'CompletedOrderController@index']);
			Route::get('/completed/{order}', ['as' => 'user.completed.show', 'uses' => 'CompletedOrderController@show']);
			Route::patch('/completed/{order}', ['as' => 'user.completed.update', 'uses' => 'CompletedOrderController@update']);
			Route::get('/approved', ['as' => 'user.approved.index', 'uses' => 'ApprovedOrderController@index']);
			Route::get('/approved/{order}', ['as' => 'user.approved.show', 'uses' => 'ApprovedOrderController@show']);
			Route::get('/cancelled', ['as' => 'user.cancelled.index', 'uses' => 'CancelledOrderController@index']);
			Route::get('/cancelled/{order}', ['as' => 'user.cancelled.show', 'uses' => 'CancelledOrderController@show']);
			Route::get('/inrevision', ['as' => 'user.inrevision.index', 'uses' => 'InrevisionOrderController@index']);
			Route::get('/inrevision/{order}', ['as' => 'user.inrevision.show', 'uses' => 'InrevisionOrderController@show']);
			Route::get('/unpaid', ['as' => 'user.unpaid.index', 'uses' => 'UnpaidOrderController@index']);
			Route::get('/unpaid/{order}', ['as' => 'user.unpaid.show', 'uses' => 'UnpaidOrderController@show']);
			Route::patch('/unpaid/{order}', ['as' => 'user.unpaid.update', 'uses' => 'UnpaidOrderController@update']);
			Route::delete('/unpaid/{order}', ['as' => 'user.unpaid.destroy', 'uses' => 'UnpaidOrderController@destroy']);
			Route::post('/{order}/message/store', ['as' => 'user.message.store', 'uses' => 'MessagesController@store']);
			Route::get('/unassigned', ['as' => 'user.unassigned.index', 'uses' => 'UnassignedOrdersController@index']);
			Route::get('/unassigned/{order}', ['as' => 'user.unassigned.show', 'uses' => 'UnassignedOrdersController@show']);
			Route::post('/store', ['as' => 'user.unassigned.store', 'uses' => 'UnassignedOrdersController@store']);
			Route::post('/confirm', ['as' => 'user.order.confirm', 'uses' => 'UnassignedOrdersController@confirm']);
			Route::get('/execute', ['as' => 'user.pay.execute', 'uses' => 'UnassignedOrdersController@execute']);
			Route::get('/cancelpay', ['as' => 'user.pay.cancel', 'uses' => 'UnassignedOrdersController@cancel']);

		});

		// Route::resource('user', 'UserController', ['except' => ['show']]);
		Route::group(['prefix' => 'profile'], function () {
			Route::get('/', ['as' => 'user.profile.edit', 'uses' => 'ProfileController@edit']);
			Route::put('/', ['as' => 'user.profile.update', 'uses' => 'ProfileController@update']);
			Route::put('/password', ['as' => 'user.profile.password', 'uses' => 'ProfileController@password']);
		});
		
		Route::group(['prefix' => 'messages'], function () {
			Route::get('/', ['as' => 'user.message.index', 'uses' => 'MessagesController@index']);
			Route::get('/update', ['as' => 'user.message.update', 'uses' => 'MessagesController@update']);
		});

		Route::group(['prefix' => 'coupon'], function () {
			Route::post('/', ['as' => 'user.coupon.store', 'uses' => 'CouponsController@store']);
			Route::get('/', ['as' => 'user.coupon.index', 'uses' => 'CouponsController@index']);
			Route::get('/{coupon}', ['as' => 'user.coupon.show', 'uses' => 'CouponsController@show']);
		});
		Route::get('/news', ['as' => 'user.news.index', 'uses' => 'NewsController@index']);
		Route::get('/home', 'HomeController@index')->name('home');
	});
	/* User guest routes */
	Route::get('/order/create', ['as' => 'order.create', 'uses' => 'UnassignedOrdersController@create']);
	Route::get('/order/create/ref=c{referredBy?}-{referralId?}', ['as' => 'order.create.referred', 'uses' => 'UnassignedOrdersController@create']);
	Route::post('/fileupload', ['as' => 'fileupload.store', 'uses' => 'FileUploadController@store']);
	Route::post('/fileupload/{name}', ['as' => 'fileupload.delete', 'uses' => 'FileUploadController@destroy']);
});
		
/* writer routes */
Route::group(['prefix' => 'writer'], function () {
	Route::group(['namespace' => 'Writer'], function () {
		/* writer auth routes */
		Route::group(['middleware' => 'auth:writer'], function () {
			Route::group(['prefix' => 'order'], function () {
				Route::get('/bids', ['as' => 'writer.bids.index', 'uses' => 'MakeBidsController@index']);
				Route::post('/bid/store', 'MakeBidsController@store')->name('bid.store');
				Route::post('/bid/{bid}', 'MakeBidsController@destroy')->name('bid.destroy');
				Route::get('/assigned', 'AssignedOrderController@index')->name('writer.assigned.index');
				Route::get('/assigned/{order}', ['as' => 'writer.assigned.show', 'uses' => 'AssignedOrderController@show']);
				Route::patch('/assigned/{order}', 'AssignedOrderController@update')->name('writer.assigned.update');
				Route::get('/inprogress', 'InprogressOrderController@index')->name('writer.inprogress.index');
				Route::get('/inprogress/{order}', ['as' => 'writer.inprogress.show', 'uses' => 'InprogressOrderController@show']);
				Route::patch('/inprogress/{order}', 'InprogressOrderController@update')->name('writer.inprogress.update');
				Route::get('/inediting', ['as' => 'writer.inediting.index', 'uses' => 'IneditingOrderController@index']);
				Route::get('/inediting/{order}', ['as' => 'writer.inediting.show', 'uses' => 'IneditingOrderController@show']);
				Route::get('/ineditingu/{order}', ['as' => 'writer.inediting-unpicked.show', 'uses' => 'IneditingOrderController@show']);
				Route::get('/completed', ['as' => 'writer.completed.index', 'uses' => 'CompletedOrderController@index']);
				Route::get('/completed/{order}', ['as' => 'writer.completed.show', 'uses' => 'CompletedOrderController@show']);
				Route::get('/inrevision', ['as' => 'writer.inrevision.index', 'uses' => 'InrevisionOrderController@index']);
				Route::patch('/inrevision/{order}', ['as' => 'writer.inrevision.update', 'uses' => 'InrevisionOrderController@update']);
				Route::get('/inrevision/{order}', ['as' => 'writer.inrevision.show', 'uses' => 'InrevisionOrderController@show']);
				Route::get('/cancelled', ['as' => 'writer.cancelled.index', 'uses' => 'CancelledOrderController@index']);
				Route::get('/cancelled/{order}', ['as' => 'writer.cancelled.show', 'uses' => 'CancelledOrderController@show']);
				Route::get('/approved', ['as' => 'writer.approved.index', 'uses' => 'ApprovedOrderController@index']);
				Route::get('/approved/{order}', ['as' => 'writer.approved.show', 'uses' => 'ApprovedOrderController@show']);
				Route::post('/{order}/message/store', ['as' => 'writer.message.store', 'uses' => 'MessagesController@store']);
				Route::get('/unassigned', ['as' => 'writer.unassigned.index', 'uses' => 'UnassignedOrdersController@index']);
				Route::get('/unassigned/{order}', ['as' => 'writer.unassigned.show', 'uses' => 'UnassignedOrdersController@show']);
				Route::patch('/adjust/{order}', ['as' => 'writer.adjust.update', 'uses' => 'AdjustWriterDeadlineController@update']);

			});
			Route::get('/', 'HomeController@index')->name('writer.home');
			Route::get('/invoices', ['as' => 'writer.invoice.index', 'uses' => 'InvoicesController@index']);
			Route::post('/invoices', ['as' => 'writer.invoice.store', 'uses' => 'InvoicesController@store']);
			Route::get('/invoices/{invoice}/requested', ['as' => 'writer.invoice.requested.show', 'uses' => 'InvoicesController@show']);
			Route::get('/invoices/{invoice}/paid', ['as' => 'writer.invoice.paid.show', 'uses' => 'InvoicesController@show']);
			Route::get('/messages', ['as' => 'writer.message.index', 'uses' => 'MessagesController@index']);
			Route::get('/messages/update', ['as' => 'writer.message.update', 'uses' => 'MessagesController@update']);
			Route::get('profile', ['as' => 'writer.profile.edit', 'uses' => 'ProfileController@edit']);
			Route::put('profile', ['as' => 'writer.profile.update', 'uses' => 'ProfileController@update']);
			Route::put('profile/password', ['as' => 'writer.profile.password', 'uses' => 'ProfileController@password']);
			Route::put('profile/education', ['as' => 'writer.profile.education', 'uses' => 'ProfileController@education']);
			Route::put('profile/payment', ['as' => 'writer.profile.payment', 'uses' => 'ProfileController@payment']);
			Route::get('profile/editpayment', ['as' => 'writer.profile.editpayment', 'uses' => 'ProfileController@editpayment']);
			Route::get('/news', ['as' => 'writer.news.index', 'uses' => 'NewsController@index']);
			Route::get('/notes', ['as' => 'writer.notes.index', 'uses' => 'NotesToWriterController@index']);
			Route::get('/notes/update', ['as' => 'writer.notes.update', 'uses' => 'NotesToWriterController@update']);
			Route::post('/fileupload', ['as' => 'writer.fileupload.store', 'uses' => 'FileUploadController@store']);
			Route::post('/fileupload/{name}', ['as' => 'writer.fileupload.delete', 'uses' => 'FileUploadController@destroy']);
			Route::get('/ratings', ['as' => 'writer.customerreviews.index', 'uses' => 'MyRatingsController@index']);
		});

		/* writer guest routes */
		Route::group(['namespace' => 'Auth'], function () {
			Route::get('/register', 'RegisterController@showRegisterForm')->name('writer.register');
			Route::get('/login', 'LoginController@showLoginForm')->name('writer.login');
			Route::post('/login', 'LoginController@Login');
			Route::post('/register', 'RegisterController@create');
			Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('writer.password.email');
			Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('writer.password.request');
			Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('writer.password.reset');
			Route::post('/password/reset', 'ResetPasswordController@Reset')->name('writer.password.update');
		});
	});
});

/* admin routes */
Route::group(['prefix' => 'admin'], function () {
	Route::group(['namespace' => 'Admin'], function () {
		/* admin auth routes */
		Route::group(['middleware' => 'auth:admin'], function () {
			Route::group(['prefix' => 'order'], function () {
				Route::get('/assigned', 'AssignedOrdersController@index')->name('admin.assigned.index');
				Route::get('/assigned/{order}', 'AssignedOrdersController@show')->name('admin.assigned.show');
				Route::get('/{order}/bids', 'ViewBidsAssignOrdertoWriterController@index')->name('admin.bids.index');
				Route::patch('/{order}/assign', 'ViewBidsAssignOrdertoWriterController@update')->name('admin.assign.update');
				Route::get('/inprogress', 'InprogressOrderController@index')->name('admin.inprogress.index');
				Route::get('/inprogress/{order}', ['as' => 'admin.inprogress.show', 'uses' => 'InprogressOrderController@show']);
				Route::get('/ineditingunpicked', ['as' => 'admin.inediting-unpicked.index', 'uses' => 'IneditingUnpickedOrderController@index']);
				Route::get('/ineditingunpicked/{order}', ['as' => 'admin.inediting-unpicked.show', 'uses' => 'IneditingUnpickedOrderController@show']);
				Route::get('/inediting', 'IneditingOrderController@index')->name('admin.inediting.index');
				Route::get('/inediting/{order}', ['as' => 'admin.inediting.show', 'uses' => 'IneditingOrderController@show']);
				Route::get('/completed', ['as' => 'admin.completed.index', 'uses' => 'CompletedOrderController@index']);
				Route::get('/completed/{order}', ['as' => 'admin.completed.show', 'uses' => 'CompletedOrderController@show']);
				Route::get('/inrevision', ['as' => 'admin.inrevision.index', 'uses' => 'InrevisionOrderController@index']);
				Route::get('/inrevision/{order}', ['as' => 'admin.inrevision.show', 'uses' => 'InrevisionOrderController@show']);
				Route::get('/cancelled', ['as' => 'admin.cancelled.index', 'uses' => 'CancelledOrderController@index']);
				Route::get('/cancelled/{order}', ['as' => 'admin.cancelled.show', 'uses' => 'CancelledOrderController@show']);
				Route::get('/unpaid', ['as' => 'admin.unpaid.index', 'uses' => 'UnpaidOrderController@index']);
				Route::get('/unpaid/{order}', ['as' => 'admin.unpaid.show', 'uses' => 'UnpaidOrderController@show']);
				Route::delete('/unpaid/{order}', ['as' => 'admin.unpaid.destroy', 'uses' => 'UnpaidOrderController@destroy']);
				Route::get('/approved', ['as' => 'admin.approved.index', 'uses' => 'ApprovedOrderController@index']);
				Route::get('/approved/{order}', ['as' => 'admin.approved.show', 'uses' => 'ApprovedOrderController@show']);
				Route::get('/search', ['as' => 'admin.search.index', 'uses' => 'SearchOrderController@index']);
				Route::post('/{order}/message/store', ['as' => 'admin.message.store', 'uses' => 'MessagesController@store']);
				Route::get('/unassigned', ['as' => 'admin.unassigned.index', 'uses' => 'UnassignedOrdersController@index']);
				Route::get('/unassigned/{order}', ['as' => 'admin.unassigned.show', 'uses' => 'UnassignedOrdersController@show']);
				Route::post('/unassigned/store', ['as' => 'admin.unassigned.store', 'uses' => 'UnassignedOrdersController@store']);
				Route::post('/unassigned/confirm', ['as' => 'admin.unassigned.confirm', 'uses' => 'UnassignedOrdersController@confirm']);
				Route::get('/unassigned/create', ['as' => 'admin.unassigned.create', 'uses' => 'UnassignedOrdersController@create']);
				Route::patch('/adjustdeadline/{order}', ['as' => 'admin.adjustdeadline.update', 'uses' => 'AdjustWriterDeadlineController@update']);
				Route::patch('/adjustwritamount/{order}', ['as' => 'admin.adjustwritamount.update', 'uses' => 'AdjustWriterAmountController@update']);
				Route::get('/urgent', ['as' => 'admin.urgent.index', 'uses' => 'UrgentOrderController@index']);
			});
			
			Route::get('/finances', ['as' => 'admin.finances.index', 'uses' => 'FinancesController@index']);
			Route::put('/finances/{cost}', ['as' => 'admin.finances.update', 'uses' => 'FinancesController@update']);
			Route::get('/myinvoices', ['as' => 'admin.myinvoice.index', 'uses' => 'MyInvoicesController@index']);
			Route::post('/myinvoices', ['as' => 'admin.myinvoice.store', 'uses' => 'MyInvoicesController@store']);
			Route::get('/myinvoices/{invoice}/requested', ['as' => 'admin.myinvoice.requested.show', 'uses' => 'MyInvoicesController@show']);
			Route::get('/myinvoices/{invoice}/paid', ['as' => 'admin.myinvoice.paid.show', 'uses' => 'MyInvoicesController@show']);
			Route::get('/expenses', ['as' => 'admin.expensesinvoice.index', 'uses' => 'ExpensesInvoicesController@index']);
			Route::post('/expenses', ['as' => 'admin.expensesinvoice.store', 'uses' => 'ExpensesInvoicesController@store']);
			Route::get('/expenses/{invoice}/requested', ['as' => 'admin.expensesinvoice.requested.show', 'uses' => 'ExpensesInvoicesController@show']);
			Route::get('/expenses/{invoice}/paid', ['as' => 'admin.expensesinvoice.paid.show', 'uses' => 'ExpensesInvoicesController@show']);
			Route::get('/allrequestedinvoices', ['as' => 'admin.allrequestedinvoices.index', 'uses' => 'AllRequestedInvoicesController@index']);
			Route::get('/allrequestedinvoices/{invoice}', ['as' => 'admin.allrequestedinvoices.show', 'uses' => 'AllRequestedInvoicesController@show']);
			Route::patch('/allrequestedinvoices/{invoice}', ['as' => 'admin.allrequestedinvoices.update', 'uses' => 'AllRequestedInvoicesController@update']);
			Route::get('/allpaidinvoices', ['as' => 'admin.allpaidinvoices.index', 'uses' => 'AllPaidInvoicesController@index']);
			Route::get('/allpaidinvoices/{invoice}', ['as' => 'admin.allpaidinvoices.show', 'uses' => 'AllPaidInvoicesController@show']);
			Route::get('/searchinvoices', ['as' => 'admin.searchinvoices.index', 'uses' => 'SearchInvoicesController@index']);
			Route::get('/searchinvoices/{role}/{user}', ['as' => 'admin.searchinvoices.show', 'uses' => 'SearchInvoicesController@show']);
			Route::get('/searchinvoices/{role}/{user}/{invoice}', ['as' => 'admin.searchinvoicesorders.show', 'uses' => 'SearchInvoicesOrdersController@show']);
			Route::get('/messages', ['as' => 'admin.message.index', 'uses' => 'MessagesController@index']);
			Route::get('/messages/update', ['as' => 'admin.message.update', 'uses' => 'MessagesController@update']);
			Route::delete('/messages/{message}', ['as' => 'admin.message.delete', 'uses' => 'MessagesController@destroy']);
			Route::get('/fileupload', ['as' => 'admin.fileupload.index', 'uses' => 'FileUploadController@index']);
			Route::post('/fileupload', ['as' => 'admin.fileupload.store', 'uses' => 'FileUploadController@store']);
			Route::post('/fileupload/{name}', ['as' => 'admin.fileupload.delete', 'uses' => 'FileUploadController@destroy']);

			Route::group(['prefix' => 'news'], function () {
				Route::get('/', ['as' => 'admin.news.index', 'uses' => 'NewsController@index']);
				Route::get('/create', ['as' => 'admin.news.create', 'uses' => 'NewsController@create']);
				Route::post('/', ['as' => 'admin.news.store', 'uses' => 'NewsController@store']);
			});

			Route::group(['prefix' => 'profile'], function () {
				Route::get('/', ['as' => 'admin.profile.edit', 'uses' => 'ProfileController@edit']);
				Route::put('/', ['as' => 'admin.profile.update', 'uses' => 'ProfileController@update']);
				Route::put('password', ['as' => 'admin.profile.password', 'uses' => 'ProfileController@password']);
				Route::put('payment', ['as' => 'admin.profile.payment', 'uses' => 'ProfileController@payment']);
				Route::get('editpayment', ['as' => 'admin.profile.editpayment', 'uses' => 'ProfileController@editpayment']);
			});
			Route::group(['prefix' => 'writer'], function () {
				Route::get('/', ['as' => 'admin.writer.index', 'uses' => 'WriterController@index']);
				Route::get('/create', ['as' => 'admin.writer.create', 'uses' => 'WriterController@create']);
				Route::post('/', ['as' => 'admin.writer.store', 'uses' => 'WriterController@store']);
				Route::get('/{writer}', ['as' => 'admin.writer.show', 'uses' => 'WriterController@show']);
				Route::get('/{writer}/edit', ['as' => 'admin.writer.edit', 'uses' => 'WriterController@edit']);
				Route::put('/{writer}', ['as' => 'admin.writer.update', 'uses' => 'WriterController@update']);
				Route::put('/{writer}/password', ['as' => 'admin.writer.password', 'uses' => 'WriterController@password']);
				Route::put('/{writer}/education', ['as' => 'admin.writer.education', 'uses' => 'WriterController@education']);
				Route::put('/{writer}/payment', ['as' => 'admin.writer.payment', 'uses' => 'WriterController@payment']);
				Route::delete('/{writer}', ['as' => 'admin.writer.destroy', 'uses' => 'WriterController@destroy']);
			});
			Route::group(['prefix' => 'editor'], function () {
				Route::get('/', ['as' => 'admin.editor.index', 'uses' => 'EditorController@index']);
				Route::get('/create', ['as' => 'admin.editor.create', 'uses' => 'EditorController@create']);
				Route::post('/', ['as' => 'admin.editor.store', 'uses' => 'EditorController@store']);
				Route::get('/{editor}', ['as' => 'admin.editor.show', 'uses' => 'EditorController@show']);
				Route::get('/{editor}/edit', ['as' => 'admin.editor.edit', 'uses' => 'EditorController@edit']);
				Route::put('/{editor}', ['as' => 'admin.editor.update', 'uses' => 'EditorController@update']);
				Route::put('/{editor}/password', ['as' => 'admin.editor.password', 'uses' => 'EditorController@password']);
				Route::put('/{editor}/education', ['as' => 'admin.editor.education', 'uses' => 'EditorController@education']);
				Route::put('/{editor}/payment', ['as' => 'admin.editor.payment', 'uses' => 'EditorController@payment']);
				Route::delete('/{editor}', ['as' => 'admin.editor.destroy', 'uses' => 'EditorController@destroy']);
			});
			Route::group(['prefix' => 'client'], function () {
				Route::get('/', ['as' => 'admin.client.index', 'uses' => 'ClientController@index']);
				Route::get('/create', ['as' => 'admin.client.create', 'uses' => 'ClientController@create']);
				Route::post('/', ['as' => 'admin.client.store', 'uses' => 'ClientController@store']);
				Route::get('/{client}', ['as' => 'admin.client.edit', 'uses' => 'ClientController@edit']);
				Route::put('/{client}', ['as' => 'admin.client.update', 'uses' => 'ClientController@update']);
				Route::put('/{client}/password', ['as' => 'admin.client.password', 'uses' => 'ClientController@password']);
				Route::delete('/{client}', ['as' => 'admin.client.destroy', 'uses' => 'ClientController@destroy']);
			});

			Route::group(['prefix' => 'admin'], function () {
				Route::get('/', ['as' => 'admin.admin.index', 'uses' => 'AdminController@index']);
				Route::get('/create', ['as' => 'admin.admin.create', 'uses' => 'AdminController@create']);
				Route::post('/', ['as' => 'admin.admin.store', 'uses' => 'AdminController@store']);
				Route::get('/{admin}', ['as' => 'admin.admin.show', 'uses' => 'AdminController@show']);
				Route::get('/{admin}/edit', ['as' => 'admin.admin.edit', 'uses' => 'AdminController@edit']);
				Route::put('/{admin}', ['as' => 'admin.admin.update', 'uses' => 'AdminController@update']);
				Route::put('/{admin}/payment', ['as' => 'admin.admin.payment', 'uses' => 'AdminController@payment']);
				Route::put('/{admin}/password', ['as' => 'admin.admin.password', 'uses' => 'AdminController@password']);
				Route::delete('/{admin}', ['as' => 'admin.admin.destroy', 'uses' => 'AdminController@destroy']);
			});

			Route::group(['prefix' => 'coupon'], function () {
				Route::get('/', ['as' => 'admin.coupon.index', 'uses' => 'CouponsController@index']);
				Route::get('/create', ['as' => 'admin.coupon.create', 'uses' => 'CouponsController@create']);
				Route::post('/store', ['as' => 'admin.coupon.store', 'uses' => 'CouponsController@store']);
				Route::get('/{coupon}', ['as' => 'admin.coupon.show', 'uses' => 'CouponsController@show']);
				Route::delete('/{coupon}', ['as' => 'admin.coupon.destroy', 'uses' => 'CouponsController@destroy']);
			});
			Route::get('/', 'HomeController@index')->name('admin.home');
			Route::get('/notes', ['as' => 'admin.notes.index', 'uses' => 'NotesToWriterController@index']);
			Route::delete('/notes/{note}', ['as' => 'admin.notes.delete', 'uses' => 'NotesToWriterController@destroy']);
			Route::get('/notes/update', ['as' => 'admin.notes.update', 'uses' => 'NotesToWriterController@update']);
			Route::get('/unrefunded', ['as' => 'admin.unrefunded.index', 'uses' => 'UnrefundedOrdersController@index']);
			Route::patch('/unrefunded/{order}', ['as' => 'admin.unrefunded.update', 'uses' => 'UnrefundedOrdersController@update']);
			Route::get('/refunded', ['as' => 'admin.refunded.index', 'uses' => 'refundedOrdersController@index']);

		});
		/* admin guest routes */
		Route::group(['namespace' => 'Auth'], function () {
			Route::get('/register', 'RegisterController@showRegisterForm')->name('admin.register');
			Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
			Route::post('/login', 'LoginController@Login');
			Route::post('/register', 'RegisterController@create');
			Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
			Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
			Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
			Route::post('/password/reset', 'ResetPasswordController@Reset')->name('admin.password.update');
		});
	});
});
	
/* editor routes */
Route::group(['prefix' => 'editor'], function () {
	Route::group(['namespace' => 'Editor'], function () {
		/* Editor auth routes */
		Route::group(['middleware' => 'auth:editor'], function () {
			Route::group(['prefix' => 'order'], function () {
				Route::get('/ineditingunpicked', 'IneditingUnpickedOrderController@index')->name('editor.inediting-unpicked.index');
				Route::get('/ineditingunpicked/{order}', ['as' => 'editor.inediting-unpicked.show', 'uses' => 'IneditingUnpickedOrderController@show']);
				Route::patch('/ineditingunpicked/{order}', ['as' => 'editor.inediting-unpicked.update', 'uses' => 'IneditingUnpickedOrderController@update']);
				Route::get('/inediting', 'IneditingOrderController@index')->name('editor.inediting.index');
				Route::get('/inediting/{order}', ['as' => 'editor.inediting.show', 'uses' => 'IneditingOrderController@show']);
				Route::patch('/inediting/{order}', ['as' => 'editor.inediting.update', 'uses' => 'IneditingOrderController@update']);
				Route::get('/completed', ['as' => 'editor.completed.index', 'uses' => 'CompletedOrderController@index']);
				Route::get('/completed/{order}', ['as' => 'editor.completed.show', 'uses' => 'CompletedOrderController@show']);
				Route::get('/inrevision', ['as' => 'editor.inrevision.index', 'uses' => 'InrevisionOrderController@index']);
				Route::get('/inrevision/{order}', ['as' => 'editor.inrevision.show', 'uses' => 'InrevisionOrderController@show']);
				Route::patch('/inrevision/{order}', ['as' => 'editor.inrevision.update', 'uses' => 'InrevisionOrderController@update']);
				Route::get('/cancelled', ['as' => 'editor.cancelled.index', 'uses' => 'CancelledOrderController@index']);
				Route::get('/cancelled/{order}', ['as' => 'editor.cancelled.show', 'uses' => 'CancelledOrderController@show']);
				Route::get('/approved', ['as' => 'editor.approved.index', 'uses' => 'ApprovedOrderController@index']);
				Route::get('/approved/{order}', ['as' => 'editor.approved.show', 'uses' => 'ApprovedOrderController@show']);
				Route::post('/{order}/message/store', ['as' => 'editor.message.store', 'uses' => 'MessagesController@store']);
			});
			Route::get('/', 'HomeController@index')->name('editor.home');
			Route::get('/invoices', ['as' => 'editor.invoice.index', 'uses' => 'InvoicesController@index']);
			Route::post('/invoices', ['as' => 'editor.invoice.store', 'uses' => 'InvoicesController@store']);
			Route::get('/invoices/{invoice}/requested', ['as' => 'editor.invoice.requested.show', 'uses' => 'InvoicesController@show']);
			Route::get('/invoices/{invoice}/paid', ['as' => 'editor.invoice.paid.show', 'uses' => 'InvoicesController@show']);
			Route::get('/messages', ['as' => 'editor.message.index', 'uses' => 'MessagesController@index']);
			Route::get('/messages/update', ['as' => 'editor.message.update', 'uses' => 'MessagesController@update']);
			Route::get('profile', ['as' => 'editor.profile.edit', 'uses' => 'ProfileController@edit']);
			Route::put('profile', ['as' => 'editor.profile.update', 'uses' => 'ProfileController@update']);
			Route::put('profile/password', ['as' => 'editor.profile.password', 'uses' => 'ProfileController@password']);
			Route::put('profile/education', ['as' => 'editor.profile.education', 'uses' => 'ProfileController@education']);
			Route::put('profile/payment', ['as' => 'editor.profile.payment', 'uses' => 'ProfileController@payment']);
			Route::get('profile/editpayment', ['as' => 'editor.profile.editpayment', 'uses' => 'ProfileController@editpayment']);
			Route::get('/news', ['as' => 'editor.news.index', 'uses' => 'NewsController@index']);
			Route::get('/notes', ['as' => 'editor.notes.index', 'uses' => 'NotesToWriterController@index']);
			Route::post('/fileupload', ['as' => 'editor.fileupload.store', 'uses' => 'FileUploadController@store']);
			Route::post('/fileupload/{name}', ['as' => 'editor.fileupload.delete', 'uses' => 'FileUploadController@destroy']);
		});
		/* Editor guest routes */
		Route::group(['namespace' => 'Auth'], function () {
			Route::get('/register', 'RegisterController@showRegisterForm')->name('editor.register');
			Route::get('/login', 'LoginController@showLoginForm')->name('editor.login');
			Route::post('/login', 'LoginController@Login');
			Route::post('/register', 'RegisterController@create');
			Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('editor.password.email');
			Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('editor.password.request');
			Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('editor.password.reset');
			Route::post('/password/reset', 'ResetPasswordController@Reset')->name('editor.password.update');
		});
	});
});