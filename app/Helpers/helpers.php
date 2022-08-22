<?php


use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralSettings;
use App\Models\Category;
use App\Models\Size;
use App\Models\Error404;
use App\Models\Shop;
use App\Models\ContactUsSetting;
use Darryldecode\Cart\Cart;

//use http\Client\Curl\User;
use Intervention\Image\Facades\Image;

//********************General settings*****************
function allSettings($a = null)
{
    if ($a == null) {
        $general_setting = GeneralSettings::get();
        if ($general_setting) {
            $output = [];
            foreach ($general_setting as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;

    } else {
        $general_setting = GeneralSettings::where(['slug' => $a])->first();
        if ($general_setting) {
            $output = $general_setting->value;
            return $output;
        }
        return false;
    }
}



function allCategory($take = null)
{
    return Category::where(['parent_id' => PARENT, 'active_status' => STATUS_ACTIVE])->with('child')->take($take)->get();
}


function allBrand()
{
    return Brand::where(['active_status' => STATUS_ACTIVE])->get();

}


function allSize()
{
    return Size::get();

}
function contactus()
{
    return ContactUsSetting::first();

}


function error404()
{
    return Error404::first();

}

function shopBanners()
{
    return Shop::where('active_status', STATUS_ACTIVE)->orderBy('id', 'desc')->get();

}


function getParent($category_id)
{
    $parent = Category::where('id', $category_id)->select('id', 'name', 'image', 'icon', 'slug')->with('child')->get();
    return $parent;
}


//*****************************file Upload*******************

function fileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }

    $file_name = time().'_'. $new_file->getClientOriginalName();
    $destinationPath = public_path($path);

    # old file delete

    $url = asset($path);
    $old_file_path = str_replace($url . '/', '', $old_file_name);

    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_path)) {

        unlink($path . $old_file_path);
    }

//    # resize image
//    if (filesize($new_file) / 1024 > 500) {
//        $imageResize = Image::make($new_file)
//            ->orientate()
//            ->fit(1024, 1024, function ($constraint) {
//                $constraint->upsize();
//            })->save($destinationPath . $file_name);
//
//    } else {

        #original image upload

//        $new_file->move($destinationPath, $file_name);

//    }

    $new_file->move($destinationPath, $file_name);


    return $file_name;
}


# remove Image

function removeImage($path, $old_file_name)
{
    $url = asset($path);
    $old_file_path = str_replace($url . '/', '', $old_file_name);

    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_path)) {

        unlink($path . $old_file_path);
    }

    return true;
}


//*************************************Image Path**************************

function path_product_image()
{
    return 'uploaded_file/images/product/';
}

function path_shop_banner_image()
{
    return 'uploaded_file/images/banner/';
}

function path_category_image()
{
    return 'uploaded_file/images/category/';
}

function path_banner_image()
{
    return 'uploaded_file/images/banner/';
}

function path_slider_image()
{
    return 'uploaded_file/images/banner/';
}


function path_user_image()
{
    return 'uploaded_file/images/profile/';
}


function path_general_settings_image()
{
    return 'uploaded_file/images/settings/';
}

function path_brand_image()
{
    return 'uploaded_file/images/brand/';
}

function path_blog_image()
{
    return 'uploaded_file/images/blog/';
}

function path_about_us_image()
{
    return 'uploaded_file/images/about/';
}

function path_talent_team_image()
{
    return 'uploaded_file/images/talent_team/';
}
function path_error404_image()
{
    return 'uploaded_file/images/404/';
}


function offerPrice($total, $offer)
{
    if ($offer) {
        $offer_price = (((100 - $offer) * $total) / 100);
        return $offer_price;
    }
    return 0;

}

function SellPrice($old_price, $discount)
{
    $discount_price = (100 - $discount);

    $present_price = ($discount_price * $old_price) / 100;

    return $present_price;
}

function percentage($regular_price, $discount)
{
    $percentage = ($discount / $regular_price);
    return round($percentage);
}

//***************** userRole ***********


function userRole($a = null)
{
    $user = [
        '1' => 'Super Admin',
        '2' => 'Admin',
        '3' => 'customer',
    ];

    if ($a == null) {
        return $user;
    }
    return $user[$a];
}

//***************** Order Status ***********

function orderStatus($a = null)
{

    $order_status = [

        ORDER_PENDING => 'Pending',
        ORDER_PROCESSING => 'Processing',
        ORDER_SHIPPED => 'Shipped',
        ORDER_DELIVERED => 'Delivered',
        ORDER_RETURN => 'Return',
        ORDER_CANCELLED => 'Cancelled',
        ORDER_DELIVERED_FAILED => 'Delivery Failed'
    ];

    if ($a == null) {
        return $order_status;
    }
    return $order_status[$a];
}


function vendorOrderStatus($a = null)
{

    $status = [

        PRODUCT_REQUESTED_FROM_SHOPSTICK => 'Requested From Shopstick',
        PRODUCT_ACCEPT_BY_SELLER => 'Accepted by Seller',
        PRODUCT_PACKAGING_BY_SELLER => 'Packaging complete',
        PRODUCT_SHIPPING_TO_SHOPSTICK => 'Shipped to Shopstick',
        PRODUCT_DELIVERED_TO_SHOPSTICK => 'Delivered to shopStick',
        PRODUCT_RETURN_FROM_SHOPSTIUCK => 'Accept return product',
        PRODUCT_ORDER_NOT_COMPLETE => 'Order not completed'

    ];


    if ($a == null) {
        return $status;
    }
    return $status[$a];
}

function adminOrderStatus($a = null)
{

    $status = [

        PRODUCT_REQUESTED_TO_SELLER => 'Product request to seller',
        PRODUCT_RECEIVED_FROM_SELLER => 'Product Received from Seller',
        PRODUCT_RECEIVED_FROM_SHOPSTICK => 'Product Received from ShopStick',
        PRODUCT_RETURN_TO_SELLER => 'Product return to Seller',

    ];

    if ($a == null) {
        return $status;
    }
    return $status[$a];
}


# VENDOR_PRODUCT_PAYMENT_STATUS

function vendorProductPaymentStatus($a = null)
{
    $status = [

        VENDOR_PRODUCT_PAYMENT_DELIVERY_DUE => 'Delivery due amount',
        VENDOR_PRODUCT_PAYMENT_UNDER_PROCESS => 'Payment under Process',
        VENDOR_PRODUCT_PAYMENT_PAYABLE => 'Payment under Process',
        VENDOR_PRODUCT_PAYMENT_PAID => 'Paid amount',
        VENDOR_PRODUCT_PAYMENT_RETURN => 'Product Return',

    ];

    if ($a == null) {
        return $status;
    }
    return $status[$a];
}


//***************** Payment Type ***********

function paymentType($a = null)
{

    $paymentType = [
        '1' => 'Bkash',
        '2' => 'Rocket',
        '3' => 'Cash On Delivery',
        '4' => 'Paypal',
    ];

    if ($a == null) {
        return $paymentType;
    }
    return $paymentType[$a];
}

//************ Payment Status***************

function paymentStatus($a = null)
{

    $payment = [
        '1' => 'Paid',
        '5' => 'Not Paid Yet',

    ];

    if ($a == null) {
        return $payment;
    }
    return $payment[$a];
}

//************ Payment Status***************

function deliveryType($a = null)
{

    $payment = [
        '1' => 'Free',
        '2' => 'local pickup',

    ];

    if ($a == null) {
        return $payment;
    }
    return $payment[$a];
}

#Random Number
function randomString($a = 10)
{
    $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $c = strlen($x) - 1;
    $z = '';
    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return $z;
}

# Random order number
function randomOrderNumber($a = 10)
{
    $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $c = strlen($x) - 1;
    $z = '';

    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return 'SS' . $z;
}

# random number
function randomNumber($a = 10)
{
    $x = '0123456789';
    $c = strlen($x) - 1;

    $z = rand(1, $c);       # first number never taken 0

    for ($i = 0; $i < $a - 1; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }

    return $z;
}

//function allsettings($keys = null)
//{
//    try {
//        if ($keys && is_array( $keys )) {
//            return Adminsetting::whereIn( 'slug', $keys )->pluck( 'value', 'slug' )->toArray();
//        } elseif ($keys && is_string( $keys )) {
//            $setting = Adminsetting::where( 'slug', $keys )->first();
//            return empty( $setting ) ? false : $setting->value;
//        }
//        return Adminsetting::pluck( 'value', 'slug' )->toArray();
//    } catch (Exception $e) {
//
//    }
//}


function rating($id)
{
    // $product = Product::where(['id' => $id])->first();
    // $comments = $product->product_review;

    $comments = Product_review::where('product_id', $id)->get();

    if (count($comments) > 0)

        $rating = ceil($comments->sum('rating') / count($comments));
    else {
        $rating = 0;
    }
    return $rating;
}

function couponDiscount($code = null)
{
    try {
        $discount = Coupon::where('code', $code)->get('discount');
        return $discount;

    } catch (\Exception $e) {
        return 0;
    }
}

//***********************City && Area *********************

function city($id = null)
{
    try {
        $city = District::where('id', $id)->first();
        return $city->name;

    } catch (\Exception $e) {
        return null;
    }
}


function area($id = null)
{
    try {
        $area = Upazila::where('id', $id)->first();
        return $area->name;

    } catch (\Exception $e) {
        return null;
    }
}

// *************************** inStock *****************

function inStock($qty, $sold)
{
    $inStock = ($qty - $sold);

    return $inStock;
}

//************************ Check if Exist in Wishlist *****

function isFavourite($productID, $userID)
{
    $items = Wishlist::where([['user_id', $userID], ['product_id', $productID]])->first();
    if (isset($items)) {
        return true;
    } else {
        return false;
    }
}

// ******************* hasChild of Category

function hasChildofCategory($category_id)
{
    $result = Sub_Category::where('category_id', $category_id)->first();
    if (isset($result)) {
        return true;
    } else {
        return false;
    }
}


#childre


function categoryTree($parent_id)
{
    $childs = Category::Where('parent_id', $parent_id)->get();

    if (!empty($childs) && count($childs) > 0) {

        foreach ($childs as $child) {
            $data[] = [
                'id' => $child->id,
                'name' => $child->name,
            ];

//           categoryTree($child->id);
        }

        return $data;
    }

}

# Get Num of Days between two date

function num_of_days($date_ago, $date)
{
    $date = strtotime($date); // or your date as well
    $date_ago = strtotime($date_ago);
    $datediff = $date - $date_ago;

    return round($datediff / (60 * 60 * 24)) > 0 ? round($datediff / (60 * 60 * 24)) : 0;
}


function status_field($status, $route, $id)
{

    $name_route_inactive = $route . '.inactive';
    $name_route_active = $route . '.active';
    return $status ? ' <a type="button" class="btn btn-sm btn-info" href="' . route($name_route_inactive, encrypt($id)) . '"><i class="fas fa-lock-open "></i></a>' : '<a type="button" class="btn btn-sm btn-danger" href="' . route($name_route_active, encrypt($id)) . '"><i class="fas fa-lock "></i></a>';
}

function action_field($route, $id, $view = null, $edit = null, $delete = null)
{

    $button = isset($edit) ? '<a class="btn btn-sm btn-info" href="' . route($route . '.edit', encrypt($id)) . '"><i class="fas fa-edit"></i></a>' : '';

    if (isset($view)) {
        $button .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-success" href="' . route(isset($view) ? $route . '.view' : '', encrypt($id)) . '"><i class="fas fa-eye"></i></a>';
    }

    $button .= '&nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger delete" href="' . route($route . '.delete', encrypt($id)) . '"><i class="fas fa-trash"></i></a>';

    return $button;
}


function allUnit($a = null)
{
    if ($a != null) {
        $unit = IngredientUnit::where('id', $a)->first();
        if (!$unit) {
            return '';
        }
        return strtolower($unit->name);
    }
    $units = IngredientUnit::all();
    $data = [];
    foreach ($units as $unit) {
        $data[] = [
            'id' => $units->id,
            'name' => $units->name,
        ];
    }

    return $data;
}

# Gender

function gender($a = null)
{
    $gender = [
        MALE => 'Male',
        FEMALE => 'Female',
        OTHER => 'Other',
    ];
    if ($a != null) {
        return $gender[$a];
    }
    return $gender;
}

#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SMS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function send_sms($contact_no, $message)
{
    $contact_no = parse_contact($contact_no);
    $url = "http://isms.zaman-it.com/smsapi";
    $data = [
        "api_key" => "C20006775fd232db3951e8.60204773",
        "type" => "text",
        "contacts" => '88' . $contact_no,
        "senderid" => 8809612440871,
        "msg" => $message,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function parse_contact($contact_no)
{
    $length = strlen($contact_no);
    $new = "";
    if ($length < 11) {
        return 0;
    } else if ($length > 11) {
        $reqLength = $length - 11;

        for ($i = $reqLength; $i < $length; $i++) {
            $new[$i - $reqLength] = $contact_no[$i];
        }

    } else {
        $new = $contact_no;
    }

    return $new;
}

# shopstick commission

function commission($product_id)
{

    $productsCategories = ProductCategory::where('product_id', $product_id)->orderBy('id', 'asc')->get();

    if (isset($productsCategories[0])) {

        foreach ($productsCategories as $productsCategory) {

            if ($productsCategory->category->commission > 0) {
                $commission = $productsCategory->category->commission;
                break;
            }

        }
    }

    return isset($commission) ? $commission : allSettings('commission');

}

function shopstickCommission($total_amount, $commission)
{
    return ($total_amount * $commission) / 100;
}


#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ wbd SMS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

# Get Attribute values

function getAttributeValues($attribute_id, $product_id)
{
    $attributeValue = AttributeValue::where('attribute_id', $attribute_id)->get();


    $productAttributeValue = ProductAttributeValue::where(['product_id' => $product_id, 'attribute' => $attribute_id])->select('attribute_value_id')->get();


    $selectedValue = [];
    $i = 0;
    foreach ($productAttributeValue as $key) {
        $selectedValue[$i] = $key->attribute_value_id;
        $i++;
    }

    $data['attribute_value'] = $attributeValue;
    $data['selectedValue'] = $selectedValue;

    return $data;
}

# Guard

function get_guard()
{
    if (Auth::guard('admin')->check()) {
        return "admin";
    } elseif (Auth::guard('vendor')->check()) {
        return "vendor";
    }
}


# STOCK

function productStock($product_id)
{

    $stocks = Stock::where('product_id', $product_id)->whereRaw('quantity - sold >  0')->get();

    return $stocks;
}

# cart
function myCatAmount()
{
    $total = \Cart::getTotal();
    return isset($total) ? number_format($total, 2) : 0.0 ;

}


function cartItems()
{
    return \Cart::getContent();
}


function getSubTotal($price, $quantity)
{
    $subTotal = (float)$price * (float)$quantity;

    return number_format($subTotal,2);
}
