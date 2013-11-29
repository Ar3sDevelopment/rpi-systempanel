#Raspberry Pi System Panel#
A PHP System Information Panel, developed on Raspberry Pi with support for Raspistill.

##Preview##
![Preview](https://www.dropbox.com/s/3o4jo655eijskg2/Foto%2029-11-13%2011%2041%2050%20%281%29.png)<br />
![Preview iOS](https://www.dropbox.com/s/ao7ec9ooh08sfvi/Foto%2029-11-13%2011%2041%2050.png)<br />
*Soon will be released a demo version*

##Mobile Ready##
The Panel is mobile ready with support for iOS web apps bookmarked to Home Screen thanks to Bootstrap v3.

#Installation#
* Download all files to a directory available to webserver (Apache2 and Nginx are tested)
* Prepare an empty database on MySQL (it's the only DBMS supported for now)
* Access to the application (if install.php is not the first page, go to it) and set Database information and the first user access (it will be administrator)
* The panel is ready

*Settings page is work in progress*

#Widgets#
*Widgets soon can be developed or customized following some simple guidelines and will be moved to their directory*
If you want to try you can watch and edit the panelwidgets folder. The panel has its own widgets folder but this will change soon.
Widgets must extends AbstractWidget class (abstract.widget.php) and before closing php tag you must create an instance assigned to $widget.
*The instance is required for now*

#IMPORTANT#
The panel requires Smarty v3 installed and in the PHP include path.<br />
*Smarty folder will be added on next milestone*
