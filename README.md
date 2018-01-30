# pushover-send

Simple PHP script to add support for pushover.net as a notification service in Synology DSM.

## Getting Started

These instructions will get you up and running using this script as an SMS service provider in Synology DSM.

### Prerequisites

WebStation and PHP packages are required to be set up and configured on the Synology NAS. Instructions for this can be found in the official Synology documentation. It can also be installed on another server accessible from the Synology NAS. Instructions for this are not provided here.


### Installing

1. Place the contents of the project in the web root folder on your NAS.

2. Create a pushover application if you have not already done so (pushover.net -> Apps & Plugins -> Create a New Application / API Token)

3. Add an SMS provider in the Synology DSM interface:  
Go to Control Panel -> Notification -> SMS. Click "Add SMS service provider".  
Give it a name, I suggest pushover-send, and paste the following URL where asked for SMS url:  
http://localhost/pushover-send.php?userkey=username&appkey=pwd&to=1234&text=Hello+World  
Assign the variables as follows:  
userkey=username as Username   
appkey=pwd as Password   
to=1234 as Phone number  
text=Hello+World as Message content  

4. Enter your pushover keys as follows:  
Username: Pushover user key  
Password: Pushover API Token for the pushover synology app (create one if not already done, pushover.net -> Apps & Plugins -> Create a New Application / API Token)  
Confirm password: Pushover API Token again  
Phone number: Add a phone number. It won't ever be sent or used in any way, but is required due to this method emulating an SMS provider.  
Disable the sms interval, or set as desired.

5. Click the "Send a test SMS message" button to verify that it works. You should now receive a notification through pushover.net!

6. Additional configuation
Some configuration options are available in the pushover-send.php file. These options include allowing remote access, change notification sound and change notification priority. 


## Built With

* [php-pushover](https://github.com/cschalenborgh/php-pushover) - The pushover API framework used


## Authors

* **Erik N** - [eriktheswede] (https://github.com/eriktheswede/)

## License

This project is licensed under the BSD license - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Thank you to Chris Schalenborgh (https://github.com/cschalenborgh/) for creating the php-pushover project used in this script and to Styxit (https://github.com/styxit) for the inspiration behind it.
