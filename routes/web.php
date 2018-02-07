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

// Return User View
Route::get('/', 'view_controller@home');

Route::get('/documentation', function (){
    return view('documentation');  
});

// ***************** Announcement (Vistor routes) *****************
// View Announcement Details
Route::get('/view-announcement-details/{announcementId}', 'view_controller@viewAnnouncementDetails');

// ***************** Announcement (Admin routes) *****************
// Make Announcement
Route::post('/make-announcement', 'upload_controller@makeAnnouncement');
// View All Announcements
Route::get('/view-all-announcements', 'upload_controller@viewAllAnnouncements');
// View/Edit Specific Announcement
Route::get('/edit-announcement/{announcement}', 'upload_controller@editAnnouncement');
// Save Edit Specific Announcement
Route::post('/edit-announcement/{announcement}', 'upload_controller@saveEditAnnouncement');
// Enable Specific Announcement
Route::put('/enable-announcement/{announcement}', 'upload_controller@enableAnnouncement');
// Disable Specific Announcement
Route::put('/disable-announcement/{announcement}', 'upload_controller@disableAnnouncement');
// Delete Specific Announcement
Route::delete('/delete-announcement/{announcement}', 'upload_controller@deleteAnnouncement');
// Search for Announcement
Route::post('/searchAnnouncement', 'upload_controller@searchAnnouncement');
// Delete Specific Announcement Image
Route::delete('/delete-announcement-image/{announcement}', 'upload_controller@deleteAnnouncementImage');
// Delete Specific Announcement File
Route::delete('/delete-announcement-file/{announcement}', 'upload_controller@deleteAnnouncementFile');


// ***************** Images *****************
// Upload Image
Route::post('/upload-image', 'upload_controller@uploadImage');
// View Achievement Images
Route::get('/view-all-achievement-images', 'upload_controller@viewAllAchievementImages');
// View OnGoing Images
Route::get('/view-all-ongoing-images', 'upload_controller@viewAllOnGoingProjectImages');
// View Gallery Images
Route::get('/view-all-gallery-images', 'upload_controller@viewAllRandomImages');
// View Slider Images
Route::get('/view-all-slider-images', 'upload_controller@viewAllSliderImages');
// View/Edit Specific Image
Route::get('/edit-image/{imageType}/{imageId}', 'upload_controller@editImage');
// Save Edit Specific Image
Route::post('/edit-image/{imageId}', 'upload_controller@saveEditImage');
// Enable Specific Image
Route::put('/enable-image/{imageType}/{imageId}', 'upload_controller@enableImage');
// Disable Specific Image
Route::put('/disable-image/{imageType}/{imageId}', 'upload_controller@disableImage');
// Delete Specific Image
Route::delete('/delete-image/{imageType}/{imageId}', 'upload_controller@deleteImage');
// Search for Iamge
Route::post('/searchImage', 'upload_controller@searchImage');

// ***************** Circular *****************
// Upload Cicular
Route::post('/upload-circular', 'upload_controller@uploadCircular');
// View All Circulars
Route::get('/view-all-circular', 'upload_controller@viewAllCirculars');
// View/Edit Specific Circular
Route::get('/edit-circular/{circularId}', 'upload_controller@editCircular');
// Save Edit Specific Circular
Route::post('/edit-circular/{circular}', 'upload_controller@saveEditCircular');
// Enable Specific Circular
Route::put('/enable-circular/{circular}', 'upload_controller@enableCircular');
// Disable Specific Circular
Route::put('/disable-circular/{circular}', 'upload_controller@disableCircular');
// Delete Specific Circular
Route::delete('/delete-circular/{circular}', 'upload_controller@deleteCircular');
// Search for Circular
Route::post('/searchCircular', 'upload_controller@searchCircular');

// ***************** Member *****************
// Add Member
Route::post('/add-member', 'upload_controller@addMember');
// View All Committe Members
Route::get('/view-all-commitee-member', 'upload_controller@viewAllManagmentCommitteMembers');
// View All Focal Members
Route::get('/view-all-focal-member', 'upload_controller@viewAllFocalMembers');
// View/Edit Specific Member
Route::get('/edit-member/{memberType}/{memberId}', 'upload_controller@editMember');
// Save Edit Specific Member
Route::post('/edit-member/{memberType}/{memberId}', 'upload_controller@saveEditMember');
// Enable Specific Member
Route::put('/enable-member/{memberType}/{memberId}', 'upload_controller@enableMember');
// Disable Specific Member
Route::put('/disable-member/{memberType}/{memberId}', 'upload_controller@disableMember');
// Delete Specific Member
Route::delete('/delete-member/{memberType}/{memberId}', 'upload_controller@deleteMember');
// Search for Member
Route::post('/searchMember', 'upload_controller@searchMember');

// ***************** Visitor Message (Visitor routes) *****************
// Visitor Add Message
Route::post('/contactUs', 'view_controller@contactUs');

// ***************** Visitor Message (Admin routes) *****************
// View Messages
Route::get('/view-all-messages', 'upload_controller@viewAllMessages');
// View Specific Message
Route::get('/view-message/{messageId}', 'upload_controller@viewMessage');
// View All Replies to a Specific Message Sender
Route::get('/view-all-messages-of-specific-sender/{messageId}', 'upload_controller@viewAllMessagesOfSpecificSender');
// Reply to Message
Route::post('/reply-message/{messageId}', 'upload_controller@replyMessage');
// Mark As Unread Message
Route::put('/mark-as-unread-message/{messageId}', 'upload_controller@markAsUnreadMessage');
// Mark As Read Message
Route::put('/mark-as-read-message/{messageId}', 'upload_controller@markAsReadMessage');
// Delete Specific Message
Route::delete('/delete-message/{messageId}', 'upload_controller@deleteMessage');
// Search for Sender
Route::post('/searchSender', 'upload_controller@searchSender');

// ***************** Authentication *****************
Auth::routes();

Route::get('/user/logout','Auth\LoginController@userLogout')->name('user.logout');

// Return Admin View
Route::prefix('admin')->group(function () {
    Route::get('/', 'upload_controller@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\admin_controller@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\admin_controller@login')->name('admin.login.submit');
    
    //admin password reset routes
    Route::post('/password/email','Auth\adminForgetPassword_controller@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Auth\adminForgetPassword_controller@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\adminPasswordReset_controller@reset');
    Route::get('/password/reset/{token}','Auth\adminPasswordReset_controller@showResetForm')->name('admin.password.reset');
});