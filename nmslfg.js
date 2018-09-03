document.addEventListener('DOMContentLoaded', function() {
    
    // submit a posting
    function submitLFG(username, platform, activity, mic, gametype) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                loadListings('/loadListings.php', "listings");
                console.log(xhr.response);
                document.getElementById('result').innerHTML = xhr.response; 
            } 
        }
        xhr.open("POST", "submitLFG.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username="+username+"&platform="+platform+"&activity="+activity+"&mic="+mic+"&gametype="+gametype);
    }

    //load the listings
    function loadListings(url,target){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.setRequestHeader('cache-control', 'no-cache, must-revalidate, post-check=0, pre-check=0');
        xhr.setRequestHeader('cache-control', 'max-age=0');
        xhr.setRequestHeader('expires', '0');
        xhr.setRequestHeader('expires', 'Tue, 01 Jan 1980 1:00:00 GMT');
        xhr.setRequestHeader('pragma', 'no-cache');
        xhr.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                var html = this.responseText;
                document.getElementById(target).innerHTML = html;
            }
        }
        xhr.send();
    }

    loadListings('/loadListings.php', "listings");

    document.getElementById('submit').addEventListener("click", function(e){
        e.preventDefault;
        document.getElementById("submit").disabled = true;
        setTimeout(function(){
            document.getElementById("submit").disabled = false;  
        }, 3000);
        var username = document.getElementById('username').value;
        var platform = document.querySelector('input[name="platform"]:checked').value;
        var activity = document.getElementById("activity").value;
        var mic = document.getElementById('mic').checked;
        var gametype = document.querySelector('input[name="gametype"]:checked').value;

        if (username !== "" && platform !== "none" && activity !== "undefined" && gametype !== "none") {
            submitLFG(username, platform, activity, mic, gametype);
            document.getElementById("reset").click();
        }
        else {
            alert("Complete the fields.");
        }
        
    })
});