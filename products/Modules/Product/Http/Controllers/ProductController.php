<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Person\Entities\Person;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\createProductRequest;
use Modules\Product\Http\Requests\DeleteProductRequest;
use Modules\Product\Http\Requests\FilterRequest;
use Modules\Product\Http\Requests\ProductInfoRequest;
use Modules\Product\Http\Requests\ShowProductsRequest;
use Modules\Product\Transformers\DeleteProductResource;
use Modules\Product\Transformers\FilterResource;
use Modules\Product\Transformers\ProductInfoResource;
use Modules\Product\Transformers\ProductResource;
use Exception;
use Modules\Product\Transformers\ShowProductsResource;
use Modules\Product\Transformers\UpdateProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param createProductRequest $product
     * @return ProductResource
     */
    public function Create(CreateProductRequest $product)
    {
        try {
            $valid_data = Validator::make($product->all(), $product->rules());
            if (!$valid_data->fails()) {
                $data = $product->all();
                Product::create($data);
                SendMailtoPersonController::index(Person::find($product->get('person_id'))->email);
                return new ProductResource($product);
            } else
                throw ValidationException::withMessages([$valid_data->getMessageBag()]);

        } catch (Exception $e) {

            //Another way to return json response - pure code
            $result = [];
            $response_code = 400;
            $result['code'] = -1;
            $result['status'] = false;
            $result['msg'] = $e->getMessage();
            $result['data'] = [];
            return response()->json($result, $response_code);
        }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function ProductsList(ShowProductsRequest $data)
    {
        $page = $data->get('page');
        $productsData = Product::with('person')->paginate($page);
        return new ShowProductsResource($productsData);


    }

    public function GetProductInfoById(ProductInfoRequest $data)
    {

        $product_id = $data->get('product_id');
        $ProductInfo = Product::find($product_id);
        return new ProductInfoResource($ProductInfo);


    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CreateProductRequest $product)
    {

        try {
            $product_id = $product->get('product_id');
            $ProductInfo = Product::find($product_id);
            if (!empty($ProductInfo) && $ProductInfo) {
                $data = $product->all();
                $ProductInfo->update($data);
                return new UpdateProductResource($product);

            }
        } catch (Exception $e) {
            $result = [];
            $response_code = 400;
            $result['code'] = -1;
            $result['status'] = false;
            $result['msg'] = '';
            $result['data'] = [];
            $result['msg'] = $e->getMessage();
            return response()->json($result, $response_code);
        }


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(DeleteProductRequest $data)
    {


        try {
            $product_id = $data->get('product_id');
            $ProductInfo = Product::find($product_id)->delete();
            return new DeleteProductResource([]);
        } catch (Exception $e) {

            //Another way to return json response - pure code
            $result = [];
            $response_code = 400;
            $result['code'] = -1;
            $result['status'] = false;
            $result['msg'] = $e->getMessage();
            $result['data'] = [];
            return response()->json($result, $response_code);
        }

    }

    public function FilterProduct(FilterRequest $request)
    {

        $product_name = $request->get('product_name');
        $person_name = $request->get('person_name');
        $ProductsData = Product::whereHas('person', function ($query) use ($person_name) {
            $query->where('full_name', 'like', '%' . $person_name . '%');
        })->Where('name', 'like', '%' . $product_name . '%')->get();
        return new FilterResource($ProductsData);


    }


}
