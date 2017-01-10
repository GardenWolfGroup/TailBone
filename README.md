#[Tailbone Website Software v1.02](https://tailbone.gardenwolf.com/ "Tailbone's Official Website")
##Table of Contents
1. [Latest Versions](#latest-versions)
  1. [v1.02](v102)
  2. [v1.01](v101)
2. [General Information](#general-information)
3. [Features](#features)
4. [Installation](#installation)

##Latest Versions
###v1.02
1. Added a sleep arg in [system/upgrader/run.php](https://github.com/GardenWolfGroup/Tailbone/blob/master/system/upgrader/run.php) to prevent "Redirected too many times" issue.
2. Removed the board from [sytem/admin/sys/pages/loggedin.php](https://github.com/GardenWolfGroup/Tailbone/blob/master/system/admin/sys/pages/loggedin.php) and replaced it with simple version checker
      
###v1.01
Updated [system/installer/sys/submit.php](https://github.com/GardenWolfGroup/Tailbone/blob/master/system/installer/sys/submit.php) file so that the "construction" variable is defined after Tailbone installation.

##General Information
Tailbone is a software for Web servers to use, this is designed for \*NIX Servers, Windows Server DOESN'T WORK with Tailbone at all!
  
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

##Upgrading
1. Back up your install.
2. Extract all contents of the TailBone zip except for the data folder to your install location.
3. navigate to the website and TailBone will handle the rest.
