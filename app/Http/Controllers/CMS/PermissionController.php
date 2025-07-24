<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\PermissionRequest;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct(private PermissionService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Permission::class);

        $permissions = $this->service->getList();

        return view('cms.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Permission::class);

        $parents = $this->service->getParentList();

        return view('cms.permissions.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        Gate::authorize('create', Permission::class);

        $this->service->create($request->validated());

        return to_route('cms.permissions.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        Gate::authorize('view', $permission);

        $permission->loadMissing([
            'children:id,name,parent_id',
            'parent:id,name,parent_id',
        ]);

        return view('cms.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('update', $permission);

        $permission->loadMissing([
            'children:id,parent_id',
            'parent:id,name,parent_id',
        ]);

        $parents = $this->service->getParentList();

        return view('cms.permissions.edit', compact('permission', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        Gate::authorize('update', $permission);

        $this->service->update($permission, $request->validated());

        return to_route('cms.permissions.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_saved')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('delete', $permission);

        $this->service->delete($permission);

        return to_route('cms.permissions.index')->with([
            'type' => 'success',
            'message' => __('app.messages.data_deleted'),
        ]);
    }
}
