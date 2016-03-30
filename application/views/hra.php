<!DOCTYPE HTML>
<html>
<header>
<SCRIPT type="text/javascript">
    //window.history.forward();
    //function noBack() { window.history.forward(); }
	//window.onbeforeunload = function() { return "We will not be able to save your answers if you exit. Do you wish to proceed?"; };
      
  window.onbeforeunload = function (e) {
            var e = e || window.event;
            var msg = "We will not be able to save your answers if you exit. Do you wish to proceed?"

            // For IE and Firefox
            if (e) {
                e.returnValue = msg;
            }

            // For Safari / chrome
            return msg;
         };
     
</SCRIPT>
<style>
*{margin:0;padding:0}
html, body {height:100%;width:100%;overflow:hidden}
table {height:100%;width:100%;table-layout:static;border-collapse:collapse}
iframe {height:100%;width:100%}

.header {border-bottom:1px solid #000}
.content {height:100%}
</style>
</header>
    
<body >
    <a href="http://philcare.com.ph/gateway/home/logout">Logout</a>
    
    <iframe id="ytplayer" src="https://apps.philcare.com.ph/OneSystemOnline/MemberPortal/HRAAgreemetAndCondition.aspx?CertNo=<?php echo $certno ?>" ></iframe>
    
</body>
</html>