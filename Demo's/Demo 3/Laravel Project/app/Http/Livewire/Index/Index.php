<?php

namespace App\Http\Livewire\Index;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class Index extends Component
{

    public $toggle;

    public function mount()
    {
        $toggle = false;
    }

    public function toggleLight()
    {
        $this->toggle = !$this->toggle;
        $switch = ($this->toggle) ? "on" : "off";

        $client = new Client();
        $headers = [
        'Content-Type' => 'application/json',
        'fiware-service' => 'openiot',
        'fiware-servicepath' => '/'
        ];
        $body = '{
        "actionType": "update",
        "entities": [
            {
            "type": "Lamp",
            "id": "urn:ngsi-ld:Lamp:001",
            "'.$switch.'": {
                "type": "command",
                "value": ""
            }
            }
        ]
        }';
        $request = new Request('POST', 'http://localhost:4041/v2/op/update', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();
    }

    public function ringBell()
    {
        $client = new Client();
        $headers = [
        'Content-Type' => 'application/json',
        'fiware-service' => 'openiot',
        'fiware-servicepath' => '/'
        ];
        $body = '{
        "actionType": "update",
        "entities": [
            {
            "type": "Bell",
            "id": "urn:ngsi-ld:Bell:001",
            "ring": {
                "type": "command",
                "value": ""
            }
            }
        ]
        }';
        $request = new Request('POST', 'http://localhost:4041/v2/op/update', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

    }

    public function render()
    {
        return view('livewire.index.index');
    }
}
