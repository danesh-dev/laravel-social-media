<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\Post;
use App\Models\User;
use App\Policies\ChatPolicy;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Chat::class, ChatPolicy::class);

        Broadcast::routes(['middleware' => ['auth']]);

        // require base_path('routes/channels.php');

        try {
            require base_path('routes/channels.php');
        } catch (\Exception $e) {
            Log::error('Error loading broadcast routes: ' . $e->getMessage());
        }
    }
}
