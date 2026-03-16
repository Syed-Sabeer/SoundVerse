<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\SellerPackage;
use Auth;
use Session;
Use App\Models\User;
Use App\Models\Seller;
Use App\Models\PackagePurchaseHistory;
use Carbon\Carbon;
use Stripe;
use Stripe\Charge;
use App\Helpers\Helper;

class SellerPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller_packages = SellerPackage::all();
        return view('seller_packages.index',compact('seller_packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller_packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      	if(!isset($request->logo) || (isset($request->logo) && empty($request->logo))){
           flash('Please upload package logo')->error();
           return back();
        }
           
        $seller_package = new SellerPackage;
        $seller_package->name = $request->name;
        $seller_package->amount = $request->amount;
        $seller_package->product_upload = $request->product_upload ?? 0;
        $seller_package->digital_product_upload = $request->digital_product_upload ?? 0;
        $seller_package->flash_deal_product_limit = $request->flash_deal_product_upload ?? 0;
        $seller_package->daily_deal_product_limit = $request->daily_deal_product_upload ?? 0;
        $seller_package->duration = $request->duration;
        $seller_package->duration_type = $request->duration_type;
        $seller_package->description = $request->description;
        $seller_package->logo = $request->logo;

        if($seller_package->save()){
            flash(__('Package has been inserted successfully'))->success();
            return redirect()->route('seller_packages.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller_package = SellerPackage::findOrFail(decrypt($id));
        return view('seller_packages.edit', compact('seller_package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller_package = SellerPackage::findOrFail($id);
        $seller_package->name = $request->name;
        $seller_package->amount = $request->amount;
        $seller_package->product_upload = $request->product_upload ?? 0;
        $seller_package->digital_product_upload = $request->digital_product_upload ?? 0;
        $seller_package->flash_deal_product_limit = $request->flash_deal_product_upload ?? 0;
        $seller_package->daily_deal_product_limit = $request->daily_deal_product_upload ?? 0;
        $seller_package->duration = $request->duration;
        $seller_package->duration_type = $request->duration_type;
      	$seller_package->description = $request->description;
        $seller_package->logo = $request->logo;
        

        if($seller_package->save()){
            flash(__('Package has been inserted successfully'))->success();
            return redirect()->route('seller_packages.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(SellerPackage::destroy($id)){
            flash(__('Package has been deleted successfully'))->success();
            return redirect()->route('seller_packages.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }


    //FrontEnd
    //@index
    public function seller_packages_list()
    {
        $seller_packages = SellerPackage::all();
        return view('seller_packages.frontend.seller_packages_list',compact('seller_packages'));
    }

   
public function seller_packages_list_api()
{
    try {
        $seller_packages = SellerPackage::all();
        return response()->json([
            'status' => true,
            'message' => 'Seller packages fetched successfully',
            'data' => $seller_packages
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to fetch seller packages',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function purchase_package(Request $request)
    {
        $data['seller_package_id'] = $request->seller_package_id;
        $data['payment_method'] = $request->payment_option;

        $request->session()->put('payment_type', 'seller_package_payment');
        $request->session()->put('payment_data', $data);

        $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);

        if($seller_package->amount == 0){
            if(Auth::user()->shop->seller_package_id != $seller_package->id){
                return $this->purchase_payment_done(Session::get('payment_data'), null);
            }
            else {
                flash(__('You can not purchase this package anymore.'))->warning();
                return back();
            }
        }

        if($request->payment_option == 'paypal'){
            $paypal = new PaypalController;
            return $paypal->getCheckout();
        }
        elseif ($request->payment_option == 'stripe') {
            $stripe = new StripePaymentController;
            return $stripe->stripe();
        }
        elseif ($request->payment_option == 'sslcommerz_payment') {
            $sslcommerz = new PublicSslCommerzPaymentController;
            return $sslcommerz->index($request);
        }
        elseif ($request->payment_option == 'instamojo') {
            $instamojo = new InstamojoController;
            return $instamojo->pay($request);
        }
        elseif ($request->payment_option == 'razorpay') {
            $razorpay = new RazorpayController;
            return $razorpay->payWithRazorpay($request);
        }
        elseif ($request->payment_option == 'paystack') {
            $paystack = new PaystackController;
            return $paystack->redirectToGateway($request);
        }
    }


    public function packages_payment_list(Request $request)
    {
        $purchase_history = PackagePurchaseHistory::where('seller_id', Auth::user()->id)->orderby('id', 'DESC')->paginate(15);
        return view('seller_packages.frontend.package_purchase_list',compact('purchase_history'));
    }

   
public function packages_payment_list_api(Request $request)
{
    try {
        Log::info('packages_payment_list_api called');

        $userId = Auth::id(); 
        Log::info('Authenticated user ID: ' . ($userId ?? 'null'));

        if (!$userId) {
            Log::warning('Unauthenticated access attempt to packages_payment_list_api');
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $purchaseHistory = PackagePurchaseHistory::where('seller_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate(15);

        Log::info('Package purchase history fetched', [
            'user_id' => $userId,
            'count' => $purchaseHistory->count()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Package purchase history fetched successfully.',
            'data' => $purchaseHistory
        ], 200);

    } catch (\Exception $e) {
        Log::error('Error fetching package purchase history', [
            'user_id' => $userId ?? null,
            'error_message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Error fetching package purchase history.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    
    public function seller_purchase_package_by_wallet(Request $request, $id){
        
        $seller_package = SellerPackage::findOrFail($id);
        
        if(Auth::user()->balance < $seller_package->amount){
            flash(translate('You have not Sufficient Balance in Your Wallet'))->error();
            return back();
        }
        
        $user = Auth::user();
        $user->balance -= $seller_package->amount;
        $user->save();
        
        $shop = Auth::user()->shop;
        $shop->seller_package_id = $id;
        $shop->product_upload_limit += $seller_package->product_upload;
        $shop->flash_deal_product_limit += $seller_package->flash_deal_product_limit;
        $shop->package_invalid_at = date('Y-m-d', strtotime('+ '.$seller_package->duration.$seller_package->duration_type));
        $shop->verification_status = 1;

        if($shop->save()){
            $purchase_history = new PackagePurchaseHistory();
            $purchase_history->seller_id = Auth::user()->id;
            $purchase_history->seller_package_id = $id;
            $purchase_history->package = $seller_package->name;
            $purchase_history->price = $seller_package->amount;
            $purchase_history->payment_type = 'Wallet';
            $purchase_history->save();

            flash(__('Package purchasing successful'))->success();
            return redirect()->route('seller.packages_payment_list');
        }

        flash(translate('Something Went Wrong'))->error();
        return back();
    }
        
    public function seller_purchase_package_by_stripe(Request $request){
        // dd($request->all());
        $seller_package = SellerPackage::findOrFail($request->seller_package_id);

        if($seller_package->amount == 0){
            if(Auth::user()->seller->seller_package_id == $seller_package->id){
                flash(__('You can not purchase this package anymore.'))->warning();
                return back();
            }
        }
        
        $transaction_fee = Helper::stripeFeeCalculator($seller_package->amount);
        $amount = $seller_package->amount + $transaction_fee;
        
        // dd(round($amount));
        try{
            try{
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                $check = Stripe\Charge::create([
                    "amount" => round(floatval($amount) * 100),
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Seller Package Purchase"
                ]);
                
            }catch(Exception $e){
                flash(translate($e->getMessage()))->error();
                return back();
            }catch(\Stripe\Exception\CardException $e){
                flash(translate($e->getMessage()))->error();
                return back();
            }catch(\Stripe\Exception\InvalidRequestException $e){
                flash(translate($e->getMessage()))->error();
                return back();
            }
            
            if(isset($check['status']) && $check['status'] == 'succeeded'){
                // dd($check);
                $seller_package = SellerPackage::findOrFail($request->seller_package_id);

                $shop = Auth::user()->shop;
                $shop->seller_package_id = $request->seller_package_id;
                $shop->product_upload_limit += $seller_package->product_upload;
                $shop->flash_deal_product_limit += $seller_package->flash_deal_product_limit;
                $shop->package_invalid_at = date('Y-m-d', strtotime('+ '.$seller_package->duration.$seller_package->duration_type));
                $shop->verification_status = 1;

                if($shop->save()){
                    $purchase_history = new PackagePurchaseHistory();
                    $purchase_history->seller_id = Auth::user()->id;
                    $purchase_history->seller_package_id = $request->seller_package_id;
                    $purchase_history->package = $seller_package->name;
                    $purchase_history->price = $seller_package->amount;
                    $purchase_history->payment_type = 'Stripe';
                    $purchase_history->save();

                    flash(__('Package purchasing successful'))->success();
                    return redirect()->route('seller.packages_payment_list');
                }

                flash(translate('Something Went Wrong'))->error();
                return back();
            }

        }catch(Exception $e){
            flash(translate('Something Went Wrong'))->error();
            return back();
        }

    }

public function seller_purchase_package_by_stripe_api(Request $request)
{
    $request->validate([
        'seller_package_id' => 'required|exists:seller_packages,id',
        'stripeToken' => 'required|string',
    ]);

    try {
        $user = Auth::user();
        $seller_package = SellerPackage::findOrFail($request->seller_package_id);

   
        if ($seller_package->amount == 0 && $user->seller->seller_package_id == $seller_package->id) {
            return response()->json([
                'status' => false,
                'message' => 'You cannot purchase this package again.'
            ], 403);
        }

        $transaction_fee = Helper::stripeFeeCalculator($seller_package->amount); 
        $amount = $seller_package->amount + $transaction_fee;

   
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create([
            "amount" => round(floatval($amount) * 100),
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Seller Package Purchase"
        ]);

        if (isset($charge['status']) && $charge['status'] == 'succeeded') {

            $shop = $user->shop;
            $shop->seller_package_id = $seller_package->id;
            $shop->product_upload_limit += $seller_package->product_upload;
            $shop->flash_deal_product_limit += $seller_package->flash_deal_product_limit;
            $shop->package_invalid_at = now()->add($seller_package->duration, $seller_package->duration_type);
            $shop->verification_status = 1;
            $shop->save();

        
            PackagePurchaseHistory::create([
                'seller_id' => $user->id,
                'seller_package_id' => $seller_package->id,
                'package' => $seller_package->name,
                'price' => $seller_package->amount,
                'payment_type' => 'Stripe',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Package purchased successfully.',
                'data' => [
                    'package' => $seller_package->name,
                    'amount' => $seller_package->amount,
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Stripe charge failed.'
            ], 400);
        }

    } catch (\Stripe\Exception\CardException $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
    } catch (Exception $e) {
        return response()->json(['status' => false, 'message' => 'Something went wrong. ' . $e->getMessage()], 500);
    }
}

    public function purchase_payment_done($payment_data, $payment){
        $seller = Auth::user()->shop;
        $seller->seller_package_id = Session::get('payment_data')['seller_package_id'];
        $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
        //$seller->remaining_uploads += $seller_package->product_upload;
        //$seller->remaining_digital_uploads += $seller_package->digital_product_upload;
        $seller->package_invalid_at = date('Y-m-d', strtotime('+ '.$seller_package->duration.$seller_package->duration_type));
        $seller->save();

        flash(__('Package purchasing successful'))->success();
        return redirect()->route('seller.dashboard');
    }

    public function unpublish_products(Request $request){
        foreach (Seller::all() as $key => $seller) {
            if($seller->invalid_at != null && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0){
                foreach ($seller->user->products as $key => $product) {
                    $product->published = 0;
                    $product->save();
                }
            }
        }
    }
}
