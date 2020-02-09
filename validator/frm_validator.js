

//***********Char validation starts*****************//
	function ChkChar(str)
		{
		var check=0;
		var len = str.length
	 	for (var i=0;i<len;++i)
		{
		  if(str.charCodeAt(i)<65 || str.charCodeAt(i)>122)
	 	  {
			check=1;
			if (i>0)
			{
				if (str.charCodeAt(i)==32)
				{
					check=0;
				}
			}
		  }
		  else
		  {
			check=0;
		  }
		  if (check==1)
		  {
			return true;
		  }
		}
		return false;
	}
//***********Char validation end*****************//
//***********Phone validation end*****************//
 function ChkPhone(frmName,fldName,display){
	var FormName;
	var FldName;
	var Display;
	FormName=frmName;
	FldName=fldName;
	Display=display;
	var no;
	no=eval("document."+FormName+"."+FldName+".value");
	var find=/[a-zA-Z\*\=\_\>\<\:\@\&\%\?\$]/;
	if (no.search(find)!= -1 || no == "")
		{
			alert("That is not a valid " + Display+ ". Please enter again.");
			eval("document."+FormName+"."+FldName+".focus()");
			eval("document."+FormName+"."+FldName+".select()");
			return false;
		}
	}
//****Phone validation end****************
//***********Special Char validation starts*****************//
 function ChkSpecial(str)
		{
			var test=/[%\?\>\<\*\.\:\;\@\~\!\@\#\$\%\^\&\*\(\)\_\+\-\=\|\{\}\[\]\`]/;

			if (str.search(test)!= -1)
			{
				return false;
			}
		}
//***********Special Char validation end*****************//

//*************** Main Form Validation Starts Here******************************// 
	function frmValidate(frmName,fldName,display,IsBlank,CharNumAdv){
		var FormName;
		var FldName;
		var Display;
		var Blank;
		var Special;		
		FormName=frmName;
		FldName=fldName;
		Display=display;
		Blank=IsBlank;
		Special=CharNumAdv;		
		var val;
		val=eval("window.document."+FormName+"."+FldName+".value");
		
		if (Blank=='YES'){
			if (val==""){
				alert(""+ Display +" can not be blank.    ");				
				eval("document."+FormName+"."+FldName+".focus()");
				return false;
			}
			var check;
			var check2;
			var len = val.length
	 		for (var i=0;i<len-1;++i)
			{
			  if(val.charCodeAt(i)!=13 && val.charCodeAt(i+1)!=10)
			  {
  			   if(val.charCodeAt(i)!=10 && val.charCodeAt(i-1)!=13)
			   {
  			    if(val.charCodeAt(i)!=32)
			    {
  			      check=1;
			    }
			   }
              }   		       
			}
					

 			 if(val.charCodeAt(len-1)!=32 && val.charCodeAt(len-1)!=10)
			   {
  			      check=1;
			   }


			if (check != 1){
				alert(""+ Display +" can not be blank.");				
				eval("document."+FormName+"."+FldName+".focus()");
				eval("document."+FormName+"."+FldName+".select()");
				return false;
			}


			
		}
		
		if (Special=='Adv'){
			if (ChkSpecial(val)==false){
				alert(""+ Display +" should be filled up properly.");
				eval("document."+FormName+"."+FldName+".focus()");
				eval("document."+FormName+"."+FldName+".select()");
				return false;
			}
		}
		
		if (Special=='Char'){
			if (ChkChar(val)){
				alert(""+ Display +" can contain characters only.");
				eval("document."+FormName+"."+FldName+".focus()");
				eval("document."+FormName+"."+FldName+".select()");
				return false;
			}
		}
		
		if (Special=='Num'){
			if (isNaN(val)==true){
				alert(""+ Display +" can contains numeric only.");
				eval("document."+FormName+"."+FldName+".focus()");
				eval("document."+FormName+"."+FldName+".select()");
				return false;
			}
		}
		if (Special==' '){
			if (val==""){
				alert(""+ Display +" can not be blank.");
				eval("document."+FormName+"."+FldName+".focus()");
				eval("document."+FormName+"."+FldName+".select()");
				return false;
			}
			}

	}
//*************** Main Form Validation Starts Here******************************//
//*************Date Validation Starts Here ***********************************//
//*************Date Validation Ends Here ***********************************//

//*****************Email validation starts *********************************//
function ChkEmail(frmName,strEmail)
    {
		var re;
		var FormName;
		var FldName;
		FormName=frmName;
		FldName=strEmail;
        re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
		var str=eval("document."+FormName+"."+FldName+".value");
        if (re.test(str) == false)
		{			
			alert("That is not a valid Email address. Please enter again.    ");
			eval("document."+FormName+"."+FldName+".focus()");
			eval("document."+FormName+"."+FldName+".select()");
			return false;
		}
	}
 //*****************Email validation ends *********************************//

//*****************Select validation starts *********************************//
function ChkSelect(frmName,fldName,display){
		var FormName;
		var FldName;
		var Display;
		FormName=frmName;
		FldName=fldName;
		Display=display;
	var val;
	val=eval("document."+FormName+"."+FldName+".options[document."+FormName+"."+FldName+".selectedIndex].value");
		if (val==-1){
		alert("Please, select the "+ Display +"");
		eval("document."+FormName+"."+FldName+".focus()");
		return false;
		}
}
//*****************Email validation ends *********************************//
//*****************String Compare validation starts *********************************//
function StrMatch(frmName,strFast,strLast,displayFast,displayLast)
    {
		var FormName;
		var FldName1;
		var FldName2;
		var Display1;
		var Display2;

		FormName=frmName;
		FldName1=strFast;
		FldName2=strLast;
		Display1=displayFast;
		Display2=displayLast;
		
		var str1=eval("document."+FormName+"."+FldName1+".value");
		var str2=eval("document."+FormName+"."+FldName2+".value");

		if (str1 !=str2)
		{			
			alert(Display1 + " and " + Display2 +" does not match. Please enter again.");
			eval("document."+FormName+"."+FldName2+".focus()");
			eval("document."+FormName+"."+FldName2+".select()");
			return false;
		}
	}
//*****************String Compare validation ends *********************************//

//******************** Trim Function starts here**********************************//
function trim(st)
{
     var result;
       for(i=0;i<st.length;i++)
         {
           if(st.charAt(i)==" ")
           {
             result=st.substring(i+1,st.length);
           }
           else
           {
             break;
           }
         }
         
         if(i==0)
         {
          return st;
         }
         else
         {
          return result;
         }
}
//******************** Trim Function ends here**********************************//