<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        try {
            $idUserSesion = $request->user()->id;
            $items = Company::where('id', '>', 0)->with('plan')->with('category')->with('city')->get();
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
            $items = Company::find($id);
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
            $item = Company::create([
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'linkweb' => $request->linkweb,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'schedule' => $request->schedule,
                'payments' => $request->payments,
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'user_id' => $idUserSesion
            ]);
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
            $items = Company::find($id)
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
            $items = Company::destroy($id);
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
    
    protected function getB64Image($base64_image)
    {  
         // Obtener el String base-64 de los datos         
         $image_service_str = substr($base64_image, strpos($base64_image, ",")+1);
         // Decodificar ese string y devolver los datos de la imagen        
         $image = base64_decode($image_service_str);   
         // Retornamos el string decodificado
         return $image; 
    }
    
    protected function getB64Extension($base64_image, $full=null){  
        // Obtener mediante una expresión regular la extensión imagen y guardarla
        // en la variable "img_extension"        
        preg_match("/^data:image\/(.*);base64/i",$base64_image, $img_extension);   
        // Dependiendo si se pide la extensión completa o no retornar el arreglo con
        // los datos de la extensión en la posición 0 - 1
        return ($full) ?  $img_extension[0] : $img_extension[1];  
    }
    
    public function changeLogo(Request $request, $id)
    {
        // Obtener los datos de la imagen
        $image_avatar_b64 = $request->image;
        $img = $this->getB64Image($image_avatar_b64);
        // Obtener la extensión de la Imagen
        $img_extension = $this->getB64Extension($image_avatar_b64);
        // Crear un nombre aleatorio para la imagen
        $img_name = $id . '_user_avatar'. '.' . $img_extension;
        // echo $image_name;
        // Usando el Storage guardar en el disco creado anteriormente y pasandole a 
        // la función "put" el nombre de la imagen y los datos de la imagen como 
        // segundo parametro
        Storage::disk('images/logos')->put($img_name, $img);
    }
    
    
}