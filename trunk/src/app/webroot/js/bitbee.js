function efficacyAccept(obj){
	var aAccetpType, sFileType;
	var sAccetpType = obj.accept.toLowerCase();
	if(sAccetpType.length > 0){
		aAccetpType = sAccetpType.split(",");
	}

	if(obj.value != "" && aAccetpType.length > 0){
		sFileType = obj.value.replace(/.*\./g,"").toLowerCase();
		
		var isAccept = aAccetpType.indexOf(sFileType);

		if(isAccept == -1) {
			alert("『×』不支持的文件类型");
			obj.outerHTML = obj.outerHTML;
		}
	}	
}