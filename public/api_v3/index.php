<?php

$site_url =  $_SERVER['REQUEST_SCHEME']. "://" . $_SERVER['HTTP_HOST'];
$publicDir = realpath(__DIR__ . "/..");

if ($_REQUEST['service'] == 'media' && $_REQUEST['action'] == 'add') {
	$mediaType = $_REQUEST['entry:mediaType'];
	$mediaName = $_REQUEST['entry:name'];
	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="utf-8"?><xml><result><objectType>KalturaMediaEntry</objectType><mediaType>'.$mediaType.'</mediaType><sourceType>6</sourceType><dataUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/flvclipper/entry_id/0_sj06pgun/version/0</dataUrl><plays>0</plays><views>0</views><duration>0</duration><msDuration>0</msDuration><id>'.$mediaName.'</id><name>'.$mediaName.'</name><partnerId>1533221</partnerId><userId>media@weber.edu</userId><creatorId>media@weber.edu</creatorId><status>7</status><moderationStatus>6</moderationStatus><moderationCount>0</moderationCount><type>1</type><createdAt>'.time().'</createdAt><updatedAt>'.time().'</updatedAt><rank>0</rank><totalRank>0</totalRank><votes>0</votes><downloadUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/raw/entry_id/0_sj06pgun/version/0</downloadUrl><searchText>_PAR_ONLY_ 1533221 _MEDIA_TYPE_1| test8 </searchText><licenseType>-1</licenseType><version>0</version><thumbnailUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/thumbnail/entry_id/0_sj06pgun/version/0</thumbnailUrl><accessControlId>1458341</accessControlId><replacementStatus>0</replacementStatus><partnerSortValue>0</partnerSortValue><rootEntryId>'.$mediaName.'</rootEntryId><operationAttributes></operationAttributes><entitledUsersEdit></entitledUsersEdit><entitledUsersPublish></entitledUsersPublish></result><executionTime>0.12082099914551</executionTime></xml>';
}

if ($_REQUEST['service'] == 'media' && $_REQUEST['action'] == 'addContent') {
	header('Content-type: text/xml');
	$token = $_REQUEST['resource:token'];
	$entryId = $_REQUEST['entryId'];
	$data = json_encode(array("status" => "success"));

    sleep(5);

	$c = curl_init("$site_url/kaltura/$token/$entryId");
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($c, CURLOPT_POSTFIELDS, $data);
	curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-type:application/json', 'Content-Length: '.strlen($data)));
	curl_exec($c);
	curl_close($c);

	echo '<?xml version="1.0" encoding="utf-8"?><xml><result><objectType>KalturaMediaEntry</objectType><mediaType>1</mediaType><conversionQuality>4762681</conversionQuality><sourceType>1</sourceType><dataUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/flvclipper/entry_id/'.$token.'/version/0</dataUrl><plays>0</plays><views>0</views><duration>0</duration><msDuration>0</msDuration><id>'.$token.'</id><name>Default Title</name><partnerId>1533221</partnerId><userId>media@weber.edu</userId><creatorId>media@weber.edu</creatorId><status>1</status><moderationStatus>6</moderationStatus><moderationCount>0</moderationCount><type>1</type><createdAt>'.time().'</createdAt><updatedAt>'.time().'</updatedAt><rank>0</rank><totalRank>0</totalRank><votes>0</votes><downloadUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/raw/entry_id/'.$token.'/version/0</downloadUrl><searchText>_PAR_ONLY_ _1533221_ _MEDIA_TYPE_1|  Default Title </searchText><licenseType>-1</licenseType><version>0</version><thumbnailUrl>http://cdnbakmi.kaltura.com/p/1533221/sp/153322100/thumbnail/entry_id/'.$token.'/version/0</thumbnailUrl><accessControlId>1458341</accessControlId><replacementStatus>0</replacementStatus><partnerSortValue>0</partnerSortValue><conversionProfileId>4762681</conversionProfileId><rootEntryId>'.$token.'</rootEntryId><operationAttributes></operationAttributes><entitledUsersEdit></entitledUsersEdit><entitledUsersPublish></entitledUsersPublish></result><executionTime>0.34513711929321</executionTime></xml>';

	file_put_contents("$publicDir/kaltura/log.txt", "$site_url/kaltura/$token/$entryId" . PHP_EOL , FILE_APPEND | LOCK_EX);
}

if ($_REQUEST['service'] == 'uploadtoken' && $_REQUEST['action'] == 'upload') {
	$token = $_REQUEST['uploadTokenId'];

	$data = file_get_contents($_FILES['fileData']['tmp_name']);
	file_put_contents("$publicDir/kaltura/".$token.".mp4", $data, FILE_APPEND);

	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="utf-8"?><xml><result><objectType>KalturaUploadToken</objectType><id>'.$token.'</id><partnerId>1533221</partnerId><userId>media@weber.edu</userId><status>1</status><fileName>kaltura.encode.mp4</fileName><fileSize>281632</fileSize><uploadedFileSize>100000</uploadedFileSize><createdAt>'.time().'</createdAt><updatedAt>'.time().'</updatedAt></result><executionTime>0.063082933425903</executionTime></xml>';
}


if ($_REQUEST['service'] == 'uploadtoken' && $_REQUEST['action'] == 'add') {
	$objType = isset($_REQUEST['objectType']) ? $_REQUEST['objectType']:"";
	$fileName = isset($_REQUEST['fileName']) ? $_REQUEST['fileName'] : "";
	$fileSize = isset($_REQUEST['fileSize']) ? $_REQUEST['fileSize'] : "";
	$partnerId = $_REQUEST['partnerId'];
	header('Content-type: text/xml');
	$id = uniqid();
	echo '<?xml version="1.0" encoding="utf-8"?><xml><result><objectType>'. $objType.'</objectType><id>'.$id.'</id><partnerId>'.$partnerId.'</partnerId><userId>media@weber.edu</userId><status>0</status><fileName>'.$fileName.'</fileName><fileSize>'.$fileSize.'</fileSize><createdAt>'.time().'</createdAt><updatedAt>'.time().'</updatedAt></result><executionTime>0.086648941040039</executionTime></xml>';
}
?>
