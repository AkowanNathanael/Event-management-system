<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\VenueController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;















//
Route::get("/email", function () {
   Mail::to("danyonathaniel7@gmail.com")->send(new \App\Mail\Sample(Auth::user()));
})->middleware("auth");

Route::get("/login", function () {
    return view("login");
})->name("login")->middleware("guest");
Route::get("/register", function () {
    return view("register");
})->name("register")->middleware("guest");
Route::get("/admin/dashboard",function(){
    $users=User::where("isadmin", "0")->count();
    $admins=User::where("isadmin", "1")->count();
    $categories=\App\Models\Category::all()->count();
    $eventArtists=\App\Models\EventArtist::all()->count();
    $events=\App\Models\Event::all()->count();
    $ticketTypes=\App\Models\TicketType::all()->count();
    // $services=\App\Models\Service::all()->count();
    $carts=\App\Models\Cart::all()->count();
    // $quizzes=\App\Models\Quiz::all()->count();
    // $questions=\App\Models\Question::all()->count();
    $data=[
        "users"=>$users,
        "admins"=>$admins,
        "categories"=>$categories,
        "eventArtists"=>$eventArtists,
        "events"=>$events,
        "ticketTypes"=>$ticketTypes,
        "carts"=>$carts,
        "paidTickets"=>\App\Models\Cart::where("status", "paid")->count(),
        "orderedTickets"=>\App\Models\Cart::where("status", "ordered")->count(),
        "userCarts" => \App\Models\Cart::where('user_id', Auth::id())->count(),
        "userPaidTickets" => \App\Models\Cart::where('user_id', Auth::id())
            ->where('status', 'paid')
            ->count(),
        "userOrderedTickets" => \App\Models\Cart::where('user_id', Auth::id())
            ->where('status', 'ordered')
            ->count(),


    ];
    // dd($data);

  return view("admin.index", $data);
})->middleware("auth")->name("admin.dashboard");

Route::middleware("auth")->group(function () {
    //
    Route::post("/logout/auth", [Authentication::class, "logout"]);
    Route::post("/auth/changepassword", [Authentication::class, "changepassword"]);
    Route::post("/auth/profilechange", [Authentication::class, "uploadprofilepicture"]);
    //
    Route::get("/admin/category/create", [CategoryController::class, "create"]);
    Route::post("/admin/category/store", [CategoryController::class, "store"]);
    Route::get("/admin/category", [CategoryController::class, "index"]);
    Route::get("/admin/category/{category}", [CategoryController::class, "show"]);
    Route::put("/admin/category/{category}", [CategoryController::class, "update"]);
    Route::delete("/admin/category/{category}", [CategoryController::class, "destroy"]);
    Route::get("/admin/category/{category}/edit", [CategoryController::class, "edit"]);
    //
    Route::get("/admin/venue/create", [VenueController::class, "create"]);
    Route::post("/admin/venue/store", [VenueController::class, "store"]);
    Route::get("/admin/venue", [VenueController::class, "index"]);
    Route::get("/admin/venue/{venue}", [VenueController::class, "show"]);
    Route::put("/admin/venue/{venue}", [VenueController::class, "update"]);
    Route::delete("/admin/venue/{venue}", [VenueController::class, "destroy"]);
    Route::get("/admin/venue/{venue}/edit", [VenueController::class, "edit"]);
    //
    Route::get("/admin/artist/create", [ArtistController::class, "create"]);
    Route::post("/admin/artist/store", [ArtistController::class, "store"]);
    Route::get("/admin/artist", [ArtistController::class, "index"]);
    Route::get("/admin/artist/{artist}", [ArtistController::class, "show"]);
    Route::put("/admin/artist/{artist}", [ArtistController::class, "update"]);
    Route::delete("/admin/artist/{artist}", [ArtistController::class, "destroy"]);
    Route::get("/admin/artist/{artist}/edit", [ArtistController::class, "edit"]);
    //
    Route::get("/admin/tickettype/create", [TicketTypeController::class, "create"]);
    Route::post("/admin/tickettype/store", [TicketTypeController::class, "store"]);
    Route::get("/admin/tickettype", [TicketTypeController::class, "index"]);
    Route::get("/admin/tickettype/{ticketType}", [TicketTypeController::class, "show"]);
    Route::put("/admin/tickettype/{ticketType}", [TicketTypeController::class, "update"]);
    Route::delete("/admin/tickettype/{ticketType}", [TicketTypeController::class, "destroy"]);
    Route::get("/admin/tickettype/{ticketType}/edit", [TicketTypeController::class, "edit"]);
    //
    Route::get("/admin/organiser/create", [OrganiserController::class, "create"]);
    Route::post("/admin/organiser/store", [OrganiserController::class, "store"]);
    Route::get("/admin/organiser", [OrganiserController::class, "index"]);
    Route::get("/admin/organiser/{organiser}", [OrganiserController::class, "show"]);
    Route::put("/admin/organiser/{organiser}", [OrganiserController::class, "update"]);
    Route::delete("/admin/organiser/{organiser}", [OrganiserController::class, "destroy"]);
    Route::get("/admin/organiser/{organiser}/edit", [OrganiserController::class, "edit"]);
    //
    Route::get("/admin/ticket/create", [TicketController::class, "create"]);
    Route::post("/admin/ticket/store", [TicketController::class, "store"]);
    Route::get("/admin/ticket", [TicketController::class, "index"]);
    Route::get("/admin/ticket/{ticket}", [TicketController::class, "show"]);
    Route::put("/admin/ticket/{ticket}", [TicketController::class, "update"]);
    Route::delete("/admin/ticket/{ticket}", [TicketController::class, "destroy"]);
    Route::get("/admin/ticket/{ticket}/edit", [TicketController::class, "edit"]);
    //
    Route::get("/admin/cart/create", [CartController::class, "create"]);
    Route::post("/admin/cart/{ticket}/store", [CartController::class, "store"]);
    Route::get("/admin/cart", [CartController::class, "index"]);
    Route::get("/admin/cart/{cart}", [CartController::class, "show"]);
    Route::put("/admin/cart/{cart}", [CartController::class, "update"]);
    Route::delete("/admin/cart/{cart}/{ticket}", [CartController::class, "destroy"]);
    Route::get("/admin/cart/{cart}/edit", [CartController::class, "edit"]);
    //
    Route::get("/admin/order", [CartController::class, "orders"]);
    //
    Route::get("/admin/receipt", [CartController::class, "receipts"]);
    Route::get("/admin/receipt/verify", [CartController::class, "verify"]);
    Route::post("/admin/receipt/find", [CartController::class, "findReference"]);
    //
    Route::get("/admin/admin/create", [AdminController::class, "create"]);
    Route::post("/admin/admin/store", [AdminController::class, "store"]);
    Route::get("/admin/admin", [AdminController::class, "index"]);
    Route::get("/admin/admin/{admin}", [AdminController::class, "show"]);
    Route::put("/admin/admin/{admin}", [AdminController::class, "update"]);
    Route::delete("/admin/admin/{admin}", [AdminController::class, "destroy"]);
    Route::get("/admin/admin/{admin}/edit", [AdminController::class, "edit"]);
    //
    Route::get("/admin/add-question/{quiz}", [QuestionController::class, "create"]);
    Route::post("/admin/add-question", [QuestionController::class, "store"]);
    //
    Route::get("/admin/event/create", [EventController::class, "create"]);
    Route::post("/admin/event/store", [EventController::class, "store"]);
    Route::get("/admin/event", [EventController::class, "index"]);
    Route::get("/admin/event/{event}", [EventController::class, "show"]);
    Route::put("/admin/event/{event}", [EventController::class, "update"]);
    Route::delete("/admin/event/{event}", [EventController::class, "destroy"]);
    Route::get("/admin/event/{event}/edit", [EventController::class, "edit"]);

    //
    Route::get("/admin/profile", [ProfileController::class, "profile"]);
    // User
    Route::get("/user/profile", [ProfileController::class, "profile"]);
    Route::get("/user/event", [ClientController::class, "events"]);
    Route::get("/user/event/{event}", [ClientController::class, "showevent"]);
    Route::get("/user/podcast", [ClientController::class, "podcasts"]);
    Route::get("/user/podcast/{podcast}", [ClientController::class, "showpodcast"]);
    Route::get("/user/post", [ClientController::class, "posts"]);
    Route::get("/user/post/{post}", [ClientController::class, "showpost"]);
    Route::get("/user/resource", [ClientController::class, "resources"]);
    Route::get("/user/resource/{resource}", [ClientController::class, "showresource"]);
    Route::get("/user/quiz", [ClientController::class, "quizzes"]);
    Route::get("/user/quiz/{quiz}", [ClientController::class, "showquiz"]);
    Route::get("/user/service", [ClientController::class, "services"]);
    Route::get("/user/service/{service}", [ClientController::class, "showservice"]);
    Route::get("/user/quiz", [ClientController::class, "showquiz"]);
    Route::get("/user/view-question/{quiz}", [ClientController::class, "showquestions"]);
});


Route::post("/login/auth", [Authentication::class, "login"]);
Route::post("/register/auth", [Authentication::class, "register"]);
//

//
// Route::redirect("/", "/login")->name("home");
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard');
    }
    return redirect('/login');
})->name('home');






// template
Route::get('/blank', function () {
    return view("sneat.html.blank");
});
Route::get('/auth-index', function () {
    return view("sneat.html.index");
});
Route::get('/auth-forgot', function () {
    return view("sneat.html.auth-forgot-password-basic");
});

Route::get('/auth-login', function () {
    return view("sneat.html.auth-login-basic");
});
Route::get('/auth-register', function () {
    return view("sneat.html.auth-register-basic");
});
Route::get('/auth-extended-ui-scrollbar', function () {
    return view("sneat.html.extended-ui-perfect-scrollbar");
});
Route::get('/auth-extended-text-divider', function () {
    return view("sneat.html.extended-ui-text-divider");
});
Route::get('/auth-form-layout-horinzontal', function () {
    return view("sneat.html.form-layouts-horizontal");
});
Route::get('/auth-form-layouts-vertical', function () {
    return view("sneat.html.form-layouts-vertical");
});
Route::get('/auth-form-basic-inputs', function () {
    return view("sneat.html.forms-basic-inputs");
});
Route::get('/auth-form-input-groups', function () {
    return view("sneat.html.forms-input-groups");
});
Route::get('/auth-icons-boxicons', function () {
    return view("sneat.html.icons-boxicons");
});
Route::get('/auth-layouts', function () {
    return view("sneat.html.layouts-blank");
});
Route::get('/auth-layouts-container', function () {
    return view("sneat.html.layouts-container");
});
Route::get('/auth-layouts-fluid', function () {
    return view("sneat.html.layouts-fluid");
});
Route::get('/auth-layouts-without-menu', function () {
    return view("sneat.html.layouts-without-menu");
});
Route::get('/auth-layouts-without-navbar', function () {
    return view("sneat.html.layouts-without-navbar");
});
Route::get('/auth-pages-account', function () {
    return view("sneat.html.pages-account-settings-account");
});
Route::get('/auth-pages-connection', function () {
    return view("sneat.html.pages-account-settings-connections");
});
Route::get('/auth-pages-notifications', function () {
    return view("sneat.html.pages-account-settings-notifications");
});
Route::get('/auth-error', function () {
    return view("sneat.html.pages-misc-error");
});
Route::get('/auth-maintenance', function () {
    return view("sneat.html.pages-misc-under-maintenance");
});
Route::get('/auth-cards', function () {
    return view("sneat.html.cards-basic");
});
Route::get('/auth-tables', function () {
    return view("sneat.html.tables-basic");
});
Route::get('/auth-accordion', function () {
    return view("sneat.html.ui-accordion");
});
Route::get('/auth-alerts', function () {
    return view("sneat.html.ui-alerts");
});
Route::get('/auth-badges', function () {
    return view("sneat.html.ui-badges");
});
Route::get('/auth-buttons', function () {
    return view("sneat.html.ui-buttons");
});
Route::get('/auth-carousels', function () {
    return view("sneat.html.ui-carousel");
});
Route::get('/auth-collapse', function () {
    return view("sneat.html.ui-collapse");
});
Route::get('/auth-dropdowns', function () {
    return view("sneat.html.ui-dropdowns");
});
Route::get('/auth-footer', function () {
    return view("sneat.html.ui-footer");
});
Route::get('/auth-list-group', function () {
    return view("sneat.html.ui-list-groups");
});
Route::get('/auth-modals', function () {
    return view("sneat.html.ui-modals");
});
Route::get('/auth-navbar', function () {
    return view("sneat.html.ui-navbar");
});
Route::get('/auth-offcanvas', function () {
    return view("sneat.html.ui-offcanvas");
});
Route::get('/auth-pagination', function () {
    return view("sneat.html.ui-pagination-breadcrumbs");
});
Route::get('/auth-progress', function () {
    return view("sneat.html.ui-progress");
});
Route::get('/auth-spinners', function () {
    return view("sneat.html.ui-spinners");
});
Route::get('/auth-tab-pills', function () {
    return view("sneat.html.ui-tabs-pills");
});
Route::get('/auth-toasts', function () {
    return view("sneat.html.ui-toasts");
});
Route::get('/auth-tooltips', function () {
    return view("sneat.html.ui-tooltips-popovers");
});
Route::get('/auth-typography', function () {
    return view("sneat.html.ui-typography");
});

