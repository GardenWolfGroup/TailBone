#[TailBone Website Software v2.0](https://tailbone.gardenwolf.com/ "Tailbone's Official Website")
##Table of Contents
1. [Version History](#version-history)
	1. [v2.1 Excitable Penguin](#v21-excitable-penguin) 
	2. [v2.0 Punctual Penguin](#v20-punctual-penguin) 
	3. [v1.02 Intent Corgi](#v102-intent-corgi)
	4. [v1.01 Tentative Corgi](#v101-tentative-corgi)
	5. [v1.0 Curious Corgi](#v10-curious-corgi)
2. [General Information](#general-information)
3. [Features](#features)
4. [Installation](#installation)

##Version History

###v2.1 (Excitable Penguin)
We updated things.

###v2.0 (Punctual Penguin)
<details>
<summary>ChangeLog</summary>  
<details>
<summary>[system/admin/run.php](system/admin/run.php)</summary>
-Updated to use the new theme file.  
-Added MSGBanner.js script.  
-Added the version tags to prevent "bad cache".  
-Removed the strange page reg thing I did...  
-Fixed a session timeout issue.  
-New MSGBanner script.  
</details>

<details>
<summary>[system/admin/sys/editTheme.php](system/admin/sys/editTheme.php) </summary>
- Updated to use the new theme file.
</details>

<details>
<summary>[system/admin/sys/pages/theme.php](system/admin/sys/pages/theme.php)</summary>
- Updated to use the new theme file.
</details>

<details>
<summary>[system/main/theme/theme.php](system/main/theme/theme.php)</summary>
--REPLACES themeColours.scss.php thing...
</details>

<details>
<summary>[system/main/theme/animations.css](system/main/theme/animations.css)</summary>
--ADDED
</details>

<details>
<summary>[data/theme.php](data/theme.php)</summary>
--REPLACES colours.php
</details>

<details>
<summary>[system/jScipts/loading.js](system/jScipts/loading.js)</summary>
- Removed MSGBanner parts.
</details>

<details>
<summary>[system/jScipts/MSGBanner.js](system/jScipts/MSGBanner.js)</summary>
--NEW: Contains the click to close and the timeout.
</details>

<details>
<summary>[system/main/run.php](system/main/run.php)</summary>
-Updated to use the new theme file.  
-Updated to report 404 as a header.  
-Updated to make edit button direct to settings when a 404 has occurred.  
-Added the MSGBanner.js script.  
-Added the version tags to prevent "bad cache".  
-Fixed a session timeout issue.  
-New MSGBanner script.  
-Re-added the animations.  
-No longer requiring file. Only echoing its contents. (More secure and prevents scripts from running.)  
</details>

<details>
<summary>[system/installer/sys/install.php](system/installer/sys/install.php)</summary>
-Updated to use the new theme file.  
-Added the version tags to prevent "bad cache".  
</details>

<details>
<summary>[system/jScripts/wysiwyg.php](system/jScripts/wysiwyg.php)</summary>
- Updated to use the new theme file.
</details>

<details>
<summary>[system/installer/sys/sumbit.php](system/installer/sys/sumbit.php)</summary>
- Fixed MSGBanner parameters.
</details>

<details>
<summary>[system/upgrader/run.php](system/upgrader/run.php)</summary>
- Updated to edit data folder colours.php to theme.php.
</details>

<details>
<summary>[system/admin/sys/pages/file_manager.php](system/admin/sys/pages/file_manager.php)</summary>
- Updated to the new theme stuffs.
</details>

<details>
<summary>[system/admin/sys/pages/pages.php](system/admin/sys/pages/pages.php)</summary>
- Re-arranged the buttons.
</details>

<details>
<summary>system/admin/sys/pages/pages_*.php</summary>
--REMOVED
</details>

<details>
<summary>[system/admin/sys/pages/pages.php](system/admin/sys/pages/pages.php) </summary>
- Updated to contain ALL pages data.
</details>

<details>
<summary>system/admin/sys/sys.pagereg.php</summary>
--REMOVED
</details>

<details>
<summary>[system/admin/sys/pages/users.php](system/admin/sys/pages/users.php)</summary>
- Updated to use new theme var.
</details>

<details>
<summary>[system/admin/sys/*](system/admin/sys/) (excluding pages folder)</summary>  
-Updated to work with the new loggedin check.  
-Updated to use new MSGBanner.  
</details>

<details>
<summary>[index.php](index.php)</summary>
-Added the new loggedin check.  
-Added getUsers() function.  
</details>

<details>
<summary>[system/admin/sys/pages/users.php](system/admin/sys/pages/users.php)</summary>
- Now uses the userList function.
</details>

<details>
<summary>[system/admin/sys/pages/loggedin.php](system/admin/sys/pages/loggedin.php)</summary>
-Added server admin email.
</details>

<details>
<summary>[system/main/theme/main.css](system/main/theme/main.css)</summary>
-Fixed stretched images issue.
</details>

<details>
<summary>[system/admin/sys/pages/file_manager.php](system/admin/sys/pages/file_manager.php)</summary>
- Viewer is no longer a pesky iframe. It is a proper image viewer this time.
</details>
</details>

###v1.02 (Intent Corgi)
<details>
<summary>Changelog</summary>
Added a sleep arg to [system/upgrader/run.php](system/upgrader/run.php) to avoid "Redirected too many times" issue.

Removed the board from [system/admin/sys/pages/loggedin.php](system/admin/sys/pages/loggedin.php) and replaced it with a simple version checker.  Echoes the Tailbone codename as well.

ALL INDEX FILES (except the one in root) are pointing to one file for less redundancy

Added the Tailbone codename var to [index.php](index.php)

Added version vars at the end of file names to avoid caching problems between version changes in [system/main/run.php](system/main/run.php), [system/admin/run.php](system/admin/run.php), and [system/installer/sys/install.php](system/installer/sys/install.php)

Removed animations from [system/main/run.php](system/main/run.php)

Removed system/main/theme/animations.css as it is no longer needed.

Updated [contributors](contributors.md), also changed file format from txt to md.
</details>

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
