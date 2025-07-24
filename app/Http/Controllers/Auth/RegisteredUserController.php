<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            $user->roles()->attach([RoleEnum::COMMON_USER]);

            DB::commit();

            return to_route('login')->with([
                'type' => 'success',
                'message' => __('app.messages.successfully_registered')
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with([
                'type' => 'danger',
                'message' => __('app.messages.unexpected_error')
            ]);
        }
    }
}
