<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct(private RoleService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Role::class);

        $roles = $this->service->getList();

        return view('cms.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Role::class);

        $permissions = $this->service->getPermissionList();

        return view('cms.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Gate::authorize('create', Role::class);

        $this->service->create($request->validated(), $request->user()->id);

        return to_route('cms.roles.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        Gate::authorize('view', $role);

        $role->loadMissing('permissions:id,name');

        return view('cms.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('update', $role);

        $role->loadMissing('permissions:id,name');
        $permissions = $this->service->getPermissionList();
        $selectedPermissionIds = $this->service->getPermissionIds($role);

        return view('cms.roles.edit', compact('role', 'permissions', 'selectedPermissionIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        Gate::authorize('update', $role);

        $this->service->update($role, $request->validated());

        return to_route('cms.roles.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete', $role);

        $this->service->delete($role);

        return to_route('cms.roles.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_deleted')
        ]);
    }
}
