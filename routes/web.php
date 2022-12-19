<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserStatusDataController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SocialMediaController;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SponsorController;

use App\Http\Controllers\Forms\ProfileFormController;
use App\Http\Controllers\Forms\ItemFormController;

use App\View\Components\CommonLayout;

use App\Http\Requests\ItemFormRequest;
use App\Http\Requests\SponsorRequest;

/**
 * Frontend routes:
 */

Route::get('/', function () {
    return CommonLayout::home();
})->name('home');

Route::get('/origins', function () {
    return CommonLayout::origins();
})->name('origins');

Route::get('/privacy-policy', function () {
    return CommonLayout::policy();
})->name('privacy-policy');


Route::prefix('events')->group(function () {
    Route::get('/', function ($type = null) {
        return redirect('/events/all');
    });
    
    Route::get('/{type}', function ($type = null) {
        return EventController::index($type);
    })->name('events');
});

Route::get('/event/{name}', function ($name) {
    return EventController::show($name);
});


Route::prefix('projects')->group(function () {
    Route::get('/', function () {
        return ProjectController::index();
    })->name('projects');
    
    Route::get('/{tag}', function ($tag) {
        return ProjectController::index($tag);
    });
});

Route::get('/project/{name}', function ($name) {
    return ProjectController::show($name);
});


Route::prefix('blog')->group(function () {
    Route::get('/', function () {
        return view('common.blog')->with(PostController::index());
    })->name('blog');
    
    Route::get('/{tag}', function ($tag) {
        return view('common.blog')->with(PostController::index($tag));
    })->name('blog-tag');
});

Route::get('/blog/entry/{name}', function ($name) {
    return PostController::single($name);
})->name('blog-single');


Route::prefix('posts')->group(function () {
    Route::get('/{user}', function ($user) {
        return view('common.blog')->with(PostController::index(null, $user));
    })->name('user-posts');
    
    Route::get('/{user}/{tag}', function ($user, $tag) {
        return view('common.blog')->with(PostController::index($tag, $user));
    })->name('user-posts-tag');
});

Route::get('/post/{name}', function ($name) {
    return PostController::single($name);
})->name('post-single');


Route::prefix('members')->group(function () {
    Route::get('/', function () {
        return redirect()->route('members', ['role' => 'All']);
    });

    Route::get('/{role}', function ($role = null) {
        return UserController::index($role, Auth::user());
    })->name('members');
});

Route::prefix('member')->group(function () {
    Route::get('/', function () {
        return Auth::check() ? UserController::Single(Auth::user()->username)
                             : redirect()->route('home');
    });
    Route::get('/{user}', function ($user) {
        return UserController::Single($user, 'main', null, Auth::user());
    })->name('member');

    Route::get('/{user}/{page}', function ($user, $page) {
        return $page != 'community-posts' ? UserController::Single($user, $page, null, Auth::user()) : redirect()->route('user-posts', ['user' => $user]);
    });
    
    Route::get('/{user}/{page}/{tag}', function ($user, $page, $tag) {
        return UserController::Single($user, $page, $tag);
    });
});

Route::get('/social-media', function () {
    return SocialMediaController::index(Auth::user());
});

Route::get('/verify-user/{key}', function (string $key) {
    return Auth::check() ? UserController::verify(Auth::user(), $key) : redirect()->route('login');
});

Route::post('/invite-user', function (Request $request) {
    return Auth::check() ? \App\Http\Controllers\EmailController::invite(Auth::user(), $request) : null;
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/edit-profile', function () {
        return ProfileFormController::editProfileForm(Auth::user());
    })->name('edit-profile');

    Route::post('/update-profile', function () {
        return ProfileFormController::updateProfile(Auth::user());
    });

    Route::post('/close-account', function () {
        return UserStatusDataController::closeAccount(Auth::user());
    });

    Route::post('/remove-data', function () {
        return UserStatusDataController::requestRemoveData(Auth::user());
    });

    Route::get('/tech-type', function (Request $request) {
        return \App\Http\Controllers\TechnologyController::index(Auth::user(), $request->type);
    });

    Route::get('/user-tech/edit', function (Request $request) {
        return \App\Http\Controllers\UserTechController::edit(Auth::user(), $request->id);
    });

    Route::get('/view-applications', function (Request $request) {
        return PositionController::applications(Auth::user(), $request->id);
    });

    Route::get('/set-media', function (Request $request) {
        return SocialMediaController::single(Auth::user(), $request);
    });

    Route::get('/update-media', function (\App\Http\Requests\SocialMediaRequest $request) {
        return SocialMediaController::update(Auth::user(), $request);
    });

    Route::get('/position-apply', function (Request $request) {
        return PositionController::apply(Auth::user(), $request);
    });

    Route::get('/position-application-data', function (Request $request) {
        return PositionController::single(Auth::user(), $request);
    });

    Route::get('/position-application-reply', function (Request $request) {
        return PositionController::reply(Auth::user(), $request);
    });

    Route::get('/item-create/{type}', function (Request $request, string $type) {
        return ItemFormController::createEditItemForm(Auth::user(), $request, $type);
    })->name('item-create');

    Route::get('/item-edit/{type}', function (Request $request, string $type) {
        return ItemFormController::createEditItemForm(Auth::user(), $request, $type);
    })->name('item-edit');

    Route::post('/item-submit/{type}', function (ItemFormRequest $request, string $type) {
        return ItemFormController::createEditItem(Auth::user(), $request, $type);
    });

    Route::get('/image-delete/{type}', function (ItemFormRequest $request, string $type) {
        return ItemFormController::deleteImage(Auth::user(), $request, $type);
    });

    Route::get('/item-delete/{type}', function (Request $request, string $type) {
        return ItemFormController::deleteItem(Auth::user(), $request, $type);
    });

    Route::post('/item-report/{type}', function (\App\Http\Requests\ReportRequest $request, string $type) {
        return ReportController::report(Auth::user(), $request, $type);
    });

    Route::post('/comment-create', function (\App\Http\Requests\CommentRequest $request) {
        return CommentController::create(Auth::user(), $request);
    });

    Route::post('/comment-delete', function (Request $request) {
        return CommentController::destroy(Auth::user(), $request);
    });

    Route::post('/activity-toggle', function () {
        return UserController::activityToggle(Auth::user());
    });

    Route::post('/events-subscribe', function (Request $request) {
        return EventController::subscribe(Auth::user(), $request);
    });

    Route::post('/events-unsubscribe', function (Request $request) {
        return EventController::unSubscribe(Auth::user(), $request);
    });

    Route::post('/view-notification', function (Request $request) {
        return NotificationController::markViewed(Auth::user(), $request);
    });

    Route::post('/display-notifications-viewed', function () {
        return NotificationController::indexLastWeek(Auth::user());
    });

    Route::post('/ban-user', function (Request $request) {
        return UserController::toggleBan(Auth::user(), $request);
    });

    Route::post('/follow-user', function (Request $request) {
        return UserController::toggleFollow(Auth::user(), $request);
    });

    Route::get('/reports', function () {
        return ReportController::Index(Auth::user());
    });

    Route::get('/reports/resolved', function () {
        return ReportController::Index(Auth::user(), true);
    });

    Route::post('/report-resolved', function (Request $request) {
        return ReportController::toggleResolved(Auth::user(), $request);
    });

    Route::post('/verify-resend', function () {
        return \App\Http\Controllers\EmailController::sendVerificationEmail(Auth::user()->email, Auth::user()->verification);
    });

    Route::get('/toggle-doorbell', function () {
        return \App\Http\Controllers\EnvController::DoorbellToggle(Auth::user());
    });

    Route::post('/sponsor-store', function (SponsorRequest $request) {
        return \App\Http\Controllers\SponsorController::store(Auth::user(), $request);
    });

    Route::post('/sponsor-update', function (SponsorRequest $request) {
        return \App\Http\Controllers\SponsorController::update(Auth::user(), $request);
    });

    Route::get('/sponsor-delete/{id}', function (int $id) {
        return \App\Http\Controllers\SponsorController::destroy(Auth::user(), $id);
    });

    Route::get('/sponsors', function () {
        return SponsorController::form(Auth::user());
    });

    Route::get('/sponsor/{id}', function (int $id) {
        return SponsorController::show($id);
    });

});

Route::get('/posts-fetch-more', function (Request $request) {
    return PostController::fetchMore(Auth::user(), $request);
});

Route::get('/comment-replies', function (Request $request) {
    return CommentController::index($request);
});

Route::get('/canvas', function (Request $request) {
    return \App\Http\Controllers\CanvasController::renderCanvas($request);
});

Route::post('/ring-doorbell', function (Request $request) {
    return \App\Http\Controllers\DiscordController::ringDoorbell(Session::getId());
});

// Handler for Instafram redirects
Route::get('/accounts/login', function () {
    return \App\Http\Controllers\CanvasController::redirectUrl('instagram', '/accounts/login');
});

/**
 * User routes:
 */

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/users', function () {
    return UserController::index();
});

Route::get('/users/{role}', function ($role) {
    return UserController::index($role);
});

Route::get('/user/{id}', function ($id) {
    return UserController::index($id);
});


// Route::get("/users/?id={$id}", UserController::single($id));
