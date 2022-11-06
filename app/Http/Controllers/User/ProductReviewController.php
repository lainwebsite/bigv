<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductReview;
use App\Models\ReviewImage;
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
            $productReview = ProductReview::create([
                'rating' => $rating,
                'description' => $request->description[$key],
                'variation_name' => $cart->product_variation->name,
                'product_id' => $cart->product_variation->product_id,
                'user_id' => $cart->user_id
            ]);
        }
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
