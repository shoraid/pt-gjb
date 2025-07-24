<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $service) {}

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('cms.profile.edit', ['user' => $request->user()]);
    }

    /**
     * Display the user's profile form.
     */
    public function show(Request $request)
    {
        return view('cms.profile.show', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $this->service->update($request->user(), $request->validated());

        return to_route('cms.profile.show')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }
}
