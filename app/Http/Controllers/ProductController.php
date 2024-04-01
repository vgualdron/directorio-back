<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $idUserSesion = $request->user()->id;
            $items = Product::where('id', '>', 0)
                                ->with('images')
                                ->orderBy('updated_at', 'desc')->get();
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=> $idUserSesion,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $items,
            'message' => 'Succeed',
        ], JsonResponse::HTTP_OK);
    }

    public function show(Request $request, $id)
    {
        try {
            $items = Product::find($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=>$e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $items,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function store(Request $request)
    {
        try {
            $idUserSesion = $request->user()->id;
            $item = Product::create($request->all());
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=>$e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $item,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        try {
            $items = Product::find($id)
                        ->update($request->all());
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=>$e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $items,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $items = Product::destroy($id);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=>$e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $items,
            'message' => 'Succeed'
        ], JsonResponse::HTTP_OK);
    }

    public function search(Request $request)
    {
        try {
            $idUserSesion = $request->user()->id;
            $items = Product::where('id', '>', 0)
                                ->with('images')
                                ->orderBy('priority', 'desc')->get();
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message'=> $idUserSesion,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'data' => $items,
            'message' => 'Succeed',
        ], JsonResponse::HTTP_OK);
    }
}