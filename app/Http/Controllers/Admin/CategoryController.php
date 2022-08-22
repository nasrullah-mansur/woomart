<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        return $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $category = $this->categoryService->getAllCategoryForDatatable();

            return datatables($category)->editColumn('image', function ($category) {
                $image = '<img src="' . $category->image . '" height="70" width="90" alt="No Image"/>';
                return $image;

            })->editColumn('icon', function ($category) {
                $icon = '<img src="' . $category->icon . '" height="70" width="90" alt="No Image"/>';
                return $icon;

            })->editColumn('status', function ($category) {

                $button = '' . $category->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                return $button;

            })->editColumn('top_category', function ($category) {

                $button = '' . $category->top_category ? '<label class="text-success">Yes</label>' : '<label class="text-danger">No</label>' . '';
                return $button;

            })->addColumn('parent', function ($category) {
                $parent = $category->parent_id != 0 ? $category->parent->name : '';
                return $parent;

            })->addColumn('action', function ($category) {

                $button = $category->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.categoryChangeStatus', [encrypt($category->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.categoryChangeStatus', [encrypt($category->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.category.edit', [$category->slug]) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.category.delete', [encrypt($category->id)]) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['icon', 'image', 'icon', 'status', 'action', 'parent', 'top_category'])
                ->make(true);
        }

        return view('admin.category.index', ['menu' => 'Products', 'page_title' => 'Category']);
    }

    /*
     * * New category create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {
            app(CategoryCreateRequest::class);

            $category = $this->categoryService->store($request);

            if ($category['success'] == true) {

                toast($category['message'], 'success');
                return redirect()->route('admin.category');
            }

            toast($category['message'], 'warning');
            return redirect()->back();
        }

        $categories = Category::where(['parent_id' => PARENT, 'active_status' => STATUS_ACTIVE])->get();
        return view('admin.category.create', ['categories' => $categories, 'menu' => 'Products', 'page_title' => 'Category', 'task' => 'create']);
    }

    // ************************** End crate/store  ******************

    /*
     * * Find category by editID,  pass category to edit page and update
     */

    public function editUpdate(Request $request, $slug = null)
    {
        if ($request->isMethod('POST')) {

            app(CategoryCreateRequest::class);

            $category = $this->categoryService->update($request);

            if ($category['success'] == true) {

                toast($category['message'], 'success');
                return redirect()->route('admin.category');
            }

            toast($category['message'], 'warning');
            return redirect()->back();

        } else {

            $category = Category::where('slug', $slug)->first();

            if ($category) {

                $categories = Category::where('parent_id', PARENT)->get();
                return view('admin.category.edit', ['category' => $category, 'categories' => $categories, 'menu' => 'Products', 'page_title' => 'Category']);

            } else {

                toast("Category doesn't exists", 'warning');
                return redirect()->back();
            }
        }
    }

    //************************End Edit/Update category ******************

    /*
     * * Find category by ID DELETE it
     */

    public function delete($id)
    {
        $category = app(CategoryService::class)->delete($id); //call delete function

        if ($category['success'] == true) {

            toast($category['message'], 'success');
            return redirect()->route('admin.category');
        }

        toast($category['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete category ******************

    /*
     * * Find category by ID and change active status,
     * * * if status is active; all products belongs to this category shows on home page
     * * * * Otherwise it not show
     */

    public function changeStatus($id, $status)
    {
        $category = Category::where('id', decrypt($id))->first();

        if ($category) {
            // active = 1, inActive  = 0;

            $category->update(['active_status' => decrypt($status)]);
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            toast('Category successfully ' . $message, 'success');
            return redirect()->route('admin.category');
        }

        toast("Category doesn't exists", 'warning');
        return redirect()->route('admin.category');

    }

    //************************End status active/inActive ******************
}
