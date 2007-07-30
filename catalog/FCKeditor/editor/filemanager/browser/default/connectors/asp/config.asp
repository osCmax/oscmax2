﻿<!--
 * FCKeditor - The text editor for internet
 * Copyright 2006 osCMax2003-2005 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * File Name: config.asp
 * 	Configuration file for the File Manager Connector for ASP.
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
-->
<%

Dim ConfigUserFilesPath

' Path to user files relative to the document root.
' SECURITY TIP: Uncomment the following line to set a fixed path.
' ConfigUserFilesPath = "/UserFiles/"

Dim ConfigAllowedExtensions, ConfigDeniedExtensions
Set ConfigAllowedExtensions	= CreateObject( "Scripting.Dictionary" )
Set ConfigDeniedExtensions	= CreateObject( "Scripting.Dictionary" )

ConfigAllowedExtensions.Add	"File", ""
ConfigDeniedExtensions.Add	"File", "php|asp|aspx|ascx|jsp|cfm|cfc|pl|bat|exe|com|dll|vbs|js|reg"

ConfigAllowedExtensions.Add	"Image", "jpg|gif|jpeg|png|bmp"
ConfigDeniedExtensions.Add	"Image", ""

ConfigAllowedExtensions.Add	"Flash", "swf|fla"
ConfigDeniedExtensions.Add	"Flash", ""

ConfigAllowedExtensions.Add	"Media", "swf|fla|jpg|gif|jpeg|png|avi|mpg|mpeg|mp(1-4)|wma|wmv|wav|mid|midi|rmi|rm|ram|rmvb|mov|qt"
ConfigDeniedExtensions.Add	"Media", ""

%>