<?php

include './header.php';
if (isset($_POST['mystyle'])) {
    $theme = mysqli_real_escape_string($GLOBALS['conn'], $_POST['theme']);
    mysqli_query($GLOBALS['conn'], "UPDATE husers SET h_style = '".$theme."'");
}
?>
    <title>Theme Color Options [ IHAP ]</title>
    <div class="mdl-grid mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
        	<div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        		<style type="text/css">
                .cholder {
                    display: inline-flex;
                    }

                .ccolor {
                    height: 30px;
                    width: 50px;
                    border-radius: 8%;
                    border: white 1px solid;
                }

                </style>

                <h4>Select Theme</h4>
                <form name="themeForm" method="POST" action="">
                    <div class="input-field inline">
                        <input type="radio" id="zahra" name="theme" value="zahra"/>
                        <label for="zahra"><p class="cholder" for="zahra">
                            <span class="ccolor mdl-color--teal"></span><span class="ccolor csec mdl-color--red"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="zahra">Zahra's Fade</div>

                    <div class="input-field inline">
                        <input type="radio" id="love" name="theme" value="love"/>
                        <label for="love"><p class="cholder" for="love">
                            <span class="ccolor mdl-color--cyan"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="love">Love, Olive</div>

                    <div class="input-field inline">
                        <input type="radio" id="wizz" name="theme" value="wizz"/>
                        <label for="wizz"><p class="cholder" for="wizz">
                            <span class="ccolor mdl-color--black"></span><span class="ccolor csec mdl-color--yellow"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wizz">The Wizz</div>

                    <div class="input-field inline">
                        <input type="radio" id="pint" name="theme" value="pint"/>
                        <label for="pint"><p class="cholder" for="pint">
                            <span class="ccolor mdl-color--blue"></span><span class="ccolor csec mdl-color--pink"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="pint">The Bluepint</div>

                    <div class="input-field inline">
                        <input type="radio" id="stack" name="theme" value="stack"/>
                        <label for="stack"><p class="cholder" for="stack">
                            <span class="ccolor mdl-color--grey"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Needle in a Haystack</div>

                                        <div class="input-field inline">
                        <input type="radio" id="indie" name="theme" value="indie"/>
                        <label for="indie"><p class="cholder" for="indie">
                            <span class="ccolor mdl-color--indigo"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Indie</div>

                                        <div class="input-field inline">
                        <input type="radio" id="haze" name="theme" value="haze"/>
                        <label for="haze"><p class="cholder" for="haze">
                            <span class="ccolor mdl-color--purple"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Purple Haze</div>

                    <div class="input-field inline">
                        <input type="radio" id="stack" name="theme" value="stack"/>
                        <label for="stack"><p class="cholder" for="stack">
                            <span class="ccolor mdl-color--lime"></span><span class="ccolor csec mdl-color--brown"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Needle in a Haystack</div>

                     <div class="input-field inline">
                    <input type="radio" id="indie" name="theme" value="indie"/>
                    <label for="indie"><p class="cholder" for="indie">
                        <span class="ccolor mdl-color--red"></span><span class="ccolor csec mdl-color--brown"></span>
                    </p></label>
                    </div><div class="mdl-tooltip" for="stack">Indie</div>

                    <div class="input-field inline">
                    <input type="radio" id="haze" name="theme" value="haze"/>
                    <label for="haze"><p class="cholder" for="haze">
                        <span class="ccolor mdl-color--green"></span><span class="ccolor csec mdl-color--brown"></span>
                    </p></label>
                    </div><div class="mdl-tooltip" for="stack">Purple Haze</div>
                    <div class="input-field">
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="mystyle" style="float:right;"><i class="material-icons">save</i></button>
                </div>
                </form>

        	</div>
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
                <h4>Custom Styling</h4>

            <form name="themeForm" method="POST" action="" class="">
            <div class="input-field">
                <input id="primary" type="text" name="primary">
                <label for="primary" data-error="wrong" data-success="right" class="center-align">Primary Color</label>
            </div>

            <div class="input-field">
                <input id="secondary" type="text" name="secondary">
                <label for="secondary" data-error="wrong" data-success="right" class="center-align">Accent Color </label>
            </div>

            <div class="input-field">
                <input id="textp" type="text" name="textp">
                <label for="textp" data-error="wrong" data-success="right" class="center-align">Text Primary Color </label>
            </div>

            <div class="input-field">
                <input id="texts" type="text" name="texts">
                <label for="texts" data-error="wrong" data-success="right" class="center-align">Text Secondary Color </label>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" name="custom" style="float:right;"><i class="material-icons">save</i></button>
            </form>
        </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
           tips in accordion
        </div>
    </div>
<?php
include './footer.php';
