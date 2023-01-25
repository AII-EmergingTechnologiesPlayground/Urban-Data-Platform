# Welcome to the Urban Data Platfrom!

**Some information about the project**

# Documentation

## Table of contents

- [UDP API](#UDP-API)
  - [Introduction](#Introduction)
  - [Callback URL & Standard headers](#Callback-URL-&-Standard-headers)
  - [Entity creation](#Entity-creation)
  - [Query entity](#Query-entity)
  - [Get one entity](#Get-one-entity)
  - [Get entity with compact attributes](#Get-entity-with-compact-attributes)
  - [Get entity with attribute value](#Get-entity-with-attribute-value)
  - [Get all entities](#Get-all-entities)
  - [Get entities by type or pattern](#Get-entities-by-type-or-pattern)
  - [Get entities by type](#Get-entities-by-type)
  - [Get entities by pattern](#Get-entities-by-pattern)
  - [Get entities by Simple Query Language](#Get-entities-by-Simple-Query-Language)
  - [Update entity](#Update-entity)
  - [Single attribute](#Single-attribute)
  - [Multiple attributes](#Multiple-attributes)
  - [Batch update](#Batch-update)
  - [Retrieving history of an entity](#Retrieving-history-of-an-entity)
  - [What will be added in the next release](#What-will-be-added-in-the-next-release)
- [UDP development and test environment](#UDP-development-and-test-environment)
- [UDP Proof of Concept](#UDP-Proof-of-Concept)
  - [Features](#Features)
  - [Deployment](#Deployment)

## UDP API

### Introduction

In this document, you can read how to use the UDP API. It explains the format in which a request must be made and an additional example has also been provided to give a better picture.

### Callback URL & Standard headers

    "Callback URL": 20.16.84.167
    {
        "Content-Type": "application/json",
        "Fiware-Service": "demoiot",
        "Fiware-ServicePath": "/NAME_OF_PROJECT",
    }

### Entity creation

##### Format

    POST 20.16.84.167:1026/v2/entities
    {
    	"id": "SENSOR_ID",
    	"type": "SENSOR_TYPE",
    	"ATTRIBUTE_NAME":{
    		"type": "ATTRIBUTE_TYPE",
    		"value":
    	}
    }

##### Example

    Formats toevoegen
        curl --location --request POST
        '20.16.84.167:1026/v2/entities' \
        --header  'Content-type: application/json' \
        --header  'Fiware-Service: demoiot' \
        --header  'Fiware-ServicePath: /test_project’ \
        --data-raw '{
        	"id": "MultiSensor1",
        	"type": "MultiSensor",
        	"pressure": {
        	"metadata": {},
        	"type": "Integer",
        	"value": 0
        	},
        	"temperature": {
        	"metadata": {},
        	"type": "Float",
        	"value": 0
        	}
        }'

### Query entity

#### Get one entity

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities/MultiSensor1' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: /test_project'

#### Get entity with compact attributes

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}?options=keyValues

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities/MultiSensor1?options=keyValues' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project '

#### Get entity with attribute value

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}?options= values&attrs={ATTRIBUTE_NAME}

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities/MultiSensor1?options=values&attrs=temperature' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: /test_project'

### Get all entities

To get an overview of all the existing entities within a certain combination of the service and servicepath it is possible to use the following example below.

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project '

### Get entities by type or pattern

If you wish to get multiple entities by a certain defined type or pattern you can refer to this chapter.

#### Get entities by type

To get all entities of a certain defined type you can use the curl request shown below. This with return all the entities with the selected service path with the given entity type shown as **{TYPE}**

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?type={TYPE}

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities?type=MultiSensor' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project’

#### Get entities by pattern

To get all entities that are within the requested pattern you can use the curl request shown below. The example below will return all the multisensors that are ending with 0 or 1, so **MultiSensor0** and **MultiSensor1** will show in the response.

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?idPattern=^{ID_NAME} [{ID_NUMBER_RANGE}]

##### Example

    curl --location -g --request
    GET '20.16.84.167:1026/v2/entities?idPattern=^MultiSensor[0-1]' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project’

#### Get entities by Simple Query Language

> Note: disable header “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?q={QUERY}

##### Example

    curl --location  --request
    GET '20.16.84.167:1026/v2/entities?q=pressure==0' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project '

### Update entity

There are a few different solutions to update an attribute or attributes of an entity within the UDP. **Single attribute** can only be used to update a single attribute of an entity. To update multiple attributes of an entity you can refer to the **Multiple attributes** in this chapter.

> Note: disable header “Content-type”, this causes errors.

#### Single attribute

##### Format

    POST 20.16.84.167:1026/v2/entities/{ID}/attrs/{ATTRIBUTE_TYPE}/value

AMOUNT

##### Example

    curl --location  --request
    PUT '20.16.84.167:1026/v2/entities/MultiSensor1/attrs/temperature/value' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: / test_project' \
    --header  'Content-Type: text/plain' \
    --data-raw  '25'

#### Multiple attributes

##### Format

    PATCH 20.16.84.167:1026/v2/entities/{SENSOR_ID}/attrs

    ATTRIBUTES

##### Example

    curl --location --request
    PATCH  'http://20.16.84.167:1026/v2/entities/MultiSensor1/attrs' \
    --header 'Fiware-Service: demoiot' \
    --header 'Fiware-ServicePath: /test_project' \
    --header 'Content-Type: application/json' \
    --data-raw ' {
     "pressure":{"type":"Integer", "value": 89},
     "temperature": {"type":"Float", "value": 1}
    }'

### Batch update

If you desire to update multiple attributes of multiple entities at the same time you can use the batch update. With this method you can put multiple entities in the "**entities**" within the --**data-raw** as shown below.

##### Format

    POST http://http://20.16.84.167:1026/v2/op/update

    RAW DATA

##### Example

    curl --location --request POST 'http://http://20.16.84.167:1026/v2/op/update' \
    --header 'Fiware-Service: demoiot' \
    --header 'Fiware-ServicePath: /test_project' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "actionType":"update",
        "entities":[
        {
    	    "id":"MultiSensor1", "type":"MultiSensor",
    	    "pressure":{"type":"Integer", "value": 12}
        },
        {
    	    "id":"MultiSensor2", "type":"MultiSensor",
    	    "pressure":{"type":"Integer", "value": 20}
        },
    ]

}'

### Retrieving history of an entity

If you desire to retrieve the historic data of an entity you can achieve it with the example shown below. **AMOUNT_OF_DATA** refers to the amount of data that you will receive.

> Note: disable header “Content-type”, this causes errors.

##### Format

GET `20.16.84.167:8666/STH/v1/contextEntities/type/{SENSOR_TYPE}/id/{SENSOR_ID}/attributes/{ATTRIBUTE_NAME}?lastN={AMOUNT_OF_DATA}`

##### Example

    curl --location--request
    GET '20.16.84.167:8666/STH/v1/contextEntities/type/MultiSensor/id/MultiSensor1/attributes/pressure?lastN=20' \
    --header'Fiware-Service: demoiot' \
    --header'Fiware-ServicePath: /test_project' \

### What will be added in the next release

- Sensor relationships
- Security (authentication and authorization)
- MQTT
- Additional ideas of the groups

## UDP development and test environment

## UDP Proof of Concept

Dit laravel project is bedoelt om enkele functionaliteiten te gebruiken van het UDP doormiddel van een dashboard. De volgende functionaliteiten zijn er in verwerkt, de overige functionaliteiten die nog niet werken zijn grijs.

### Features

- Beschikbare datasets(types)
- Inzicht in dataset(entities)
- Entity inzicht(beschikbare attributen)
- Download CSV van geschiedenis van attribuut (CSV bestaat max uit 10.000 regels)

### Deployment

Om dit project te deployen zijn de volgende commands nodig

#### Kopieër de env.example naar env.

    npm install
    composer install
    php artisan key:generate

Om de connecten met het UDP of een test versie moeten de volgende regels worden aangepast in de DataController: Bij de path is het vereist om een / te gebruiken zoals

    /voorbeeld_udp_path
    protected string $ip = '<INVULLEN>'; protected string $service = '<INVULLEN>'; protected string $path = '<INVULLEN>';
