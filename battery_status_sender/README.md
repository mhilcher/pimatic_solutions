# Battery Status Sender

A few month ago I had a problem when I needed to monitor the battery level of my "kitchen tablet".

I have an old Samsung Galaxy Tab integrated into the wallboard in the kitchen an it is always on and I wanted that the battery only is loading when the battery level is low. So I put a switch there which I can control via pimatic.

To automate this switch I needed a tool to send the battery level to pimatic. 
As I don't use tasker (and I didn't even know about that tool at this time) I searched for a solution. 
So I wrote a little app with cordova that can be installed on android devices.
It's a very basic app which does nothing else then sending the battery level in a variable to a script on a server that can be defined in a text field.
It also runs in the background and saves the configuration to the card.

Here you find 3 files you might need:

- BatteryStatusSender.apk
- io.cordova.BatteryStatusSender.config.json
- puvar.php

I cannot garantee that the apk runs on every android version, I tested it with CyanogenMod 10 (Android 4.2.2), Android 4.4 and 5
