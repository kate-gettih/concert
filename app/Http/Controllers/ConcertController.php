<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ConcertController extends BaseController
{
    public function getById(int $id): JsonResponse
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:concerts,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Такого концерта не существует. Пожалуйста, выберите другой!'], 400)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        $concert = Concert::find($id);

        $client = new Client(['base_uri' => 'https://singer.loc', 'verify' => false]);
        $response = $client->get('api/singer/only/ ' . $concert->singer_id);
        $singerJson = $response->getBody()->getContents();

        $concert->singer = json_decode($singerJson, true);

        return response()->json($concert, 200, [], JSON_PRETTY_PRINT);
    }

    public function getAllByCityId(int $id): JsonResponse
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:cities,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Такого города не существует. Пожалуйста, выберите другой!'], 400)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        $concerts = Concert::where(['city_id' => $id])->get();

        foreach ($concerts as $concert) {
            $client = new Client(['base_uri' => 'https://singer.loc']);
            $response = $client->get('api/singer/only/ ' . $concert->singer_id);
            $singerJson = $response->getBody()->getContents();

            $concert->singer = json_decode($singerJson, true);
        }

        return response()->json($concerts, 200, [], JSON_PRETTY_PRINT);
    }

    public function getAllBySingerId(int $id): string
    {
        $concerts = Concert::where(['singer_id' => $id])->get();

        return json_encode($concerts, JSON_PRETTY_PRINT);
    }

}
