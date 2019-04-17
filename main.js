// https://developer.openstack.org/api-guide/quick-start/api-quick-start.html
window.addEventListener('DOMContentLoaded', function() {
    let COMPUTE_API = "http://172.20.2.165/compute/v2.1";
    let USERNAME = "";
    let PASSWORD = "";

    document.getElementById("submitButton").addEventListener("click", function(event) {
        event.preventDefault();
        console.log('calling');
        let TOKEN_API = "http://172.20.2.165/identity/v3/auth/tokens";

        $.ajax({
            type: "POST",
            url: TOKEN_API,
            data: {
              username: "admin",
              password: "secret"
            },
            success: function(data) {
              console.log(data);
              //do something when request is successfull
            },
            dataType: "json"
          });
    });

}, true);

/*
curl -i \
  -H "Content-Type: application/json" \
  -d '
{ "auth": {
    "identity": {
      "methods": ["password"],
      "password": {
        "user": {
          "name": "admin",
          "domain": { "id": "default" },
          "password": "secret"
        }
      }
    }
  }
}' \
  "http://172.20.2.165/identity/v3/auth/tokens" ; echo

*/