<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        $settings = \Illuminate\Support\Facades\Schema::hasTable('site_settings')
            ? SiteSetting::all()->pluck('value', 'key')->all()
            : [];

        $env = strtolower((string) config('app.env', 'production'));
        $mode = strtolower((string) config('app.mode', $env));
        $isProduction = app()->isProduction() || $mode === 'production' || $env === 'production';
        $isDemo = !$isProduction && ($mode === 'demo');
        $isDevelopment = !$isProduction && in_array($mode, ['local', 'development', 'dev']);
        $configuredShowDemo = config('app.show_demo_credentials');
        $showDemoCredentials = $isProduction
            ? false
            : ($configuredShowDemo !== null ? filter_var($configuredShowDemo, FILTER_VALIDATE_BOOLEAN) : true);

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_active' => $user->is_active,
                    'avatar_url' => $user->avatar_url,
                    'roles' => $user->getRoleNames(),
                    'permissions' => $user->getAllPermissions()->pluck('name'),
                ] : null,
            ],
            'site' => [
                'name' => $settings['site_name'] ?? config('app.name', 'LaraSvelte'),
                'description' => $settings['site_description'] ?? '',
                'maintenance_mode' => filter_var($settings['maintenance_mode'] ?? 'false', FILTER_VALIDATE_BOOLEAN),
                'enable_registration' => filter_var($settings['enable_registration'] ?? 'true', FILTER_VALIDATE_BOOLEAN),
            ],
            'branding' => \Illuminate\Support\Facades\Schema::hasTable('site_settings')
                ? \App\Http\Controllers\Admin\BrandingController::getCachedBranding()
                : [],
            'modules' => \App\Models\Module::getCachedActiveModules(),
            'app_env' => [
                'mode' => $isProduction ? 'production' : $mode,
                'is_production' => $isProduction,
                'is_demo' => $isDemo,
                'is_development' => $isDevelopment,
                'show_demo_credentials' => $showDemoCredentials,
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
                'warning' => fn () => $request->session()->get('warning'),
                'info' => fn () => $request->session()->get('info'),
            ],
        ]);
    }
}
