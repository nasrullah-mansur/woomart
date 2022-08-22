<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Services\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /*
     * * Get All Products
     */

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $products = Product::select('*');
            return datatables($products)
                ->editColumn('primary_image', function ($products) {

                    return '<img src="' . $products->primary_image . '" alt="No Image" width="40" height="40"/>';

                })->editColumn('category_id', function ($products) {

                    return isset($products->category) ? $products->category->name : '';

                })->editColumn('price', function ($products) {

                    return $products->discount_price > 0 ? '<p>' . $products->discount_price . '&#2547; <sub><del>' . $products->price . '&#2547;</del></sub></p>' : '<p>' . $products->price . '&#2547;</p>';

                })->editColumn('active_status', function ($products) {

                    $button = '' . $products->active_status ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                    return $button;

                })->addColumn('action', function ($products) {

                    $button = $products->active_status ? '<a type="button"  href="' . route('admin.product.status', [$products->slug, encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.product.status', [$products->slug, encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.product.edit', $products->slug) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.product.delete', $products->slug) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['primary_image', 'active_status', 'action', 'price'])
                ->make(true);
        }

        return view('admin.product.index', ['menu' => 'Products', 'page_title' => 'Product']);

    }

    /*
       * * *    Product create/store
    */

    public function createStore(Request $request)
    {
        if ($request->isMethod('post')) {


            app(ProductCreateRequest::class);

            $product = $this->productService->store($request);

            if ($product['success'] == true) {

                toast($product['message'], 'success');
                return redirect()->route('admin.product');
            }

            toast($product['message'], 'warning');
            return redirect()->back();
        }

        //    #get function

        $colors = Color::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('id', 'asc')->get();
        $brands = Brand::where(['active_status' => STATUS_ACTIVE])->orderBy('name', 'asc')->get();
        $categories = Category::where(['active_status' => STATUS_ACTIVE, 'parent_id' => PARENT])->orderBy('name', 'asc')->get();

        return view('admin.product.create', ['categories' => $categories, 'brands' => $brands, 'colors' => $colors, 'sizes' => $sizes, 'menu' => 'Products', 'page_title' => 'Product']);
    }

    // ************************** End create/store ******************


    /*
      * * *    Product edit/update
    */

    public function editUpdate(Request $request, $slug = null)
    {
        if ($request->isMethod('post')) {

            app(ProductCreateRequest::class);

            $product = $this->productService->update($request);

            if ($product['success'] == true) {

                toast($product['message'], 'success');
                return redirect()->route('admin.product');
            }

            toast($product['message'], 'warning');
            return redirect()->route('admin.product');

        } else {

            $product = Product::where('slug', $slug)->first();

            if ($product) {

                $colors = Color::doesnthave('productColor')->orderBy('name', 'asc')->get();
                $sizes = Size::doesnthave('productSize')->orderBy('id', 'asc')->get();
                $brands = Brand::where(['active_status' => STATUS_ACTIVE])->orderBy('name', 'asc')->get();
                $categories = Category::where(['active_status' => STATUS_ACTIVE, 'parent_id' => PARENT])->orderBy('name', 'asc')->get();

                return view('admin.product.edit', ['categories' => $categories, 'product' => $product, 'brands' => $brands, 'colors' => $colors, 'sizes' => $sizes, 'menu' => 'Products', 'page_title' => 'Product', 'task' => 'Create']);

            } else {

                toast("Product doesn't exists");
                return redirect()->back();

            }

        }

    }

    // **************************  end edit/update ******************


    /*
      * * *    product active status change, active ot in active
    */


    public function changeStatus($slug, $status)
    {
        $product = Product::where('slug', $slug)->first();

        if ($product) {

            $success = $product->update(['active_status' => decrypt($status)]);    // active = 1, inActive  = 0;
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {

                toast('Product successfully ' . $message, 'success');
                return redirect()->route('admin.product');

            } else {

                toast('Something went wrong','warning');
                return redirect()->back();
            }

        }

        toast("Product doesn't exists", 'warning');
        return redirect()->back();

    }


    //********************** end product active status change, active ot in active ********************



    /*
      * * *    product delete
    */


    public function delete($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if ($product) {

          $success = $product->delete();

            if ($success) {

                toast('Product successfully deleted','success');
                return redirect()->route('admin.product');

            } else {

                toast('Something went wrong','warning');
                return redirect()->back();
            }

        }

        toast("Product doesn't exists", 'warning');
        return redirect()->back();

    }


    //********************** end product active status change, active ot in active ********************



    public function sub_category(Request $request)
    {
        $category_id = $request->category_id;

        $subcategories = Category::where(['parent_id' => $category_id])->get();

        return response()->json($subcategories);

    }

    //********************** End Get subCategory  by CategoryID ********************


}
