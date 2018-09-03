<html>
<head>
    <title>No Man's Sky – Looking For Group</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122816500-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-122816500-1');
    </script>


    <script type="text/javascript" src="nmslfg.js"></script>
   
    <link rel="stylesheet" type="text/css" href="reset.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
    <meta name="description" content="Find people to play No Man's Sky online with! Create a posting or message someone to play online with." />	
	<meta name="keywords" content="No Man's Sky, No Man's Sky LFG, Hello Games, Xbox One, PlayStation, PC, play with groups, LFG, Looking For Group"/>
		
</head>
<body>
<main>
    <h4>Unofficial</h4>
    <h1>No Man's Sky LFG</h1>
        <p style="margin-top: -20px; text-align: center">BETA</p>
    <div class="text">
        <p>This LFG (nmslfg.com) has no affiliation with Hello Games. "No Man's Sky" is a registered trademark of Hello Games. I'm just a fan who wanted to make something for this awesome community :)</p>
    </div>
    <form class="nmslfg">
        <input type="text" placeholder="Your GamerTag" id="username" maxlength="30"><br />
    
        <div class="platforms">
            <input type="radio" name="platform" id="psn" value="psn">
            <label for="psn">PlayStation 4</label>

            <input type="radio" name="platform" id="xbox" value="xbox">
            <label for="xbox">XBoxOne</label>

            <input type="radio" name="platform" id="pc" value="pc">
            <label for="pc">PC</label>


            <input type="radio" name="platform" id="hiddenradio" value="none" hidden checked>
 
        </div>
    <div id="microphone">
        <input type="checkbox" name="mic" id="mic">
        <label for="mic">I have a mic!</label>
    </div>  
        <? /*<!-- <input type="checkbox" name="adult" id="adult"> Other adults only. --> */ ?>
    <div id="activity-select">
        Activity: 
        <select name="activity" id="activity">
            <option value="Anything">Anything</option>
            <option value="Missions">Missions</option>
            <option value="Base Building">Base Building</option>
            <option value="Story">Story</option>
            <option value="Battle">Battle</option>
            <option value="Explore">Explore</option>
        </select>
    </div>
    <div class="gametype">
        <input type="radio" name="gametype" id="creative" value="Creative">
        <label for="creative">Creative</label>
        <input type="radio" name="gametype" id="normal" value="Normal">
        <label for="normal">Normal</label>
        <input type="radio" name="gametype" id="survival" value="Survival">
        <label for="survival">Survival</label>
        <input type="radio" name="gametype" id="permadeath" value="Permadeath">
        <label for="permadeath">Permadeath</label>

        <input type="radio" name="gametype" value="none" hidden checked> 
    </div>
    <?/*<!-- <div class="g-recaptcha" data-sitekey="6Ld2k2UUAAAAAGcP0to5nf6NlYEZF5Bwh7A8bOwc"></div>  -->*/?>
    <div class="text" style="margin-top: 20px;">
        <p>By posting on this site, you agree to the <a href="disclaimer.php">disclaimer</a>.</p>
        <p>Better features of this LFG are still in development. If there is a bug, or you have a suggestion, <a href="contact.php">contact me</a>.<br />Profanity is filtered. Postings are automatically deleted after 1 hour.</p>
    </div>
    <button id="submit">Submit</button>
    
    <input type="reset" id="reset">
    </form>
    
    <div id="result">
    </div>

    <div id="listings">
    </div>
</main>
</body>
</html>