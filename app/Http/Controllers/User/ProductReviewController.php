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
            // dd($key);
            $cart = Cart::find($key);

            $productReview = ProductReview::create([
                'rating' => $rating,
                'description' => $request->description[$key],
                'variation_name' => $cart->product_variation->name,
                'product_id' => $cart->product_variation->product_id,
                'user_id' => $cart->user_id
            ]);
            
            // Mencari (product_review) berdasarkan (product_id)
            $product_reviews = ProductReview::where('product_id', $cart->product_variation->product_id)->get();
            // dd($product_reviews);
    
            $product_rating = 0;
            $rating_count = 0;
            // Looping perhitungan review berdasarkan ($product_review)
            foreach ($product_reviews as $keypro => $review) {
                $product_rating += $review->rating;
                $rating_count += 1;
            }
    
            // Update review ke product
            $product = Product::find($cart->product_variation->product_id);
            
            $new_rating = ($rating_count != 0) ? number_format((float)($product_rating / $rating_count), 2, '.', ''): 0;
            $product->update([
                'rating' => $new_rating,
            ]);
    
            $vendor_reviews = ProductReview::whereHas('product', function ($q) use ($product) {
                $q->whereHas('vendor', function ($q) use ($product) {
                    $q->where('vendor_id', $product->vendor_id);
                });
            })->get();
    
            $vendor_rating = 0;
            $rating_count = 0;
            foreach ($vendor_reviews as $keyven => $review) {
                $vendor_rating += $review->rating;
                $rating_count += 1;
            }
    
            $vendor = Vendor::find($product->vendor_id);
    
            $new_rating = ($rating_count != 0) ? number_format((float)($vendor_rating / $rating_count), 2, '.', ''): 0;
            $vendor->update([
                'rating' => $new_rating,
            ]);
    
            if ($request->review_photos[$key]) {
                foreach ($request->review_photos[$key] as $keyd => $photo) {
                    $photod = 'review-' . $cart->product_variation->product_id . '-' . time() . '-' . $photo->getClientOriginalName();
                    $photo->move(public_path('uploads'), $photod);
                    ReviewImage::create([
                        'link' => $photod,
                        'review_id' => $productReview->id
                    ]);
                }
            }
            // if ($request->review_photos) {
            //     foreach ($request->review_photos as $keyed => $photos) {
            //         $carttemp = Cart::find($keyed);
            //         foreach ($photos as $keyd => $photo) {
            //             $photod = 'review-' . $carttemp->product_variation->product_id . '-' . time() . '-' . $photo->getClientOriginalName();
            //             $photo->move(public_path('uploads'), $photod);
            //             ReviewImage::create([
            //                 'link' => $photod,
            //                 'review_id' => $productReview->id
            //             ]);
            //         }
            //     }
            // }
        }
        $cart->transaction->update([
            'is_reviewed' => 1
        ]);
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
