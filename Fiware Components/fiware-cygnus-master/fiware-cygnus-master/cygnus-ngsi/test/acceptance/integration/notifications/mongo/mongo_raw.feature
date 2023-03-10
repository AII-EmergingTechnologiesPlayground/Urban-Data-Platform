# -*- coding: utf-8 -*-
#
# Copyright 2015-2017 Telefonica Investigación y Desarrollo, S.A.U
#
# This file is part of fiware-cygnus (FIWARE project).
#
# fiware-cygnus is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General
# Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any
# later version.
# fiware-cygnus is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
# details.
#
# You should have received a copy of the GNU Affero General Public License along with fiware-cygnus. If not, see
# http://www.gnu.org/licenses/.
#
# For those usages not covered by the GNU Affero General Public License please contact:
# iot_support at tid.es
#
__author__ = 'Iván Arias León (ivan.ariasleon at telefonica dot com)'

#
#  Note: the "skip" tag is to skip the scenarios that still are not developed or failed
#        -tg=-skip
#

Feature: Get raw values persisted by Cygnus using different requests
  As a cygnus user
  I want to be able to get raw values persisted by Cygnus using different requests
  so that they become more functional and useful


  @happy_path
  Scenario: received a notification at Cygnus and store it as raw data
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_happy_path", service path "/test", entity type "room", entity id "room3", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives a notification with attributes value "random number=2", metadata value "True" and content "json"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo

  @service
  Scenario Outline: received a notification at Cygnus and store it as raw data with several services
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "<service>", service path "/test", entity type "room", entity id "room3", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives a notification with attributes value "random number=2", metadata value "True" and content "<content>"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
    And delete database in mongo
  Examples:
    | service                 | content |
    | test_orga601000         | json    |
    | test_ORGA601110         | json    |
    | test_Org_614010         | json    |
    | with max length allowed | json    |
    | test_orga601000         | xml     |
    | test_ORGA601110         | xml     |
    | test_Org_614010         | xml     |
    | with max length allowed | xml     |

  @service_path @BUG_406
  Scenario Outline: received a notification at Cygnus and store it as raw data with several services paths
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_service_path", service path "<service_path>", entity type "room", entity id "room3", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives a notification with attributes value "random number=2", metadata value "True" and content "<content>"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
  Examples:
    | service_path            | content |
    | /serv60100              | json    |
    | /SERV60120              | json    |
    | /Serv_6140              | json    |
    | /12345678900            | json    |
    | /12345678900            | json    |
    | /                       | json    |
    | with max length allowed | json    |
    | /serv60100              | xml     |
    | /SERV60120              | xml     |
    | /Serv_6140              | xml     |
    | /12345678900            | xml     |
    | /12345678900            | xml     |
    | /                       | xml     |
    | with max length allowed | xml     |

  @entities @BUG_407 @skip
  Scenario Outline: received a notification at Cygnus and store it as raw data with several entities types and entities id
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_entities", service path "/test", entity type "<entity_type>", entity id "<entity_id>", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives a notification with attributes value "random number=2", metadata value "True" and content "<content>"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
  Examples:
    | entity_type             | entity_id        | content |
    | Room                    | Room2            | json    |
    | HOUSE                   | Room2            | json    |
    |                         | Room2            | json    |
    | house                   | ROOM             | json    |
    | device                  | modelogw.assetgw | json    |
    | with max length allowed | room2            | json    |
    | Room                    | Room2            | xml     |
    | HOUSE                   | Room2            | xml     |
    |                         | Room2            | xml     |
    | house                   | ROOM             | xml     |
    | device                  | modelogw.assetgw | xml     |
    | with max length allowed | room2            | xml     |

  @attribute_name
  Scenario Outline: received a notification at Cygnus and store it as raw data with several attributes names
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_attribute_name", service path "/test", entity type "room", entity id "room2", with attribute number "1", attribute name "<attribute_name>" and attribute type "celcius"
    And receives a notification with attributes value "random number=2", metadata value "True" and content "<content>"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
  Examples:
    | attribute_name          | content |
    | random                  | json    |
    | RANDOM_ALPHANUMERIC=100 | json    |
    | temperature             | json    |
    | tempo_45                | json    |
    | random                  | xml     |
    | RANDOM_ALPHANUMERIC=100 | xml     |
    | temperature             | xml     |
    | tempo_45                | xml     |

  @attribute_value
  Scenario Outline: received a notification at Cygnus and store it as raw data with several attributes value
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_attribute_value", service path "/test", entity type "room", entity id "room2", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives a notification with attributes value "<attribute_value>", metadata value "True" and content "<content>"
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
  Examples:
    | attribute_value                     | content |
    | random number=2                     | json    |
    | 34                                  | json    |
    | 34.67                               | json    |
    | 0.45                                | json    |
    | 0                                   | json    |
    | -45                                 | json    |
    | -46.29                              | json    |
    | 4.324234233129797897978997          | json    |
    | 4234234234.324234233129797897978997 | json    |
    | 1234567890122222                    | json    |
    | random number=2                     | xml     |
    | 34                                  | xml     |
    | 34.67                               | xml     |
    | 0.45                                | xml     |
    | 0                                   | xml     |
    | -45                                 | xml     |
    | -46.29                              | xml     |
    | 4.324234233129797897978997          | xml     |
    | 4234234234.324234233129797897978997 | xml     |
    | 1234567890122222                    | xml     |

  @several_notifications
  Scenario Outline: received several notifications at Cygnus and store it as raw data with several notifications number
    Given copy properties.json file from "epg_properties.json" to test "mongo-sink" and sudo local "false"
    And configuration of cygnus instances with different ports "true", agents files quantity "1", id "test" and in "row" mode
    And copy flume-env.sh, log4j.properties, krb5.conf and restart cygnus service. This execution is only once "true"
    And verify if cygnus is installed correctly
    And verify if mongo is installed correctly
    And service "test_several_notifications", service path "/test", entity type "room", entity id "room2", with attribute number "1", attribute name "random" and attribute type "celcius"
    And receives "<notifications_number>" notifications with consecutive values beginning with "25" and with one step
    Then receive an "OK" http code
    And validate that the attribute value and type are stored in mongo
  Examples:
    | notifications_number |
    | 1                    |
    | 10                   |
    | 50                   |
    | 100                  |


