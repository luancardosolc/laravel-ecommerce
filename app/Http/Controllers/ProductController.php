<?php

namespace App\Http\Controllers;

use App\Classes\CustomResponse;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *      security={{ "apiAuth": {} }}
     *     )
     */
    public function index(): Response
    {
        $products = Product::all();
        return Response($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required',
        ]);

        return Response(Product::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return Response(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        $product = Product::find($id);
        $product->update($request->all());
        return Response($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CustomResponse
     */
    public function destroy(int $id): CustomResponse
    {
        if (!Product::destroy($id)) {
            return new CustomResponse('Failed to delete the product', false);
        }

        return new CustomResponse('Product has been deleted');
    }

    /**
     * @param string $name
     * @return Response
     */
    public function search(string $name): Response
    {
        $products = Product::where('name', 'like', '%' . $name . '%')->get();
        return new CustomResponse('Success', true, $products);
    }
}
