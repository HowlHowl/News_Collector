<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

/**
 * Class ReuterNews
 * @package App\Http\Controllers
 */
class ReuterNews extends Controller
{
    /**
     *
     */
    public function index()
    {
        ini_set('max_execution_time', 300);

        $array = ['IRBR3.SA', 'PETR4.SA', 'OIBR4.SA'];

        foreach ($array as $empresa) {

            $response = $this->gethtml('https://wireapi.reuters.com/v8/feed/rcom/us/marketnews/ric:' . $empresa, true);

            $this->newsFilter($response);
        }
    }

    /**
     * Função responsável por implementar o processo curl
     * @param $url
     * @param bool $jsonDecode
     * @return bool|mixed|string
     */
    private function gethtml($url, $jsonDecode = false)
    {

        $jsonCompleto = curl_init();
        curl_setopt($jsonCompleto, CURLOPT_URL, $url);
        curl_setopt($jsonCompleto, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($jsonCompleto);

        if ($jsonDecode) {
            $response = json_decode($response, true);
        }

        curl_close($jsonCompleto);

        return $response;

    }

    /**
     * Função responsável por percorrer o array de notícias e retornar apenas o valor da URl de cada notícia
     * @param $response
     */
    private function newsFilter($response)
    {
        $noticiaEmpresa = $response['wire_name'];

        foreach ($response['wireitems'] as $noticia) {

            if ($noticia['wireitem_type'] == 'story') {

                $noticiaNome = $noticia['templates'][0]['story']['hed'];
                $noticiaURL = $noticia['templates'][0]['template_action']['url'];
                $noticiaData = $noticia['templates'][0]['story']['updated_at'];

                $noticiaData = substr($noticiaData, 0, 10);

//                echo "<pre>";
//                print_r($noticiaData);
//                die;

                $finalResponse = $this->gethtml($noticiaURL);

                $service = new NewsService();
                $service->create([
                    'name' => $noticiaNome,
                    'content' => 'WOW, I\'m learning PHP 2.',
                    'date' => $noticiaData,
                    'company' => $noticiaEmpresa
                ]);


            }
        }
    }
}
