# TYPO3 Extension "me_shortlink"

## Installation

1. just upload and activate the extension

## Configuration

1.  activate Google Analytics Tracking
	* you can active this feature in your extension configuration
	* insert the Google Analytics tracking id
	* the tracked data will be available as "Event Tracking" in your Google Analytics dashboard.

## How to use

1. the best way to manage the shortlink is to create a sysfolder and put all your records into it
2. add new shortlink record
3. select the language of the shortlink, its only important for internal links
4. you can link the record to an internal or external page
5. save
6. enter www.your-domain.com/yourshortlink
7. you will redirected to your specified target

## Contact
* typo3@move-elevator.de
* Company: http://www.move-elevator.de
* Issue-Tracker - https://github.com/move-elevator/me_shortlink

## Change Log

2017-06-09  Philipp Heckelt <phe@move-elevator.de>

    * 1.7.0 - add TYPO3v8 compatibility

2016-06-08  Hendrik Papmahl <hpa@move-elevator.de>

    * 1.6.1 - fix icon path
    
2016-06-08  Philipp Heckelt <phe@move-elevator.de>

    * 1.6.0 - add multilanguage support

2016-03-17  Jan Maennig <jam@move-elevator.de>

	* fixed unittest without EXT: phpunit

2016-02-18 Philipp Heckelt <phe@move-elevator.de>

    * added blacklists for phpunit tests
    * changed to standard PSR2

2016-01-29  Jan Maennig <jam@move-elevator.de>

	* add TYPO3 7.6 compatibility
	* used typolink_url to create shortlink target

2015-07-23  Steve Schütze <sts@move-elevator.de>

	* 1.4.5 - update Testcases

2015-05-29  Steve Schütze <sts@move-elevator.de>

	* 1.4.4 - add proxy support

2015-05-08  Steve Schütze <sts@move-elevator.de>

	* 1.4.3 - fix composer.json

2015-03-17  Sascha Seyfert <sef@move-elevator.de>

	* 1.4.1 - add README.md

2015-03-13  Sascha Seyfert <sef@move-elevator.de>

	* 1.4.0 - add jenkins build.xml to check the code style, TER release

2014-10-17  Jan Männig <jma@move-elevator.de>, Sascha Seyfert <sef@move-elevator.de>

	* 1.3.2 - add google analytics tracking

2014-04-08  Sascha Seyfert  <sef@move-elevator.de>

	* 1.2.0 - TYPO3 6.2 Support

2013-10-08  Sascha Seyfert <sef@move-elevator.de>

	* 1.1.0 - refactoring

2012-11-21  Sascha Seyfert <sef@move-elevator.de>

	* 1.0.0 - stable release and code cleanup

2012-10-23  Sascha Seyfert <sef@move-elevator.de>

	* 0.1.0 first release
