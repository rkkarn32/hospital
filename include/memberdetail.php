<?php session_start();
?>
<div id="container" class="container">
    <?php include_once 'view.php'; ?>
    <div><span></span></div>
    <?php include_once 'searchform.php'; ?>
    
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