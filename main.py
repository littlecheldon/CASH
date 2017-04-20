import RPi.GPIO as GPIO #gpio library
import time  # for sleep function
import adafruit_BME280 #weather sensor class
import LED_Dimming #LED class contol module
import Door_Switch #doorsensor control module
import test_BME280 #function to read BME280


GPIO.setmode(GPIO.BCM)  # BCM = numbers in green box next to GPIO bins

#-------------LED pins-----------------------#
GPIO.setup(23, GPIO.OUT)  # set GPIO 25 as output for blue led
GPIO.setup(24, GPIO.OUT)  # set GPIO 25 as output for green led
GPIO.setup(25, GPIO.OUT)  # set GPIO 24 as output for red led

#-------------door switch pin--------------------#
GPIO.setup(17, GPIO.INPUT, GPIO.PUD_UP) #set GPIO 17 as input for door sensor

#--------------BME280 setup----------------------#



#Initialize each led
led1 = LED_Dimming.LED(23)    #blue led
led2 = LED_Dimming.LED(24)    #green led
led3 = LED_Dimming.LED(25)    #red led

led1.setLight(100)
led2.setLight(50)
led3.setLight(20)


#initialize BME280 weather sensor
sensor = adafruit_BME280.BME280(mode=adafruit_BME280.BME280_OSAMPLE_8)
test_BME280.readWeather(sensor)


#initialize the door sensor to read gpio 17
doorSensor = Door_Switch.doorSensor()

if doorSensor.readDoorSensor():
    print("switch is open")
else:
    print("switch is closed")

while True:
    x = 1