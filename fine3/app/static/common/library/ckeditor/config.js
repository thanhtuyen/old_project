/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'others' }
	];
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    	CKEDITOR.config.contentsCss = window.location.origin+'/static/common/library/ckeditor/contents.css';
	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.allowedContent = true;
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';
	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';

};
