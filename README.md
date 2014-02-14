#Raspberry Pi Node.js System Panel#
A Node.js System Information Panel with custom widgets, developed for Raspberry Pi with support for `raspistill`.
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
If you want to try you can watch and edit the panelwidgets folder.

#Installation#
1. Prepare an empty database on MySQL (it's the only DBMS supported for now)
2. Download all files and use *npm install* to download missing packages
3. Go to **framework** folder and use `npm install`
4. In **framework** folder edit **db_conn.json** to your mysql settings
5. Go to **panelwidgets** folder and use `npm install` into any widget folder to install their dependencies
6. -- Next steps are not implemented yet --
7. Access to the application on 1338 port and set Database informations and the panel login information (he will have administrator rights)
8. The panel is ready to log you in

##Important##
**Introduced Stored Procedures but not in the install.php yet so you have to restore it from the sql you find in the root.
I'm working on an updater for keeping data between versions and updating stored procedures too.**
