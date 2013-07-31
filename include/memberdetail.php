<?php session_start();
?>
<script>
    $(document).ready(function() {
        $('#viewDetail').hide();
        //        oTable = $('#example').dataTable({
        //        });
            
        var Data = "task=loadalluser";
        $.ajax({
            url:'taskprocess.php',
            data:Data,
            type:'POST',
            dataType:'json',
            cache:false,
            success: function(output){
                if(output[0][0] !=0){
                    oTable.fnClearTable();
                        
                    for(var i =0; i < output.length;i++){
                        oTable.fnAddData([i+1,output[i][1],output[i][2],output[i][3],
                            "<button type='button' onclick='ShowUserDetails("+output[i][0]+")'>Show Details</button>"
                        ]);
                    }
                }
            }
        });
    });
</script>
<div id="container" class="container">
    <div id="viewDetail" style="display: none">
        <?php include_once 'view.php'; ?>
        <center><button id="editButton" name="editButton">Edit Data</button></center>
    </div>
    <div id="editDetail" style="display: nones">
        <form id="editForm_E" method="POST" onsubmit="return UpdateRecord()">
            <?php include 'editrecord.php'; ?>
            <div class="button" id="editButton" align="center">
                <button id="submit_E" type="submit" > Update </button>
                <button type="reset" id="cancel_E" onclick="CancelUpdate()"> Cancel </button>
            </div>
        </form>
    </div>
    <div><span></span></div>

    <div id="searchRecord" class="searcgBox">
        <form id="searchForm" method="POST" onsubmit="return SearchRecord()" action="test.php">
            <div class="searchDetail" style="margin-left: 2%">
                <?php include_once 'searchform.php'; ?>
                <div class="button" id="searchButton" align="center">
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