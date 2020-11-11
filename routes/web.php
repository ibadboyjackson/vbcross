<?php


use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserProfileController;
use Dongm2ez\Mention\Facades\Mention;
use Illuminate\Support\Facades\Auth;

//testing routes
Route::livewire('chat/new', 'chat-new')->middleware(['is-ban', 'global-share']);

Route::get('/test', function () {
    return 0;
});
//testing routes end

Route::get('/', function () {
   return redirect()->route('stories');
});

Route::get('/blog', function () {
    $posts = \App\Post::with(['user' , 'user.roles'])
        ->whereNotNull('published_at')
        ->paginate(100);
    return view('welcome', compact('posts'));
})->middleware(['is-ban', 'global-share'])->name('public.posts');

Auth::routes();


Route::middleware(['auth', 'is-ban', 'global-share'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
//    admin routes
    Route::group(['middleware' => ['role:admin']], function () {

        Route::group(['prefix'=>'admin','as'=>'admin.'], function(){

            Route::prefix('manage-users')->group(function () {
                Route::get('/', [ManageUserController::class, 'index'])->name('manage-users');
                Route::get('/ban/{user}', [ManageUserController::class, 'ban'])->name('manage-users.ban');
                Route::get('/unban/{user}', [ManageUserController::class, 'unban'])->name('manage-users.unban');
                Route::get('/edit/{user}', [ManageUserController::class, 'edit'])->name('manage-users.edit');
            });

            Route::resource('categories', 'CategoriesController');
            Route::resource('message', 'ChatMessageController');
            Route::resource('story', 'StoryController');
        });


    });

//    user routes
    Route::group(['middleware' => ['role:user']], function () {
        //
    });

//    common routes for admin and user

    Route::get('stories' , [StoryController::class, 'stories'])->name('stories');
    Route::resource('post', 'PostController');
    Route::get('post/like-toggle/{post}', [LikeController::class, 'likeToggle'])->name('post.like-toggle');
    Route::get('post/comment/{post}', [CommentController::class, 'index'])->name('post.comment');
    Route::post('post/comment', [CommentController::class, 'store'])->name('post.comment.store');
    Route::livewire('comment/{post}', 'comment');

    Route::get('chat/global-message', [ChatController::class, 'globalMessage'])->middleware('role:admin')->name('chat.global-message');
    Route::post('chat/global-message', [ChatController::class, 'sendGlobalMessage'])->middleware('role:admin')->name('chat.global-message');

    Route::prefix('chat')->group(function () {
//        Route::get('/{selectedConversationId?}', [ChatController::class, 'inbox'])->name('chat');
        Route::livewire('/{selectedConversationId?}', 'chat')->name('chat');
        Route::get('/start-conversation/{receiver}', [ChatController::class, 'startConversation'])->name('chat.start-conversation');
        Route::get('/start-challenge/{receiver}', [ChatController::class, 'startChallenge'])->name('chat.start-challenge');
        Route::livewire('public/arena', 'chat-arena')->name('chat.arena');
        Route::livewire('online/members', 'online-members')->name('chat.online.members');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [UserProfileController::class, 'show'])->name('profile');
        Route::post('/', [UserProfileController::class, 'update'])->name('profile');
        Route::post('/change-password', [UserProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::get('/public/{user}', [UserProfileController::class, 'publicProfile'])->name('profile.public');
    });


});


