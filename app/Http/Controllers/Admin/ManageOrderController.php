<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AccountInfo;
use App\Model\Order;
use App\Model\Order_detail;
use App\Model\Product;
use App\Model\ShopStickAccountSummery;
use App\Model\Stock;
use App\Model\UserDemandProducts;
use App\Model\VendorAccountSummery;
use App\Services\ManageOrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ManageOrderController extends Controller
{

    private $manageOrderService;

    public function __construct(Request $request, ManageOrderService $manageOrderService)
    {
        $this->manageOrderService = $manageOrderService;

        $this->route = $request->route()->getAction();
        $this->page_title = isset($this->route['page_title']) ? $this->route['page_title'] : null;
        $this->task = isset($this->route['task']) ? $this->route['task'] : null;
        $this->pageSettings = array('page_title' => $this->page_title, 'task' => $this->task);
    }


    public function index(Request $request, $key = null)
    {

        if ($request->ajax()) {


            $orders = $this->manageOrderService->orders($key);

            return datatables($orders)->editColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->format('d M Y  H:i');


            })->editColumn('shipping_id', function ($orders) {
                return $orders->shipping ? $orders->shipping->city . ', ' . $orders->shipping->area : '';


            })->editColumn('payment_id', function ($orders) {
                return $orders->payment_id ? '' : 'no payment';

            })->addColumn('payment_method', function ($orders) {
                return $orders->is_order_successful ? ($orders->is_cash_on_delivery ? '<level class = "btn btn-info">COD</level>' : '<level class = "btn btn-success">Online</level>') : '<level class = "btn btn-warning">Pending</level>';

            })->editColumn('order_status', function ($orders) {

                if ($orders->order_status == ORDER_PENDING) {
                    $status = '<level class ="btn btn-warning">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_PROCESSING) {
                    $status = '<level class ="btn btn-info">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_SHIPPED) {
                    $status = '<level class ="btn btn-secondary">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_DELIVERED) {
                    $status = '<level class ="btn btn-success">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_RETURN) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_DELIVERED_FAILED) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                } elseif ($orders->order_status == ORDER_CANCELLED) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                }

                return $status;

            })->editColumn('image', function ($orders) {
                $img = '';
                foreach ($orders->order_details as $item) {

                    $img .= '<img src="' . $item->image . '" alt="No Image" width="40" height="40"/>';
                }
                return  isset($img) ?  $img :  'img';

            })->addColumn('action', function ($orders) {

                $button = '<a type="button"  href="' . route('admin.order.invoice', encrypt($orders->id)) . '" class=" btn btn-success btn-sm"><i class="fas fa-file-invoice"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" href="' . route('admin.order.details', encrypt($orders->id)) . '" class="edit btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['created_at', 'shipping_id', 'payment_method', 'order_status', 'action', 'image'])
                ->make(true);
        }

        if ($key == null) {
            $page_title = 'All Orders';
        } else {
            $page_title = orderStatus(decrypt($key));
        }


        return view('admin.orders.index')->with(['menu' => 'Orders', 'page_title' => $page_title, 'key' => $key]);
    }

    #deleted orders list

    public function trash(Request $request)
    {
        if ($request->ajax()) {

            $orders = Order::onlyTrashed()->select('*');

            return datatables($orders)->editColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->format('d M Y  H:i');


            })->editColumn('shipping_id', function ($orders) {
                return $orders->shipping ? $orders->shipping->city . ', ' . $orders->shipping->area : '';


            })->editColumn('payment_id', function ($orders) {
                return $orders->payment_id ? '' : 'no payment';

            })->addColumn('payment_method', function ($orders) {
                return $orders->is_order_successful ? ($orders->is_cash_on_delivery ? '<level class = "btn btn-info">COD</level>' : '<level class = "btn btn-success">Online</level>') : '<level class = "btn btn-warning">Pending</level>';

            })->editColumn('order_status', function ($orders) {

                if ($orders->order_status == ORDER_PENDING) {
                    $status = '<level class ="btn btn-warning">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_PROCESSING) {
                    $status = '<level class ="btn btn-info">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_SHIPPED) {
                    $status = '<level class ="btn btn-secondary">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_DELIVERED) {
                    $status = '<level class ="btn btn-success">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_RETURN) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                } elseif ($orders->order_status == ORDER_DELIVERED_FAILED) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                } elseif ($orders->order_status == ORDER_CANCELLED) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                }

                return $status;

            })->editColumn('deleted_at', function ($orders) {
                return '<level class ="btn btn-danger">' . Carbon::parse($orders->deleted_at)->format('d M Y  H:i') . '</level>';


            })->addColumn('image', function ($orders) {
                $img = '';
                foreach ($orders->order_details as $item) {

                    $img .= '<img src="' . $item->image . '" alt="No Image" width="40" height="40"/>';
                }
                return  isset($img) ?  $img :  'img';

            })->addColumn('action', function ($orders) {

                $button = '<a type="button" href="' . route('admin.order.details', encrypt($orders->id)) . '" class="edit btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['created_at', 'shipping_id', 'payment_method', 'order_status', 'action', 'deleted_at', 'image'])
                ->make(true);
        }


        return view('admin.orders.trash')->with(['menu' => 'Orders', 'page_title' => 'Deleted Orders']);
    }

    #User Demand list


    public function userDemandProducts(Request $request)
    {
        if ($request->ajax()) {

            $orders = UserDemandProducts::select('*');

            return datatables($orders)->editColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->format('d M, Y');


            })->addColumn('user', function ($orders) {
                return $orders->user_id ? $orders->user->name . ',<br/> ' . $orders->user->phone_number : '';


            })->addColumn('vendor_id', function ($orders) {

                return $orders->product->vendor ? '<level class="btn btn-info">' . $orders->vendor->shop_name . '<small class="text-warning"> <br>' . $orders->vendor->phone . '</small></level>' : '';

            })->addColumn('product', function ($orders) {

                return isset($orders->product->brand_id) ? $orders->product->name . '<br/> ' . 'Brand: ' . $orders->product->brand->name : $orders->product->name;
            })->editColumn('deleted_at', function ($orders) {
                return '<level class ="btn btn-danger">' . Carbon::parse($orders->deleted_at)->format('d M Y  H:i') . '</level>';


            })->addColumn('action', function ($orders) {

                $button = '<a type="button" href="' . route('admin.order.details', encrypt($orders->id)) . '" class="edit btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['created_at', 'user', 'vendor_id', 'product', 'action'])
                ->make(true);
        }


        return view('admin.orders.demand_products')->with(['menu' => 'Products', 'page_title' => 'Request Product']);
    }
    // ************************** End get different order ******************

    /*
     * * Find Orders by ID and show it details
     */

    public function details($id)
    {
        $order = Order::where('id', decrypt($id))->with('order_details.vendor', 'order_details.product.vendor')->with('shipping', 'user')->withTrashed()->first();

        if ($order) {

            $items = $order->order_details;
            $notReceivedItem = Order_detail::where(['order_id' => $order->id, 'is_received' => false])->exists();

            return view('admin.orders.details', ['order' => $order, 'items' => $items, 'notReceivedItem' => $notReceivedItem, 'menu' => 'Orders', 'page_title' => 'All orders',]);

        }
        return redirect()->back()->with('error', 'Something went wrong !!');

    }

    /*
     * * Find Orders by ID and show it details
     */

    public function invoice($id)
    {

        $order = Order::where('id', decrypt($id))->with('order_details')->first();
        $items = $order->order_details;

        return view('admin.orders.invoice', ['order' => $order, 'items' => $items, 'menu' => 'Orders', 'page_title' => 'All orders',]);

    }

    //************************End show details order ******************

    /*
     * * Find Order by ID DELETE it
     */

    public function delete($id)
    {

        $order = Order::where('id', decrypt($id))->first();

        $delete = $order->delete();
        if ($delete) {
            return redirect()->route('admin.orders')->with('success', 'Order successfully deleted, thanks');
        }
        return redirect()->back()->with('error', 'Something went wrong !!');

    }

    public function forceDelete($id)
    {

        $order = Order::where('id', decrypt($id))->withTrashed()->first();

        $forceDelete = $order->forceDelete();

        if ($forceDelete) {
            return redirect()->route('admin.all.deleted.order')->with('success', 'Order permanently delete successful, thanks');
        }
        return redirect()->back()->with('error', 'Something went wrong !!');

    }

    public function restore($id)
    {
        $order = Order::where('id', decrypt($id))->withTrashed()->first();
        if ($order) {
            $restore = Order::where('id', decrypt($id))->restore();

            if ($restore) {
                return redirect()->route('admin.orders')->with('success', 'Order successfully restored, thanks');
            }
            return redirect()->back()->with('error', 'Something went wrong !!');
        }
        return redirect()->back()->with('error', 'Something went wrong !!');


    }


    //************************End delete order ******************

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Product delivery status and vendor account ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function productOrderStatusUpdate(Request $request)
    {

        $item = Order_detail::where('id', $request->o_details_id)->first();

        if ($item) {

            $itemData['admin_side_status'] = $request->admin_side_status;
            $success = $item->update($itemData);

            if ($success) {

                #   check existing product status #

                $existAccInfo = AccountInfo::where(['order_number' => $item->order->order_number, 'vendor_id' => $item->vendor_id, 'product_id' => $item->product_id])->exists();

                if ($existAccInfo) {
                    Alert::error('Oofs', 'Already ' . adminOrderStatus($request->admin_side_status) . ' and save account information');
                    return redirect()->back();
                }
                # stock update

                $product = Product::where('id', $item->product_id)->first();

                if ($product) {

                    $qty = $product->quantity - $item->quantity;
                    $sold = $product->sold_quantity + $item->quantity;

                    $product->update([
                        'quantity' => $qty,
                        'sold_quantity' => $sold,
                    ]);

                }

                #  account info

                $odData['order_number'] = $item->order->order_number;
                $odData['vendor_id'] = $item->vendor_id;
                $odData['product_id'] = $item->product_id;
                $odData['delivery_to_shopstick_date'] = $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? Carbon::now()->toDateString() : null;
                $odData['name'] = $item->name;
                $odData['brand'] = $item->brand;
                $odData['unit'] = $item->unit;
                $odData['image'] = $item->image;
                $odData['price'] = $item->product_price;
                $odData['size'] = $item->size;
                $odData['color'] = $item->color;
                $odData['quantity'] = $item->quantity;
                $odData['quantity'] = $item->quantity;
                $odData['total_amount'] = $item->total_amount;
                $odData['commission'] = $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? commission($item->product_id) : 0;
                $odData['shopstick_amount'] = $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? shopstickCommission($odData['total_amount'], $odData['commission']) : 0;
                $odData['seller_amount'] = $odData['total_amount'] - $odData['shopstick_amount'];
                $odData['payment_status'] = VENDOR_PRODUCT_PAYMENT_DELIVERY_DUE;
                $odData['packaging_cost'] = isset($request->packaging_cost) ? $request->packaging_cost : 0;

                #stock
                if ($request->stock_id){
                    $stock = Stock::where('id', $request->stock_id)->first();

                    if ($stock)
                    {
                        $odData['stock_id'] = $stock->id;
                        $odData['purchase_price'] = $stock->purchase_price;
                        $odData['total_purchase_price'] = $stock->purchase_price * $item->quantity;

                        $sold = $stock->sold + $odData['quantity'];
                        $stock->update(['sold' => $sold]);

                    }
                }

                #stock_end

                $odData['is_managed_by_shopstick'] = $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? false : true;
                $item->update([

                    'vendor_side_status' => $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? PRODUCT_DELIVERED_TO_SHOPSTICK : $item->vendor_side_status,
                    'is_received' => true,
                    'is_received_from_shopstick' => $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? false : true,

                ]);

                AccountInfo::create($odData);


                #  vendor account summery update  #

                if ($request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER) {

                    $vendorAccountSummery = VendorAccountSummery::where('vendor_id', $odData['vendor_id'])->first();

                    if (empty($vendorAccountSummery)) {

                        $accountData['vendor_id'] = $odData['vendor_id'];
                        $accountData['total_amount'] = $odData['total_amount'];
                        $accountData['shopstick_amount'] = $odData['shopstick_amount'];
                        $accountData['seller_amount'] = $odData['seller_amount'];
                        $accountData['delivery_due_amount'] = $odData['seller_amount'];
//                                $accountData['total_payable'] = $odData['seller_amount'];

                        VendorAccountSummery::create($accountData);

                    } else {

                        $accountData['total_amount'] = $vendorAccountSummery->total_amount + $odData['total_amount'];
                        $accountData['shopstick_amount'] = $vendorAccountSummery->shopstick_amount + $odData['shopstick_amount'];
                        $accountData['seller_amount'] = $vendorAccountSummery->seller_amount + $odData['seller_amount'];
                        $accountData['delivery_due_amount'] = $vendorAccountSummery->delivery_due_amount + $odData['seller_amount'];

                        $vendorAccountSummery->update($accountData);
                    }
                }

                $message = $request->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER ? 'Product Received from seller successfully' : 'Product managed by Shopstick successfully';
                return redirect()->back()->with('success', $message);

            }


            Alert::error('OOfs, Something went wrong');
            return redirect()->back();

        }

        return redirect()->back()->with('error', 'The product not exists in Order Details');


    }


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ order delivery status ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function orderStatusUpdate(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $orderStatus['order_status'] = $request->order_status;

        $success = $order->update($orderStatus);

        if ($success) {

            if ($request->order_status == ORDER_DELIVERED) {

                # shopstick summmery part 1

                if ($order->is_cash_on_delivery) {
                    $shopstickAccountSummery = ShopStickAccountSummery::first();

                    $shopData['total_received'] = $shopstickAccountSummery->total_received + $order->total_payable_amount;
                    $shopData['cod_received'] = $shopstickAccountSummery->cod_received + $order->total_payable_amount;
                    $shopData['order_amount'] = $shopstickAccountSummery->order_amount + $order->total_order_amount;
                    $shopData['coupon_discount'] = $shopstickAccountSummery->coupon_discount + $order->coupon_discount;
                    $shopData['delivery_charge'] = $shopstickAccountSummery->delivery_charge + $order->delivery_charge;
                    $shopData['cash_in_hand'] = $shopstickAccountSummery->cash_in_hand + $order->total_order_amount;

                    $shopstickAccountSummery->update($shopData);
                }

                $order_details = $order->order_details;

                foreach ($order_details as $item) {

                    $accountInfo = AccountInfo::where(['order_number' => $item->order->order_number, 'vendor_id' => $item->vendor_id, 'product_id' => $item->product_id])->first();

                    if ($accountInfo) {

                        $accountInfo->update([

                            'payment_status' => VENDOR_PRODUCT_PAYMENT_UNDER_PROCESS,
                            'delivery_to_customer_date' => Carbon::now()->toDateTimeString()
                        ]);

                        # shopstick account summery 2

                        $shopstickAccountSummery = ShopStickAccountSummery::first();

                        $shopAccData['commission_amount'] = $shopstickAccountSummery->commission_amount + $accountInfo->shopstick_amount;
                        $shopAccData['seller_amount'] = $accountInfo->is_managed_by_shopstick == false ? $shopstickAccountSummery->seller_amount + $accountInfo->seller_amount : $shopstickAccountSummery->seller_amount;
                        $shopAccData['payable_to_seller'] = $accountInfo->is_managed_by_shopstick == false ? $shopstickAccountSummery->payable_to_seller + $accountInfo->seller_amount : $shopstickAccountSummery->payable_to_seller;
                        $shopAccData['payable_to_shopstick'] = $accountInfo->is_managed_by_shopstick == true ? $shopstickAccountSummery->payable_to_shopstick + $accountInfo->seller_amount : $shopstickAccountSummery->payable_to_shopstick;

                        $shopstickAccountSummery->update($shopAccData);

                        # vendor account summery

                        if ($accountInfo->is_managed_by_shopstick == false) {

                            $vendorAccountSummery = VendorAccountSummery::where('vendor_id', $item->vendor_id)->first();

                            $accountData['delivery_due_amount'] = $accountInfo->is_managed_by_shopstick == false ? $vendorAccountSummery->delivery_due_amount - $accountInfo->seller_amount : $vendorAccountSummery->delivery_due_amount;
                            $accountData['under_processing_amount'] = $accountInfo->is_managed_by_shopstick == false ? $vendorAccountSummery->under_processing_amount + $accountInfo->seller_amount : $vendorAccountSummery->under_processing_amount;

                            $vendorAccountSummery->update($accountData);
                        }

                    }


                }

            }
            return redirect()->back()->with('success', 'Order Successfully ' . orderStatus($orderStatus['order_status']));

        }
    }


    public function deliveryFailed(Request $request)
    {

        $order = Order::where('id', $request->order_id)->first();
        $orderStatus['order_status'] = $request->order_status;

        $success = $order->update($orderStatus);

        if ($success) {

            # shopstick summmery part 1

            $shopstickAccountSummery = ShopStickAccountSummery::first();

            $shopData['delivery_charge'] = $shopstickAccountSummery->delivery_charge + 50;
            $shopData['cash_in_hand'] = $shopstickAccountSummery->cash_in_hand - 50;

            $shopstickAccountSummery->update($shopData);


            $order_details = $order->order_details;

            foreach ($order_details as $item) {

                $accountInfo = AccountInfo::where(['order_number' => $item->order->order_number, 'vendor_id' => $item->vendor_id, 'product_id' => $item->product_id])->first();

                if ($accountInfo) {

                    $accountInfo->update([

                        'payment_status' => VENDOR_PRODUCT_PAYMENT_DELIVERY_FAILED
                    ]);

                    # shopstick account summery 2

//                        $shopstickAccountSummery = ShopStickAccountSummery::first();
//
//                        $shopAccData['commission_amount'] = $shopstickAccountSummery->commission_amount + $accountInfo->shopstick_amount;
//                        $shopAccData['seller_amount'] = $accountInfo->is_managed_by_shopstick == false ? $shopstickAccountSummery->seller_amount + $accountInfo->seller_amount : $shopstickAccountSummery->seller_amount;
//                        $shopAccData['payable_to_seller'] = $accountInfo->is_managed_by_shopstick == false ? $shopstickAccountSummery->payable_to_seller + $accountInfo->seller_amount : $shopstickAccountSummery->payable_to_seller;
//                        $shopAccData['payable_to_shopstick'] = $accountInfo->is_managed_by_shopstick == true ? $shopstickAccountSummery->payable_to_shopstick + $accountInfo->seller_amount : $shopstickAccountSummery->payable_to_shopstick;
//
//                        $shopstickAccountSummery->update($shopAccData);

                    # vendor account summery

                    if ($accountInfo->is_managed_by_shopstick == false) {

                        $vendorAccountSummery = VendorAccountSummery::where('vendor_id', $item->vendor_id)->first();

                        $accountData['delivery_due_amount'] = $vendorAccountSummery->delivery_due_amount - $accountInfo->seller_amount;
                        $accountData['total_amount'] = $vendorAccountSummery->total_amount - $accountInfo->total_amount;
                        $accountData['seller_amount'] = $vendorAccountSummery->shopstick_amount - $accountInfo->shopstick_amount;
                        $accountData['shopstick_amount'] = $vendorAccountSummery->shopstick_amount - $accountInfo->shopstick_amount;

                        $vendorAccountSummery->update($accountData);
                    }

                }


            }

            return redirect()->back()->with('success', 'Order successfully Delivery failed');

        }
    }

    //************************End Change order ******************

    public function allOrderProducts(Request $request)
    {
        if ($request->ajax()) {

            $products = Order_detail::where('is_order_successful', true)->whereHas('order')->select('*');

            return datatables($products)->addColumn('order_date', function ($products) {

                return date('d M, Y', strtotime($products->order->created_at));

            })->addColumn('vendor_id', function ($products) {

                return $products->vendor ? '<level class="btn btn-info">' . $products->vendor->shop_name . '<small class="text-warning"> <br>' . $products->vendor->phone . '</small></level>' : '';

            })->addColumn('order_number', function ($products) {

                return $products->order ? $products->order->order_number : '';

            })->addColumn('image', function ($products) {

                return '<img src="' . $products->image . '" alt="No Image" width="40" height="40"/>';


            })->addColumn('delivery_status', function ($products) {

                if ($products->order->order_status == ORDER_PROCESSING) {
                    $status = '<level class=" btn btn-info">Processing</level>';
                } else if ($products->order->order_status == ORDER_SHIPPED) {
                    $status = '<level class=" btn btn-warning">Shipping</level>';
                } else if ($products->order->order_status == ORDER_DELIVERED) {
                    $status = '<level class=" btn btn-success">Delivered</level>';
                } else if ($products->order->order_status == ORDER_PENDING) {
                    $status = '<level class=" btn btn-warning">Pending</level>';
                } else if ($products->order->order_status == ORDER_RETURN) {
                    $status = '<level class=" btn btn-danger">Return</level>';
                } else if ($products->order->order_status == ORDER_DELIVERED_FAILED) {
                    $status = '<level class=" btn btn-danger">Delivery Failed</level>';
                } elseif ($products->order->order_status == ORDER_CANCELLED) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($products->order->order_status) . '</level>';
                }
                return $status;


            })->addColumn('is_received', function ($products) {

                if ($products->is_received_from_shopstick) {
                    $status = '<level class=" btn btn-info">Received from shopstick</level>';

                } else {
                    if ($products->vendor_side_status == PRODUCT_REQUESTED_FROM_SHOPSTICK) {
                        $status = '<level class=" btn btn-warning">Requested to seller</level>';

                    } else if ($products->vendor_side_status == PRODUCT_ACCEPT_BY_SELLER) {
                        $status = '<level class=" btn btn-warning">Accepted By Seller</level>';

                    } else if ($products->vendor_side_status == PRODUCT_PACKAGING_BY_SELLER) {
                        $status = '<level class=" btn btn-warning">Package Completed</level>';

                    } else if ($products->vendor_side_status == PRODUCT_SHIPPING_TO_SHOPSTICK) {
                        $status = '<level class=" btn btn-warning">Shipped by seller</level>';

                    } else if ($products->vendor_side_status == PRODUCT_DELIVERED_TO_SHOPSTICK) {
                        $status = '<level class=" btn btn-success">Received from seller</level>';

                    } else {
                        $status = '';
                    }
                }

                return $status;

            })->addColumn('action', function ($products) {

                $button = '<a type="button" href="' . route('admin.order.details', encrypt($products->order->id)) . '" class="edit btn btn-primary btn-sm"><i class="far fa-eye"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['order_date', 'delivery_status', 'vendor_id', 'order_number', 'image', 'action', 'is_received'])
                ->make(true);
        }

        return view('admin.orders.order_products')->with(['menu' => 'Orders', 'page_title' => 'All order Products']);

    }

}
