<?php

namespace App\Policies;

use App\Admin;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(Admin $admin, Category $category)
    {
        return $admin->id === $category->admin_id;
    }

    public function update(Admin $admin, Category $category)
    {
        return $admin->id === $category->admin_id;
    }

    public function delete(Admin $admin, Category $category)
    {
        return $admin->id === $category->admin_id;
    }
}
