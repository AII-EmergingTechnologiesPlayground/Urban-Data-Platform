<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class DataController extends Controller
{
    protected string $ip = '20.16.84.167';
    protected string $service = 'voorbeeld';
    protected string $path = '/voorbeeld';

    public function datasets()
    {
        try {

            $client = new Client();
            $res = $client->request('GET', $this->ip . ':1026/v2/types', [
                'headers' => [
                    'Fiware-Service' => $this->service,
                    'Fiware-ServicePath' => $this->path
                ]
            ]);

            $data = json_decode($res->getBody(), true);

            return view('datasets/index', ['data' => $data]);

        } catch (GuzzleException $e) {
            // Handle excpetion
            return view('error/guzzle_error');
        }
    }

    public function dataset(Request $request)
    {
//        return $request->type;
        try {

            $client = new Client();
            $res = $client->request('GET', $this->ip . ':1026/v2/entities/?type=' . $request->type, [
                'headers' => [
                    'Fiware-Service' => $this->service,
                    'Fiware-ServicePath' => $this->path
                ]
            ]);

            $data = json_decode($res->getBody(), true);
//            dd($data);

            return view('datasets/dataset', ['data' => $data, 'type' => $request->type]);

        } catch (GuzzleException $e) {
            // Handle excpetion
            return view('error/guzzle_error');
        }
    }

    public function sensorHistory(Request $request)
    {
        try {

            $client = new Client();
            $res = $client->request('GET', $this->ip . ':8666/STH/v2/entities/' . $request->id . '/attrs/' . $request->attr . '?type=' . $request->type . '&lastN=10000', [
                'headers' => [
                    'Fiware-Service' => $this->service,
                    'Fiware-ServicePath' => $this->path
                ]
            ]);

            $data = json_decode($res->getBody(), true);
            $data['value'] = array_reverse($data['value']);

            return view('sensor/sensor_history_attr', ['data' => $data['value'], 'type' => $request->type, 'id' => $request['id'], 'attr' => $request->attr]);

        } catch (GuzzleException $e) {
            // Handle excpetion
            return view('error/guzzle_error');
        }
    }

    public function downloadHistoryAttr(Request $request)
    {
        try {

            $client = new Client();
            $res = $client->request('GET', $this->ip . ':8666/STH/v2/entities/' . $request->id . '/attrs/' . $request->attr . '?type=' . $request->type . '&lastN=10000&filetype=csv', [
                'headers' => [
                    'Fiware-Service' => $this->service,
                    'Fiware-ServicePath' => $this->path
                ]
            ]);

            $file = "historic_data" . $request->type . "_" . $request->id ."_" . $request->type . ".txt";
            $txt = fopen($file, "w") or die("Unable to open file!");
            fwrite($txt, strval($res->getBody()));
            fclose($txt);

            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            header("Content-Type: text/plain");
            readfile($file);

        } catch (GuzzleException $e) {
            // Handle excpetion
            return view('error/guzzle_error');
        }
    }
}
