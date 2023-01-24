# Welcome to the Urban Data Platfrom of Emerging technologies playgroud!

**Some information about the project**

# Documentation

## Table of conte## Headingnts

- [UDP API](#UDP-API)
  - [Introduction](#Introduction)
  - [Callback URL & Standard headers](#Callback-URL-&-Standard-headers)
  - [Entity creation](#Entity-creation)
- [UDP development and test environment](#UDP-development-and-test-environment)

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

    curl --location  --request  GET
    '20.16.84.167:1026/v2/entities/MultiSensor1' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: /test_project'

## UDP development and test environment
