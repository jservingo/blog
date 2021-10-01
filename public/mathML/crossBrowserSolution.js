var fMathSolutionProcess = function () {
	alert('fMathSolutionProcess');
	
	FMATH.ApplicationConfiguration.setFolderUrlForFonts('mathml-formula/fonts');
	FMATH.ApplicationConfiguration.setFolderUrlForGlyphs('mathml-formula/glyphs');
	FMATH.ApplicationConfiguration.setFolderUrlForCursor('mathml-formula/cursor');
	FMATH.ApplicationConfiguration.setMouseDisabled("");
	FMATH.ApplicationConfiguration.setColorOver("#BFECFF");
	
	var fMathModal = document.createElement('div');
	fMathModal.classList.add("FMathModal");
	document.body.appendChild(fMathModal);

	alert('createElement');
	
	var fMathModalDiv = document.createElement('div');
	fMathModalDiv.classList.add("FMathModal-content");
	fMathModal.appendChild(fMathModalDiv);
	
	var fMathModalTitle = document.createElement('span');
	fMathModalTitle.textContent="MathML";
	fMathModalDiv.appendChild(fMathModalTitle);
	
	var fMathModalClose = document.createElement('span');
	while( fMathModalClose.firstChild ) {
		fMathModalClose.removeChild( fMathModalClose.firstChild );
	}

	fMathModalClose.appendChild( document.createTextNode("X") );
	fMathModalClose.classList.add("FMathModalclose-btn");
	fMathModalDiv.appendChild(fMathModalClose);
	
	var fMathModalContent = document.createElement('textarea');
	fMathModalContent.style.cssText = "width:100%;height:400px;resize:none;";
	fMathModalDiv.appendChild(fMathModalContent);

	fMathModalClose.onclick = function(){
	  fMathModal.style.display = "none"
	}
	window.onclick = function(e){
	  if(e.target == fMathModal){
		fMathModal.style.display = "none"
	  }
	}

	var allMathMLLive = document.getElementsByTagName("math");
	var allMathML = Array.prototype.slice.call(allMathMLLive);

	alert('getElementsByTagName');

	var mathmlList = new Array(allMathML.length);
	var canvasList = new Array(allMathML.length);
	var divTooltipList = new Array(allMathML.length);
	var canvasTooltipList = new Array(allMathML.length);
	var canvasIdList = new Array(allMathML.length);
	var canvasScaleList = new Array(allMathML.length);
	var formulasList = new Array(allMathML.length);

	String.prototype.replaceAll = function(search, replacement) {
		var target = this;
		return target.replace(new RegExp(search, 'g'), replacement);
	};

	var onClick = function(e) {
		var elementId = e.target.getAttribute("id");

		var goToFmath = function() { window.open('https://math-on-web.com/FMath-Chrome-Extension/index.html','_blank'); }

		var getMathML = function() {
			var index = getIndexForElementId(elementId);
			var _mathml = formulasList[index].getMathMLString("ENTITIES", true);
			fMathModal.style.display = "block";
			fMathModalTitle.textContent="MathML";
			fMathModalContent.value = _mathml;
		}
		var getLatex = function() {
			var index = getIndexForElementId(elementId);
			var _mathml = formulasList[index].getMathMLString("ENTITIES", true);
			var latex = formulasList[index].convertMathMLToLatex(_mathml)
			fMathModal.style.display = "block";
			fMathModalTitle.textContent="LaTeX";
			fMathModalContent.value = latex;
		}

		var zoomIn = function() {
			var index = getIndexForElementId(elementId);
			canvasScaleList[index] = canvasScaleList[index] * 1.25;
			formulasList[index].scaleFormula(canvasScaleList[index]);
		}
		var zoomIn100 = function() {
			var index = getIndexForElementId(elementId);
			canvasScaleList[index] = canvasScaleList[index] * 2;
			formulasList[index].scaleFormula(canvasScaleList[index]);
		}
		var zoomOut = function() {
			var index = getIndexForElementId(elementId);
			canvasScaleList[index] = canvasScaleList[index] / 1.25;
			formulasList[index].scaleFormula(canvasScaleList[index]);
		}
		var zoomOut100 = function() {
			var index = getIndexForElementId(elementId);
			canvasScaleList[index] = canvasScaleList[index] / 2;
			formulasList[index].scaleFormula(canvasScaleList[index]);
		}
		var zoom100 = function() {
			var index = getIndexForElementId(elementId);
			canvasScaleList[index] = 1;
			formulasList[index].scaleFormula(canvasScaleList[index]);
		}

		var items = [
			{ title: 'Get MathML', icon: 'ion-compose', fn: getMathML },
			{ },
			{ title: 'Zoom In 2x', icon: 'ion-plus-round', fn: zoomIn100 },
			{ title: 'Zoom In 25%', icon: 'ion-plus-round', fn: zoomIn },
			{ title: 'Zoom 100%', icon: 'ion-help-buoy', fn: zoom100 },
			{ title: 'Zoom Out 25%', icon: 'ion-android-remove', fn: zoomOut },
			{ title: 'Zoom Out 2x', icon: 'ion-android-remove', fn: zoomOut100 },
			{ },
			{ title: 'Help', icon: 'ion-clipboard', fn: goToFmath }
		]

		var onClose = function(e) {
			basicContext.close()
		}
		basicContext.show(items, e, onClose)
	}
	
	document.addEventListener('keydown', onKeyDown);
	document.addEventListener('keyup', onKeyUp);

	drawAllFormula();

	function getIndexForElementId(id){
		for(var i=0; i<canvasIdList.length; i++){
			if(canvasIdList[i] == id){
				return i;
			}
		}
		return 0;
	}


	function drawAllFormula(){
		var c = document.createElement('canvas');
		if(c.getContext == null){
			console.log("XHTML page !!! This page doesn't accept to create canvas element");
		}else{
			for(var i=0; i<allMathML.length; i++){
				var e = allMathML[i];
				var styleElem = window.getComputedStyle(e, null);
				var fontSize = parseInt(getIntegerFromPx(styleElem.getPropertyValue("font-size")));
				var fontBold = styleElem.getPropertyValue("font-weight");
				var fontItalic = styleElem.getPropertyValue("font-style");
				var fontColor = styleElem.getPropertyValue("color");
				fontColor = rgb2hex(fontColor);

				mathmlList[i] = e.outerHTML;			
				
				var canvas = document.createElement('canvas');
				canvas.id     = "FMATH_Formula" + i;
				canvas.width  = 1;
				canvas.height = 1;
				canvas.dir = "ltr";
				
				canvasList[i] = canvas;
				canvasIdList[i] = "FMATH_Formula" + i;
				canvasScaleList[i] = 1;

				var parentNode = e.parentNode;
				parentNode.insertBefore(canvas, e);
				parentNode.removeChild(e);
				
				
				var div = document.createElement('div');
				div.id = "FMATH_Formula_div" + i;
				div.style.position = "absolute";
				div.style.zIndex  = "999";
				
				parentNode.insertBefore(div, canvas);
				
				
				var canvasTip = document.createElement('canvas');
				canvasTip.id     = "FMATH_Formula_tip" + i;
				canvasTip.width  = 1;
				canvasTip.height = 1;
				canvasTip.dir = "ltr";
			
				div.appendChild(canvasTip);
				canvasTooltipList[i] = canvasTip;
				divTooltipList[i] = div;
				

				var formula = new FMATH.MathMLFormula();
				formula.setDisableMouse(false);
				
				formulasList[i] = formula;
				formulasList[i].setFontSize(fontSize*1.4);
				formulasList[i].setFontBold(fontBold=='bold');
				formulasList[i].setFontItalic(fontItalic=='italic');
				formulasList[i].setColor(fontColor);
				formulasList[i].drawImage(canvas, canvasTip, mathmlList[i]);
				
				if(formula.isBlock()){
					var divBlock = document.createElement('div');
					
					parentNode.insertBefore( divBlock, canvas);
					parentNode.removeChild(canvas);
					
					divBlock.appendChild(canvas);
				}else{
					canvas.style.cssText="inline-block; vertical-align:middle;";
				}

				canvas.addEventListener('click', onLeftClick);
				canvas.addEventListener('mousemove', onMouseOverFormula );
				canvas.addEventListener('mouseout', onMouseOutFormula);
				canvas.addEventListener('contextmenu', onClick);
				
				canvas.addEventListener('mousedown', onMouseDown);
				canvas.addEventListener('mouseup', onMouseUp);

			}
		}
		
	}

	function onKeyDown(evt){
		for(var i=0; i<formulasList.length; i++){
			formulasList[i].onKeyDown(evt);
		}
	}
	function onKeyUp(evt){
		for(var i=0; i<formulasList.length; i++){
			formulasList[i].onKeyUp(evt);
		}
	}

	function onMouseDown(evt){
		var elementId = evt.target.getAttribute("id");
		var index = getIndexForElementId(elementId);
		formulasList[index].onMouseDown(evt);
	}

	function onMouseUp(evt){
		var elementId = evt.target.getAttribute("id");
		var index = getIndexForElementId(elementId);
		formulasList[index].onMouseUp(evt);
	}


	function onLeftClick(evt){
		var elementId = evt.target.getAttribute("id");
		var index = getIndexForElementId(elementId);
		formulasList[index].clickLeftOn(evt);
	}


	function onMouseOverFormula(e){
		
		var elementId = e.target.getAttribute("id");
		var index = getIndexForElementId(elementId);
		var ret = formulasList[index].onMouseMove(e);
		
		if(ret){
			divTooltipList[index].style.display = "";
			divTooltipList[index].style.left = (e.pageX + 5) + "px";
			divTooltipList[index].style.top = (e.pageY + 5) + "px";
		}else{
			divTooltipList[index].style.display = "none";
		}
	}

	function onMouseOutFormula(e){

		var elementId = e.target.getAttribute("id");
		var index = getIndexForElementId(elementId);
		formulasList[index].onMouseMove();
		
		divTooltipList[index].style.display = "none";
	}

	function getIntegerFromPx(val){
		if(val.indexOf(".")>-1){
			return val.substring(0, val.indexOf("."));
		}
		return val.substring(0, val.length-2);
	}
	
	function rgb2hex(rgb_color) {
		if (rgb_color.substr(0, 1) === '#') {
			return rgb_color;
		}
		var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(rgb_color);
		var red = parseInt(digits[2]);
		var green = parseInt(digits[3]);
		var blue = parseInt(digits[4]);

		var hex = (red << 16) | (green << 8) | blue;
		return '#' + hex.toString(16);
	}

	function lightenDarkenColor(col, amt) {
	  
		var num = parseInt(col,16);
	 
		var r = (num >> 16) + amt;
	 
		if (r > 255) r = 255;
		else if  (r < 0) r = 0;
	 
		var b = ((num >> 8) & 0x00FF) + amt;
	 
		if (b > 255) b = 255;
		else if  (b < 0) b = 0;
	 
		var g = (num & 0x0000FF) + amt;
	 
		if (g > 255) g = 255;
		else if (g < 0) g = 0;
	 
		return (g | (b << 8) | (r << 16)).toString(16); 
	}
};

document.addEventListener("DOMContentLoaded", fMathSolutionProcess);


