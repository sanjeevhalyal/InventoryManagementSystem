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
        width: 300px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
    }
    #inner {
        width: 100%;
        display: flex;
        justify-content: center;

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

        <div id="inner" >
            <a id="link"  href="{{url('/oauth')}}">
            <button type="button" class="btn btn-light" ><img  width="40px" height="40px" src="https://use.fontawesome.com/releases/v5.0.9/svgs/brands/windows.svg" >
                <span style="color:black">Click to Login using Microsoft</span></button>
            </a>
        </div>


    </div>
</div>
