<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ReviewImage;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->rating as $key => $rating) {
            $cart = Cart::find($key);
            $cart->transaction->update([
                'is_reviewed' => 1
            ]);
            $productReview = ProductReview::create([
                'rating' => $rating,
                'description' => $request->description[$key],
                'variation_name' => $cart->product_variation->name,
                'product_id' => $cart->product_variation->product_id,
                'user_id' => $cart->user_id
            ]);
        }
        $product_reviews = ProductReview::where('product_id', $cart->product_variation->product_id)->get();

        $product_rating = 0;

        foreach ($product_reviews as $key => $review) {
            $product_rating += $review->rating;
        }

        $product = Product::find($cart->product_variation->product_id);

        $product->update([
            'rating' => $product_rating,
        ]);

        $vendor_reviews = ProductReview::whereHas('product', function ($q) use ($product) {
            $q->whereHas('vendor', function ($q) use ($product) {
                $q->where('vendor_id', $product->vendor_id);
            });
        })->get();

        $vendor_rating = 0;

        foreach ($vendor_reviews as $key => $review) {
            $vendor_rating += $review->rating;
        }

        $vendor = Vendor::find($product->vendor_id);

        $vendor->update([
            'rating' => $vendor_rating,
        ]);

        if ($request->review_photos) {
            foreach ($request->review_photos as $keyed => $photos) {
                $cart = Cart::find($keyed);
                foreach ($photos as $keyd => $photo) {
                    $photod = 'review-' . $cart->product_variation->product_id . '-' . time() . '-' . $photo->getClientOriginalName();
                    $photo->move(public_path('uploads'), $photod);
                    ReviewImage::create([
                        'link' => $photod,
                        'review_id' => $productReview->id
                    ]);
                }
            }
        }
        return redirect()->route('user.transaction.show', $request->transaction_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReview $productReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductReview $productReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReview $productReview)
    {
        //
    }
}
