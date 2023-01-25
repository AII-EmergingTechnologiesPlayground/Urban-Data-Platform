# Welcome to the Urban Data Platfrom!

On this Github repository you can read about which components have been built. Here you can find which FIware components we used, what demos we made and the current version of the UDP. You can also read the documentation on the use of the API, how to set up a development/test environment and how to use the Proof of Concept.

# Documentation

## Table of contents
   * [UDP API](#UDP-API)
	   * [Introduction](#Introduction)
	   * [Callback URL & Standard headers](#Callback-URL-&-Standard-headers)
	   * [Entity creation](#Entity-creation)
	   * [Query entity](#Query-entity)
		    * [Get one entity](#Get-one-entity)
		    * [Get entity with compact attributes](#Get-entity-with-compact-attributes)
		    * [Get entity with attribute value](#Get-entity-with-attribute-value)
	   * [Get all entities](#Get-all-entities)
	   * [Get entities by type or pattern](#Get-entities-by-type-or-pattern)
		    * [Get entities by type](#Get-entities-by-type)
		    * [Get entities by pattern](#Get-entities-by-pattern)
		    * [Get entities by Simple Query Language](#Get-entities-by-Simple-Query-Language)
	   * [Update entity](#Update-entity)
		    * [Single attribute](#Single-attribute)
		    * [Multiple attributes](#Multiple-attributes)
	   * [Batch update](#Batch-update)
	   * [Retrieving history of an entity](#Retrieving-history-of-an-entity)
	   * [What will be added in the next release](#What-will-be-added-in-the-next-release)
   * [UDP development and test environment](#UDP-development-and-test-environment)
	   * [Required software](#Required-software)
		    * [Postman](#Postman)
		    * [VirtualBox](#VirtualBox)
		    * [Ubuntu](#Ubuntu)
	   * [Virtual machine installeren](#Installing-a-virtual-machine)
	   * [Ubuntu environment set up](#Ubuntu-environment-set-up)
		    * [Installing Docker](#Installing-Docker)
		    * [Host-guest text copying does not work](#Host-guest-text-copying-does-not-work)
		    * [Compose up](#Compose-up)
	   * [Ports](#Ports)
   * [UDP Proof of Concept](#UDP-Proof-of-Concept)
	   * [Features](#Features)
	   * [Deployment](#Deployment)

##  UDP API

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

> Note: disable header  “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}
##### Example

    curl --location  --request  
    GET '20.16.84.167:1026/v2/entities/MultiSensor1' \
    --header  'Fiware-Service: demoiot' \
    --header  'Fiware-ServicePath: /test_project'

#### Get entity with compact attributes
> Note: disable header  “Content-type”, this causes errors.
##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}?options=keyValues

##### Example

    curl --location  --request  
    GET '20.16.84.167:1026/v2/entities/MultiSensor1?options=keyValues' \  
    --header  'Fiware-Service: demoiot' \  
    --header  'Fiware-ServicePath: / test_project '

#### Get entity with attribute value
> Note: disable header  “Content-type”, this causes errors.
##### Format

    GET 20.16.84.167:1026/v2/entities/{ID}?options= values&attrs={ATTRIBUTE_NAME}

##### Example

    curl --location  --request  
    GET '20.16.84.167:1026/v2/entities/MultiSensor1?options=values&attrs=temperature' \  
    --header  'Fiware-Service: demoiot' \  
    --header  'Fiware-ServicePath: /test_project'

### Get all entities
To get an overview of all the existing entities within a certain combination of the service and servicepath it is possible to use the following example below.
> Note: disable header  “Content-type”, this causes errors.

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
> Note: disable header  “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?type={TYPE}

##### Example

    curl --location  --request  
    GET '20.16.84.167:1026/v2/entities?type=MultiSensor' \  
    --header  'Fiware-Service: demoiot' \  
    --header  'Fiware-ServicePath: / test_project’

#### Get entities by pattern
To get all entities that are within the requested pattern you can use the curl request shown below. The example below will return all the multisensors that are ending with 0 or 1, so **MultiSensor0** and **MultiSensor1** will show in the response.
> Note: disable header  “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?idPattern=^{ID_NAME} [{ID_NUMBER_RANGE}]

##### Example

    curl --location -g --request  
    GET '20.16.84.167:1026/v2/entities?idPattern=^MultiSensor[0-1]' \  
    --header  'Fiware-Service: demoiot' \  
    --header  'Fiware-ServicePath: / test_project’

#### Get entities by Simple Query Language
> Note: disable header  “Content-type”, this causes errors.

##### Format

    GET 20.16.84.167:1026/v2/entities?q={QUERY}

##### Example

    curl --location  --request  
    GET '20.16.84.167:1026/v2/entities?q=pressure==0' \  
    --header  'Fiware-Service: demoiot' \  
    --header  'Fiware-ServicePath: / test_project '

### Update entity
There are a few different solutions to update an attribute or attributes of an entity within the UDP. **Single attribute** can only be used to update a single attribute of an entity. To update multiple attributes of an entity you can refer to the **Multiple attributes** in this chapter.
> Note: disable header  “Content-type”, this causes errors.

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
> Note: disable header  “Content-type”, this causes errors.

##### Format

    GET  20.16.84.167:8666/STH/v1/contextEntities/type/{SENSOR_TYPE}/id/{SENSOR_ID}/attributes/{ATTRIBUTE_NAME}?lastN={AMOUNT_OF_DATA}

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

##  UDP development and test environment
This document serves as a guide for starting up a Fiware instance. It is possible to follow this document to set up both a test environment and a live environment.

### Required software
There are two programs required to test and run the environment, namely Postman and VirtualBox.  It is not recommended to run the Fiware instance on a Windows platform as this will result in an error and/or non-working Fiware instance.  If the computer the Fiware instance will run on is running on the Ubuntu operating system, it is only required to download Postman.

#### Postman
Postman is an application with which to build and use working APIs. No specific version is required for this programme. The latest version can be obtained at [www.postman.com](http://www.postman.com/)

#### VirtualBox
VirtualBox is required if no Ubuntu operating system is present on the computer.  Using this programme, it is possible to run an instance of Ubuntu on a Windows operating system as a guest operating system. The latest version can be obtained at [https://www.virtualbox.org/wiki/Downloads](https://www.virtualbox.org/wiki/Downloads)

#### Ubuntu
This operating system can be obtained at [www.ubuntu.com/download/desktop](http://www.ubuntu.com/download/desktop) versie 22.04.X LTS wordt geadviseerd.

### Installing Virtual Machine
If the computer is running as Ubuntu as the operating system, it is possible to go directly to Ubuntu environment setup. It is recommended to use the following settings.

In the menu, go to **Machine->New when VirtualBox** is started.  A window will open, see Figure 1. The important thing here is that the correct Ubuntu ISO file is selected. And that **Skip unattended Installation** is checked. If this is not done, Ubuntu will not install all the components required. This installation requires some time.

**Figure 1**
*Creating Virtual Machine*
![ ](https://github.com/AII-EmergingTechnologiesPlayground/Urban-Data-Platform/blob/docs/Recourses/Image1.png?raw=true)

Creating Virtual aIf the ISO file is not automatically unmounted from the virtual machine causing it to keep booting into the installation, the ISO file must be unmounted. This can be done via **Machine->Settings->Storage**Machine

For the virtual machine to work correctly and as desired, some settings need to be changed, this requires the virtual machine to be off.

**System->Processor**
 - Processors: 2 CPU (Geadviseerd)

**System->Motherboard**  
 - Base Memory: 3072 (Geadviseerd)

**Display**  
 - Video Memory: 128MB

**Network**
 - Adapter 1: Attached to NAT

### Ubuntu environment set up
#### Installing Docker
The instruction to install Docker on Ubuntu can be found via the following link: [https://docs.docker.com/engine/install/ubuntu/](https://docs.docker.com/engine/install/ubuntu/)

#### Host-guest text copying does not work
If it is not possible to copy from the host to the guest operating system, you can run the following commands in Ubuntu's terminal.

    sudo apt-get update
    sudo apt-get install virtualbox-guest-x11
    sudo VBoxClient --clipboard

#### Compose up
To set up the Fiware container correctly, a file called **compose.yaml** must be created in Ubuntu. This file should contain the required configuration of Fiware. After this, it is possible to create the container using.

    sudo docker compose up

Fiware will initialise and run in a few minutes. If you want to reset the container, you can do so by:

> Pas op! Alle data wordt verwijderd.

    sudo docker compose down
    sudo docker compose up

### Ports
Make sure that ports **1026** and **8666** are always available. These are the communication ports for the Fiware instance.

## UDP Proof of Concept
This laravel project is meant to use some functionalities of the UDP through a dashboard. The following functionalities are included, the remaining functionalities that do not yet work are greyed out.

### Features
- Available datasets(types) 
- Dataset insight(entities) 
- Entity insight(available attributes) 
- Download CSV of history of attribute (CSV consists of max 10,000 lines)

### Deployment
To deploy this project, the following commands are required
#### Copy the env.example to env.

    npm install
    composer install
    php artisan key:generate

To connect to the UDP or a test version, the following rules need to be modified in the DataController: At the path, it is required to use a / such as

    /example_udp_path 
    protected string $ip = '<FILL>'; protected string $service = '<FILL>'; protected string $path = '<FILL>';

 
