<style>
    .resibo {
        display: grid;
        justify-content: center;
        text-align: center;
        font-family: monospace;
        width: 300px;
        margin: auto;
    }
    .span {
        margin-top: 1%;
        margin-bottom: 1%;
    }
    .date-time {
        gap: 10%;
        margin-top: 5px;
        font-weight: bold;
    }
</style>

<div class="resibo">
    <p class="span">=======================</p>
    <span>Store: 3KC </span>
    <span>Address: Sandoval St Silay City </span>
    <span>Contact No.: 09307725683</span>
    <span class="date-time">

        <?php
            date_default_timezone_set('Asia/Manila');
            $date = date("F j, Y");
            $time = date("g:i A");
            echo $date . " " . $time;
        ?>
    </span>
    <p class="span">=======================</p>
</div>
     <!-- ang php code info -->
<br><br><br><br><br><br><br><br><br><br><br>


 <div class="resibo">
 <p class="span">=======================</p>
 <span>This is Not a Official Reciept</span>
 <span>Thank You Come again!! </span>
 <p class="span">=======================</p>
 </div>

