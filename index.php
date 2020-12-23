<html>

<head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>

		$(document).ready(function() {
			var websocket = new WebSocket("ws://localhost:8090/php-socket.php");
			
			websocket.onopen = function(event) {
				console.log("connection established");
			}

			websocket.onmessage = function(event) {
				var Data = JSON.parse(event.data);
				$('#data-box').append(`<p>Update: ${Data.data}</p>`);

				console.log(Data);
			};

			websocket.onerror = function(event) {
				console.log("error");
			};
			websocket.onclose = function(event) {
				console.log("connection closed");
			};

			 i=1;

			$('#frmChat').on("submit", function(event) {
				event.preventDefault();
				var messageJSON = {
					data : $('#data').val(),
					
				};
				websocket.send(JSON.stringify(messageJSON));
			});
		});
	</script>
</head>

<body>
	<form name="frmChat" id="frmChat">
		<div id="data-box"></div>
		<input type="text" name="data" id="data" placeholder="data" class="chat-input data" required />
		<input type="submit" id="btnSend" name="send-data" value="Send">
	</form>
</body>

</html>