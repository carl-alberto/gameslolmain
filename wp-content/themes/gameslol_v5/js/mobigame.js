const SOCKET_CHANNEL = "ws://localhost:60202";

function checkMobiGameExists(callback) {
    sendMsgToServer('check', '', callback);
}

function runGame(jsonUrl, packageName) {
    // Support of previous AegLauncher version - pass only json Url for game
    if (!packageName) {
        sendMsgToServer('rungame', jsonUrl);
        return;
    }

    // Pass json Url for common games and game package name
    sendMsgToServer('rungame', '{"jsonUrl":"' + jsonUrl + '","packageName":"' + packageName + '"}')
}

function sendMsgToServer(command, message, callback) {
    if (!("WebSocket" in window)) {
        return window.error();
    }

    var socket = new WebSocket("ws://localhost:60202" + '/' + command);
	
    socket.onopen = function () {
        socket.send(message);
    };
	socket.onclose = function (event) {
        console.log("WebSocket Error Code: " + event.code);
    };
    if (callback) {
        socket.onmessage = function (evt) {
            var received_msg = evt.data;

            try {
                // JSON responce is recived from AegLauncher
                let resp = JSON.parse(received_msg);

                if (!resp || typeof resp !== "object") {
                    throw "Response is not valid JSON";
                }

                // Pass is MobiGame installed and installed version
                callback(resp.installed, resp.version);
            } catch (err) {
                // We pass response to callback for backward compatibility
                // because plain string "true" can be receved from old version of AegLauncher when MobiGame is installed
                // but in this case version is unknown
                callback(received_msg);
            }
        };
    }
}
