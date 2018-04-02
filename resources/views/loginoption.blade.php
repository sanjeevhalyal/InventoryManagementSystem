<style>

    .modalDialog {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:1;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: auto;
    }

    .modalDialog > div {
        width: 400px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
    }
    #inner {
        width: 100%;
        margin: 0 auto;
        border-radius:5px;
    }

</style>



<div id="openModal" class="modalDialog">
    <div>
        <h2>NUI galway Socs Inventory Site</h2>
        <p> Site requires you to login before use.</p>
        <p>Please login using NUI galway unveirsity Mail ID</p>

        <?php

        $image=asset('img/microsoftlogo.png');
        ?>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <a id="link"  href="{{url('/oauth')}}">
        <div id="inner" class="w3-button w3-blue">

            <img  width="40px" height="40px" src="{{$image}}" >
             Click to Login using Microsoft
        </div>
        </a>
    </div>
</div>
