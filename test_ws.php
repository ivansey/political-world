<script type="text/javascript">
function add(text) {
	document.forms[0].b.value=text+"\n"+document.forms[0].b.value;
}

if("WebSocket" in window) {
	var timer;
	var ws=new WebSocket("ws://v92707.hosted-by-vdsina.ru:8047/myws");
	ws.onopen=function() {
		add('Connection opened');
		timer=window.setInterval(function() {
			var date = new Date();
			var message='ping at '+date.getSeconds();
			ws.send(message);
			add('Client sent message "'+message+'"');
		}, 30000);
    };

    ws.onmessage=function(evt) {
		add('Message from server: "'+evt.data+'"');
    };
    
    ws.onclose=function() {
		add('Connection closed');
        window.clearTimeout(timer);
    };
} else {
    alert("Your browser doesn't support WebSocket");
}
</script>
<form>
<textarea name="b" style="width:100%;height:100%"/></textarea>
</form>
