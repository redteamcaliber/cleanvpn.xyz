



















                      <script>
var topchecks = 0;
var sess_id	= "";
var skinDone = 0;
var compWin = false;
var attachWin = false;
var browserstr = "";
var unLoading = false;
var company = null;

function Loaded(result)
{
	if (result != "")
	{
		alert(result);
		return false;
	}
	try 
	{
		top.JavaCheckCnt++;	
		top.apploaded=true;
		window.setTimeout("top.window.topframe.Login()",500);
   }
	catch (e)
	{
		topchecks++;
		if (topchecks==200)
		{
			out="<h3>Java failed - <font color='#FF0000'>Please read below!</font></h3>";
			out+='This application requires Java to function properly.<br>You can read more about <u><a target="_blank" ';
			out+='href="https://support.countermail.com/kb/faq.php?id=50">Java troubleshooting here</a></u>.<br><br>';
			top.window.right.document.getElementById("logintext").innerHTML=out;
		}
		else window.setTimeout("top.window.topframe.Loaded()",250);
		return;
	}
}


function SetApplet()
{
	var out='<applet name="CounterMailEngine" class="appletclass" code="CounterMailEngine.class"  height="0" width="0" archive="https://countermail.com/CounterMailEngine174.txt" >';
	out +='<param name="permissions" value="all-permissions" />';
	out +='<param name="url"  value="3d6990d7fef65c062ad387ccab8056d0462d939aa534d461035bc3ac516de0c48237fd997baf52dc578b5fd1d9021effdd1882fc04b34cee7e304f880593e0e895dcf87dc31d2bae6785a83c4d7f9fb9f6f31197fc4305e4703ab562afe83c479dcf24fad0177b2270b85ffcf00abb08e2cc5084b5785d1b5df8fff391286e8532b2e73d46b9d0c4cffb9e1037627e61f556d975d954d6fd54a3537827a35eefe38020596e48c911bb297c736255602ac1c5352da76e059443c385c0c0a4d65ce5d702a3fedbd2f91e2e2503c6f27b4df7f711bc89ee7b8f57a25377438d31125da07b5bb425c09d8b97a6c19f37e4880214dce5f7f8c7e8e17e656fe0854a0d" />';
	out +='<param name="url2"  value="5096af195c29cbd7aacf09ec0447fc0ace6ae02f118fad57427eac7ab04870ce7e81c20aa26fc60e7f8953b633664bb42681eb3e8cde86e5921e81ca34b5e8cd1432a34214e103e201c79fd5d486c4dcb84f0bbcd1b495fc75e990b77135c5cabd72e80ff3c11e2e44f4ba89adbe77fd46cb1ee902071bbc93677d6275adf12f4822b1133e48527c3d17924d6a4c99d86c4b8f264749636c0a1230eb612e4579856a662e8cd60ebe699c568e34bce317a4f0da41e32d2a24884795293f2de84b65e0f40b843f187e225e4a4f67d1a06b6384d2148172db5103b411caf8b14b9d293c90eaf9c206e223ec271a035fea758755c3fcc2cc5373d58b23add552600b" />';
	out +='<param name="bgcolor" value="#000000" />';
	out +='<param name="inittype" value="1" />';
	out +='<param name="instance" value="1533648331140061" />';
	out +='<param name="mitmprot" value="0" />';
	out +='</applet>';
	document.getElementById('cmengin').innerHTML=out;
	return;
}

function RegFinished(result)
{
	window.setTimeout("alert('"+result+"')",200);
	url=top.window.right.location.search;
	window.setTimeout('top.DURL("/src/options.php'+url+'","right")',500);
}


function Login()
{
	try 
	{
		top.JavaCheckCnt++;	
   }
	catch (e)
	{
		window.setTimeout("top.window.topframe.Login()",250);
		return;
	}
	
	if (typeof top.window.right == "undefined" || top.window.right.document.getElementById("logintext")==null || top.apploaded==false)
	{
		if (top.JavaCheckCnt > 200)
		{
			top.JavaCheckCnt=0;
			out="<h3>Java failed - <font color='#FF0000'>Please read below!</font></h3>";
			out+='This application requires Java to function properly.<br>You can read more about <u><a target="_blank" ';
			out+='href="https://support.countermail.com/kb/faq.php?id=50">Java troubleshooting here</a></u>.<br><br>';
			top.window.right.document.getElementById("logintext").innerHTML=out;
		}
		else window.setTimeout("top.window.topframe.Login();",250);
	}
	else
	{
		top.loginopen=true;
		top.apploaded=true;
		unLoading=false;
		top.JavaCheckCnt=0;
		top.cmapp=top.window.topframe.document.applets[0];
		var reason=""+top.window.location.href;
				if  (reason.indexOf("?r=t")>0 || reason.indexOf("?r=s")>0)
		{
			top.CheckReason();
		}
		else
		{
			out  ='If you don\'t see the login window, you can click on this button:';
			out +='<br><br><div align="left"><input type="button" id="cmbutton2" onclick="javascript:top.window.topframe.Login();" value="Login" /></div>';
			top.window.right.document.getElementById("logintext").innerHTML=out;
			window.setTimeout("document.applets[0].LoginUser();",300)
		}
	}
}

function isActive()
{
	if (!top.apploaded) return false;
	if (top.cmapp!=null && typeof top.cmapp.Logout != "undefined") return true;
	return false;
}

function ExitPage()
{
	//if (unLoading) return;
	//unLoading=true;
	//if (isActive()) top.cmapp.Logout();
	//sess_id="";
	Signout();
}



function Signout()
{
	if (unLoading) return;
	unLoading=true;
	if (isActive()) top.cmapp.Logout();
	
	var comp=''+top.window.location.href;
	if (comp.indexOf('company=')>=0) comp=true;
	else comp=false;
	
	if (comp && top.window.document.getElementById('right')) top.window.location='signout.php?CMID='+sess_id+'&company=1';
	else if (!comp && top.window.document.getElementById('right')) top.window.right.location='signout.php?CMID='+sess_id;
	if (top.window.document.getElementById('left')) top.window.left.location='blank.php';
	document.getElementById('topholder').style.visibility="hidden";
	sess_id="";
}


function useDocumentClose()
{
	browserstr = navigator.appName;
	if (browserstr.indexOf("Netscape") !=-1 || browserstr.indexOf("Mozilla") !=-1) return "yes";
   return "no";
}

function PGP_PostFile(win,enc,prevAttachments)
{
		attachWin=win;
	top.cmapp.PGP_PostFile(enc,prevAttachments);
}


function Uploaded(inname)
{
		if (attachWin!=false)
	{
		attachWin.Uploaded(inname);
		attachWin = false;
	}
	else alert("Compose window is no more!");
}

function Expired(session_id)
{
	window.onunload=null;
	window.setTimeout("alert('This account has expired, you need to buy a premium subscription.');",100);
	window.setTimeout("top.document.location='https://countermail.com/?p=upgrade&cart=np&CMID="+session_id+"'",300);
}

function GetFileResult(result)
{
	if (result!="") alert(result);
}

function LoggedIn(session_id,arg)
{
	sess_id=session_id;
	top.apploaded=true;
	var skin="";
	if (arg !=null && parseInt(arg)>0) skin=arg;
	tapout ='<table align="left" id="toptable" cellspacing="0" cellpadding="0"><tr><td><a target="_blank" href="https://countermail.com">';
	tapout +='<img class="toploggo" src="https://countermail.com/images/cm_logga_green.gif" border="0" align="middle" name="cmloggo"></a>';
	tapout +='</td><td width="15" class="toptablemid"></td><td width="83"><a title="Write a new message" href="javascript:void(0);" ';

	if (top.mitmprot==true)
	{
		tapout +=' onClick=\'top.comp_in_new("src/compose.php?newmessage=1",';
		tapout +=' "640","640","scrollbars=yes,menubar=no,location=no,resizable=yes,status=no");\'';
	}
	else
	{
		tapout +='onClick=\'javascript:compWin=window.open("compose.php?newmessage=1&CMID='+sess_id+'",';
		tapout +=' "_blank","width=640,height=640,scrollbars=yes,menubar=no,location=no,resizable=yes,status=no");\'';		
	}
	tapout +=' id="btnl'+skin+'">New mail</a></td>';
	tapout +='<td width="82"><a href="javascript:void(0)" onclick="top.DURL(\'/src/addressbook.php\',\'right\');" id="btnm'+skin+'">Contacts</a></td>';
	tapout +='<td width="82"><a href="javascript:void(0)" onclick="top.DURL(\'/src/search.php\',\'right\');" id="btnm'+skin+'">Search</a></td>';
	tapout +='<td width="82"><a href="javascript:void(0)" onclick="top.DURL(\'/src/folders.php\',\'right\');" id="btnm'+skin+'">Folders</a></td>';
	tapout +='<td width="82"><a href="javascript:void(0)" onclick="top.DURL(\'/plugins/calendar/calendar.php\',\'right\');" id="btnm'+skin+'">Calendar</a></td>';
	tapout +='<td width="82"><a href="javascript:void(0)" onclick="top.DURL(\'/src/options.php\',\'right\');" id="btnm'+skin+'">Settings</a></td>';
	tapout +='<td width="82"><a target="_blank" hr'+'ef="https://support.countermail.com/kb/index.php?CMID='+session_id+'" id="btnm'+skin+'">Support</a></td>';
	tapout +='<td width="83"><a target="_top" href="javascript:void(0);" onClick="javascript:Signout();" id="btnr'+skin+'">Logout</a></td>';
	tapout +='<td width="7"></td>';
	tapout +='</tr></table>';	
	document.getElementById("topholder").innerHTML=tapout;
	document.getElementById('topholder').style.visibility="visible";
	if (arg.length!=1)
	{
		window.setTimeout("top.DURL('/src/left_main.php','left');",250);
		window.setTimeout("top.DURL('/src/right_main.php','right');",600);
		top.prevURL="/src/right_main.php";
	}
}


</script>
