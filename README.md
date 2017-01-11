#[Tailbone Website Software v1.02](https://tailbone.gardenwolf.com/ "Tailbone's Official Website")
##Table of Contents
1. [Latest Versions](#latest-versions)
	1. [v1.02 Intent Corgi](v102-intent-corgi)
	2. [v1.01 Tentative Corgi](#v101-tentative-corgi)
	3. [v1.0 Curious Corgi](#v10-curious-corgi)
2. [General Information](#general-information)
3. [Features](#features)
4. [Installation](#installation)

##Latest Versions
###v1.02 (Intent Corgi)
Added a sleep arg to [system/upgrader/run.php](system/upgrader/run.php) to avoid "Redirected too many times" issue.

Removed the board from [system/admin/sys/pages/loggedin.php](system/admin/sys/pages/loggedin.php) and replaced it with a simple version checker.  Echoes the Tailbone codename as well.

ALL INDEX FILES (except the one in root) are pointing to one file for less redundancy

Added the Tailbone codename var to [index.php](index.php)

Added version vars at the end of file names to avoid caching probles between version changes in [system/main/run.php](system/main/run.php), [system/admin/run.php](system/admin/run.php), and [system/installer/sys/install.php](system/installer/sys/install.php)

Removed animations from (system/main/run.php)[system/main/run.php]

Removed system/main/theme/animations.css as it is no longer needed.

Updated [contributors](contributors.md), also changed file format from txt to md.

###v1.01 (Tentative Corgi)  
Updated [system/installer/sys/submit.php](system/installer/sys/submit.php) file so that the "construction" variable is defined after Tailbone installation.

###v1.0 (Curious Corgi) 
The intial release of Tailbone.

##General Information
Tailbone is a software for Web servers to use, this is designed for \*NIX Servers,	 Windows Server DOESN'T WORK with Tailbone at all!
  
Any questions regarding this software should be directed at [Toshi Bennett](mailto:toshi@gardenwolf.com?Subject=Tailbone "Send an email to Toshi") or [Cody Brian](mailto:cody@gardenwolf.com?Subject=Tailbone "Send an email to Cody")


## Features
1. File Uploader
  1. Subdirectroy support
  2. Only supports image files in source
  3. Ability to upload to subdirectories
  4. Image viewer for uploaded files
  5. Link popup for file sharing
  6. Space left bar
2. Page creation, editing, and deletion through the graphical frontend
3. Settings editior through graphical frontend
4. Multiple users
  1. Password Reset
  2. User Deletion

##Installation
1. Download the .zip file
2. Extract into target directory
3. Make sure the permissions of the data directory are set corrently.
4. Open the domain in a web browser and follow the on-page instructions