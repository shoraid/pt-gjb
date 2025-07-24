<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', User::class);

        $users = $this->service->getList();

        return view('cms.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', User::class);

        $roles = $this->service->getRoleList();

        return view('cms.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        Gate::authorize('create', User::class);

        $this->service->create($request->validated(), $request->user()->id);

        return to_route('cms.users.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);

        $user->loadMissing('roles:id,name');

        return view('cms.users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        $user->loadMissing('roles:id,name');
        $roles = $this->service->getRoleList();
        $selectedRoleIds = $this->service->getRoleIds($user);

        return view('cms.users.edit', compact('user', 'roles', 'selectedRoleIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        Gate::authorize('update', $user);

        $this->service->update($user, $request->validated());

        return to_route('cms.users.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $this->service->delete($user);

        return to_route('cms.users.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_deleted')
        ]);
    }
}
