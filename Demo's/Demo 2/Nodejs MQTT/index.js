var mqtt = require('mqtt'), url = require('url');
// Parse
var mqtt_url = url.parse(process.env.CLOUDAMQP_MQTT_URL || 'mqtt://localhost:1883');
var auth = (mqtt_url.auth || ':').split(':');
var url = "mqtt://" + mqtt_url.host;

//username: auth[0] + ":" + auth[0] if you are on a shared instance
var options = {
  port: mqtt_url.port,
  clientId: 'mqttjs_' + Math.random().toString(16).substr(2, 8) +'_'+new Date(),
};

// // Create a client connection
var client = mqtt.connect(url, options);

// client.on('connect', function() { // When connected

//   // subscribe to a topic
//   client.subscribe('/#', function() {
//     // when a message arrives, do something with it
//     client.on('message', function(topic, message, packet) {
//       console.log("Received '" + message + "' on '" + topic + "'");
//     });
//   });

//   // publish a message to a topic
//   // client.publish('/test', 'my message', function() {
//   //   console.log("Message is published");
//   //   client.end(); // Close the connection when published
//   // });
// });

client.on('connect', function () {
    console.log('connected to the server. ID :');
});

client.on('message', function (topic, message) {
  console.log(message.toString());
});

client.on("error", function(error) {
    console.log("ERROR: ", error);
});

client.on('offline', function() {
    console.log("offline");
});

client.on('reconnect', function() {
    console.log("reconnect");
});

client.subscribe('/ul/4jggokgpepnvsb2uv4s40d59ov/door001/attrs', function() {
  // when a message arrives, do something with it
  client.on('message', function(topic, message, packet) {
    console.log("Received '" + message + "' on '" + topic + "'");
  });
});

//start sending
// var i = 0;
// setInterval(
//     function(){
//         var message = i.toString();
//         console.log("sending ", message)
//         client.publish("/test", message, {qos: 1}, function(){
//             console.log("sent ", message)
//         });
//         i += 1;
//     },
// 3000);