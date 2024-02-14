<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Advertismaent;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleGroup;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Job;
use App\Models\Podcast;
use App\Models\PodcastList;
use App\Models\Store;
use App\Policies\AdvertismaentPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\PermissionPolicy;
use Spatie\Permission\Models\Role;
use App\Policies\ArticleGroupPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ChildCategoryPolicy;
use App\Policies\JobPolicy;
use App\Policies\PodcastListPolicy;
use App\Policies\PodcastPolicy;
use App\Policies\StorePolicy;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Article::class => ArticlePolicy::class,
        ArticleGroup::class => ArticleGroupPolicy::class,
        Podcast::class => PodcastPolicy::class,
        PodcastList::class => PodcastListPolicy::class,
        Advertismaent::class => AdvertismaentPolicy::class,
        Store::class => StorePolicy::class,
        Job::class => JobPolicy::class,
        Category::class => CategoryPolicy::class,
        ChildCategory::class => ChildCategoryPolicy::class,
    ];

    /**
     *
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
