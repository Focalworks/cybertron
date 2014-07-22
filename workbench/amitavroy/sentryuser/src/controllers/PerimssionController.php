<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/19/14
 * Time: 4:09 PM
 */

class PermissionController extends BaseController
{
    protected $layout = 'sentryuser::master';

    public function handlePermissionListing()
    {
        $query = DB::table('permission_in_group');
        $query->join('permissions', 'permissions.permission_id', '=', 'permission_in_group.permission_id');
        $query->join('groups', 'groups.id', '=', 'permission_in_group.group_id');
        $query->orderBy('permissions.permission_group_name', 'asc');
        $query->orderBy('permissions.permission_name', 'asc');
        $data = $query->get();

        $permissions = array();
        foreach ($data as $row)
        {
            $permissions[$row->permission_name][] = $row;
        }
//        GlobalHelper::dsm($permissions);

        $groups_temp = DB::table('groups')->get();
        $groups = array();
        foreach ($groups_temp as $row)
        {
            $groups[$row->id] = $row;
        }

        $this->layout->content = View::make('sentryuser::permissions.permission-list')
            ->with('groups', $groups)
            ->with('permissions', $permissions);
    }

    public function handlePermissionSave()
    {
        dd(Input::all());
    }
}