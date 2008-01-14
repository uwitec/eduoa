/**
 * Basic Initialization Script for SWFUpload
 * This file sets up most of the properties for a common
 * installation of SWFUpload.  While you don't have to, 
 * it can be used with the css files and callbacks file
 * that accompanied it in the package you downloaded. 
 *
 * This script is not copyrighted, but please leave
 * my name and link in the header 
 * so others can learn how to achieve this look and feel
 * for SWFUpload from my website. Thanks.
 * 
 * CakePHP Users: to integrate with cakephp, 
 * see http://bakery.cakephp.org/articles/view/296
 * 
 * @author James Revillini http://james.revillini.com
 * @version 1.0
 */

var swfu;

window.onload = function () {
	swfu = new SWFUpload({
		upload_script 					: 'upload.php',	//change this if you need to
		target 							: 'SWFUploadTarget',
		flash_path 						: '/js/swfupload/SWFUpload.swf', 	//change this if you need to
		allowed_filesize 				: 30720,	// 30 MB
		allowed_filetypes 				: '*.*',
		allowed_filetypes_description 	: 'All files',
		browse_link_innerhtml 			: 'Browse',
		upload_link_innerhtml 			: 'Upload queue',
		browse_link_class 				: 'swfuploadbtn browsebtn',
		upload_link_class 				: 'swfuploadbtn uploadbtn',
		flash_loaded_callback 			: 'swfu.flashLoaded',	//if you change the name of the instance (swfu), change this line too!
		upload_file_queued_callback 	: 'fileQueued',
		upload_file_start_callback 		: 'uploadFileStart',
		upload_progress_callback 		: 'uploadProgress',
		upload_file_complete_callback 	: 'uploadFileComplete',
		upload_file_cancel_callback 	: 'uploadFileCancelled',
		upload_queue_complete_callback 	: 'uploadQueueComplete',
		upload_error_callback 			: 'uploadError',
		upload_cancel_callback 			: 'uploadCancel',
		auto_upload 					: false		
	});
	//swfu.loadUI();	//i haven't needed this, but if it's not initing, then try uncommenting this line
}