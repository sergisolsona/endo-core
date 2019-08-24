<?php

namespace Endo\EndoCore\App\Providers;

use Endo\EndoCore\App\Policies\RoutesPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];


    /**
     * Policies without models
     *
     * @var array
     */
    protected $policiesWithoutModel = [
        RoutesPolicy::class
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        /*
		 * Workaround for policies without model.
		 */
        foreach ($this->policiesWithoutModel as $policyWithoutModel)
        {
            foreach (get_class_methods(new $policyWithoutModel()) as $method)
            {
                Gate::define($method, "{$policyWithoutModel}@{$method}");
            }
        }

        $this->registerPolicies();

        //
    }
}
