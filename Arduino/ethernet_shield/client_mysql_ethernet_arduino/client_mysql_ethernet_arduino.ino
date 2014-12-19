#include <DHT.h>
#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x01 }; // RESERVED MAC ADDRESS
EthernetClient client;
char server[] = "192.168.1.20"; // IP Adres (or name) of server to dump data to

long previousMillis = 0;
unsigned long currentMillis = 0;
long interval = 250000; // READING INTERVAL

int t = 0;	// TEMPERATURE VAR
String temp = "*";  //String to send

int sensorPin = 0; //the analog pin the TMP36's Vout (sense) pin is connected to
//the resolution is 10 mV / degree centigrade with a
//500 mV offset to allow for negative temperatures

void setup() { 
	Serial.begin(115200);
        Serial.println("test");  

	if (Ethernet.begin(mac) == 0) {
		Serial.println("Failed to configure Ethernet using DHCP"); 
        }else{
                Serial.println("Connected via Ethernet using DHCP");  
        }
        Serial.print("IP Address        : ");
        Serial.println(Ethernet.localIP());
        Serial.print("Subnet Mask       : ");
        Serial.println(Ethernet.subnetMask());
        Serial.print("Default Gateway IP: ");
        Serial.println(Ethernet.gatewayIP());
        Serial.print("DNS Server IP     : ");
        Serial.println(Ethernet.dnsServerIP());
}

void loop(){

	if (client.connect("192.168.1.20",80)) { // REPLACE WITH YOUR SERVER ADDRESS
                Serial.println("-> Connected");
                //Make a HTTP request
                //client.println("GET /php_mysql_ethernet_arduino/add.php?temperature=24");
                client.print("GET /php_mysql_ethernet_arduino/add.php?");
                client.print("temperature=");
	        t = (int)temp_sensor();
                temp = String(t);
                client.print(temp);
                client.println(" HTTP/1.1");
                client.print( "Host: " );
                client.println(server);
                client.println( "Connection: close" );
                client.println();
                client.println();
                client.stop();
        }
        else {
          // you didn't get a connection to the server:
          Serial.println("--> connection failed/n");
        }

	if (client.connected()) { 
		client.stop();	// DISCONNECT FROM THE SERVER
	}

	delay(60000); // WAIT ONE MINUTE BEFORE SENDING AGAIN
}

float temp_sensor()
{
  //getting the voltage reading from the temperature sensor
  int reading = analogRead(sensorPin);
  // converting that reading to voltage, for 3.3v arduino use 3.3
  float voltage = reading * 5.0;
  voltage /= 1024.0;
  // print out the voltage
  //Serial.print(voltage); 
  //Serial.println(" volts");
  // now print out the temperature
  float temperatureC = (voltage - 0.5) * 100 ; //converting from 10 mv per degree wit 500 mV offset
  //to degrees ((voltage - 500mV) times 100)
  Serial.print(temperatureC); 
  Serial.println(" degrees C");
  // now convert to Fahrenheit
  //float temperatureF = (temperatureC * 9.0 / 5.0) + 32.0;
  //Serial.print(temperatureF); 
  //Serial.println(" degrees F");
  //delay(1000); //waiting a second 
  
  return (temperatureC);
}



