<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laraeast\LaravelSettings\Models\Setting;
use Laraeast\LaravelSettings\Facades\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Setting::class);

        return view('dashboard.settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->authorize('update', Setting::class);

        $files = [
            'logo',
        ];

        foreach ($request->except(array_merge(['_token', '_method', 'media'], $files)) as $key => $value) {
            Settings::set($key, $value);
        }

        foreach ($files as $file) {
            Settings::set($file)->addAllMediaFromTokens([], $file);
        }

        flash(trans('settings.messages.updated'));

        return redirect()->route('dashboard.settings.index');
    }
}
