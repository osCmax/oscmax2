============================================
File Manager for HTMLarea (PHP version) v0.1
============================================

Introduction
============
This File Manager is a simple extension/adaptation of the Image Manager for
HTMLarea. As such, it should not be regarded more than a mod to this useful
add-on.

Functionality
=============
Called from an HTMLarea, File Manager lets you browse for any file in a dir-
ectory specified by you. The file will be selected and then a link to this 
file will be inserted in the original textarea.
Additionally, one can upload new files and manage the files and directories.

Compatability
=============
This script has been tested with HTMLarea 2.03 only and I cannot give any
guarantees as such. However, with some small adjustments, it should work for
HTMLarea 3.0a too.

Installation
============
Extract the files in the zip-file to the htmlarea/popups directory, using
folder names.

To run the script, add a button to the toolbar with id "linktofile". Then
add the following code:

<code>
else if (cmdID.toLowerCase() == 'linktofile') {
  var fileLink = showModalDialog(_editor_url + "popups/file/insert_file.php", 
				editdoc,
				"resizable: no; help: no; status: no; scroll: no; ");
  if (fileLink) { editor_insertHTML(objname, unescape( fileLink) ); }
</code>

Note that this code differs from the way Image Manager is called. Also, the
code may differ for HTMLarea 3.0a.

Known issues
============
Noticed that links are translated to absolute links when the location of the
file is given to the editor. This might be a (mis)configuration of HTMLarea,
I do not know. The script -in principle- returns only the relative location
of the file.

Customizations
==============
You might want to change what will be passed on to the editor, as well as the
format of the output. One can easily change this in the insert_file.php file.

"Support" for file types not in the list right now is easy to add: just make
an icon with dimensions 48x48 and name it <extension>.gif. The script looks
for an image that has the name of the extension of the file. If it does not
find one, def.gif will be used.

About the adaptor
=================
Tim van Pelt <taurentius@hotmail.com>
Needs some sleep right now....