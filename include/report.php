<?php
session_start();
include_once 'sql_connection.php';
?>
<div class="container">
    <div id="searchRecord" class="searcgBox">
        <form id="reportForm" method="POST" onsubmit="return ReportData()" action="test.php">
            <div class="searchDetail" style="margin-left: 2%">
                <?php include_once 'searchform.php'; ?>
                <div class="button" id="buttons" align="center">
                    <button type="submit">Search Result</button>
                </div>
            </div>
        </form> 
    </div>
    <div id="demo" >
        <table id="example" class="display" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th style="width: 50px">S.N.</th>
                    <th >Name</th>
                    <th style="width: 160px">Role Type</th>    
                    <th style="width: 150px">Account Type</th>
                    <th style="width: 150px">View Details</th>
                </tr>
            </thead>
            <tbody >
            </tbody>        
        </table>
    </div>
</div>