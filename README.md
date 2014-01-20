#Raspberry Pi System Panel#
A Node.js System Information Panel with custom widgets, developed for my Raspberry Pi with support for Raspistill but supports Linux too *(not Raspistill)*.

##Preview##
###Desktop Preview###
![Preview](https://dl.dropboxusercontent.com/u/16581748/desktop.png)<br />
###Mobile Preview###
![Preview iOS](https://dl.dropboxusercontent.com/u/16581748/mobile.png)<br />

*Soon will be released a demo version*

##Mobile Ready##
The Panel is mobile ready with support for iOS web apps bookmarked to Home Screen thanks to Bootstrap v3.

##Widgets##
*Widgets soon can be developed or customized following some simple guidelines and will be moved to their directory*<br />
If you want to try you can watch and edit the panelwidgets folder. The panel has its own widgets folder but this will change soon.

#Installation#
* Download all files and use *npm install* to download missing packages
* Prepare an empty database on MySQL (it's the only DBMS supported for now)
* Access to the application on 1338 port and set Database information *(not yet available)* and the panel login information (he will have administrator rights)
* The panel is ready to log you in

*Settings page is work in progress*

##Important##
**Introduced Stored Procedures but not in the install.php yet so you have to restore it from the sql you find in the root.
I'm working on an updater for keeping data between versions and updating stored procedures too.**
The new widget Terminal can be added by these query:
*INSERT  IGNORE INTO `widget` VALUES (14,6,0,'Terminal','terminal','terminal.tpl','',1,'terminal','Terminal');
INSERT  IGNORE INTO `user_widget` VALUES (26,1,14,'terminal',13,'','',1);*
