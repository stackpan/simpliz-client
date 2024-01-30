<?php

namespace App\Providers;

use App\Models\PersonalAccessToken;
use App\Repositories\Impl\QuizRepositoryImpl;
use App\Repositories\Impl\TokenRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\QuizRepository;
use App\Repositories\TokenRepository;
use App\Repositories\UserRepository;
use App\Services\AuthenticationService;
use App\Services\Impl\AuthenticationServiceImpl;
use App\Services\Impl\ParticipantServiceImpl;
use App\Services\Impl\QuizServiceImpl;
use App\Services\ParticipantService;
use App\Services\QuizService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TokenRepository::class, TokenRepositoryImpl::class);
        $this->app->singleton(UserRepository::class, UserRepositoryImpl::class);
        $this->app->singleton(QuizRepository::class, QuizRepositoryImpl::class);

        $this->app->singleton(AuthenticationService::class, AuthenticationServiceImpl::class);
        $this->app->singleton(ParticipantService::class, ParticipantServiceImpl::class);
        $this->app->singleton(QuizService::class, QuizServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
