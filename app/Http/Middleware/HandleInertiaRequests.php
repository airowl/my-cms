<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        $passDataUser = null;
        if(isset($user)){
            $passDataUser = $user->getSummery();
            if (isset($user->avatar)) {
                $urlAvatar = env('APP_URL') . Storage::url($user->avatar);
                $passDataUser->avatar = $urlAvatar ?? $user->avatar;
            }
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $passDataUser ?? $user,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
