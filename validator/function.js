
function setCheckBox(theForm,theStatus)
{
	var sus=eval("window.document."+theForm+".elements.length");
	for(j=0;j<sus;j++)
	{
		str="window.document."+theForm+".elements["+j+"].type";
		if(eval(str)=="checkbox")
		{
			ltr="window.document."+theForm+".elements["+j+"].checked="+theStatus;
			eval(ltr);
		}
	}
}
function delete_something(theURL,theValue,theMsg)
{
	var str="Are you sure to delete this "+theMsg+" : "+theValue+" ?    ";
	choice=confirm(str);
	if(choice)
	{
		window.location.href=theURL;
	}
	else
	{
		return false;
	}
}
function setFocus(theForm,theElement)
{
	eval("window.document."+theForm+"."+theElement+".focus()");
}
function popupOpen(theURL,windowName)
{
	window.open(theURL,windowName,'height=450,width=650,toolbar=0,status=1,scrollbars=1,menubar=0,left=0,top=0');
}
function setCombo(theForm,theElement,theMess)
{
	var str=eval("window.document."+theForm+"."+theElement+".selectedIndex");
	if(str==0)
	{
		alert("Please select a value for "+theMess+"    ");
		eval("window.document."+theForm+"."+theElement+".focus()");
		return false
	}
}
function NewWindow(theURL,windowName,theStatus)
{
	window.open(theURL,windowName,theStatus);
}
function LoadPopup(getFileName,getWindowName,getHeight,getWidth) {
	var _file = getFileName;
	var _window = getWindowName;
	var _toolbar = 0;
	var _menubar = 0;
	var _status = 1;
	var _resizable = 1;
	var _width = getWidth;
	var _height = getHeight;
	var _top = (screen.height - _height) / 2;
	var _left = (screen.width - _width) / 2;
	var _scrollbars = 1;
	
	var _condition = "toolbar=" + _toolbar + ",menubar=" + _menubar + ",status=" + _status + ",resizable=" + _resizable;
	_condition+=",width=" + _width + ",height=" + _height + ",left=" + _left + ",top=" + _top + ",scrollbars=" + _scrollbars + "";
	
	window.open(_file,_window,_condition);
}
