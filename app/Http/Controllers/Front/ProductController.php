<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function singleProduct($lang, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {

            if ($product->sub_category_id != 'null')
            {
                $related_products = Product::where('sub_category_id',$product->sub_categeory_id )->take(4)->get();
                if (empty($related_products))
                {
                    $related_products = Product::where('category_id',$product->categeory_id )->take(4)->get();
                }

            } else {
                $related_products = Product::where('category_id',$product->category_id)->take(4)->get();
            }

            $related_all_products = isset($related_products)  ? $related_products : null ;

            return view('front.product.single_product', ['page_tile' => $product->name, 'product' => $product, 'related_products' => $related_all_products]);
        }
        $id['id'] = 1;
        return view('front.404', ['id'=>$id, 'message' => "Product doesn't exists"]);
    }


    public function searchProduct(Request $request)
    {
        if ($request->category_id == null) {

            $products = Product::where('name', 'LIKE', "%{$request->search_text}%")
                ->orWhere('description', 'LIKE', "%{$request->search_text}%")
                ->orWhere('about_product', 'LIKE', "%{$request->search_text}%")->paginate(6);

        } else {
            $category = Category::where('id', $request->category_id)->first();

            $products = Product::where('category_id', $request->category_id)
                ->where('name', 'LIKE', "%{$request->search_text}%")
                ->orWhere('description', 'LIKE', "%{$request->search_text}%")
                ->orWhere('about_product', 'LIKE', "%{$request->search_text}%")->paginate(6);
        }

        $category_name = isset($category) ? $category : null;
        $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();

        if (isset($products[0])) {

            $id['id'] = 1;
            return view('front.pages.shop', ['id'=> $id, 'best_selling_products'=>$best_selling_products, 'products' => $products, 'category_name' => $category_name, 'section' => 'best_match']);
        }

        $id['id'] = 1;
        return view('front.404', ['id'=>$id, 'message' => "Product doesn't found"]);
    }



    /*
     *  * Category Product
    */
    public function categoryProduct($lang, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {

            $products = Product::where('category_id', $category->id)->paginate(6);
            $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();

            $category_name = $category;

            if (isset($products[0])) {

                $id['id'] = 1;
                return view('front.pages.shop', ['id'=>$id, 'page_tile' =>$category->name, 'products' => $products, 'category_name' => $category_name, 'section' => 'best_match','best_selling_products'=>$best_selling_products]);
            }

            $id['id'] = 1;
            return view('front.404', ['id'=>$id,  'message' => "There are no products in " . $category->name . ' category']);
        }
        $id['id'] = 1;
        return view('front.404', ['id'=>$id,  'message' => "Category doesn't exists"]);

    }


    /*
     *  * Category Product
    */
    public function brandProduct($lang, $slug)
    {
        $brand = Brand::where('slug', $slug)->first();

        if ($brand) {

            $products = Product::where('brand', $brand->name)->paginate(6);
            $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();


            if (isset($products[0])) {

                $id['id'] = 1;
                return view('front.pages.shop', ['id'=>$id, 'page_tile' =>$brand->name, 'products' => $products, 'section' => 'best_match','best_selling_products'=>$best_selling_products]);
            }

            $id['id'] = 1;
            return view('front.404', ['id'=>$id, 'message' => "There are no products in " . $brand->name . ' brand']);
        }

        $id['id'] = 1;
        return view('front.404', ['id'=>$id, 'message' => "Brand doesn't exists"]);

    }



    /*
     *  * Sub Category Product
    */
    public function subCategoryProduct($lang, $slug)
    {
        $sub_category = Category::where('slug', $slug)->first();

        if ($sub_category) {

            $products = Product::where('sub_category_id', $sub_category->id)->paginate(6);
            $best_selling_products = Product::where(['active_status' => STATUS_ACTIVE , 'second_section' => true])->take(4)->get();

            $category_name = $sub_category;

            if (isset($products[0])) {

                $id['id'] = 1;
                return view('front.pages.shop', ['id'=>$id,'page_tile' =>$category_name->name,'products' => $products, 'category_name' => $category_name, 'section' => 'best_match','best_selling_products'=>$best_selling_products]);
            }

            $id['id'] = 1;
            return view('front.404', ['id'=>$id, 'message' => "There are no products in " . $sub_category->name . ' sub category']);
        }

        $id['id'] = 1;
        return view('front.404', ['id'=>$id, 'message' => "Sub category doesn't exists"]);

    }
}
